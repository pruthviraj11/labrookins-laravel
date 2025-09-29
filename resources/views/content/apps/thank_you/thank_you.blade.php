@extends('layouts.homeLayout')

@section('title', 'Thank You | L.A. BROOKINS MINISTRIES')

@section('content')
<section class="thank-you-section" style="text-align:center; padding:60px 20px;">
    <div class="thank-you-container">
        <h1 style="font-size:2.5rem; margin-bottom:20px; color:#333;">Thank You!</h1>
        <p style="font-size:1.2rem; margin-bottom:30px; color:#555;">
            We truly appreciate you reaching out to L.A. Brookins Ministries.
            Your message has been received, and our team will get back to you as soon as possible.
        </p>
        <a href="{{ url('/') }}"
           style="display:inline-block; padding:12px 25px; background:#4CAF50; color:#fff;
                  text-decoration:none; border-radius:5px; font-size:1rem;">
            Back to Home
        </a>
    </div>
</section>
@endsection
