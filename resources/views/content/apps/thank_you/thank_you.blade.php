@extends('layouts.homeLayout')

@section('title', 'Thank You | L.A. BROOKINS MINISTRIES')

@section('content')
    <section class="thank-you-section" style="text-align:center; padding:60px 20px;">
        <div class="thank-you-container">
            <i class="bi bi-check-circle text-success display-1 mb-3"></i>
            <h1 style="font-size:2.5rem; margin-bottom:20px; color:#198754;"> Thank You!</h1>
            <p style="font-size:1.2rem; margin-bottom:30px; color:#555;">
                Thank you for your order. It will be processed and sent out as soon as possible. If you have any questions
                please contact us at: <a href="mailto:labministries@att.net">labministries@att.net</a>
            </p>
            <a href="{{ url('/') }}"
                style="display:inline-block; padding:12px 25px; background:#4CAF50; color:#fff;
                  text-decoration:none; border-radius:5px; font-size:1rem;">
                Back to Home
            </a>
        </div>
    </section>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        localStorage.removeItem("guestId");
        console.log("guest_id removed from localStorage");
    });
</script>
