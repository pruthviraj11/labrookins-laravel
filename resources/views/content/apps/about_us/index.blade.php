@extends('layouts.layoutMaster')

@section('title', 'About Us')

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #editor {
            height: 300px;
            /* change to any height you want */
        }

        .ql-editor {
            min-height: 300px;
            /* ensures typing area stays large */
        }
    </style>
@endsection


@section('vendor-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Manage About Us</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('about-us.save') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <div id="editor">{!! $aboutUs->description ?? '' !!}</div>
                    <textarea name="description" id="description" class="d-none">{!! $aboutUs->description ?? '' !!}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

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
@endsection
