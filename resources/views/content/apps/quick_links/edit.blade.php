@extends('layouts/layoutMaster')

@section('title', 'Quick Links')

@section('content')
    <div class="card">
        <div class="container">
            <div class="card-header">
                <h4 class="card-title">Quick Links</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('home.quicklinks.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Link 1 --}}
                    <div class="mb-4">
                        <div class="">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title1" value="{{ old('title1', $quickLinks->title1 ?? '') }}"
                                class="form-control">
                            @error('title1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="">
                            <label class="form-label mt-2">Image</label>
                            <input type="file" name="image1" class="form-control">
                            @if (isset($quickLinks) && $quickLinks->image1)
                                <img src="{{ Storage::url($quickLinks->image1) }}" class="img-fluid mt-2"
                                    style="max-width:150px;">
                            @endif
                        </div>

                        <div class="mt-2">
                            <label class="form-label mt-2">URL <span class="text-danger">*</span></label>
                            <input type="text" name="url1" value="{{ old('url1', $quickLinks->url1 ?? '') }}"
                                class="form-control">
                            @error('url1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- Link 2 --}}
                    <div class="mb-4">
                        <div class="">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title2" value="{{ old('title2', $quickLinks->title2 ?? '') }}"
                                class="form-control">
                            @error('title2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="">
                            <label class="form-label mt-2">Image</label>
                            <input type="file" name="image2" class="form-control">
                            @if (isset($quickLinks) && $quickLinks->image2)
                                <img src="{{ Storage::url($quickLinks->image2) }}" class="img-fluid mt-2"
                                    style="max-width:150px;">
                            @endif
                        </div>

                        <div class="mt-2">
                            <label class="form-label mt-2">URL <span class="text-danger">*</span></label>
                            <input type="text" name="url2" value="{{ old('url2', $quickLinks->url2 ?? '') }}"
                                class="form-control">
                            @error('url2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- Link 3 --}}
                    <div class="mb-4">
                        <div class="">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title3" value="{{ old('title3', $quickLinks->title3 ?? '') }}"
                                class="form-control">
                            @error('title3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="">
                            <label class="form-label mt-2">Image</label>
                            <input type="file" name="image3" class="form-control">
                            @if (isset($quickLinks) && $quickLinks->image3)
                                <img src="{{ Storage::url($quickLinks->image3) }}" class="img-fluid mt-2"
                                    style="max-width:150px;">
                            @endif
                        </div>

                        <div class="mt-2">
                            <label class="form-label mt-2">URL <span class="text-danger">*</span></label>
                            <input type="text" name="url3" value="{{ old('url3', $quickLinks->url3 ?? '') }}"
                                class="form-control">
                            @error('url3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- Link 4 (optional) --}}
                    <div class="mb-4">
                        <div class="">
                            <label class="form-label">Title</label>
                            <input type="text" name="title4" value="{{ old('title4', $quickLinks->title4 ?? '') }}"
                                class="form-control">
                        </div>
                        <div class="">
                            <label class="form-label mt-2">Image</label>
                            <input type="file" name="image4" class="form-control">
                            @if (isset($quickLinks) && $quickLinks->image4)
                                <img src="{{ Storage::url($quickLinks->image4) }}" class="img-fluid mt-2"
                                    style="max-width:150px;">
                            @endif
                        </div>
                        <div class="mt-2">
                            <label class="form-label mt-2">URL</label>
                            <input type="text" name="url4" value="{{ old('url4', $quickLinks->url4 ?? '') }}"
                                class="form-control">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
