<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Order #{{ $order->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0;padding:0;background:#f4f7fa;font-family:Arial,sans-serif;">
    <table width="100%" bgcolor="#f4f7fa" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#fff"
                    style="border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.07);">

                    <!-- Header -->
                    <tr>
                        <td
                            style="padding:40px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;border-radius:12px 12px 0 0;text-align:center;">
                            <div style="font-size:48px;line-height:1.2;">🎉</div>
                            <h1 style="font-size:28px;font-weight:700;margin:10px 0;">Payment Successful!</h1>
                            <p style="font-size:16px;margin:0;">Order #{{ $order->id }}</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px 35px;">
                            <h2 style="color:#2d3748;margin:0 0 10px 0;font-size:22px;">Hello
                                {{ $order->fname ?? 'Customer' }}!</h2>
                            <p style="color:#555;font-size:15px;line-height:1.7;margin-bottom:28px;">
                                Thank you for your order and payment. We have received your order and started processing
                                it. Here are your order details:
                            </p>

                            <!-- Order Details Card -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom:30px;border-radius:8px;overflow:hidden;background:#f8fafc;">
                                <tr>
                                    <td
                                        style="padding:18px 0 18px 20px;width:180px;color:#667eea;font-size:15px;font-weight:600;">
                                        Order Date:</td>
                                    <td style="padding:18px 15px;color:#4a5568;font-size:15px;">
                                        {{ \Carbon\Carbon::parse($order->date_and_time)->format('F j, Y') }}
                                    </td>
                                </tr>
                                <tr style="border-top:1px solid #e2e8f0;">
                                    <td style="padding:18px 0 18px 20px;font-weight:600;color:#667eea;font-size:15px;">
                                        Payment Status:</td>
                                    <td style="padding:18px 15px;">
                                        <span
                                            style="background:#38b2ac;color:#fff;padding:7px 15px;border-radius:18px;font-size:14px;font-weight:700;display:inline-block;">Paid</span>
                                    </td>
                                </tr>
                                <tr style="border-top:1px solid #e2e8f0;">
                                    <td style="padding:18px 0 18px 20px;font-weight:600;color:#667eea;font-size:15px;">
                                        Transaction ID:</td>
                                    <td style="padding:18px 15px;color:#4a5568;">#{{ $order->transaction_id ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr style="border-top:1px solid #e2e8f0;">
                                    <td style="padding:18px 0 18px 20px;font-weight:600;color:#667eea;font-size:15px;">
                                        Total Amount:</td>
                                    <td style="padding:18px 15px;font-size:18px;color:#38a169;font-weight:700;">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                                <tr style="border-top:1px solid #e2e8f0;">
                                    <td style="padding:18px 0 18px 20px;font-weight:600;color:#667eea;font-size:15px;">
                                        Order Type:</td>
                                    <td style="padding:18px 15px;color:#4a5568;">{{ $order->order_type }}</td>
                                </tr>
                            </table>

                            <!-- Shipping Address -->
                            @if ($order->street_address1)
                                <div
                                    style="background:#e6fffa;border-left:5px solid #38b2ac;padding:20px 25px 10px 25px;border-radius:7px;margin-bottom:24px;">
                                    <h3 style="color:#22543d;margin:0 0 10px 0;font-size:17px;">Shipping Address</h3>
                                    <p style="color:#285e61;font-size:15px;line-height:1.6;margin:0;">
                                        @if ($order->ship_to_different_address == 0)
                                            {{ $order->fname }} {{ $order->lname }}<br>
                                            {{ $order->street_address1 . ' ' . $order->street_address2 }}<br>
                                        @endif

                                        @if ($order->ship_to_different_address == 1)
                                            {{ $order->d_fname }} {{ $order->d_lname }}<br>
                                            {{ $order->d_street_address1 . ' ' . $order->d_street_address2 }}<br>
                                        @endif
                                        {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                                        @if ($order->country)
                                            {{ $order->country }}
                                        @endif
                                    </p>
                                </div>
                            @endif

                            <!-- Card Info (if wanted) -->
                            @if ($order->card_type || $order->card_number)
                                <div
                                    style="background:#fefcbf;border-left:5px solid #ecc94b;padding:18px 25px 8px 25px;border-radius:7px;margin-bottom:22px;">
                                    <h3 style="color:#b7791f;margin:0 0 8px 0;font-size:16px;">Card Info</h3>
                                    <p style="color:#b7791f;font-size:14px;margin:0;">
                                        <strong>Type:</strong> {{ $order->card_type ?? 'N/A' }}<br>
                                        <strong>Number:</strong> **** **** **** {{ $order->card_number ?? 'XXXX' }}
                                    </p>
                                </div>
                            @endif



                            @if (!empty($cartItems))
                                <h3 style="color:#2d3748;">Your Order Items</h3>
                                <table width="100%" cellpadding="6" cellspacing="0"
                                    style="border-collapse: collapse; margin-bottom: 30px; background:#f8fafc; border-radius:8px;">
                                    <thead>
                                        <tr style="background:#667eea; color:#fff; text-align:left;">
                                            <th style="padding: 12px;">Product</th>
                                            <th style="padding: 12px; text-align:center;">Quantity</th>
                                            <th style="padding: 12px; text-align:right;">Price</th>
                                            <th style="padding: 12px; text-align:right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr style="border-top:1px solid #e2e8f0; vertical-align: middle;">
                                                <td style="padding: 12px; display: flex; align-items: center;">
                                                    <img src="{{ asset('storage/products/' . $item['image']) }}"
                                                        alt="{{ $item['name'] }}" width="50"
                                                        style="margin-right: 12px; border-radius: 6px;">
                                                    {{ $item['name'] }}
                                                </td>
                                                <td style="padding: 12px; text-align:center;">{{ $item['quantity'] }}
                                                </td>
                                                <td style="padding: 12px; text-align:right;">
                                                    ${{ number_format($item['price'], 2) }}</td>
                                                <td style="padding: 12px; text-align:right;">
                                                    ${{ number_format($item['quantity'] * $item['price'], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table width="100%" cellpadding="6" cellspacing="0" style="margin-bottom:25px;">
                                    <tr>
                                        <td style="color:#222;">Subtotal:</td>
                                        <td style="text-align:right;">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#222;">Total Tax (10%):</td>
                                        <td style="text-align:right;">${{ number_format($tax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#222;">Shipping:</td>
                                        <td style="text-align:right;">${{ number_format($shipping, 2) }}</td>
                                    </tr>
                                    <tr style="font-weight:bold; border-top:1px solid #667eea;">
                                        <td style="color:#2d3748;">Total:</td>
                                        <td style="text-align:right; color:#764ba2;">${{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                </table>

                            @endif

                            @if (!empty($digitalProducts))
                                <div
                                    style="background:#fff3f3;border-left:5px solid #f56565;padding:20px 25px;border-radius:7px;margin-bottom:24px;">
                                    <h3 style="color:#c53030;margin-bottom:10px;">Digital Products</h3>
                                    <p style="color:#718096;font-size:14px;">
                                        Your purchased digital product(s) are attached with this email.
                                    </p>
                                </div>
                            @endif
                            <!-- Order Summary Button -->

                            <!-- Thank You -->
                            <div style="text-align:center;margin:38px 0;">
                                <span style="font-size:46px;">🛒</span>
                                <p style="font-size:16px;color:#2d3748;font-weight:600;margin-top:12px;">
                                    Your order is being processed.<br>
                                    <span style="color:#764ba2;">Thank you for shopping with us!</span>
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="text-align:center;background:#f8fafc;padding:24px 25px;border-radius:0 0 12px 12px;border-top:1px solid #e2e8f0;">
                            <p style="margin:0;font-size:14px;color:#667eea;font-weight:700;">{{ config('app.name') }}
                            </p>
                            <p style="margin:8px 0 0 0;color:#4a5568;font-size:13px;">
                                Need help? Email
                                <a href="mailto:support@labrookins.com"
                                    style="color:#667eea;text-decoration:none;">support@labrookins.com</a>
                            </p>
                            <p style="margin:8px 0 0 0;color:#a0aec0;font-size:12px;line-height:1.6;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
