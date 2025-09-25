@extends('layouts.homeLayout')

@section('title', $page_title ?? 'Event Details')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .evntDetailsTitle {
        font-size: 30px;
        color: #02092b;
        font-weight: bold;
        margin-bottom: 15px !important;
    }

    .no-padding {
        margin: 0px !important;
        padding: 0px !important;
        padding-left: 17px !important;
    }

    .orgTitle {
        font-size: 22px;
        font-weight: bold;
        margin-top: 20px;
        color: #02092b;
    }

    .event_details p {
        margin-bottom: 8px;
        font-size: 16px;
    }
</style>
@endpush

@section('content')

{{-- Banner Section --}}
@if(!empty($event->image))
<section id="hero" class="hero">
    <div class="container" data-aos="zoom-in">
        <img src="{{ asset('storage/' . $event->image) }}" class="commonBanner" style="width:100%;">
    </div>
</section>
@endif

{{-- Event Details Section --}}
<section class="container-fluid no-padding">
    <div class="container event_details commongBlackEvntDetails">
        <h3 class="mb-3 evntDetailsTitle">{{ $event->title }}</h3>

        <div class="row">
            {{-- Date & Time --}}
            <div class="col-md-12">
                <p><i class="fa fa-calendar-alt"></i> :-
                    {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                    @if(!empty($event->time_from))
                        @ {{ $event->time_from }}
                    @endif
                </p>
            </div>

            {{-- Venue Location --}}
            @if(!empty($event->venue_location))
                <p><i class="fa fa-map-marker-alt"></i> :- {{ $event->venue_location }}</p>
            @endif

            {{-- Website
            @if(!empty($event->website))
                <p><strong>Website :</strong> <a href="{{ $event->website }}" target="_blank">{{ $event->website }}</a></p>
            @endif --}}

            {{-- Cost --}}
            @if(isset($event->cost))
                <p><strong>Cost :</strong> {{ $event->cost != 0 ? $event->cost : 'Free' }}</p>
            @endif

            {{-- Description --}}
            @if(!empty($event->description))
                <p><strong>Description :</strong> {!! $event->description !!}</p>
            @endif

            {{-- Organizer Details --}}
            @if(!empty($event->organizer_name) || !empty($event->organizer_email) || !empty($event->organizer_phone))
                <h4 class="orgTitle">Organizer Details :</h4>

                @if(!empty($event->organizer_name))
                    <p><strong>Name :</strong> {{ $event->organizer_name }}</p>
                @endif

                @if(!empty($event->organizer_email))
                    <p><strong>Email :</strong> {{ $event->organizer_email }}</p>
                @endif

                @if(!empty($event->organizer_phone))
                    <p><strong>Phone :</strong> {{ $event->organizer_phone }}</p>
                @endif
            @endif

            {{-- Venue Details --}}
            @if(!empty($event->venue_name) || !empty($event->venue_phone) || !empty($event->venue_website) || !empty($event->venue_gmap_link))
                <h4 class="orgTitle">Venue Details :</h4>

                @if(!empty($event->venue_name))
                    <p><strong>Name :</strong> {{ $event->venue_name }}</p>
                @endif

                @if(!empty($event->venue_location))
                    <p><strong>Location :</strong> {{ $event->venue_location }}</p>
                @endif

                @if(!empty($event->venue_phone))
                    <p><strong>Phone :</strong> {{ $event->venue_phone }}</p>
                @endif

                @if(!empty($event->venue_website))
                    <p><strong>Website :</strong> <a href="{{ $event->venue_website }}" target="_blank">{{ $event->venue_website }}</a></p>
                @endif

                @if(!empty($event->venue_gmap_link))
                    <p><strong>Google Map :</strong></p>
                    <iframe src="{{ $event->venue_gmap_link }}" width="400" height="400" style="border:0;"
                        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
            @endif
        </div>
    </div>
</section>

@endsection
