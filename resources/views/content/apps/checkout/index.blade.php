@extends('layouts.homeLayout')

@section('title', 'Checkout | L.A. BROOKINS MINISTRIES')

@section('content')
    <div class="container mt-5">
        <section id="hero" class="hero">
            <div class="container" data-aos="zoom-in">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                @if (!empty($home_banner) && !empty($home_banner->image))
                                    <img src="{{ asset('storage/' . $home_banner->image) }}" class="img-fluid"
                                        alt="{{ $home_banner->title ?? 'Books Banner' }}" />
                                @else
                                    <img src="{{ asset('home/assets/img/books_banner.png') }}" class="img-fluid"
                                        alt="Books Banner" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <h2 class="mb-4">Checkout</h2>


        <form action="{{ route('place_order.index') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Billing Details -->
                <div class="col-lg-6 mb-4">
                    <h4>Billing Details</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname"
                                value="{{ old('fname') }}" required>
                            @error('fname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname"
                                value="{{ old('lname') }}" required>
                            @error('lname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Company Name (optional)</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                name="company_name" value="{{ old('company_name') }}">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Country / Region <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                value="{{ old('country', 'United States (US)') }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-2 @error('street_address1') is-invalid @enderror"
                                name="street_address1" placeholder="House number and street name"
                                value="{{ old('street_address1') }}" required>
                            @error('street_address1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control @error('street_address2') is-invalid @enderror"
                                name="street_address2" placeholder="Apartment, suite, unit, etc. (optional)"
                                value="{{ old('street_address2') }}">
                            @error('street_address2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Town / City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">State / County (optional)</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" name="state"
                                value="{{ old('state') }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Zipcode</label>
                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                name="zip_code" value="{{ old('zip_code') }}">
                            @error('zip_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                value="{{ old('mobile') }}" required>
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Order Notes (optional)</label>
                            <textarea class="form-control @error('order_notes') is-invalid @enderror" name="order_notes" rows="3"
                                placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('order_notes') }}</textarea>
                            @error('order_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="col-lg-6 mb-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="differentShipping"
                            name="ship_to_different_address"
                            {{ old('ship_to_different_address', 'checked') ? 'checked' : '' }}>
                        <label class="form-check-label" for="differentShipping">Ship to a different address?</label>
                    </div>

                    <div id="shippingFields" class="{{ old('ship_to_different_address', 'checked') ? '' : 'd-none' }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="d_fname" value="{{ old('d_fname') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="d_lname" value="{{ old('d_lname') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Company Name (optional)</label>
                                <input type="text" class="form-control" name="d_company_name"
                                    value="{{ old('d_company_name') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Country / Region</label>
                                <input type="text" class="form-control" name="d_country"
                                    value="{{ old('d_country', 'United States (US)') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Street Address</label>
                                <input type="text" class="form-control mb-2" name="d_street_address1"
                                    placeholder="House number and street name" value="{{ old('d_street_address1') }}">
                                <input type="text" class="form-control" name="d_street_address2"
                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                    value="{{ old('d_street_address2') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Town / City</label>
                                <input type="text" class="form-control" name="d_city" value="{{ old('d_city') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">State / County (optional)</label>
                                <input type="text" class="form-control" name="d_state" value="{{ old('d_state') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Zipcode</label>
                                <input type="text" class="form-control" name="d_zip_code"
                                    value="{{ old('d_zip_code') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="d_mobile"
                                    value="{{ old('d_mobile') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="d_email" value="{{ old('d_email') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-3">
                        <h4 class="mb-3">Your Order</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @if (session('cart') && count(session('cart')) > 0)
                                    @foreach (session('cart') as $item)
                                        @php
                                            $total = $item['price'] * $item['quantity'];
                                            $grandTotal += $total;
                                        @endphp
                                        <tr>
                                            <td>{{ $item['name'] }} x {{ $item['quantity'] }}</td>
                                            <td class="text-end">${{ number_format($total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <th>Subtotal</th>
                                    <th class="text-end">${{ number_format($grandTotal, 2) }}</th>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <th class="text-end">${{ number_format(8.95, 2) }}</th>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-end">${{ number_format($grandTotal + 8.95, 2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #0072cf">Place
                            Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Show/hide shipping fields
            document.getElementById('differentShipping').addEventListener('change', function() {
                document.getElementById('shippingFields').classList.toggle('d-none', !this.checked);
            });

            // Show shipping fields by default
            document.getElementById('shippingFields').classList.remove('d-none');
        </script>
    @endpush
@endsection
