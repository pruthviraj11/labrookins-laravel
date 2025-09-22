@extends('layouts.layoutMaster')
@section('title', $page_data['page_title'])

@section('content')
<form action="{{ $category ? route('categories.update', encrypt($category->id)) : route('categories.store') }}" method="POST">
    @csrf
    @if($category)
        @method('PUT')
    @endif

    <div class="card">
        <div class="card-header">
            <h4>{{ $page_data['form_title'] }}</h4>
            <a href="{{ route('categories.list') }}" class="btn btn-primary float-end">Back to List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span> </label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $category->title ?? '') }}">
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="is_active" {{ old('is_active', $category->is_active ?? 'active') === 'active' ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
