@extends('layouts/layoutMaster')

@section('title', 'Settings')
@section('vendor-style')
    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Settings</h4>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Website Title <span class="text-danger">*</span></label>
                            <input type="text" name="website_title" class="form-control"
                                value="{{ old('website_title', $setting->website_title ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Website Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if (!empty($setting->logo))
                                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" height="50">
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <h5 class="fw-bold">Contact Details</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $setting->email ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone No.<span class="text-danger">*</span></label>
                        <input type="text" name="contact" class="form-control"
                            value="{{ old('contact', $setting->contact ?? '') }}">
                    </div>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Address</label>
                    <!-- Quill Editor Container -->
                    <div id="address-editor" style="height: 200px;">
                        {!! old('address', $setting->address ?? '') !!}
                    </div>
                    <!-- Hidden textarea to store the content -->
                    <textarea name="address" id="address-content" style="display: none;">{{ old('address', $setting->address ?? '') }}</textarea>
                </div>
<hr>
                <h5 class="fw-bold">Social Media Links</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control"
                            value="{{ old('facebook', $setting->facebook ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Twitter</label>
                        <input type="text" name="twitter" class="form-control"
                            value="{{ old('twitter', $setting->twitter ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                            value="{{ old('instagram', $setting->instagram ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Youtube</label>
                        <input type="text" name="youtube" class="form-control"
                            value="{{ old('youtube', $setting->youtube ?? '') }}">
                    </div>
                </div>
<hr>
                <h5 class="fw-bold">Form Submit Email</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Prayer Request Email</label>
                        <input type="email" name="prayer_request_email" class="form-control"
                            value="{{ old('prayer_request_email', $setting->prayer_request_email ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Contact Form Email</label>
                        <input type="email" name="contact_form" class="form-control"
                            value="{{ old('contact_form', $setting->contact_form ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Scheduling Email</label>
                        <input type="email" name="scheduling_email" class="form-control"
                            value="{{ old('scheduling_email', $setting->scheduling_email ?? '') }}">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <button type="reset" class="btn btn-outline-secondary">Discard</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('vendor-script')
    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection

@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill editor
            var quill = new Quill('#address-editor', {
                theme: 'snow',
                placeholder: 'Enter address details...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean'],
                        ['link']
                    ]
                }
            });

            // Update hidden textarea when editor content changes
            quill.on('text-change', function() {
                document.getElementById('address-content').value = quill.root.innerHTML;
            });

            // Handle form submission
            document.querySelector('form').addEventListener('submit', function() {
                // Ensure the hidden textarea has the latest content
                document.getElementById('address-content').value = quill.root.innerHTML;
            });

            // Handle reset button
            document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
                setTimeout(function() {
                    // Clear the Quill editor content
                    quill.setContents([]);
                    document.getElementById('address-content').value = '';
                }, 10);
            });
        });
    </script>
@endsection
