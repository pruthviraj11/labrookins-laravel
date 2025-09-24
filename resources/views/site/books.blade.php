@extends('layouts.homeLayout')

@section('title', 'Books')

@push('styles')
<style>
    .pagination li {
        display: inline-block;
        height: 40px;
        text-align: center;
        line-height: 40px;
        background-color: #0e4564 !important;
        margin: 15px 5px 5px 5px;
    }

    .pagination li a {
        color: #fff;
        padding: 0 20px;
    }

    .CountSection p {
        margin: 0px;
        font-size: 20px;
    }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        @if(!empty($home_banner) && !empty($home_banner->image))
                            <img src="{{ asset('storage/' . $home_banner->image) }}"
                                 class="img-fluid"
                                 alt="{{ $home_banner->title ?? 'Books Banner' }}" />
                        @else
                            <img src="{{ asset('home/assets/img/books_banner.png') }}"
                                 class="img-fluid"
                                 alt="Books Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Books Section --}}
<section class="container">
    <div class="container row">
        <div class="col-md-12">

            {{-- Search --}}
            <div class="col-md-12 searchSection">
                {{-- <form name="myform" method="GET" action="{{ route('books.search') }}"> --}}
                <form name="myform" method="GET" action="#">

                    <input type="text"
                           class="form-control searchProducts"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Search Products...">
                </form>
            </div>

            {{-- Count --}}
            <div class="row">
                <div class="col-md-10 CountSection">
                    <p>Showing all <span class="countProducts">{{ $books->count() }}</span> results</p>
                </div>
            </div>
        </div>

        {{-- Products --}}
        <div class="searchData"></div>
        <div class="row mainData">

            @foreach($books as $book)
                <div class="col-md-3 mt-3 product">
                    <a href="#">
                        <img src="{{ asset('storage/products/' . $book->product_image) }}"
                             alt="{{ $book->product_name }}"
                             height="375px">
                        <h2 class="product__title">{{ $book->product_name }}</h2>
                        <span class="price">${{ number_format($book->product_price, 2) }}</span>
                    </a>

                    <a class="add_to_cart_button btn"
                       data-pid="{{ $book->id }}"
                       data-price="{{ $book->product_price }}"
                       rel="nofollow">
                        Add to cart
                    </a>
                    {{-- <a href="{{ route('cart.index') }}" --}}
                    <a href="#"

                       class="viewCart_{{ $book->id }}"
                       rel="nofollow"
                       style="display:none;">
                       View cart
                    </a>
                    <hr class="position_ab">
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pager Pagination">
            <div class="col-md-12">
                <div class="row">
                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
