<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentController extends Controller
{
  public function processPayment(Request $request, $orderId)
  {
    // ✅ Use withTrashed() so soft-deleted orders are still found (prevents 404)
    $order = OrderDetail::withTrashed()->findOrFail($orderId);

    // If order was soft-deleted, restore it so payment can proceed
    if ($order->trashed()) {
      $order->restore();
    }

    $request->validate([
      'card_number' => 'required|digits:16',
      'exp_month'   => 'required|digits:2',
      'exp_year'    => 'required|digits:4',
      'cvc'         => 'required|digits_between:3,4',
    ]);

    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
    $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

    $refId = 'ref' . time();

    // Create credit card object
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($request->card_number);
    $creditCard->setExpirationDate($request->exp_year . "-" . $request->exp_month);
    $creditCard->setCardCode($request->cvc);

    $payment = new AnetAPI\PaymentType();
    $payment->setCreditCard($creditCard);

    // Order info
    $orderInfo = new AnetAPI\OrderType();
    $orderInfo->setInvoiceNumber("INV-" . $order->id);
    $orderInfo->setDescription("Order payment for #" . $order->id);

    // Transaction Request
    $transactionRequest = new AnetAPI\TransactionRequestType();
    $transactionRequest->setTransactionType("authCaptureTransaction");
    $transactionRequest->setAmount($order->total_amount);
    $transactionRequest->setPayment($payment);
    $transactionRequest->setOrder($orderInfo);

    $requestObj = new AnetAPI\CreateTransactionRequest();
    $requestObj->setMerchantAuthentication($merchantAuthentication);
    $requestObj->setRefId($refId);
    $requestObj->setTransactionRequest($transactionRequest);

    $controller = new AnetController\CreateTransactionController($requestObj);

    $environment = env('AUTHORIZE_NET_ENV') === 'production'
      ? \net\authorize\api\constants\ANetEnvironment::PRODUCTION
      : \net\authorize\api\constants\ANetEnvironment::SANDBOX;

    $response = $controller->executeWithApiResponse($environment);

    // ✅ FIX 1: Guard against null response (network/timeout issue)
    if ($response === null) {
      Log::error('Authorize.Net: Null response received for Order #' . $order->id, [
        'order_id' => $order->id,
        'amount'   => $order->total_amount,
      ]);
      return back()->withErrors(['payment' => 'Payment service is currently unavailable. Please try again shortly.']);
    }

    if ($response->getMessages()->getResultCode() == "Ok") {
      $tResponse = $response->getTransactionResponse();
      $responseDesc = ["1" => "Approved", "2" => "Declined", "3" => "Error", "4" => "Held for Review"];

      if ($tResponse != null && $tResponse->getResponseCode() == "1") {
        // ✅ SUCCESS
        $cc_brand     = $tResponse->getaccountType();
        $cc_number    = $tResponse->getaccountNumber();
        $response_code = $tResponse->getResponseCode();
        $response_desc = $responseDesc[$response_code] ?? 'Approved';

        // ✅ FIX 2: tResponse->getMessages() returns a plain array in Authorize.Net SDK
        $payment_response_text = '';
        try {
          $msgs = $tResponse->getMessages();
          if (is_array($msgs) && count($msgs) > 0) {
            // TransactionResponseType::getMessages() returns array of message objects directly
            $payment_response_text = method_exists($msgs[0], 'getDescription')
              ? ($msgs[0]->getDescription() ?? '')
              : '';
          } elseif (is_object($msgs) && method_exists($msgs, 'getMessage')) {
            $msgList = $msgs->getMessage();
            if (is_array($msgList) && count($msgList) > 0) {
              $payment_response_text = $msgList[0]->getDescription() ?? '';
            }
          }
        } catch (\Throwable $e) {
          Log::warning('Authorize.Net: Could not read payment response message', ['error' => $e->getMessage()]);
        }

        $order->update([
          'card_type'        => $cc_brand,
          'card_number'      => $cc_number,
          'transaction_id'   => $tResponse->getTransId(),
          'auth_code'        => $tResponse->getAuthCode(),
          'response_code'    => $response_code,
          'response_desc'    => $response_desc,
          'payment_response' => $payment_response_text,
          'order_type'       => 'Completed',
        ]);

        Log::info('Authorize.Net: Payment SUCCESS for Order #' . $order->id, [
          'transaction_id' => $tResponse->getTransId(),
          'amount'         => $order->total_amount,
        ]);

        $cartItems = session()->get('cart', []);

        // Initialize totals
        $subtotal     = 0;
        $taxRate      = 0.10;
        $isAllDigital = true;

        foreach ($cartItems as $item) {
          $subtotal += $item['price'] * $item['quantity'];
          $product = \App\Models\Product::find($item['id']);
          if ($product && $product->product_digital !== 'yes') {
            $isAllDigital = false;
          }
        }

        $shipping = $isAllDigital ? 0.00 : 8.95;
        $tax      = $subtotal * $taxRate;
        $total    = $subtotal + $tax + $shipping;

        $digitalProducts = [];
        foreach ($cartItems as $productId => $item) {
          $product = \App\Models\Product::find($productId);
          if ($product && $product->product_digital === 'yes' && $product->download_document) {
            $digitalProducts[] = [
              'name' => $product->product_name,
              'url'  => asset('storage/products/documents/' . $product->download_document),
            ];
          }
        }

        $setting = Setting::first();
        \Mail::to($setting->admin_order_email)->send(new \App\Mail\AdminOrderNotification($order, $cartItems, $subtotal, $tax, $shipping, $total));
        \Mail::to($order->email)->send(new \App\Mail\OrderPaidNotification($order, $digitalProducts, $cartItems, $subtotal, $tax, $shipping, $total));

        session()->forget('cart');
        session()->forget('guest_id');

        return redirect()->route('thank_you.page')->with('success', 'Payment successful! Transaction ID: ' . $tResponse->getTransId());

      } else {
        // ✅ FIX 3: Properly handle decline with null-safe error reading
        $errorMsg = 'Your payment was declined.';
        try {
          if ($tResponse && $tResponse->getErrors() && count($tResponse->getErrors()) > 0) {
            $errorMsg = $tResponse->getErrors()[0]->getErrorText() ?? $errorMsg;
          }
        } catch (\Exception $e) {
          Log::warning('Authorize.Net: Could not read decline error', ['error' => $e->getMessage()]);
        }

        Log::warning('Authorize.Net: Payment DECLINED for Order #' . $order->id, [
          'error_message' => $errorMsg,
          'order_id'      => $order->id,
        ]);

        return redirect()->route('failure.page')->with('error', $errorMsg);
      }

    } else {
      // ✅ FIX 4: Null-safe API-level error reading
      $errorMsg = 'Unknown payment error.';
      try {
        $msgs = $response->getMessages()->getMessage();
        if ($msgs && count($msgs) > 0) {
          $errorMsg = $msgs[0]->getText() ?? $errorMsg;
        }
      } catch (\Exception $e) {
        Log::error('Authorize.Net: Could not read API error message', ['error' => $e->getMessage()]);
      }

      Log::error('Authorize.Net: API ERROR for Order #' . $order->id, [
        'message'  => $errorMsg,
        'order_id' => $order->id,
      ]);

      return back()->withErrors(['payment' => 'Payment failed: ' . $errorMsg]);
    }
  }

  public function online_donation_authorize(Request $request)
  {
    $data = [
      'page_name' => 'Donation',
      'page_title' => 'Donation',
      'page_url' => 'Donation',
      'item_name' => 'donation',
      'invoice' => date('YmdHis'), // current timestamp
    ];

    // Return view (resources/views/authorize.blade.php)
    return view('content/apps/authorize/authorize', $data);
  }
}
