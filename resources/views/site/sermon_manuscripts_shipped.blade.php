@extends('layouts.homeLayout')

@section('title', 'Sermon Manuscript Shipped | L.A. BROOKINS MINISTRIES')

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
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="banner">
                            @else
                                <img src="{{ asset('home/assets/img/books_banner.png') }}" class="img-fluid" alt="banner">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row">
            <div class="col-md-12 searchSection">
                <form method="get" action="">
                    <input type="text" class="form-control searchProducts" placeholder="Search Products...">
                </form>
            </div>

            <div class="row mt-3">
                <div class="col-md-10 CountSection">
                    <p>
                        Showing all <span class="countProducts">{{ $books->total() }}</span> results
                    </p>
                </div>
            </div>
        </div>

        <div class="row mainData mt-3">
            @forelse($books as $book)
                <div class="col-md-3 mt-3 product">
                    @if ($book->product_image)
                        <a href="#">
                            <img src="{{ asset('storage/products/' . $book->product_image) }}" height="375px"
                                alt="{{ $book->product_name }}">
                        </a>
                    @endif
                    <h2 class="product__title">{{ $book->product_name }}</h2>
                    <span class="price">${{ number_format($book->product_price, 2) }}</span>

                    {{-- <a class="add_to_cart_button btn" data-pid="{{ $book->id }}" data-price="{{ $book->price }}"
                        rel="nofollow">Add to cart</a> --}}
                    {{-- <a href="{{ route('cart.index') }}" class="viewCart_{{ $book->id }}" rel="nofollow"
                        style="display:none;">View cart</a> --}}


                    <a class="add_to_cart_button btn" data-pid="{{ $book->id }}" data-price="{{ $book->product_price }}"
                        rel="nofollow">
                        Add to cart
                    </a>
                    <a href="{{ route('cart.index') }}" class="viewCart_{{ $book->id }} add_to_cart_button_2 btn" rel="nofollow"
                        style="display:none;">
                        View cart
                    </a>
                    <hr class="position_ab">
                </div>
            @empty
                <div class="col-md-12">
                    <p>No books found.</p>
                </div>
            @endforelse
        </div>

        <div class="pager Pagination">
            <div class="col-md-12">
                <div class="row">
                    {{ $books->links('pagination::default') }}
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
