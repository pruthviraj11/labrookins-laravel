@extends('layouts.homeLayout')

@section('title', 'Blog')

@section('content')

<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        @if(!empty($home_banner) && !empty($home_banner->image))
                            <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="Word for Today Banner" />
                        @else
                            <img src="{{ asset('assets/img/blog.jpg') }}" class="img-fluid" alt="Default Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row welcome-container">

            @foreach($blog as $item)
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 blog">
                    <div class="pic">
                        <figure>
                            @if(!empty($item->image))
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid">
                            @endif
                        </figure>
                    </div>

                    <div class="nopadding">
                        <h2 class="blog-post-title">{{ $item->title }}</h2>
                    </div>

                    <div class="justyfy_sm"><br>
                        <p class="max-lines">
                            {!! Str::limit($item->description, 200, '...') !!}
                        </p>

                        {{-- @if(!empty($item->link)) --}}
                            <p class="link-more">
                                <a href="#" target="_blank" class="more-link">Continue reading</a>
                            </p>
                        {{-- @endif --}}
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


@endsection
