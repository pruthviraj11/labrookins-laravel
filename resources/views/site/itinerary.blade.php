@extends('layouts.homeLayout')

@section('title', 'Itinerary')

@section('content')

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
                        @if(!empty($home_banner) && !empty($home_banner->image))
                            <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid" alt="{{ $home_banner->title ?? 'Banner' }}" />
                        @else
                            <img src="{{ asset('assets/img/itinerary-banner.jpg') }}" class="img-fluid" alt="Default Banner" />
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

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            width = screen.width;

        $('#calendar').fullCalendar({
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
            events: '{{ url("/calendar-data") }}',
            eventRender: function(event, element, view) {
                if (view.type === 'month') {
                    element.html('<b>' + event.title + ' (' + event.start.format('hh:mm A') + ')</b>');
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
@endsection
