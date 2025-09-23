@extends('layouts.layoutMaster')

@section('title', isset($itinerary) ? 'Edit Itinerary' : 'Create Itinerary')

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
@endsection

@section('vendor-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ isset($itinerary) ? 'Edit' : 'Create' }} Events</h5>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ isset($itinerary) ? route('itinerary.update', encrypt($itinerary->id)) : route('itinerary.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($itinerary))
                    @method('PUT')
                @endif

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $itinerary->title ?? '') }}"
                        class="form-control" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">

                    {{-- Cost --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cost ($)</label>
                        <input type="number" step="0.01" name="cost"
                            value="{{ old('cost', $itinerary->cost ?? '') }}" class="form-control">
                        @error('cost')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" value="{{ old('website', $itinerary->website ?? '') }}"
                            class="form-control">
                        @error('website')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                {{-- Description (Quill) --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <div id="editor">{!! old('description', $itinerary->description ?? '') !!}</div>
                    <textarea name="description" id="description" class="d-none">{!! old('description', $itinerary->description ?? '') !!}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Time From --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Time From</label>
                        <input type="time" name="time_from" value="{{ old('time_from', $itinerary->time_from ?? '') }}"
                            class="form-control ">
                        @error('time_from')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Time To --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Time To</label>
                        <input type="time" name="time_to" value="{{ old('time_to', $itinerary->time_to ?? '') }}"
                            class="form-control ">
                        @error('time_to')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Start Date --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date"
                            value="{{ old('start_date', $itinerary->start_date ?? '') }}" class="form-control ">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $itinerary->end_date ?? '') }}"
                            class="form-control ">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Organizer Info --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Organizer Name</label>
                        <input type="text" name="organizer_name"
                            value="{{ old('organizer_name', $itinerary->organizer_name ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Organizer Email</label>
                        <input type="email" name="organizer_email"
                            value="{{ old('organizer_email', $itinerary->organizer_email ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Organizer Phone</label>
                        <input type="text" name="organizer_phone"
                            value="{{ old('organizer_phone', $itinerary->organizer_phone ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Venue Name</label>
                        <input type="text" name="venue_name"
                            value="{{ old('venue_name', $itinerary->venue_name ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Venue Phone</label>
                        <input type="text" name="venue_phone"
                            value="{{ old('venue_phone', $itinerary->venue_phone ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Venue Website</label>
                        <input type="text" name="venue_website"
                            value="{{ old('venue_website', $itinerary->venue_website ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Venue Location</label>
                        <input type="text" name="venue_location"
                            value="{{ old('venue_location', $itinerary->venue_location ?? '') }}" class="form-control">
                    </div>
                </div>






                {{-- Featured Image --}}
                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="image" class="form-control">
                    @if (isset($itinerary) && $itinerary->image)
                        <img src="{{ asset('storage/' . $itinerary->image) }}" class="mt-2" width="120">
                    @endif
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" name="status" class="form-check-input" id="status"
                        {{ old('status', $itinerary->status ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('itinerary.list') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        // Quill
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        $('form').on('submit', function() {
            $('#description').val(quill.root.innerHTML);
        });

        // Flatpickr
        $('.datepicker').flatpickr({
            dateFormat: "Y-m-d"
        });
        $('.timepicker').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i"
        });
    </script>
@endsection
