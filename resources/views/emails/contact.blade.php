<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;">
                                📩 New Contact Form Submission
                            </h1>
                            <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 16px; opacity: 0.9;">
                                You have received a new message
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">

                            <!-- Greeting -->
                            <p style="color: #333333; font-size: 16px; line-height: 1.5; margin: 0 0 25px 0;">
                                Hello Admin,
                            </p>
                            <p style="color: #666666; font-size: 16px; line-height: 1.5; margin: 0 0 30px 0;">
                                You've received a new contact request from <strong style="color: #333333;">{{ $contact->name }}</strong>.
                            </p>

                            <!-- Contact Details Card -->
                            <div style="background-color: #f8f9fa; border-left: 4px solid #667eea; padding: 20px; margin-bottom: 25px; border-radius: 4px;">
                                <h3 style="color: #333333; margin: 0 0 15px 0; font-size: 18px; font-weight: 600;">
                                    👤 Contact Details
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 8px 0; width: 80px;">
                                            <strong style="color: #555555; font-size: 14px;">Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #333333; font-size: 14px;">
                                            {{ $contact->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0;">
                                            <strong style="color: #555555; font-size: 14px;">Email:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="mailto:{{ $contact->email }}" style="color: #667eea; text-decoration: none; font-size: 14px;">
                                                {{ $contact->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0;">
                                            <strong style="color: #555555; font-size: 14px;">Subject:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #333333; font-size: 14px;">
                                            {{ $contact->subject }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Message Card -->
                            <div style="background-color: #fff8e1; border: 1px solid #ffcc02; padding: 20px; margin-bottom: 30px; border-radius: 4px;">
                                <h3 style="color: #333333; margin: 0 0 15px 0; font-size: 18px; font-weight: 600;">
                                    💬 Message
                                </h3>
                                <div style="background-color: #ffffff; padding: 15px; border-radius: 4px; border-left: 3px solid #ffcc02;">
                                    <p style="color: #333333; font-size: 14px; line-height: 1.6; margin: 0; font-style: italic;">
                                        "{{ $contact->comment }}"
                                    </p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                                   style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                          color: #ffffff;
                                          text-decoration: none;
                                          padding: 12px 25px;
                                          border-radius: 25px;
                                          font-weight: 600;
                                          font-size: 14px;
                                          display: inline-block;
                                          transition: all 0.3s ease;">
                                    📧 Reply to {{ $contact->name }}
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; text-align: center; border-radius: 0 0 8px 8px; border-top: 1px solid #e9ecef;">
                            <p style="color: #666666; font-size: 12px; margin: 0; line-height: 1.4;">
                                This email was automatically generated by {{ config('app.name') }}<br>
                                Please do not reply directly to this email.
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
