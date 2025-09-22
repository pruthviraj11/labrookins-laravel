@extends('layouts/layoutMaster')

@section('title', 'Home About')

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">About</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('home.welcome.update') }}" method="POST" enctype="multipart/form-data" id="welcomeForm">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $welcome->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <!-- Hidden textarea to store the actual content -->
                    <textarea name="description" id="description" style="display:none;" required>{{ old('description', $welcome->description ?? '') }}</textarea>
                    <!-- Quill editor container -->
                    <div id="quill-editor" style="height: 300px;"></div>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if (!empty($welcome->image))
                        <img src="{{ Storage::url($welcome->image) }}" alt="Welcome Image" class="img-fluid mt-2"
                            style="max-width:200px;">
                    @endif

                </div>

                <div class="mb-3">
                    <label for="text" class="form-label">Sub Title <span class="text-danger">*</span></label>
                    <input type="text" name="text" id="text" class="form-control"
                        value="{{ old('text', $welcome->text ?? '') }}" required>
                </div>

                {{-- <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" name="url" id="url" class="form-control" value="{{ old('url', $welcome->url ?? '') }}" required>
            </div> --}}

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill editor
            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['blockquote', 'code-block'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                },
                placeholder: 'Enter your description here...'
            });

            // Load existing content into Quill editor
            var existingContent = document.getElementById('description').value;
            if (existingContent) {
                quill.root.innerHTML = existingContent;
            }

            // Update hidden textarea when Quill content changes
            quill.on('text-change', function() {
                document.getElementById('description').value = quill.root.innerHTML;
            });

            // Ensure content is synced before form submission
            document.getElementById('welcomeForm').addEventListener('submit', function() {
                document.getElementById('description').value = quill.root.innerHTML;
            });
        });
    </script>
@endsection
