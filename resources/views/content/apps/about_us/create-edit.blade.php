@extends('layouts/layoutMaster')
@section('title', $page_data['page_title'])

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    @if ($page_data['page_title'] == 'Add About Us')
        <form action="{{ route('app-about_us-store') }}" method="POST">
            @csrf
        @else
            <form action="{{ route('app-about_us-update', encrypt($about->id)) }}" method="POST">
                @csrf
                @method('PUT')
    @endif

    <section class="mt-3">
        <div class="card">
            <div class="card-header">
                <h4>{{ $page_data['form_title'] }}</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <div id="editor">{!! old('description', $about->description ?? '') !!}</div>
                    <textarea name="description" id="description" class="d-none"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </section>
    </form>
@endsection

@section('vendor-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('page-script')
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        $('form').on('submit', function() {
            $('#description').val(quill.root.innerHTML);
        });
    </script>
@endsection
