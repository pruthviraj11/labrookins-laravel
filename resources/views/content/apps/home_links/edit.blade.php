@extends('layouts/layoutMaster')

@section('title', 'Home Links Settings')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Home Links</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('home.links.update') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12 ">
                        <label for="title1" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title1" id="title1" class="form-control"
                            value="{{ old('title1', $homeLink->title1 ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="url1" class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" name="url1" id="url1" class="form-control"
                            value="{{ old('url1', $homeLink->url1 ?? '') }}">
                    </div>

                    <div class="col-md-12 ">
                        <label for="title2" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title2" id="title2" class="form-control"
                            value="{{ old('title2', $homeLink->title2 ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="url2" class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" name="url2" id="url2" class="form-control"
                            value="{{ old('url2', $homeLink->url2 ?? '') }}">
                    </div>

                    <div class="col-md-12 ">
                        <label for="title3" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title3" id="title3" class="form-control"
                            value="{{ old('title3', $homeLink->title3 ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="url3" class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" name="url3" id="url3" class="form-control"
                            value="{{ old('url3', $homeLink->url3 ?? '') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
