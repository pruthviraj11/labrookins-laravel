@extends('layouts/layoutMaster')
@section('title', $page_data['page_title'])

@section('vendor-style')
    {{-- Page Css files --}}
@endsection

@section('page-style')
    <!-- Page css files -->
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-tree.css')) }}"> --}}
@endsection

@section('content')

    @if ($page_data['page_title'] == 'All Page Banner Add')
        <form action="{{ route('app-all_page_banner-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @else
            <form action="{{ route('app-all_page_banner-update', encrypt($all_page_banner->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    @endif

    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $page_data['form_title'] }}</h4>
                        <a href="{{ route('app-all_page_banner-list') }}" class="col-md-2 btn btn-primary float-end">All Page
                            Banner List</a>

                        {{-- <h4 class="card-title">{{$page_data['form_title']}}</h4> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-6 col-sm-6 mb-1">
                                <label class="form-label" for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                @if (!empty($all_page_banner->image))
                                    <div class="mt-1">
                                        <img src="{{ asset('storage/' . $all_page_banner->image) }}" alt="Banner Image"
                                            class="img-thumbnail" width="150">
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 col-sm-6 mb-1">
                                <label class="form-label" for="page">Page</label>
                                <input type="text" class="form-control" id="page" name="page"
                                    value="{{ old('page', $all_page_banner->page ?? '') }}" placeholder="Enter page name">
                            </div>


                            <div class="col-md-6 col-sm-6 mb-1">
                                <label class="form-label" for="status">Status</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="status" name="status"
                                        {{ old('status', $all_page_banner->status ?? 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Active</label>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection
@section('vendor-script')
    {{-- Vendor js files --}}
@endsection

@section('page-script')
    {{-- Page js files --}}

@endsection
