@extends('layouts.homeLayout')

@section('title', 'Word For Day | L.A. BROOKINS MINISTRIES')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/'.$home_banner->image) }}" class="img-fluid" alt="Word For Today Banner" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Word For The Day Section -->
    <section class="container my-5">
        <div class="row welcome-container">

            {{-- Post 1 --}}
             @foreach($word_for_day as $word)
            <div class="col-xs-12 col-sm-6 col-md-4 blog mb-4">
                <div class="pic">
                    <figure>
                        @if(!empty($word->image))
                            <img src="{{ asset('storage/' . $word->image) }}" alt="{{ $word->title }}" class="img-fluid">
                        @endif
                    </figure>
                </div>
                <div class="nopadding">
                    <h2 class="blog-post-title">{{ $word->title }}</h2>
                </div>
                <div class="justyfy_sm">
                    <p>
                        {!! Str::limit(strip_tags($word->description), 180) !!}
                    </p>
                    <p class="link-more">
                        <a href="{{ route('word_for_day.show', $word->slug_url) }}" class="more-link" target="_blank">Continue reading</a>
                        {{-- <a href="#" class="more-link">Continue reading</a> --}}

                    </p>
                </div>
            </div>
        @endforeach
        </div>
    </section>

@endsection
