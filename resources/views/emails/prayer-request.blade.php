<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Prayer Request Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f5f0;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f8f5f0;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #8B4F97 0%, #6B73FF 100%); padding: 40px; text-align: center; border-radius: 12px 12px 0 0;">
                            <div style="background-color: rgba(255,255,255,0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px;  align-items: center; justify-content: center;">
                                <span style="font-size: 40px;">🙏</span>
                            </div>
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 700;">
                                New Prayer Request
                            </h1>
                            <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">
                                Someone has submitted a prayer request
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">

                            <!-- Greeting -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <p style="color: #333333; font-size: 18px; line-height: 1.5; margin: 0;">
                                    Peace be with you! 🕊️
                                </p>
                                <p style="color: #666666; font-size: 16px; line-height: 1.5; margin: 10px 0 0 0;">
                                    A new prayer request has been submitted by <strong style="color: #8B4F97;">{{ $prayerRequest->requested_name }}</strong>
                                </p>
                            </div>

                            <!-- Prayer Request Details -->
                            <div style="background: linear-gradient(135deg, #fff9f3 0%, #f0f8ff 100%); border: 2px solid #e8d5f2; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #8B4F97; margin: 0 0 20px 0; font-size: 20px; font-weight: 600; text-align: center;">
                                    🕊️ Prayer Request Details
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 10px 0; width: 150px; vertical-align: top;">
                                            <strong style="color: #555555; font-size: 14px;">Category:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #333333; font-size: 14px;">
                                            <span style="background-color: #8B4F97; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                                                {{ ucfirst($prayerRequest->category) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #555555; font-size: 14px;">Subject:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #333333; font-size: 14px; font-weight: 600;">
                                            {{ $prayerRequest->subject }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #555555; font-size: 14px;">Prayer For:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #333333; font-size: 14px;">
                                            {{ $prayerRequest->need_prayer_name }}
                                            @if($prayerRequest->prayer_church_member === 'yes')
                                                <span style="color: #28a745; font-size: 12px; margin-left: 8px;">✅ Church Member</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Requester Information -->
                            <div style="background-color: #f8f9fa; border-left: 4px solid #6B73FF; padding: 25px; margin-bottom: 25px; border-radius: 4px;">
                                <h3 style="color: #333333; margin: 0 0 20px 0; font-size: 18px; font-weight: 600;">
                                    👤 Requester Information
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 8px 0; width: 120px;">
                                            <strong style="color: #555555; font-size: 14px;">Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #333333; font-size: 14px;">
                                            {{ $prayerRequest->requested_name }}
                                            @if($prayerRequest->requested_church_member === 'yes')
                                                <span style="color: #28a745; font-size: 12px; margin-left: 8px;">✅ Church Member</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0;">
                                            <strong style="color: #555555; font-size: 14px;">Email:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="mailto:{{ $prayerRequest->email }}" style="color: #6B73FF; text-decoration: none; font-size: 14px;">
                                                {{ $prayerRequest->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0;">
                                            <strong style="color: #555555; font-size: 14px;">{{ ucfirst($prayerRequest->phone_no_type_one) }}:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #333333; font-size: 14px;">
                                            <a href="tel:{{ $prayerRequest->mobile_one }}" style="color: #333333; text-decoration: none;">
                                                {{ $prayerRequest->mobile_one }}
                                            </a>
                                        </td>
                                    </tr>
                                    @if($prayerRequest->phone_no_type_two && $prayerRequest->mobile_two)
                                    <tr>
                                        <td style="padding: 8px 0;">
                                            <strong style="color: #555555; font-size: 14px;">{{ ucfirst($prayerRequest->phone_no_type_two) }}:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #333333; font-size: 14px;">
                                            <a href="tel:{{ $prayerRequest->mobile_two }}" style="color: #333333; text-decoration: none;">
                                                {{ $prayerRequest->mobile_two }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Prayer Message -->
                            <div style="background: linear-gradient(135deg, #fff5f5 0%, #ffeaa7 20%); border: 2px solid #fab1a0; padding: 25px; margin-bottom: 30px; border-radius: 8px;">
                                <h3 style="color: #d63031; margin: 0 0 15px 0; font-size: 18px; font-weight: 600; text-align: center;">
                                    💝 Prayer Message
                                </h3>
                                <div style="background-color: #ffffff; padding: 20px; border-radius: 6px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                                    <p style="color: #333333; font-size: 16px; line-height: 1.8; margin: 0; font-style: italic; text-align: center;">
                                        "{{ $prayerRequest->message }}"
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div style="text-align: center; margin: 30px 0;">
                                <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="padding-right: 10px;">
                                            <a href="mailto:{{ $prayerRequest->email }}?subject=Re: {{ $prayerRequest->subject }}"
                                               style="background: linear-gradient(135deg, #6B73FF 0%, #8B4F97 100%);
                                                      color: #ffffff;
                                                      text-decoration: none;
                                                      padding: 14px 25px;
                                                      border-radius: 25px;
                                                      font-weight: 600;
                                                      font-size: 14px;
                                                      display: inline-block;">
                                                ✉️ Reply to Requester
                                            </a>
                                        </td>
                                        <td style="padding-left: 10px;">
                                            <a href="tel:{{ $prayerRequest->mobile_one }}"
                                               style="background: linear-gradient(135deg, #00b894 0%, #55a3ff 100%);
                                                      color: #ffffff;
                                                      text-decoration: none;
                                                      padding: 14px 25px;
                                                      border-radius: 25px;
                                                      font-weight: 600;
                                                      font-size: 14px;
                                                      display: inline-block;">
                                                📞 Call Now
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Prayer Quote -->
                            <div style="text-align: center; background-color: #f1f3f4; padding: 20px; border-radius: 6px; margin: 20px 0;">
                                <p style="color: #8B4F97; font-size: 16px; font-style: italic; margin: 0; line-height: 1.6;">
                                    "And pray in the Spirit on all occasions with all kinds of prayers and requests."
                                    <br><span style="font-size: 14px; font-weight: 600;">- Ephesians 6:18</span>
                                </p>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 25px 30px; text-align: center; border-radius: 0 0 12px 12px; border-top: 1px solid #e9ecef;">
                            <div style="margin-bottom: 15px;">
                                <span style="font-size: 24px;">🙏</span>
                            </div>
                            <p style="color: #666666; font-size: 14px; margin: 0 0 10px 0; line-height: 1.4;">
                                This prayer request was submitted through {{ config('app.name') }}
                            </p>
                            <p style="color: #999999; font-size: 12px; margin: 0;">
                                May God bless this prayer request and bring comfort to those in need.
                            </p>
                            <div style="margin-top: 15px;">
                                <p style="color: #999999; font-size: 11px; margin: 0;">
                                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
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
