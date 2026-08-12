@extends('layouts.homeLayout')

@section('title', 'Error | L.A. BROOKINS MINISTRIES')

@section('content')
    <section class="error-section" style="text-align:center; padding:60px 20px;">
        <div class="error-container">
            <i class="bi bi-x-circle text-danger display-1 mb-3"></i>
            <h1 style="font-size:2.5rem; margin-bottom:20px; color:#c0392b;">Oops! Payment Failed</h1>

            @if(session('error'))
                <div style="display:inline-block; background:#fff3f3; border:1px solid #f5c6cb; border-radius:8px;
                            padding:14px 28px; margin-bottom:24px; max-width:480px;">
                    <p style="font-size:1.05rem; color:#c0392b; margin:0;">
                        <strong>Reason:</strong> {{ session('error') }}
                    </p>
                </div>
            @else
                <p style="font-size:1.2rem; margin-bottom:30px; color:#555;">
                    We're sorry, but your payment could not be processed at this time.
                    Please check your card details and try again, or contact our support team.
                </p>
            @endif

            @if ($errors->has('payment'))
                <div style="display:inline-block; background:#fff3f3; border:1px solid #f5c6cb; border-radius:8px;
                            padding:14px 28px; margin-bottom:24px; max-width:480px;">
                    <p style="font-size:1.05rem; color:#c0392b; margin:0;">
                        {{ $errors->first('payment') }}
                    </p>
                </div>
            @endif

            <div>
                <a href="javascript:history.back()"
                    style="display:inline-block; padding:12px 25px; background:#e74c3c; color:#fff;
                      text-decoration:none; border-radius:5px; font-size:1rem; margin-right:10px;">
                    &larr; Try Again
                </a>
                <a href="{{ url('/') }}"
                    style="display:inline-block; padding:12px 25px; background:#6c757d; color:#fff;
                      text-decoration:none; border-radius:5px; font-size:1rem;">
                    Back to Home
                </a>
            </div>
        </div>
    </section>
@endsection

