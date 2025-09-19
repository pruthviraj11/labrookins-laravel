@extends('layouts/layoutMaster')

@section('title', 'Order Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Order #{{ $order->id }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $order->fname }} {{ $order->lname }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
        <p><strong>Address:</strong> {{ $order->street_address1 }}, {{ $order->city }}, {{ $order->state }}</p>
        <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
        <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
        <p><strong>Response:</strong> {{ $order->response_desc }}</p>
        <p><strong>Order Type:</strong> {{ $order->order_type }}</p>
        <p><strong>Date:</strong> {{ $order->date_and_time }}</p>
    </div>
</div>
@endsection
