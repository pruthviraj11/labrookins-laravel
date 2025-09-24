@extends('layouts.homeLayout')

@section('title', 'Scheduling')

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
                                 alt="{{ $home_banner->title ?? 'Scheduling Banner' }}" />
                        @else
                            <img src="{{ asset('assets/img/aboutpage.jpg') }}"
                                 class="img-fluid"
                                 alt="Scheduling Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Scheduling Form Section --}}
<section class="container entry-content">
    <div class="col-md-12 col-lg-12 col-xl-6 offset-xl-3 text-center">
        <strong>
            Rev. Dr. Larry A. Brookins is available for preaching engagements, seminars, workshops, conferences,
            book signings, and more. To inquire for scheduling, complete the form below and click the submit button.
        </strong>
    </div>

    <div class="col-md-12 col-lg-12 col-xl-6 offset-xl-3 text-center mt-4">
        {{-- <form action="{{ route('scheduling.submit') }}" method="POST"> --}}
        <form action="#" method="POST">

            @csrf

            <div class="formbox">

                {{-- Contact Information --}}
                <div class="row">
                    <div class="col-12 stitle"><p>Contact Information</p></div>
                </div>

                {{-- Name --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Your Name:</label></div>
                    <div class="col-xl-7"><input type="text" name="yourname" class="form-control"></div>
                </div>

                {{-- Position --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Your Position:</label></div>
                    <div class="col-xl-7"><input type="text" name="yourposition" class="form-control"></div>
                </div>

                {{-- Ministry Name --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Ministry Name:</label></div>
                    <div class="col-xl-7"><input type="text" name="ministryname" class="form-control"></div>
                </div>

                {{-- Pastor Name --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Pastor's Name:</label></div>
                    <div class="col-xl-7"><input type="text" name="pastorname" class="form-control"></div>
                </div>

                {{-- Address --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Address:</label></div>
                    <div class="col-xl-7"><input type="text" name="address" class="form-control"></div>
                </div>

                {{-- City --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>City:</label></div>
                    <div class="col-xl-7"><input type="text" name="city" class="form-control"></div>
                </div>

                {{-- State --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>State:</label></div>
                    <div class="col-xl-7"><input type="text" name="state" class="form-control"></div>
                </div>

                {{-- Zip --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Zip:</label></div>
                    <div class="col-xl-7"><input type="text" name="zip" class="form-control"></div>
                </div>

                {{-- Email --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Email:</label></div>
                    <div class="col-xl-7"><input type="email" name="email" class="form-control" required></div>
                </div>

                {{-- Phones --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Office Phone:</label></div>
                    <div class="col-xl-7"><input type="tel" name="officephone" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Home Phone:</label></div>
                    <div class="col-xl-7"><input type="tel" name="homephone" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Mobile Phone:</label></div>
                    <div class="col-xl-7"><input type="tel" name="mobilephone" class="form-control"></div>
                </div>

                {{-- Ministry Affiliation --}}
                <div class="row formspace">
                    <div class="col-xl-5"><label>Ministry Affiliation:</label></div>
                    <div class="col-xl-7"><input type="text" name="ministryaffiliation" class="form-control"></div>
                </div>

                {{-- Event Information --}}
                <div class="row mt-4">
                    <div class="col-12 stitle"><p>Event Information</p></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Name of Event:</label></div>
                    <div class="col-xl-7"><input type="text" name="nameofevent" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Type of Event:</label></div>
                    <div class="col-xl-7"><input type="text" name="typeofevent" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Theme:</label></div>
                    <div class="col-xl-7"><input type="text" name="theme" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Date of Event:</label></div>
                    <div class="col-xl-7"><input type="date" name="dateofevent" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Alternate Date(s):</label></div>
                    <div class="col-xl-7"><input type="date" name="alternatedate" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Time of Service:</label></div>
                    <div class="col-xl-7"><input type="text" name="timeofservice" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Location of Event:</label></div>
                    <div class="col-xl-7"><input type="text" name="locationofevent" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Additional Information:</label></div>
                    <div class="col-xl-7"><textarea name="scomment" rows="5" class="form-control"></textarea></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>How many days of service?:</label></div>
                    <div class="col-xl-7"><input type="text" name="smanydays" class="form-control"></div>
                </div>

                <div class="row formspace">
                    <div class="col-xl-5"><label>Best time to reach you?:</label></div>
                    <div class="col-xl-7"><input type="text" name="sreachyou" class="form-control"></div>
                </div>

                {{-- reCAPTCHA --}}
                <div class="row formspace">
                    <div class="col-xl-5"></div>
                    <div class="col-xl-7">
                        <div class="g-recaptcha" data-sitekey="6LfKB9MoAAAAACqx8RAwKx6nrci-yFlujDT4HgD4"></div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="row formspace">
                    <div class="col-12">
                        <button type="submit" class="form-control btn btn-dark">Submit</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

@endsection
