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
        {{-- <h2 class="mb-4">Complete Payment</h2> --}}
        {{-- <div class="card p-4"> --}}

      <h4>Order Total: ${{ number_format($order->total_amount, 2) }}</h4>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Session Payment Error --}}
        @if (session('payment_error'))
            <div class="alert alert-danger mt-3">
                <strong>Payment Error:</strong> {{ session('payment_error') }}
            </div>
        @endif

        <form action="{{ route('payment.process', $order->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h2 style="color: #0072cf">Enter Credit Card Information</h2>
                    <div class="mb-3">
                        <label>Card Number <span class="text-danger">*</span> </label>
                        <input type="text" name="card_number" class="form-control" required maxlength="16"
                            pattern="\d{16}" inputmode="numeric" title="Please enter exactly 16 digits">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Exp Month <span class="text-danger">*</span></label>
                            {{-- <input type="text" name="exp_month" class="form-control" required> --}}
                            <select name="exp_month" class="form-control">
                                <option value="">Exp Month*</option>
                                <option value="01">01 - January</option>
                                <option value="02">02 - February</option>
                                <option value="03">03 - March</option>
                                <option value="04">04 - April</option>
                                <option value="05">05 - May</option>
                                <option value="06">06 - June</option>
                                <option value="07">07 - July</option>
                                <option value="08">08 - August</option>
                                <option value="09">09 - September</option>
                                <option value="10">10 - October</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - December</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Exp Year <span class="text-danger">*</span></label>
                            {{-- <input type="text" name="exp_year" class="form-control" required> --}}
                            <select name="exp_year" class="form-control">
                                <option value="">Exp Year*</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>CVC <span class="text-danger">*</span></label>
                            <input type="text" name="cvc" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Pay Now</button>
                </div>
                <div class="col-md-6"></div>
            </div>
        </form>
        {{-- </div> --}}
    </div>
@endsection
