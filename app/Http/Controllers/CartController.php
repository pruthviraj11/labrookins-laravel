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
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    return view('content/apps/checkout/index', compact('cart', 'home_banner'));
  }

 public function place_order(Request $request)
{
    $cart = session()->get('cart', []);
    $guestId = session('guest_id');

    // calculate total
    $grandTotal = 0;
    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }
    $total = $grandTotal + 8.95; // shipping

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

    // check if guest_id already has pending order
    $existingOrder = OrderDetail::where('guest_id', $guestId)
        ->where('order_type', 'Pending')
        ->first();

    if ($existingOrder) {
        // update existing order
        $existingOrder->update($orderData);
        $order = $existingOrder;
    } else {
        // insert new order
        $order = OrderDetail::create($orderData);
    }

    // clear cart
    // session()->forget('cart');
    // session()->forget('guest_id');


    $home_banner = Banner::where('is_page', 1)
        ->where('page', 'online_store')
        ->where('status', 1)
        ->first();

    return view('content/apps/place_order/index', compact('order', 'home_banner'));
}

}
