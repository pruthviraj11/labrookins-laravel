@extends('layouts.homeLayout')

@section('title', 'Other Products | L.A. BROOKINS MINISTRIES')

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

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            @if ($home_banner && $home_banner->image)
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="Banner">
                            @else
                                <img src="{{ asset('home/assets/img/books_banner.png') }}" class="img-fluid" alt="Banner">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="container">
        <div class="container row">
            <div class="col-md-12">

                <!-- Search -->
                <div class="col-md-12 searchSection mb-3">
                    <form method="GET" action="#">
                        {{-- <form method="GET" action="{{ route('other_products') }}"> --}}

                        <input type="text" name="q" class="form-control searchProducts" value="{{ request('q') }}"
                            placeholder="Search Products...">
                    </form>
                </div>

                <!-- Count -->
                <div class="row">
                    <div class="col-md-10 CountSection">
                        <p>
                            Showing {{ $books->count() }} of {{ $books->total() }} results
                        </p>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="row mainData">
                @forelse($books as $book)
                    <div class="col-md-3 mt-3 product">
                        @if ($book->product_image)
                            <a href="{{ route('product.show', $book->id) }}">
                                <img src="{{ asset('storage/' . $book->product_image) }}" class="img-fluid" height="375px"
                                    alt="{{ $book->product_name }}">
                                <h2 class="product__title">{{ $book->product_name }}</h2>
                                <span class="price">${{ number_format($book->product_price, 2) }}</span>
                            </a>
                        @endif
                        {{-- <a class="add_to_cart_button btn" data-pid="{{ $book->id }}"
                            data-price="{{ $book->product_price }}">
                            Add to cart
                        </a>
                        <a href="#" class="viewCart_{{ $book->id }}"
                            style="display:none;">View cart</a> --}}


                        <a class="add_to_cart_button btn" data-pid="{{ $book->id }}"
                            data-price="{{ $book->product_price }}" rel="nofollow">
                            Add to cart
                        </a>
                        <a href="{{ route('cart.index') }}" class="viewCart_{{ $book->id }} add_to_cart_button_2 btn" rel="nofollow"
                            style="display:none;">
                            View cart
                        </a>
                        <hr class="position_ab">
                    </div>
                @empty
                    <p class="text-center mt-4">No products found.</p>
                @endforelse
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $(".add_to_cart_button").on("click", function(e) {
        e.preventDefault();
        var pid = $(this).data("pid");

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                pid: pid
            },
            success: function(res) {
                if(res.status === "success"){
                    $(".viewCart_" + pid).show();

                    // SweetAlert2 Toast
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                        position: 'top-end'
                    });
                }
            }
        });
    });
});
</script>

@endpush
