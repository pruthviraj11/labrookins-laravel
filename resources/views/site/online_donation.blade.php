@extends('layouts.homeLayout')

@section('title', 'Online Donation')

@section('content')

{{-- Hero Section --}}
<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        @if(!empty($home_banner) && !empty($home_banner->image))
                            <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="{{ $home_banner->title ?? 'Online Donation Banner' }}" />
                        @else
                            <img src="{{ asset('assets/img/online-donation-banner.jpg') }}" class="img-fluid" alt="Online Donation Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Donation Section --}}
<section class="container-fluid spacetop">
    <div class="container">
        <div class="row">
            <article class="page hentry">
                <div class="entry-content">
                    <div class="row">

                        {{-- Left Column (Text) --}}
                        <div class="col-md-12 col-lg-12 col-xl-6">
                            <p>We thank you for your generous financial support of this ministry. It is because of
                                your partnership and support of this ministry that we are able to advance the
                                Kingdom of God and take the message of the Gospel to this generation. We stand in
                                faith with you for harvest and breakthrough in the areas of your life where you most
                                need it.</p>

                            <p>But I say this, He who sows sparingly shall also reap sparingly, and he who sows
                                bountifully shall also reap bountifully. Each one, as he purposes in his heart, let
                                him give, not of grief, or of necessity, for God loves a cheerful giver. And God is
                                able to make all grace abound toward you, that in everything, always having all
                                self-sufficiency, you may abound to every good work (2 Corinthians 9:6-8 – MKJV)</p>
                        </div>

                        {{-- Right Column (Form) --}}
                        <div class="col-md-12 col-lg-12 col-xl-6">
                            {{-- <form action="{{ route('donation.submit') }}" method="POST"> --}}
                            <form action="#" method="POST">

                                @csrf
                                <div class="formbox">

                                    <div class="row formspace">
                                        <div class="col-12 stitle">Online Donation</div>
                                    </div>

                                    {{-- Amount --}}
                                    <div class="row formspace align-items-center">
                                        <div class="col-md-2">
                                            <label for="amount">Amount:</label>
                                        </div>
                                        <div class="col-md-9 d-flex">
                                          <div class="mt-1 fw-bold">$</div>
                                            <input type="number"
                                                name="amount"
                                                id="amount"
                                                class="form-control fldtxt"
                                                style="width:95%;"
                                                min="1"
                                                max="9999"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="row formspace">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

@endsection
