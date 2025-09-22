@extends('layouts/layoutMaster')

@section('title', $page_data['page_title'])

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #description,
        #long_description {
            height: 200px;
        }

        .ql-editor {
            min-height: 200px;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('content')
    <form action="{{ $devotional ? route('devotional.update', encrypt($devotional->id)) : route('devotional.store') }}"
        method="POST">
        @csrf
        @if ($devotional)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h4>{{ $page_data['form_title'] }}</h4>
                <a href="{{ route('devotional.list') }}" class="btn btn-primary float-end">Back</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title', $devotional->title ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <div id="description-editor">{!! $devotional->description ?? '' !!}</div>
                    <textarea name="description" id="description" class="d-none">{!! $devotional->description ?? '' !!}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Long Description</label>
                    <div id="long-description-editor">{!! $devotional->long_description ?? '' !!}</div>
                    <textarea name="long_description" id="long_description" class="d-none">{!! $devotional->long_description ?? '' !!}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Page <span class="text-danger">*</span></label>
                    <select name="page" class="form-control form-control-lg form-control-solid" id="page">
                        @php
                            $options = [
                                '' => 'Select a page',
                                'word_for_today' => 'Word For Today',
                                'blog' => 'Blog',
                            ];
                        @endphp

                        @foreach ($options as $key => $value)
                            <option value="{{ $key }}"
                                {{ old('page', $devotional->page ?? '') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('page')
                        <span class="d-block invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="status" class="form-check-input"
                            {{ old('status', $devotional->status ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('page-script')
    <script>
        var descriptionQuill = new Quill('#description-editor', {
            theme: 'snow'
        });
        var longDescriptionQuill = new Quill('#long-description-editor', {
            theme: 'snow'
        });

        $('form').on('submit', function() {
            $('#description').val(descriptionQuill.root.innerHTML);
            $('#long_description').val(longDescriptionQuill.root.innerHTML);
        });
    </script>
@endsection
