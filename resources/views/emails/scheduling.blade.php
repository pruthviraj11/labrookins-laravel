<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Scheduling Request</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f4f7;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f0f4f7;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table cellpadding="0" cellspacing="0" border="0" width="650" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #2C5282 0%, #3182CE 100%); padding: 40px; text-align: center; border-radius: 12px 12px 0 0;">
                            <div style="background-color: rgba(255,255,255,0.2); width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 25px;  align-items: center; justify-content: center;">
                                <span style="font-size: 45px;">📅</span>
                            </div>
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 700;">
                                New Scheduling Request
                            </h1>
                            <p style="color: #ffffff; margin: 15px 0 0 0; font-size: 18px; opacity: 0.9;">
                                Ministry Event Scheduling Form Submission
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 35px;">

                            <!-- Greeting -->
                            <div style="text-align: center; margin-bottom: 35px;">
                                <p style="color: #2D3748; font-size: 20px; line-height: 1.5; margin: 0;">
                                    Greetings in Christ! ✝️
                                </p>
                                <p style="color: #4A5568; font-size: 16px; line-height: 1.5; margin: 15px 0 0 0;">
                                    A new ministry scheduling request has been submitted by <strong style="color: #2C5282;">{{ $scheduling->name }}</strong>
                                </p>
                            </div>

                            <!-- Personal Information -->
                            <div style="background: linear-gradient(135deg, #EBF8FF 0%, #BEE3F8 50%); border-left: 5px solid #3182CE; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #2C5282; margin: 0 0 20px 0; font-size: 20px; font-weight: 600;">
                                    👤 Personal Information
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 8px 0; width: 140px; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Full Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #2D3748; font-size: 14px; font-weight: 600;">
                                            {{ $scheduling->name }}
                                        </td>
                                    </tr>
                                    @if($scheduling->position)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Position:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #2D3748; font-size: 14px;">
                                            {{ $scheduling->position }}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Email:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="mailto:{{ $scheduling->email }}" style="color: #3182CE; text-decoration: none; font-size: 14px;">
                                                {{ $scheduling->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    @if($scheduling->office_phone)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Office Phone:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="tel:{{ $scheduling->office_phone }}" style="color: #2D3748; text-decoration: none; font-size: 14px;">
                                                {{ $scheduling->office_phone }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->mobile_phone)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Mobile Phone:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="tel:{{ $scheduling->mobile_phone }}" style="color: #2D3748; text-decoration: none; font-size: 14px;">
                                                {{ $scheduling->mobile_phone }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->home_phone)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Home Phone:</strong>
                                        </td>
                                        <td style="padding: 8px 0;">
                                            <a href="tel:{{ $scheduling->home_phone }}" style="color: #2D3748; text-decoration: none; font-size: 14px;">
                                                {{ $scheduling->home_phone }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Ministry Information -->
                            @if($scheduling->ministry_name || $scheduling->pastor_name || $scheduling->ministry_affilation)
                            <div style="background: linear-gradient(135deg, #F0FFF4 0%, #C6F6D5 50%); border-left: 5px solid #38A169; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #38A169; margin: 0 0 20px 0; font-size: 20px; font-weight: 600;">
                                    ⛪ Ministry Information
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    @if($scheduling->ministry_name)
                                    <tr>
                                        <td style="padding: 8px 0; width: 140px; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Ministry Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #2D3748; font-size: 14px; font-weight: 600;">
                                            {{ $scheduling->ministry_name }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->pastor_name)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Pastor Name:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #2D3748; font-size: 14px;">
                                            {{ $scheduling->pastor_name }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->ministry_affilation)
                                    <tr>
                                        <td style="padding: 8px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Ministry Affiliation:</strong>
                                        </td>
                                        <td style="padding: 8px 0; color: #2D3748; font-size: 14px;">
                                            {{ $scheduling->ministry_affilation }}
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @endif

                            <!-- Address Information -->
                            @if($scheduling->address || $scheduling->city || $scheduling->state || $scheduling->zip)
                            <div style="background: linear-gradient(135deg, #FFFAF0 0%, #FED7AA 50%); border-left: 5px solid #ED8936; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #ED8936; margin: 0 0 20px 0; font-size: 20px; font-weight: 600;">
                                    📍 Address Information
                                </h3>

                                <div style="color: #2D3748; font-size: 14px; line-height: 1.6;">
                                    @if($scheduling->address)
                                        {{ $scheduling->address }}<br>
                                    @endif
                                    @if($scheduling->city || $scheduling->state || $scheduling->zip)
                                        {{ $scheduling->city }}@if($scheduling->city && ($scheduling->state || $scheduling->zip)), @endif
                                        {{ $scheduling->state }} {{ $scheduling->zip }}
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Event Details -->
                            <div style="background: linear-gradient(135deg, #FDF2F8 0%, #FCCFCF 50%); border: 2px solid #E53E3E; padding: 25px; margin-bottom: 25px; border-radius: 8px;">
                                <h3 style="color: #E53E3E; margin: 0 0 20px 0; font-size: 20px; font-weight: 600; text-align: center;">
                                    🎯 Event Details
                                </h3>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    @if($scheduling->event_name)
                                    <tr>
                                        <td style="padding: 10px 0; width: 140px; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Event Name:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px; font-weight: 600;">
                                            {{ $scheduling->event_name }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->event_type)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Event Type:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px;">
                                            <span style="background-color: #E53E3E; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                                                {{ $scheduling->event_type }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->theam)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Theme:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px; font-style: italic;">
                                            "{{ $scheduling->theam }}"
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->event_date)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Event Date:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px; font-weight: 600;">
                                            📅 {{ \Carbon\Carbon::parse($scheduling->event_date)->format('F d, Y') }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->event_alternate_date)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Alternate Date:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px;">
                                            📅 {{ \Carbon\Carbon::parse($scheduling->event_alternate_date)->format('F d, Y') }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->time_service)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Service Time:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px;">
                                            🕐 {{ $scheduling->time_service }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->event_location)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Location:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px;">
                                            📍 {{ $scheduling->event_location }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($scheduling->total_days_service)
                                    <tr>
                                        <td style="padding: 10px 0; vertical-align: top;">
                                            <strong style="color: #4A5568; font-size: 14px;">Duration:</strong>
                                        </td>
                                        <td style="padding: 10px 0; color: #2D3748; font-size: 14px;">
                                            {{ $scheduling->total_days_service }}
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Additional Information -->
                            @if($scheduling->additional_preferance || $scheduling->best_time_reach)
                            <div style="background: linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 50%); border-left: 5px solid #4A5568; padding: 25px; margin-bottom: 30px; border-radius: 8px;">
                                <h3 style="color: #4A5568; margin: 0 0 20px 0; font-size: 18px; font-weight: 600;">
                                    💬 Additional Information
                                </h3>

                                @if($scheduling->additional_preferance)
                                <div style="margin-bottom: 15px;">
                                    <strong style="color: #4A5568; font-size: 14px;">Additional Preferences:</strong>
                                    <div style="background-color: #ffffff; padding: 15px; border-radius: 6px; margin-top: 8px; border-left: 3px solid #4A5568;">
                                        <p style="color: #2D3748; font-size: 14px; line-height: 1.6; margin: 0; font-style: italic;">
                                            "{{ $scheduling->additional_preferance }}"
                                        </p>
                                    </div>
                                </div>
                                @endif

                                @if($scheduling->best_time_reach)
                                <div>
                                    <strong style="color: #4A5568; font-size: 14px;">Best Time to Reach:</strong>
                                    <span style="color: #2D3748; font-size: 14px; margin-left: 10px;">
                                        🕐 {{ $scheduling->best_time_reach }}
                                    </span>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div style="text-align: center; margin: 35px 0;">
                                <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="padding-right: 15px;">
                                            <a href="mailto:{{ $scheduling->email }}?subject=Re: Scheduling Request - {{ $scheduling->event_name ?? 'Ministry Event' }}"
                                               style="background: linear-gradient(135deg, #3182CE 0%, #2C5282 100%);
                                                      color: #ffffff;
                                                      text-decoration: none;
                                                      padding: 15px 25px;
                                                      border-radius: 25px;
                                                      font-weight: 600;
                                                      font-size: 14px;
                                                      display: inline-block;">
                                                ✉️ Email Response
                                            </a>
                                        </td>
                                        @if($scheduling->mobile_phone)
                                        <td style="padding-left: 15px;">
                                            <a href="tel:{{ $scheduling->mobile_phone }}"
                                               style="background: linear-gradient(135deg, #38A169 0%, #2F855A 100%);
                                                      color: #ffffff;
                                                      text-decoration: none;
                                                      padding: 15px 25px;
                                                      border-radius: 25px;
                                                      font-weight: 600;
                                                      font-size: 14px;
                                                      display: inline-block;">
                                                📞 Call Now
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </div>

                            <!-- Scripture Quote -->
                            <div style="text-align: center; background-color: #f7fafc; padding: 25px; border-radius: 8px; margin: 25px 0;">
                                <p style="color: #4A5568; font-size: 16px; font-style: italic; margin: 0; line-height: 1.6;">
                                    "For I know the plans I have for you," declares the Lord, "plans to prosper you and not to harm you, to give you hope and a future."
                                    <br><span style="font-size: 14px; font-weight: 600; color: #2C5282;">- Jeremiah 29:11</span>
                                </p>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px 35px; text-align: center; border-radius: 0 0 12px 12px; border-top: 1px solid #e2e8f0;">
                            <div style="margin-bottom: 15px;">
                                <span style="font-size: 30px;">✝️</span>
                            </div>
                            <p style="color: #4A5568; font-size: 14px; margin: 0 0 10px 0; line-height: 1.4;">
                                This scheduling request was submitted through {{ config('app.name') }}
                            </p>
                            <p style="color: #718096; font-size: 12px; margin: 0;">
                                May God's grace and peace be with you as you review this ministry opportunity.
                            </p>
                            <div style="margin-top: 20px;">
                                <p style="color: #a0aec0; font-size: 11px; margin: 0;">
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
