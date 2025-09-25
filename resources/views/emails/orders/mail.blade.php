<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f7fa;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f7fa;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table cellpadding="0" cellspacing="0" border="0" width="650" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px; text-align: center; border-radius: 12px 12px 0 0;">
                            <div style="background-color: rgba(255,255,255,0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; align-items: center; justify-content: center;">
                                <span style="font-size: 40px;">📦</span>
                            </div>
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 700;">
                                Order Confirmation
                            </h1>
                            <p style="color: #ffffff; margin: 15px 0 0 0; font-size: 18px; opacity: 0.9;">
                                Thank you for your purchase!
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 35px;">

                            <!-- Greeting -->
                            <div style="margin-bottom: 30px;">
                                <h2 style="color: #2d3748; font-size: 24px; margin: 0 0 10px 0;">
                                    Hi {{ $order->fname }} {{ $order->lname }}! 👋
                                </h2>
                                <p style="color: #4a5568; font-size: 16px; line-height: 1.6; margin: 0;">
                                    We're excited to confirm that we've received your order. Here are the details:
                                </p>
                            </div>

                            <!-- Order Summary Card -->
                            <div style="background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); border: 2px solid #38b2ac; padding: 25px; margin-bottom: 25px; border-radius: 10px;">
                                <h3 style="color: #234e52; margin: 0 0 20px 0; font-size: 20px; font-weight: 600; text-align: center;">
                                    📋 Order Summary
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 12px 0; width: 150px; vertical-align: top;">
                                            <strong style="color: #2d3748; font-size: 16px;">Order Date:</strong>
                                        </td>
                                        <td style="padding: 12px 0; color: #4a5568; font-size: 16px;">
                                            📅 {{ \Carbon\Carbon::parse($order->date_and_time)->format('F d, Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 12px 0; vertical-align: top;">
                                            <strong style="color: #2d3748; font-size: 16px;">Order Type:</strong>
                                        </td>
                                        <td style="padding: 12px 0;">
                                            <span style="background-color: #667eea; color: white; padding: 6px 15px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                                                {{ ucfirst($order->order_type) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 12px 0; vertical-align: top;">
                                            <strong style="color: #2d3748; font-size: 16px;">Total Amount:</strong>
                                        </td>
                                        <td style="padding: 12px 0;">
                                            <span style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 8px 20px; border-radius: 25px; font-size: 18px; font-weight: 700; display: inline-block;">
                                                💰 ${{ number_format($order->total_amount, 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Customer Information -->
                            <div style="background: linear-gradient(135deg, #fef5e7 0%, #fed7aa 100%); border-left: 5px solid #f6ad55; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #c05621; margin: 0 0 20px 0; font-size: 20px; font-weight: 600;">
                                    👤 Customer Information
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 10px 0; width: 120px; vertical-align: top;">
                                            <strong style="color: #744210; font-size: 15px;">Name:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2d3748; font-size: 15px; font-weight: 600;">
                                            {{ $order->fname }} {{ $order->lname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #744210; font-size: 15px;">Email:</strong>
                                        </td>
                                        <td style="padding: 10px 0;">
                                            <a href="mailto:{{ $order->email }}" style="color: #667eea; text-decoration: none; font-size: 15px;">
                                                ✉️ {{ $order->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #744210; font-size: 15px;">Mobile:</strong>
                                        </td>
                                        <td style="padding: 10px 0;">
                                            <a href="tel:{{ $order->mobile }}" style="color: #2d3748; text-decoration: none; font-size: 15px;">
                                                📱 {{ $order->mobile }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Shipping Address -->
                            <div style="background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%); border-left: 5px solid #4a5568; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #2d3748; margin: 0 0 20px 0; font-size: 20px; font-weight: 600;">
                                    🏠 Shipping Address
                                </h3>

                                <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <p style="color: #2d3748; font-size: 15px; line-height: 1.6; margin: 0;">
                                        <strong>{{ $order->fname }} {{ $order->lname }}</strong><br>
                                        {{ $order->street_address1 }}<br>
                                        @if($order->street_address2)
                                            {{ $order->street_address2 }}<br>
                                        @endif
                                        {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                                        @if($order->country)
                                            {{ $order->country }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Order Status -->
                            <div style="text-align: center; background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%); padding: 25px; margin-bottom: 30px; border-radius: 10px; border: 2px solid #48bb78;">
                                <div style="margin-bottom: 15px;">
                                    <span style="font-size: 50px;">✅</span>
                                </div>
                                <h3 style="color: #22543d; margin: 0 0 10px 0; font-size: 22px; font-weight: 600;">
                                    Order Confirmed!
                                </h3>
                                <p style="color: #2f855a; font-size: 16px; margin: 0; line-height: 1.5;">
                                    Your order has been successfully placed and is being processed.
                                    You'll receive another email with tracking information once your order ships.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div style="text-align: center; margin: 35px 0;">
                                <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="padding-right: 15px;">
                                            <a href="{{ config('app.url') }}/orders/track"
                                               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                                      color: #ffffff;
                                                      text-decoration: none;
                                                      padding: 15px 30px;
                                                      border-radius: 30px;
                                                      font-weight: 600;
                                                      font-size: 16px;
                                                      display: inline-block;
                                                      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                                📦 Track Your Order
                                            </a>
                                        </td>
                                        <td style="padding-left: 15px;">
                                            <a href="{{ config('app.url') }}"
                                               style="background: transparent;
                                                      color: #667eea;
                                                      text-decoration: none;
                                                      padding: 15px 30px;
                                                      border-radius: 30px;
                                                      font-weight: 600;
                                                      font-size: 16px;
                                                      display: inline-block;
                                                      border: 2px solid #667eea;">
                                                🛍️ Continue Shopping
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Support Information -->
                            <div style="text-align: center; background-color: #f8fafc; padding: 25px; border-radius: 8px; margin: 25px 0;">
                                <h4 style="color: #2d3748; margin: 0 0 15px 0; font-size: 18px; font-weight: 600;">
                                    Need Help? 🤔
                                </h4>
                                <p style="color: #4a5568; font-size: 15px; margin: 0 0 15px 0; line-height: 1.5;">
                                    If you have any questions about your order, please don't hesitate to contact us.
                                </p>
                                <div style="display: flex; justify-content: center; gap: 20px;">
                                    <a href="mailto:support@{{ config('app.domain', 'example.com') }}"
                                       style="color: #667eea; text-decoration: none; font-size: 14px; font-weight: 500;">
                                        📧 Email Support
                                    </a>
                                    <span style="color: #cbd5e0;">|</span>
                                    <a href="tel:+1234567890"
                                       style="color: #667eea; text-decoration: none; font-size: 14px; font-weight: 500;">
                                        📞 Call Us
                                    </a>
                                </div>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px 35px; text-align: center; border-radius: 0 0 12px 12px; border-top: 1px solid #e2e8f0;">
                            <div style="margin-bottom: 20px;">
                                <h4 style="color: #2d3748; margin: 0 0 10px 0; font-size: 18px; font-weight: 600;">
                                    {{ config('app.name') }}
                                </h4>
                                <p style="color: #4a5568; font-size: 14px; margin: 0; line-height: 1.4;">
                                    Thank you for choosing us for your purchase. We appreciate your business!
                                </p>
                            </div>

                            <!-- Social Links -->
                            <div style="margin-bottom: 20px;">
                                <a href="#" style="margin: 0 10px; text-decoration: none; color: #667eea;">📘</a>
                                <a href="#" style="margin: 0 10px; text-decoration: none; color: #667eea;">📷</a>
                                <a href="#" style="margin: 0 10px; text-decoration: none; color: #667eea;">🐦</a>
                            </div>

                            <div style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                                <p style="color: #a0aec0; font-size: 12px; margin: 0; line-height: 1.4;">
                                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                                    This email was sent to {{ $order->email }} because you placed an order with us.
                                </p>
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
