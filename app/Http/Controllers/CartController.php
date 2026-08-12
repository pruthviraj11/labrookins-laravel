<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product; // or Book if you keep them in Book model
use Carbon\Carbon;

class CartController extends Controller
{
  public function index()
  {
    $cart = session()->get('cart', []);
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    return view('content/apps/cart/index', compact('cart', 'home_banner'));
  }

  public function add(Request $request)
  {
    // dd($request->all());
    $product = Product::findOrFail($request->pid);

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
      $cart[$product->id]['quantity']++;
    } else {
      $cart[$product->id] = [
        "id" => $product->id,
        "name" => $product->product_name,
        "price" => $product->product_price,
        "quantity" => 1,
        "image" => $product->product_image,
      ];
    }

    session()->put('cart', $cart);


    return response()->json([
      'status' => 'success',
      'message' => $product->product_name . ' added to cart!',
      'cart_count' => count($cart)
    ]);
  }

  public function remove($id)
  {
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
      unset($cart[$id]);
      session()->put('cart', $cart);
    }
    return redirect()->route('cart.index')->with('success', 'Item removed');
  }

  public function update(Request $request, $id)
  {
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
      $cart[$id]['quantity'] = $request->quantity;
      session()->put('cart', $cart);
    }
    return redirect()->route('cart.index');
  }

  public function checkout()
  {
    $cart = session()->get('cart', []);
    // dd($cart);
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    return view('content/apps/checkout/index', compact('cart', 'home_banner'));
  }

  public function place_order(Request $request)
  {
    $cart = session()->get('cart', []);

    $guestId = session('guest_id');

    $rules = [
      'fname' => 'required|string|max:255',
      'lname' => 'required|string|max:255',
      'country' => 'required|string|max:255',
      'street_address1' => 'required|string|max:255',
      'city' => 'required|string|max:255',
      'mobile' => 'required|string|max:20',
      'email' => 'required|email|max:255',
    ];

    // Step 2: Add conditional rules if "Ship to a different address?" is checked
    if ($request->ship_to_different_address == "on") {
      $rules = array_merge($rules, [
        'd_fname' => 'required|string|max:255',
        'd_lname' => 'required|string|max:255',
        'd_country' => 'required|string|max:255',
        'd_street_address1' => 'required|string|max:255',
        'd_city' => 'required|string|max:255',
        'd_mobile' => 'required|string|max:20',
        'd_email' => 'required|email|max:255',
      ]);
    }
    $validated = $request->validate($rules);
    // calculate total

    // $grandTotal = 0;
    // foreach ($cart as $item) {
    //   $grandTotal += $item['price'] * $item['quantity'];
    // }
    // $tax = $grandTotal * 0.10;
    // $total = $grandTotal + $tax + 8.95;
    $grandTotal = 0;
    $isDigitalOnly = true;

    if (!empty($cart)) {
      // dd($cart);
      // $productNames = collect($cart)->pluck('name')->toArray();
      // $products = Product::whereIn('product_name', $productNames)->pluck('product_digital', 'product_name')->toArray();
      $productNames = collect($cart)->pluck('id')->toArray();
      $products = Product::whereIn('id', $productNames)->pluck('product_digital', 'product_name')->toArray();
      foreach ($cart as $item) {
        $total = $item['price'] * $item['quantity'];
        $grandTotal += $total;

        $isDigital = $products[$item['name']] ?? 'no';
        if ($isDigital !== 'yes') {
          $isDigitalOnly = false;
        }
      }
    }

    $shippingCharge = $isDigitalOnly ? 0 : 8.95;
    $tax = $grandTotal * 0.10;
    $total = $grandTotal + $tax + $shippingCharge;

    // prepare order data
    $orderData = [
      'guest_id' => $guestId,
      'total_amount' => $total,

      'fname' => $request->fname,
      'lname' => $request->lname,
      'company_name' => $request->company_name,
      'country' => $request->country,
      'street_address1' => $request->street_address1,
      'street_address2' => $request->street_address2,
      'city' => $request->city,
      'state' => $request->state,
      'zip_code' => $request->zip_code,
      'mobile' => $request->mobile,
      'email' => $request->email,
      'order_notes' => $request->order_notes,

      'd_fname' => $request->d_fname,
      'd_lname' => $request->d_lname,
      'd_company_name' => $request->d_company_name,
      'd_country' => $request->d_country,
      'd_street_address1' => $request->d_street_address1,
      'd_street_address2' => $request->d_street_address2,
      'd_city' => $request->d_city,
      'd_state' => $request->d_state,
      'd_zip_code' => $request->d_zip_code,
      'd_mobile' => $request->d_mobile,
      'd_email' => $request->d_email,

      'order_type' => 'Pending',
      'ship_to_different_address' => $request->has('ship_to_different_address') ? 1 : 0,
      'delivered' => 0,
      'date_and_time' => Carbon::now(),
    ];

    // check if guest_id already has pending order (including soft-deleted ones)
    $existingOrder = OrderDetail::withTrashed()
      ->where('guest_id', $guestId)
      ->where('order_type', 'Pending')
      ->latest()
      ->first();

    if ($existingOrder) {
      // restore if soft-deleted, then update
      if ($existingOrder->trashed()) {
        $existingOrder->restore();
      }
      $existingOrder->update($orderData);
      $order = $existingOrder;
    } else {
      // insert new order
      $order = OrderDetail::create($orderData);
    }


    // ✅ Store data in temp_addcart table
    foreach ($cart as $item) {

      \App\Models\TempAddcart::create([
        'encrypted_id' => "", // or your own encryption logic
        'guest_id' => $guestId,
        'product_id' => $item['id'] ?? null,
        'quntity' => $item['quantity'],
        'price' => $item['price'],
        'totalAmount' => $item['price'] * $item['quantity'],
        'date' => Carbon::now()->toDateString(),
        'order_status' => 'pending',
        'order_date' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }


    // ✅ PRG Pattern: Redirect to GET route to prevent refresh errors
    return redirect()->route('payment.form', $order->id);
  }

  // ✅ GET route handler for payment form (prevents refresh MethodNotAllowed error)
  public function showPaymentForm($orderId)
  {
    $order = OrderDetail::withTrashed()->findOrFail($orderId);

    // Restore if soft-deleted
    if ($order->trashed()) {
      $order->restore();
    }

    $home_banner = Banner::where('is_page', 1)
      ->where('page', 'online_store')
      ->where('status', 1)
      ->first();

    return view('content/apps/place_order/index', compact('order', 'home_banner'));
  }

  public function thank_you()
  {
    return view('content/apps/thank_you/thank_you');
  }

  public function failure()
  {
    return view('content/apps/failure/failure');
  }

}
