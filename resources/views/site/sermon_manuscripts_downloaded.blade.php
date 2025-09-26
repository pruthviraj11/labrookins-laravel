@extends('layouts.homeLayout')

@section('title', 'Sermon Manuscript Downloaded | L.A. BROOKINS MINISTRIES')



@section('content')

    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            @if ($home_banner && $home_banner->image)
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="Banner" />
                            @else
                                <img src="{{ asset('home/assets/img/books_banner.png') }}" class="img-fluid"
                                    alt="Banner" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="container row">
            <div class="col-md-12">
                <div class="col-md-12 searchSection">
                    <form name="myform" method="GET" action="">
                        <input type="text" class="form-control searchProducts" name="q" value="{{ request('q') }}"
                            placeholder="Search Products...">
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-10 CountSection">
                        <p>Showing all <span class="countProducts">{{ $books->total() }}</span> results</p>
                    </div>
                </div>
            </div>

            <!-- Books Loop -->
            <div class="searchData"></div>
            <div class="row mainData">
                @foreach ($books as $book)
                    {{-- {{$book}} --}}
                    <div class="col-md-3 mt-3 product">
                        @if ($book->product_image)
                            <a href="#">
                                <img src="{{ asset('storage/products/' . $book->product_image) }}" height="375px"
                                    alt="{{ $book->product_name }}">
                            </a>
                        @endif
                        <h2 class="product__title">{{ $book->product_name }}</h2>
                        <span class="price">${{ number_format($book->product_price, 2) }}</span>

                        <a class="add_to_cart_button btn" data-pid="{{ $book->id }}" data-price="{{ $book->price }}"
                            rel="nofollow">Add to cart</a>

                        {{-- <a href="{{ route('cart.index') }}" --}}

                        <a href="#" class="viewCart_{{ $book->id }}" rel="nofollow" style="display:none;">View
                            cart</a>
                        <hr class="position_ab">
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pager Pagination">
                <div class="col-md-12">
                    <div class="row">
                        {{ $books->links('pagination::default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection



