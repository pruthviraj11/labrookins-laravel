@extends('layouts.homeLayout')
{{-- @extends('layouts.app') --}}

@section('title', 'Home Page')

@section('content')

<!-- Hero Section -->
<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <div class="row g-0">
            <div class="client-slider swiper col-md-12">
                <div class="swiper-wrapper align-items-center">
                  {{-- {{dd($home_banner)}} --}}
                      @foreach($home_banner as $banner)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/'.$banner->image) }}" class="img-fluid" alt="Banner" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<main id="main">

    <!-- Welcome Section -->
    <section id="welcome" class="welcome">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-9 row g-0 entry-line">
                    <h1 class="hadding">{{$home_about->title}}</h1>
                    <div class="col-md-4 HomeAboutSection">
                        <img src="{{ asset('storage/'.$home_about->image) }}" alt="Rev. Dr. Larry A. Brookins">
                        <span class="welcome_text">{{$home_about->text}}</span>
                    </div>
                    <div class="col-md-8 section_line p-2">
                        <p>
                           {!! $home_about->description !!}    </p>
                    </div>
                </div>
                <div class="col-md-3 px-3">
                    <div class="text-5a">
                        <div class="contentboxs">
                            <p class="sun"><strong>{{$home_links->title1}}</strong></p>
                            <p class="trad"><a target="_blank" href="{{$home_links->url1}}" rel="noopener">{{$home_links->url1}}</a></p>
                        </div>
                        <div class="contentboxs">
                            <p class="sun"><strong>{{$home_links->title2}}</strong></p>
                            <p class="trad"><a target="_blank" href="{{$home_links->url2}}" rel="noopener">{{$home_links->url2}}</a></p>
                        </div>
                        <div class="contentboxs">
                            <p class="sun"><strong>{{$home_links->title3}}</strong></p>
                            <p class="trad"><a target="_blank" href="{{$home_links->url3}}" rel="noopener" style="word-wrap: break-word;">{{$home_links->url3}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row services">

                <div class="services-col col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <a href="#">
                        <div class="services-image">
                             <img src="{{ asset('storage/'.$quick_links->image1) }}" alt="Quick Link">
                        </div>
                        <div class="titles" style="background: url({{ asset('home/assets/img/title.png') }}) no-repeat;">
                            <h4>{{$quick_links->title1}}</h4>
                        </div>
                    </a>
                </div>

                <div class="services-col col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <a href="#">
                        <div class="services-image">
                            <img src="{{ asset('storage/'.$quick_links->image2) }}">
                        </div>
                        <div class="titles" style="background: url({{ asset('home/assets/img/title.png') }}) no-repeat;">
                            <h4>{{$quick_links->title2}}</h4>
                        </div>
                    </a>
                </div>

                <div class="services-col col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <a href="#">
                        <div class="services-image">
                            <img src="{{ asset('storage/'.$quick_links->image3) }}">
                        </div>
                        <div class="titles" style="background: url({{ asset('home/assets/img/title.png') }}) no-repeat;">
                            <h4>{{$quick_links->title3}}</h4>
                        </div>
                    </a>
                </div>

                <div class="services-col col-md-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <a href="#">
                        <div class="services-image">
                            <img src="{{ asset('storage/'.$quick_links->image4) }}">
                        </div>
                        <div class="titles" style="background: url({{ asset('home/assets/img/title.png') }}) no-repeat;">
                            <h4>{{$quick_links->title4}}</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

@endsection
