@extends('layouts.homeLayout')

@section('title', 'Prayer Request')

@section('content')

{{-- Hero Section --}}
<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        @if(!empty($home_banner) && !empty($home_banner->image))
                            <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="{{ $home_banner->title ?? 'Prayer Request Banner' }}" />
                        @else
                            <img src="{{ asset('assets/img/prayerrequest-banner.jpg') }}" class="img-fluid" alt="Prayer Request Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Prayer Request Form Section --}}
<section class="container entry-content mt-5">
    <div class="row">

        {{-- Info Section --}}
        <div class="col-xl-6 entry-content">
            <p><b>Do you have a Prayer Request?</b> We are here to pray for you and help you get the results needed for your life. Please feel free to submit your prayer requests. Our experienced prayer team will pray concerning each request.</p>

            <p>Likewise the Spirit also helps our infirmities. For we do not know what we should pray for as we ought, but the Spirit Himself makes intercession for us with groanings which cannot be uttered. And He searching the hearts knows what is the mind of the Spirit, because He makes intercession for the saints according to the will of God. And we know that all things work together for good to those who love God, to those who are called according to His purpose. (Romans 8:26-28)</p>
        </div>

        {{-- Form Section --}}
        <div class="col-xl-6 content-side">
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <form action="{{ route('prayer.store') }}" method="POST">
                @csrf

                {{-- Category --}}
                <div class="mb-3">
                    <label for="category">Category*</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="" hidden>Select One</option>
                        <option value="Spiritual">Spiritual</option>
                        <option value="Health/Healing">Health/Healing</option>
                        <option value="Emotional">Emotional</option>
                        <option value="Financial">Financial</option>
                        <option value="Family/Relationship">Family/Relationship</option>
                        <option value="Business/Career/School">Business/Career/School</option>
                        <option value="Safety">Safety</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                {{-- Subject --}}
                <div class="mb-3">
                    <label for="praysubject">Subject*</label>
                    <input type="text" name="praysubject" id="praysubject" class="form-control" required>
                </div>

                {{-- Who Needs Prayer --}}
                <div class="mb-3">
                    <h4>Who Needs Prayer?</h4>
                    <label for="prayer_for">Name*</label>
                    <input type="text" name="prayer_for" id="prayer_for" class="form-control" required>

                    <div class="mt-2">
                        <label>Is this person a member of this church?*</label><br>
                        <input type="radio" name="prayer_for_is_member" value="Yes" checked> Yes
                        <input type="radio" name="prayer_for_is_member" value="No"> No
                    </div>
                </div>

                {{-- Requested By --}}
                <div class="mb-3">
                    <h4>Requested By</h4>
                    <label for="requested_by">Your Name*</label>
                    <input type="text" name="requested_by" id="requested_by" class="form-control" required>

                    <label class="mt-2">Your Phone 1*</label>
                    <div class="row">
                        <div class="col-md-5">
                            <select name="phone_no_type_one" class="form-control">
                                <option value="Mobile">Mobile</option>
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="phone_no_one" class="form-control" required>
                        </div>
                    </div>

                    <label class="mt-2">Your Email*</label>
                    <input type="email" name="your_email" class="form-control" required>

                    <div class="mt-2">
                        <label>Are you a member of this church?*</label><br>
                        <input type="radio" name="requester_is_member" value="Yes" checked> Yes
                        <input type="radio" name="requester_is_member" value="No"> No
                    </div>
                </div>

                {{-- Message --}}
                <div class="mb-3">
                    <label for="message">Message*</label>
                    <textarea name="message" id="message" rows="6" class="form-control" required></textarea>
                </div>

                {{-- reCAPTCHA --}}
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                </div>

                {{-- Submit --}}
                <div class="mb-3 text-right">
                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection
