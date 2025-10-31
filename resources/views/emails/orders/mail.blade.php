<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <title>Order Confirmation - Order #{{ $order->id }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin:0; padding:0; background:#f4f7fa; font-family:Arial, sans-serif;">
    <table width="100%" bgcolor="#f4f7fa" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="650" cellpadding="0" cellspacing="0" border="0" bgcolor="#fff"
                    style="border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1);">


                    <!-- Header -->
                    <tr>
                        <td
                            style="padding:40px; background:#667eea; color:#fff; border-radius:12px 12px 0 0; text-align:center;">
                            <h1 style="font-size:28px; font-weight:700; margin:10px 0;">
                                Order Confirmation</h1>
                            <p style="font-size:16px; margin:0;">Order #{{ $order->id }}
                            </p>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding: 30px 40px 10px 40px; color: #2d3748;">
                            <h2 style="margin:0 0 10px 0; font-size:22px;">
                                Hi {{ $order->fname }} {{ $order->lname }}! 👋
                            </h2>
                            <p style="font-size:16px; line-height:1.6; margin:0;">
                                We're excited to confirm that we've received your order.
                                Here are the details:
                            </p>
                        </td>
                    </tr>

                    <!-- Order Summary -->
                    <tr>
                        <td style="padding: 20px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); border: 2px solid #38b2ac; border-radius: 10px; padding: 20px;">
                                <tr>
                                    <td
                                        style="width: 150px; font-weight:600; font-size:16px; color:#234e52; padding-bottom:10px;">
                                        Order Date:
                                    </td>
                                    <td style="font-size:16px; color:#234e52; padding-bottom:10px;">
                                        📅
                                        {{ \Carbon\Carbon::parse($order->date_and_time)->format('F d, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600; font-size:16px; color:#234e52; padding-bottom:10px;">
                                        Order Type:
                                    </td>
                                    <td style="font-size:16px; color:#234e52; padding-bottom:10px;">
                                        {{ ucfirst($order->order_type) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600; font-size:16px; color:#234e52; padding-bottom:10px;">
                                        Total Amount:
                                    </td>
                                    <td style="font-size:18px; color:#2f855a; font-weight:700;">
                                        💰
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Products Table -->
                    <tr>
                        <td style="padding: 0 40px 10px 40px;">
                            <h3 style="color:#2d3748; margin-bottom:15px;">Your Order Items
                            </h3>
                            @if ($product_data->isNotEmpty())
                                @php
                                    // Calculate subtotal, tax (10%), shipping, and total
                                    $subtotal = $order->sub_total ?? $product_data->sum('totalAmount');
                                    $subtotal = is_numeric($subtotal) ? floatval($subtotal) : 0;

                                    $tax = round($subtotal * 0.1, 2); // 10% tax

                                    // Check if there is any physical product (not digital)
                                    $hasPhysicalProduct = $product_data->contains(function ($product) {
                                        return $product->product_digital !== 'yes';
                                    });

                                    // Shipping fee if physical product exists
                                    $shipping = $hasPhysicalProduct ? 8.95 : 0;

                                    // Total amount including tax and shipping
                                    $total = $subtotal + $tax + $shipping;
                                @endphp

                                <table width="100%" cellpadding="8" cellspacing="0" border="0"
                                    style="border-collapse: collapse; background:#f8fafc; border-radius: 8px;">
                                    <thead>
                                        <tr style="background:#667eea; color:#fff; text-align:left;">
                                            <th style="padding: 12px;">Product</th>
                                            <th style="padding: 12px; text-align:center;">Quantity</th>
                                            <th style="padding: 12px; text-align:right;">Price</th>
                                            <th style="padding: 12px; text-align:right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_data as $item)
                                            <tr style="border-top:1px solid #e2e8f0; vertical-align: middle;">
                                                <td style="padding: 12px; font-size:15px; color:#2d3748;">
                                                    {{ $item->product_name ?? 'Product Name' }}
                                                </td>
                                                <td
                                                    style="padding: 12px; text-align:center; font-size:15px; color:#2d3748;">
                                                    {{ $item->quntity }}
                                                </td>
                                                <td
                                                    style="padding: 12px; text-align:right; font-size:15px; color:#2d3748;">
                                                    ${{ number_format((float) $item->price, 2) }}
                                                </td>
                                                <td
                                                    style="padding: 12px; text-align:right; font-size:15px; color:#2d3748;">
                                                    ${{ number_format($item->quntity * $item->price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Order Cost Summary -->
                                <table width="100%" cellpadding="6" cellspacing="0"
                                    style="margin-top: 15px; margin-bottom:25px;">
                                    <tr>
                                        <td style="color:#222; font-size:15px;">Subtotal:</td>
                                        <td style="text-align:right; font-size:15px;">
                                            ${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#222; font-size:15px;">Total Tax (10%):</td>
                                        <td style="text-align:right; font-size:15px;">${{ number_format($tax, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#222; font-size:15px;">Shipping:</td>
                                        <td style="text-align:right; font-size:15px;">
                                            ${{ number_format($shipping, 2) }}</td>
                                    </tr>
                                    <tr style="font-weight:bold; border-top:1px solid #667eea;">
                                        <td style="color:#2d3748; font-size:16px;">Total:</td>
                                        <td style="text-align:right; color:#764ba2; font-size:16px;">
                                            ${{ number_format($total, 2) }}</td>
                                    </tr>
                                </table>
                            @else
                                <p style="color:#4a5568; font-size:16px;">No products found in this order.</p>

                            @endif
                        </td>
                    </tr>

                    <!-- Customer Information -->
                    <tr>
                        <td
                            style="padding: 20px 40px; background: linear-gradient(135deg, #fef5e7 0%, #fed7aa 100%); border-left: 5px solid #f6ad55; border-radius: 8px; margin-bottom: 30px; color: #744210;">
                            <h3 style="margin-top:0; font-weight:600;">👤 Customer
                                Information</h3>
                            <p style="font-size:15px; margin:0;">
                                <strong>Name:</strong> {{ $order->fname }}
                                {{ $order->lname }}<br />
                                <strong>Email:</strong> <a href="mailto:{{ $order->email }}"
                                    style="color:#667eea; text-decoration:none;">{{ $order->email }}</a><br />
                                <strong>Mobile:</strong> <a href="tel:{{ $order->mobile }}"
                                    style="color:#2d3748; text-decoration:none;">{{ $order->mobile }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Shipping Address -->
                    <tr>
                        <td
                            style="padding: 20px 40px; background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%); border-left: 5px solid #4a5568; border-radius: 8px; margin-bottom: 30px; color: #2d3748;">
                            <h3 style="margin-top:0; font-weight:600;">🏠 Shipping Address
                            </h3>
                            <p style="font-size:15px; margin:0;">
                                <strong>{{ $order->fname }}
                                    {{ $order->lname }}</strong><br />
                                {{ $order->street_address1 }}<br />
                                @if ($order->street_address2)
                                    {{ $order->street_address2 }}<br />
                                @endif
                                {{ $order->city }}, {{ $order->state }}
                                {{ $order->zip_code }}<br />
                                @if ($order->country)
                                    {{ $order->country }}
                                @endif
                            </p>
                        </td>
                    </tr>

                    <!-- Order Status Confirmation -->
                    <tr>
                        <td
                            style="text-align:center; padding: 25px 40px; background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%); border: 2px solid #48bb78; border-radius: 10px; margin-bottom: 30px; color: #22543d;">
                            <div style="font-size: 50px; margin-bottom: 15px;">✅</div>
                            <h3 style="margin: 0 0 10px 0; font-size: 22px; font-weight: 600;text-align: center;">Order Confirmed!</h3>
                            <p style="font-size: 16px; margin: 0; line-height: 1.5;">
                                Your order has been successfully placed and is being
                                processed.
                                You'll receive another email with tracking information
                                once your order ships.
                            </p>
                        </td>
                    </tr>

                    <!-- Support Information -->
                    <tr>
                        <td
                            style="text-align:center; background-color: #f8fafc; padding: 25px; border-radius: 8px; margin: 25px 40px;">
                            <h4 style="color:#2d3748; margin:0 0 15px 0; font-size:18px; font-weight:600;">
                                Need Help? 🤔
                            </h4>
                            <p style="color:#4a5568; font-size:15px; margin:0 0 15px 0; line-height:1.5;">
                                If you have any questions about your order, please don't
                                hesitate to contact us.
                            </p>
                            <div style="display:flex; justify-content:center; gap:20px;">
                                <a href="mailto:support@{{ config('app.domain', 'example.com') }}"
                                    style="color:#667eea; text-decoration:none; font-size:14px; font-weight:500;">
                                    📧 Email Support
                                </a>
                                <span style="color:#cbd5e0;">|</span>
                                <a href="tel:+1234567890"
                                    style="color:#667eea; text-decoration:none; font-size:14px; font-weight:500;">
                                    📞 Call Us
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 30px 35px; text-align: center; border-radius: 0 0 12px 12px; border-top: 1px solid #e2e8f0;">
                            <h4 style="color: #2d3748; margin: 0 0 10px 0; font-size: 18px; font-weight: 600;">
                                {{ config('app.name') }}
                            </h4>
                            <p style="color: #4a5568; font-size: 14px; margin: 0; line-height: 1.4;">
                                Thank you for choosing us for your purchase. We
                                appreciate your business!
                            </p>
                            <p style="color: #a0aec0; font-size: 12px; margin: 20px 0 0 0; line-height: 1.4;">
                                © {{ date('Y') }} {{ config('app.name') }}. All
                                rights reserved.<br />
                                This email was sent to {{ $order->email }} because you
                                placed an order with us.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
