@extends('layouts.homeLayout')

@section('title', 'Your Cart | L.A. BROOKINS MINISTRIES')


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

    <div class="container mt-5">
    <h2 class="mb-4">Complete Payment</h2>
    <div class="card p-4">
        {{-- <h4>Order Total: ${{ number_format($order->total, 2) }}</h4> --}}

        {{-- <form action="{{ route('payment.process', $order->id) }}" method="POST"> --}}
        <form action="#" method="POST">

            @csrf
            <div class="mb-3">
                <label>Card Number <span class="text-danger">*</span> </label>
                <input type="text" name="card_number" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Exp Month <span class="text-danger">*</span></label>
                    <input type="text" name="exp_month" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Exp Year <span class="text-danger">*</span></label>
                    <input type="text" name="exp_year" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>CVC <span class="text-danger">*</span></label>
                    <input type="text" name="cvc" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Pay Now</button>
        </form>
    </div>
</div>
@endsection
