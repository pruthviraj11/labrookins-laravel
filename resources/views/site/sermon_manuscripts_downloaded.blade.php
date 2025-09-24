@extends('layouts.homeLayout')

@section('title', 'Sermon Manuscript Downloaded')

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
<style>
/* Main Pagination Container */
.pager.Pagination {
    margin: 40px 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pager.Pagination .col-md-12 {
    display: flex;
    justify-content: center;
}

/* Pagination Navigation */
.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.375rem;
    gap: 5px;
    margin: 0;
}

/* Individual Pagination Items */
.pagination li {
    display: inline-block;
    height: 45px;
    text-align: center;
    line-height: 45px;
    background-color: #0e4564 !important;
    margin: 0 3px;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    min-width: 45px;
}

/* Pagination Links */
.pagination li a {
    color: #fff !important;
    padding: 0 15px;
    text-decoration: none;
    display: block;
    font-weight: 500;
    font-size: 14px;
    border-radius: 8px;
    transition: all 0.3s ease;
    height: 45px;
    line-height: 45px;
}

/* Pagination Span (for current page and disabled items) */
.pagination li span {
    color: #fff !important;
    padding: 0 15px;
    display: block;
    font-weight: 500;
    font-size: 14px;
    border-radius: 8px;
    height: 45px;
    line-height: 45px;
}

/* Hover Effects */
.pagination li:hover {
    background-color: #1a5a7a !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.pagination li a:hover {
    color: #fff !important;
    background-color: transparent;
}

/* Active/Current Page */
.pagination li.active {
    background: #0072cf !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
}

.pagination li.active span {
    color: #fff !important;
    font-weight: 600;
}

/* Disabled Items */
.pagination li.disabled {
    background-color: #6c757d !important;
    opacity: 0.6;
    cursor: not-allowed;
}

.pagination li.disabled:hover {
    background-color: #6c757d !important;
    transform: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.pagination li.disabled span,
.pagination li.disabled a {
    color: #adb5bd !important;
    cursor: not-allowed;
}

/* First/Last Page Buttons */
.pagination li:first-child,
.pagination li:last-child {
    font-weight: 600;
}

/* Previous/Next Buttons */
.pagination li:first-child a::before {
    content: "← ";
}

.pagination li:last-child a::after {
    content: " →";
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .pagination li {
        height: 40px;
        line-height: 40px;
        min-width: 40px;
        margin: 0 2px;
    }

    .pagination li a,
    .pagination li span {
        padding: 0 10px;
        font-size: 13px;
        height: 40px;
        line-height: 40px;
    }

    /* Hide some pagination items on mobile */
    .pagination li:not(.active):not(:first-child):not(:last-child):not(.disabled) {
        display: none;
    }

    .pagination li:nth-child(-n+2),
    .pagination li:nth-last-child(-n+2),
    .pagination li.active,
    .pagination li.active + li,
    .pagination li.active - li {
        display: inline-block !important;
    }
}

/* Extra Small Screens */
@media (max-width: 576px) {
    .pager.Pagination {
        margin: 20px 0;
    }

    .pagination li {
        height: 35px;
        line-height: 35px;
        min-width: 35px;
        margin: 0 1px;
    }

    .pagination li a,
    .pagination li span {
        padding: 0 8px;
        font-size: 12px;
        height: 35px;
        line-height: 35px;
    }
}

/* Loading Animation (Optional) */
.pagination-loading {
    opacity: 0.6;
    pointer-events: none;
}

.pagination-loading li {
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
    100% {
        opacity: 1;
    }
}

/* Custom Count Section Enhancement */
.CountSection p {
    margin: 0px;
    font-size: 18px;
    color: #333;
    font-weight: 500;
    padding: 15px 0;
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 20px;
}

.CountSection .countProducts {
    font-weight: 700;
    color: #0e4564;
    background-color: #e3f2fd;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 16px;
}

/* Additional Enhancement for Pagination Info */
.pagination-info {
    text-align: center;
    margin-top: 15px;
    color: #666;
    font-size: 14px;
    font-style: italic;
}
</style>

@endsection



