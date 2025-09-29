<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentController extends Controller
{
  public function processPayment(Request $request, OrderDetail $order)
  {
    // dd($request->all());
    $request->validate([
      'card_number' => 'required|digits:16',
      'exp_month' => 'required|digits:2',
      'exp_year' => 'required|digits:4',
      'cvc' => 'required|digits_between:3,4',
    ]);
    // dd($request->all());

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
    $response = $controller->executeWithApiResponse(
      env('AUTHORIZE_NET_ENV') === 'production'
      ? \net\authorize\api\constants\ANetEnvironment::PRODUCTION
      : \net\authorize\api\constants\ANetEnvironment::SANDBOX
    );

    if ($response != null && $response->getMessages()->getResultCode() == "Ok") {
      $tResponse = $response->getTransactionResponse();
      $responseDesc = array("1" => "Approved", "2" => "Declined", "3" => "Error", "4" => "Held for Review");

      if ($tResponse != null && $tResponse->getResponseCode() == "1") {
        // SUCCESS
        $cc_brand = $tResponse->getaccountType();
        $cc_number = $tResponse->getaccountNumber();
        $transaction_id = $tResponse->getTransId();
        $response_code = $tResponse->getResponseCode();
        $response_desc = $responseDesc[$response_code];


        $order->update([
          'card_type' => $cc_brand,
          'card_number' => $cc_number,
          'transaction_id' => $tResponse->getTransId(),
          'auth_code' => $tResponse->getAuthCode(),
          'response_code' => $tResponse->getResponseCode(),
          'response_desc' => $response_desc,
          'payment_response' => $tResponse->getMessages()[0]->getDescription(),
          'order_type' => 'Completed',

        ]);

        session()->forget('cart');
        session()->forget('guest_id');
        return redirect()->route('thank_you.page')->with('success', 'Payment successful! Transaction ID: ' . $tResponse->getTransId());
      } else {
        return redirect()->route('failure.page')->with('errors','');
        // return back()->withErrors(['payment' => 'Payment failed: ' . $tResponse->getErrors()[0]->getErrorText()]);
      }
    } else {
      $error = $response->getMessages()->getMessage()[0]->getText() ?? 'Unknown error';
      return back()->withErrors(['payment' => 'Payment failed: ' . $error]);
    }
  }
}
