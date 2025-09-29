@extends('layouts.homeLayout')

@section('title', 'Error | L.A. BROOKINS MINISTRIES')

@section('content')
    <section class="error-section" style="text-align:center; padding:60px 20px;">
        <div class="error-container">
            <i class="bi bi-x-circle text-danger display-1 mb-3"></i>
            <h1 style="font-size:2.5rem; margin-bottom:20px; color:#c0392b;">Oops! Something Went Wrong</h1>
            <p style="font-size:1.2rem; margin-bottom:30px; color:#555;">
                We're sorry, but your request could not be processed at this time.
                Please try again later or contact our support team if the issue continues.
            </p>
            <a href="{{ url('/') }}"
                style="display:inline-block; padding:12px 25px; background:#e74c3c; color:#fff;
                  text-decoration:none; border-radius:5px; font-size:1rem;">
                Back to Home
            </a>
        </div>
    </section>
@endsection
