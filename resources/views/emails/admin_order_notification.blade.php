<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>New Order Notification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body
    style="margin:0; padding:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#f4f7fa;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width:700px; margin:auto; background:#fff; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
        <!-- Header -->
        <tr>
            <td
                style="padding:25px; background-color:#34495e; border-radius:8px 8px 0 0; text-align:center; color:#fff;">
                <h2 style="margin:0; font-size:28px; font-weight:700;">🛒 New Order Received</h2>
                <p style="margin:8px 0 0; font-size:16px; letter-spacing:0.04em;">Order #{{ $order->id }} |
                    {{ $order->created_at->format('M d, Y h:i A') }}</p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding:30px 40px; color:#333; line-height:1.5;">
                <!-- Customer Info -->
                <h3
                    style="margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px; font-weight:700;">
                    👤 Customer Information</h3>
                <p style="margin:0; font-size:15px;">
                    <strong>Name:</strong> {{ $order->fname }} {{ $order->lname }}<br />
                    <strong>Email:</strong> <a href="mailto:{{ $order->email }}"
                        style="color:#3498db; text-decoration:none;">{{ $order->email }}</a><br />
                    <strong>Phone:</strong> {{ $order->mobile }}
                </p>

                <!-- Shipping Address -->
                <h3
                    style="margin-top:30px; margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px; font-weight:700;">
                    📦 Ship To Address</h3>
                <p style="margin:0; font-size:15px; color:#555;">
                    @if ($order->ship_to_different_address == 0)
                        {{ $order->fname }} {{ $order->lname }}<br>
                        {{ $order->street_address1 . ' ' . $order->street_address2 }}<br>
                    @endif

                    @if ($order->ship_to_different_address == 1)
                        {{ $order->d_fname }} {{ $order->d_lname }}<br>
                        {{ $order->d_street_address1 . ' ' . $order->d_street_address2 }}<br>
                    @endif
                    @if ($order->city)
                        {{ $order->city }},
                    @endif
                    @if ($order->state)
                        {{ $order->state }}
                    @endif
                    @if ($order->zip_code)
                        - {{ $order->zip_code }}
                    @endif
                    <br />
                    {{ $order->country }}
                </p>

                <!-- Order Summary -->
                <h3
                    style="margin-top:30px; margin-bottom:10px; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:6px; font-weight:700;">
                    🧾 Order Summary</h3>
                <table style="width:100%; border-collapse:collapse; font-size:15px; color:#444;">
                    <thead>
                        <tr style="background:#ecf0f1; color:#2c3e50; font-weight:700; text-align:left;">
                            <th style="padding:12px; border-top-left-radius:8px;">Product</th>
                            <th style="padding:12px; text-align:center;">Qty</th>
                            <th style="padding:12px; text-align:right;">Price</th>
                            <th style="padding:12px; text-align:right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr style="border-top:1px solid #e1e5eb;">
                                <td style="padding:12px; display:flex; align-items:center;">
                                    @if (!empty($item['image']) && file_exists(storage_path('app/public/products/' . $item['image'])))
                                        <img src="{{ asset('storage/products/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}" width="50"
                                            style="margin-right:12px; border-radius:6px;" />
                                    @else
                                        <span
                                            style="display:inline-flex; justify-content:center; align-items:center; width:50px; height:50px; margin-right:12px; border-radius:6px; background:#f0f0f0; color:#555; font-size:12px;">
                                            No Image
                                        </span>
                                    @endif
                                    {{ $item['name'] }}
                                </td>
                                <td style="padding:12px; text-align:center;">{{ $item['quantity'] }}</td>
                                <td style="padding:12px; text-align:right;">${{ number_format($item['price'], 2) }}
                                </td>
                                <td style="padding:12px; text-align:right;">
                                    ${{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <table style="width:100%; margin-top:20px; border-top:2px solid #ddd; font-size:16px; color:#222;">
                    <tr>
                        <td style="padding:10px 0; font-weight:600;">Subtotal:</td>
                        <td style="text-align:right; padding:10px 0;">${{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; font-weight:600;">Tax:</td>
                        <td style="text-align:right; padding:10px 0;">${{ number_format($tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; font-weight:600;">Shipping:</td>
                        <td style="text-align:right; padding:10px 0;">${{ number_format($shipping, 2) }}</td>
                    </tr>
                    <tr style="background:#f9f9f9; font-weight:700; border-top:2px solid #667eea;">
                        <td style="padding:10px 0; color:#2d3748;">Total:</td>
                        <td style="text-align:right; padding:10px 0; color:#764ba2;">${{ number_format($total, 2) }}
                        </td>
                    </tr>
                </table>

                <!-- View More Details Button -->
                {{-- <p style="margin-top:30px; text-align:center;">
                    <a href="{{ url('/admin/orders/' . $order->id) }}"
                        style="background-color:#3498db; color:#fff; padding:12px 24px; border-radius:5px; font-weight:600; text-decoration:none; box-shadow:0 3px 8px rgba(52, 152, 219, 0.5); display:inline-block; transition:background-color 0.3s;">
                        View Order Details
                    </a>
                </p> --}}

                <!-- Footer -->
                <p style="margin-top:40px; font-size:14px; color:#667eea; font-weight:700; text-align:center;">
                    {{ config('app.name') }}</p>
                <p style="margin:8px 0 0 0; font-size:13px; color:#4a5568; text-align:center;">Need help? Email <a
                        href="mailto:support@labrookins.com"
                        style="color:#667eea; text-decoration:none;">support@labrookins.com</a></p>
                <p style="margin:8px 0 0 0; font-size:12px; color:#a0aec0; text-align:center;">&copy;
                    {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>

            </td>
        </tr>
    </table>
</body>

</html>
