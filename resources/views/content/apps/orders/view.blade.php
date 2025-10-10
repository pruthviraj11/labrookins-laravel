@extends('layouts/layoutMaster')

@section('title', 'Order Details')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Order #{{ $order->id }}</h5>
            <button class="btn btn-primary btn-sm" onclick="window.print()">Print</button>
        </div>

        <div class="card-body">

            {{-- PERSONAL DETAILS --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Personal Details</h5>
                <div class="row">
                    <div class="col-md-4"><strong>Name:</strong> {{ $order->fname }} {{ $order->lname }}</div>
                    <div class="col-md-4"><strong>Company Name:</strong> {{ $order->company_name }}</div>
                    <div class="col-md-4"><strong>Phone:</strong> {{ $order->mobile }}</div>
                    <div class="col-md-4 mt-2"><strong>Email:</strong> {{ $order->email }}</div>
                </div>
            </div>

            {{-- PRODUCT INFORMATION --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Product Information</h5>

                @if ($product_data->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_data as $product)
                                    <tr>
                                        <td>
                                            @if ($product->product_image)
                                                <img src="{{ asset('storage/products/' . $product->product_image) }}"
                                                    width="70" class="rounded" alt="">
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_digital == 'yes' ? 'Digital' : 'Physical' }}</td>
                                        <td>{{ $product->quntity }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>${{ number_format($product->totalAmount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ORDER TOTAL SUMMARY --}}
                    <div class="d-flex justify-content-end">
                        @php
                            // Calculate subtotal, tax (10%), shipping, and total
                            $subtotal = $order->sub_total ?? $product_data->sum('totalAmount');
                            $subtotal = is_numeric($subtotal) ? floatval($subtotal) : 0;

                            $tax = round($subtotal * 0.1, 2); // 10% of subtotal
                            $shipping = '8.95';

                            // Compute total dynamically if not already in DB
                            // $grandTotal = isset($order->total_amount)
                            //     ? floatval($order->total_amount)
                            //     : round($subtotal + $tax + $shipping, 2);

                                $grandTotal = $subtotal + $tax + $shipping;
                        @endphp
                        <table class="table table-borderless w-auto text-end">
                            <tbody>
                                <tr>
                                    <th class="pe-3">Sub Total:</th>
                                    <td>${{ number_format($order->sub_total ?? $product_data->sum('totalAmount'), 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pe-3">Other Tax’s:</th>
                                    <td>${{ number_format($tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="pe-3">Shipping Charge:</th>
                                    <td>${{ number_format($shipping, 2) }}</td>
                                </tr>
                                <tr class="border-top fw-bold">
                                    <th class="pe-3">Total:</th>
                                    <td>${{ number_format($grandTotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="pe-3">Order Date And Time:</th>
                                    <td>{{ $order->date_and_time }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No products found for this order.</p>
                @endif
            </div>

            {{-- ADDRESS --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Address</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Street Address:</strong> {{ $order->street_address1 }}</p>
                        <p><strong>Company Name:</strong> {{ $order->company_name }}</p>
                        <p><strong>City:</strong> {{ $order->city }}</p>
                        <p><strong>State:</strong> {{ $order->state }}</p>
                        <p><strong>Zip Code:</strong> {{ $order->zip ?? '-' }}</p>
                        <p><strong>Country:</strong> {{ $order->country }}</p>
                        <p><strong>Phone:</strong> {{ $order->mobile }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                    </div>
                </div>
            </div>

            {{-- SHIP TO DIFFERENT ADDRESS --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Ship To Different Address</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $order->shipping_name ?? $order->fname }}
                            {{ $order->shipping_lname ?? $order->lname }}</p>
                        <p><strong>Company Name:</strong> {{ $order->shipping_company_name ?? $order->company_name }}</p>
                        <p><strong>Country:</strong> {{ $order->shipping_country ?? $order->country }}</p>
                        <p><strong>Street Address:</strong> {{ $order->shipping_address ?? $order->street_address1 }}</p>
                        <p><strong>City:</strong> {{ $order->shipping_city ?? $order->city }}</p>
                        <p><strong>State:</strong> {{ $order->shipping_state ?? $order->state }}</p>
                        <p><strong>Zip Code:</strong> {{ $order->shipping_zip ?? '-' }}</p>
                        <p><strong>Phone:</strong> {{ $order->shipping_phone ?? $order->mobile }}</p>
                        <p><strong>Email:</strong> {{ $order->shipping_email ?? $order->email }}</p>
                    </div>
                </div>
            </div>

            {{-- PAYMENT INFO --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Payment Information</h5>
                <div class="row">
                    <div class="col-md-4"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</div>
                    <div class="col-md-4"><strong>Order Confirmation:</strong> {{ ucfirst($order->response_desc) }}</div>
                    <div class="col-md-4"><strong>Order Type:</strong> {{ $order->order_type }}</div>
                </div>
            </div>

            {{-- ORDER STATUS --}}
            <div class="section mb-4">
                <h5 class="bg-light p-2 border rounded fw-bold">Order Status</h5>
                <form action="{{ route('orders.order_status', $order->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="row align-items-center">
        <div class="col-md-4">
            <label for="delivery_status" class="form-label">Delivered?</label>
            <select class="form-select" name="delivery_status" id="delivery_status">
                <option value="">Select Delivery Status</option>
                <option value="pending" {{ $order->delivered == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="delivered" {{ $order->delivered == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ $order->delivered == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-8 text-end mt-3 mt-md-0">
            <button type="submit" class="btn btn-success me-2">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Discard</a>
        </div>
    </div>
                </form>
            </div>

            {{-- FOOTER --}}
            <div class="text-end text-muted small mt-4">
                © {{ now()->year }} L.A. BROOKINS MINISTRIES
            </div>
        </div>
    </div>
@endsection
