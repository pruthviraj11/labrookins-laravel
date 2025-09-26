<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product; // or Book if you keep them in Book model

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

   public function place_order()
  {
    $cart = session()->get('cart', []);
    $home_banner = Banner::where('is_page', 1)->where('page', 'online_store')->where('status', 1)->first();

    return view('content/apps/place_order/index', compact('cart', 'home_banner'));
  }
}
