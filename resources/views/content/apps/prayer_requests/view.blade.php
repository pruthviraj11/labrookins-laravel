@extends('layouts/layoutMaster')

@section('title', 'View Prayer Request')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">View Prayer Request </h5>
        </div>
        <div class="card-body">
            <p><strong>Category :</strong> {{ $request->category }}</p>
            <p><strong>Subject :</strong> {{ $request->subject }}</p>
            <div class="bg-secondary ">
                <h3 class="p-2 fw-bold">Who Needs Prayer?</h3>
            </div>
            <p><strong>Name :</strong> {{ $request->need_prayer_name }}</p>
            <p><strong>Member of this church? :</strong> {{ $request->prayer_church_member }}</p>
            <div class="bg-secondary ">
                <h3 class=" p-2 fw-bold">Requested By</h3>
            </div>
            <p><strong> Name :</strong> {{ $request->requested_name }}</p>
            <p><strong>Phone :</strong> {{ $request->phone_no_type_one }} </p>
            {{-- <p><strong>Phone 2:</strong> {{ $request->phone_no_type_two }} {{ $request->mobile_two }}</p> --}}
            <p><strong>Email :</strong> {{ $request->email }}</p>
            <p><strong>Member of this church? :</strong> {{ $request->requested_church_member }}</p>
            <p><strong>Message :</strong> {{ $request->message }}</p>
        </div>
    </div>
@endsection
