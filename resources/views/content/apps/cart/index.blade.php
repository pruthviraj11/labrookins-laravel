@extends('layouts.homeLayout')

@section('title', 'Your Cart | L.A. BROOKINS MINISTRIES')

@push('styles')
    <style>
        .cart-container {
            margin-top: 50px;
        }

        .cart-img {
            max-height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')

    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            @if (!empty($home_banner) && !empty($home_banner->image))
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid"
                                    alt="{{ $home_banner->title ?? 'Books Banner' }}" />
                            @else
                                <img src="{{ asset('home/assets/img/books_banner.png') }}" class="img-fluid"
                                    alt="Books Banner" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container cart-container">
        <h2 class="mb-4 text-center"><i class="bi bi-cart4"></i> Your Shopping Cart</h2>

        @if (session('cart') && count(session('cart')) > 0)
            <div class="row">
                {{-- Cart Items --}}
                <div class="col-lg-8">
                    @php $grandTotal = 0; @endphp
                    @foreach (session('cart') as $id => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp

                        <div class="card mb-3 shadow-sm">
                            <div class="row g-0 align-items-center p-3">
                                <div class="col-md-3 text-center">
                                    @php
                                        $imagePath = 'storage/products/' . $item['image'];
                                    @endphp
                                    @if (!empty($item['image']) && file_exists(public_path($imagePath)))
                                        <img src="{{ asset($imagePath) }}" alt="{{ $item['name'] }}"
                                            class="img-fluid cart-img">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light text-muted cart-img"
                                            style="height:120px;">
                                            No Image
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                                    <p class="text-success mb-2">Price: ${{ number_format($item['price'], 2) }}</p>

                                    <form action="{{ route('cart.update', $id) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="form-control form-control-sm me-2" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm text-white"
                                            style="background-color: #0072cf">Update</button>
                                    </form>
                                </div>
                                <div class="col-md-3 text-end">
                                    <p class="fw-bold mb-2">Total: ${{ number_format($total, 2) }}</p>
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Order Summary</h4>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($grandTotal, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Shipping</span>
                                    <span>Free</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fw-bold">
                                    <span>Grand Total</span>
                                    <span>${{ number_format($grandTotal, 2) }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart --}}
            <div class="text-center py-5">
                <img src="{{ asset('home/assets/img/empty_cart.png') }}" alt="Empty Cart" class="img-fluid mb-3"
                    style="max-width:200px;">
                <h4 class="fw-bold">Your cart is empty</h4>
                <p class="text-muted">Looks like you haven't added anything yet.</p>
                <a href="{{ url('/books') }}" class="btn btn-primary mt-3" style="background-color: #0072cf">Continue Shopping</a>
            </div>
        @endif
    </div>
@endsection
