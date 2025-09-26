@extends('layouts.homeLayout')

@section('title', 'Itinerary | L.A. BROOKINS MINISTRIES')


@section('content')

    <!-- FullCalendar CSS -->
    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}

    <style>
        .alert-success {
            background: lightyellow;
            border-color: lightyellow;
            color: purple;
            font-size: 25px;
            padding: 10px;
        }
    </style>

    {{-- Hero Section --}}
    <section id="hero" class="hero">
        <div class="container" data-aos="zoom-in">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            @if (!empty($home_banner) && !empty($home_banner->image))
                                <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid"
                                    alt="{{ $home_banner->title ?? 'Banner' }}" />
                            @else
                                <img src="{{ asset('assets/img/itinerary-banner.jpg') }}" class="img-fluid"
                                    alt="Default Banner" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Calendar Section --}}
    <section class="eventsMain mt-5">
        <div class="container">
            <div class="mt-3">
                <div id="calendar"></div>
            </div>
        </div>
    </section>

    @push('scripts')
        <link href="{{ asset('assets/css/fullCalendar.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- jQuery -->

        <!-- Moment.js -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>

        <!-- FullCalendar JS -->
        <script src="{{ asset('assets/js/fullCalendar.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // alert('ll');
                var date = new Date(),
                    d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear(),
                    width = $(window).width(); // Use jQuery to get window width

                // Initialize FullCalendar
                $('#calendar').fullCalendar({
                    // alert('ll');
                    defaultView: width < 800 ? 'agendaDay' : 'month',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth'
                    },
                    buttonText: {
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day',
                        list: 'Agenda',
                    },
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: '{{ route('calendar.data') }}',
                            dataType: 'json',
                            data: {
                                start: start.format("YYYY-MM-DD"),
                                end: end.format("YYYY-MM-DD")
                            },
                            success: function(data) {
                                callback(data);
                            }
                        });
                    },
                    eventRender: function(event, element, view) {
                        if (view.type === 'month') {
                            element.html('<b>' + event.title + ' (' + event.start.format('hh:mm A') +
                                ')</b>');
                        }
                        if (event.start.month() !== view.intervalStart.month()) {
                            element.hide();
                        }
                    },
                    eventClick: function(event) {
                        if (event.url) {
                            window.location = event.url;
                            return false;
                        }
                    },
                });
            });
        </script>
    @endpush
@endsection
