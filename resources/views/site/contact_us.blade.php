@extends('layouts.homeLayout')

@section('title', 'Contact | L.A. BROOKINS MINISTRIES')

@section('content')

    {{-- Hero Section --}}
    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            @if (!empty($home_banner) && !empty($home_banner->image))
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid"
                                    alt="{{ $home_banner->title ?? 'Prayer Request Banner' }}" />
                            @else
                                <img src="{{ asset('home/assets/img/contact-banner.jpg') }}" class="img-fluid"
                                    alt="Contact Banner" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section>
        <div class="container">
            <div class="entry-content">
                <div class="row">

                    {{-- Contact Info --}}
                    <div class="col-md-5 margin_57">
                        <h1 class="hadding">L.A. Brookins Ministries</h1>

                        <p>
                            P.O. Box 1047<br>
                            Dolton, IL 60419<br>
                            Phone 708-639-2880<br>
                            <a href="mailto:labministries@att.net">labministries@att.net</a>
                        </p>

                        <div style="display: inline-flex;">
                            <a href="https://www.facebook.com/PastorLarryABrookins" target="_blank" rel="noopener">
                                <img src="{{ asset('home/assets/img/fb.png') }}" alt="Facebook" width="37"
                                    height="37">
                            </a>

                            <a style="margin-left: 15px;" href="https://twitter.com/labrookins" target="_blank">
                                <img src="{{ asset('home/assets/img/twt.png') }}" alt="Twitter" width="37"
                                    height="37">
                            </a>

                            <a style="margin-left: 15px;" href="https://www.youtube.com/@labrookinsmin" target="_blank">
                                <img src="{{ asset('home/assets/img/yt.png') }}" alt="YouTube" width="37"
                                    height="37">
                            </a>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="col-md-6 form_box">
                        @if (session('success'))
                            <div class="alert alert-success mt-2 mx-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="p-3" name="contactForm" method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <input type="hidden" name="spam_title" id="spam_title">

                            {{-- Name --}}
                            <div class="form-group row mt-3">
                                <div class="col-md-3"><label for="fname">Name</label></div>
                                <div class="col-md-9">
                                    <input type="text" name="fname" class="form-control w-100" id="fname"
                                        placeholder="Enter Name" required>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group row mt-3">
                                <div class="col-md-3"><label for="email">Email</label></div>
                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control w-100" id="email"
                                        placeholder="Enter Email" required>
                                </div>
                            </div>

                            {{-- Subject --}}
                            <div class="form-group row mt-3">
                                <div class="col-md-3"><label for="subject">Subject</label></div>
                                <div class="col-md-9">
                                    <input type="text" name="subject" class="form-control w-100" id="subject"
                                        placeholder="Enter Subject" required>
                                </div>
                            </div>

                            {{-- Comments --}}
                            <div class="form-group row mt-3">
                                <div class="col-md-3"><label for="comment">Comments</label></div>
                                <div class="col-md-9">
                                    <textarea name="comment" class="form-control w-100" id="comment" placeholder="Enter Comments" required></textarea>
                                </div>
                            </div>

                            {{-- reCAPTCHA --}}
                            <div class="form-group row mt-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-9 mb-2">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
