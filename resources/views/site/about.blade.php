@extends('layouts.homeLayout')

@section('title', 'About') {{-- page title --}}

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/'.$home_banner->image) }}" class="img-fluid" alt="About Banner" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section>
        <div class="container">
            <div class="entry-content">

                <div class="speak">
                    <a href="{{route('scheduling')}}">Speaking Engagement</a>
                </div>
                <div></div>

            <div></div>

            <p>&nbsp;</p>

                {!! $about_us->description !!}
            </div>
        </div>
    </section>
@endsection
