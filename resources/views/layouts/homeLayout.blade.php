<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    <meta name="description" content="@yield('description', '')" />
    <meta name="keywords" content="@yield('keywords', '')" />

    <link rel="icon" href="{{ asset('favicon') }}" type="image/x-icon">

    <!-- Google Fonts / CSS -->
    <link href="{{ asset('home/assets/css/google_css.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/css2.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('home/assets/css/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Main CSS -->
    <link href="{{ asset('home/assets/css/style.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body>

    <header id="header" class="fixed--top header-inner-pages">
        <div class="header" style="background-image: url({{ asset('home/assets/img/header-bg.png') }});">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="row ">
                    <div class="col-md-4">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('home/assets/img/logo.png') }}" class="my-4" alt="Logo">
                        </a>
                    </div>
                    <div class="col-md-8 d-flex">
                        <nav id="navbar" class="navbar order-last order-lg-0">
                            <ul>
                                <li class="homeIcon">
                                    <a class="nav-link scrollto" href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a class="nav-link scrollto" href="{{ url('about') }}">About</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#"><span>Devotional</span> <i class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        <li><a href="{{ url('word_for_day') }}">Word for Today</a></li>
                                        <li><a href="{{ url('blog') }}">Blog</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#"><span>Online Store</span> <i class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        <li><a href="{{ url('books') }}">Books</a></li>
                                        <li><a href="{{ url('sermon-manuscripts-downloaded') }}">Sermon Manuscripts -
                                                Downloaded</a></li>
                                        <li><a href="{{ url('sermon-manuscripts-shipped') }}">Sermon Manuscripts -
                                                Shipped</a></li>
                                        <li><a href="{{ url('sermon-series-shipped') }}">Sermon Series - Shipped</a>
                                        </li>
                                        <li><a href="{{ url('workbooks-manuals') }}">Workbooks & Manuals</a></li>
                                        <li><a href="{{ url('other-products') }}">Other Products</a></li>
                                    </ul>
                                </li>
                                <li><a class="nav-link scrollto" href="{{ url('scheduling') }}">Scheduling</a></li>
                                <li><a class="nav-link scrollto" href="{{ url('site.itinerary') }}">Itinerary</a></li>
                                <li class="dropdown">
                                    <a href="#"><span>Connect</span> <i class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        <li><a href="{{ url('contact_us') }}">Contact Us</a></li>
                                        <li><a href="{{ url('prayer_request') }}">Prayer Request</a></li>
                                        <li><a href="{{ url('online_donation') }}">Online Donations</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <i class="bi bi-list mobile-nav-toggle"></i>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2 footercontent_center">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('about') }}">About</a>
                    <a href="{{ url('word_for_day') }}">Devotional</a>
                </div>

                <div class="col-md-2 footercontent_center">
                    <a href="{{ url('scheduling') }}">Scheduling</a>
                    <a href="{{ url('itinerary') }}">Itinerary</a>
                    <a href="{{ url('contact_us') }}">Contact Us</a>
                </div>

                <div class="col-md-4 footercontent">
                    <h6>L.A. Brookins Ministries</h6>
                    <p>
                        P.O. Box 1047<br>
                        Dolton, IL 60419<br>
                        Phone 708-639-2880<br>
                        <a href="mailto:labministries@att.net">labministries@att.net</a>
                    </p>

                    <div class="footercontent visitor-counter-content" style="color: #fff; font-family: Merriweather">
                        <p>Total User: 493923</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="social">
                        <div class="textwidget">
                            <ul class="d-flex align-content-start">
                                <li>
                                    <p class="follow">Follow us</p>
                                </li>
                                <li>
                                    <a class="g-plus" href="https://www.facebook.com/PastorLarryABrookins"
                                        target="_blank">
                                        <i class="fb"
                                            style="background: url({{ asset('home/assets/img/social_icon.png') }}) no-repeat;"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter" href="https://twitter.com/labrookins" target="_blank">
                                        <i class="tw"
                                            style="background: url({{ asset('home/assets/img/social_icon.png') }}) no-repeat;"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="facebook" href="https://www.youtube.com/@labrookinsmin"
                                        target="_blank">
                                        <i class="yt"
                                            style="background: url({{ asset('home/assets/img/social_icon.png') }}) no-repeat;"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="powerd-by">
                                <a href="https://ekingdomsites.com/NewSite/">
                                    <img src="{{ asset('home/assets/img/powerd.png') }}" width="35%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor & Custom JS -->
    <script src="{{ asset('home/assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('home/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/validate.js') }}"></script>
    <script src="{{ asset('home/assets/js/main.js') }}"></script>
    <script src="{{ asset('home/assets/js/aos.js') }}"></script>

    <script>
        AOS.init();
    </script>


    <!-- Vendor JS Files -->
    <script src="{{ asset('home/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/aos.js') }}"></script>
    <script src="{{ asset('home/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/swiper-bundle.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('home/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
