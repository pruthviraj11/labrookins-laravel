@extends('layouts/layoutMaster')
@section('title', $page_data['page_title'])

@section('content')
@if ($page_data['page_title'] == 'Add Home Banner')
<form action="{{ route('home.home_banner.store') }}" method="POST" enctype="multipart/form-data">
@csrf
@else
<form action="{{ route('home.home_banner.update', encrypt($home_banner->id)) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
@endif

<section id="multiple-column-form">
    <div class="card">
        <div class="card-header">
            <h4>{{ $page_data['form_title'] }}</h4>
            <a href="{{ route('home.home_banner.list') }}" class="btn btn-primary float-end">Back to List</a>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title', $home_banner->title ?? '') }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Order No</label>
                    <input type="number" name="order_by" value="{{ old('order_by', $home_banner->order_by ?? '') }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(!empty($home_banner->image))
                        <img src="{{ asset('storage/'.$home_banner->image) }}" width="150" class="mt-2 img-thumbnail">
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label><br>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="status" class="form-check-input" {{ old('status', $home_banner->status ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </div>
    </div>
</section>
</form>
@endsection
