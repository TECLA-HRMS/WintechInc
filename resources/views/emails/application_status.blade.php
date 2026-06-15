<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Status Update</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Segoe UI',Arial,sans-serif;">

@php
  $config = [
    'pending'     => ['icon'=>'📋', 'color'=>'#f59e0b', 'dark'=>'#78350f', 'label'=>'Application Received',   'bg'=>'#fffbeb', 'border'=>'#fcd34d'],
    'reviewed'    => ['icon'=>'🔍', 'color'=>'#0ea5e9', 'dark'=>'#0c4a6e', 'label'=>'Application Reviewed',   'bg'=>'#f0f9ff', 'border'=>'#7dd3fc'],
    'shortlisted' => ['icon'=>'⭐', 'color'=>'#8b5cf6', 'dark'=>'#4c1d95', 'label'=>'You\'ve Been Shortlisted','bg'=>'#f5f3ff', 'border'=>'#c4b5fd'],
    'selected'    => ['icon'=>'🏆', 'color'=>'#ba1c26', 'dark'=>'#071056',  'label'=>'You\'ve Been Selected',  'bg'=>'#fff5f5', 'border'=>'#ba1c26'],
    'rejected'    => ['icon'=>'📩', 'color'=>'#6b7280', 'dark'=>'#1f2937', 'label'=>'Application Update',      'bg'=>'#f9fafb', 'border'=>'#d1d5db'],
  ];
  $c = $config[$status] ?? $config['pending'];
@endphp

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg,#071056 0%,#ba1c26 100%);border-radius:16px 16px 0 0;padding:30px 40px 26px;text-align:center;">
             
              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);border-radius:50px;padding:5px 18px;margin-bottom:14px;">
                <span style="color:rgba(255,255,255,0.9);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Wintech Inc</span>
              </div>
              <div style="font-size:44px;line-height:1;margin-bottom:10px;">{{ $c['icon'] }}</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;">{{ $c['label'] }}</h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">Application Status Notification</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:38px 40px 32px;">

              <p style="margin:0 0 18px;font-size:15px;color:#444;line-height:1.7;">
                Dear <strong style="color:#071056;">{{ $name }}</strong>,
              </p>

              {{-- Status-specific message --}}
              @if($status === 'pending')
                <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                  Thank you for applying! We have successfully received your application for the position below. Our team will review it and get back to you soon.
                </p>
              @elseif($status === 'reviewed')
                <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                  We wanted to let you know that your application has been <strong style="color:#0ea5e9;">reviewed</strong> by our hiring team. We are currently evaluating all candidates and will update you on the next steps shortly.
                </p>
              @elseif($status === 'shortlisted')
                <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                  Exciting news! After reviewing your application, we are pleased to inform you that you have been <strong style="color:#8b5cf6;">shortlisted</strong> for the next stage of our recruitment process. Our HR team will contact you soon to schedule the next steps.
                </p>
              @elseif($status === 'selected')
                <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                  We are absolutely thrilled to inform you that you have been <strong style="color:#ba1c26;">officially selected</strong> for the position below. Our HR team will reach out to you shortly with your offer letter and onboarding details.
                </p>
              @elseif($status === 'rejected')
                <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                  Thank you for your interest and for taking the time to apply. After careful consideration, we have decided to move forward with other candidates whose qualifications more closely match our current requirements. We truly appreciate your effort and encourage you to apply for future openings.
                </p>
              @endif

              <!-- Job Title Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:{{ $c['bg'] }};border:2px solid {{ $c['border'] }};border-radius:12px;padding:20px;text-align:center;">
                    <p style="margin:0 0 4px;font-size:11px;font-weight:700;color:{{ $c['color'] }};letter-spacing:1.5px;text-transform:uppercase;">Position Applied For</p>
                    <p style="margin:0;font-size:20px;font-weight:700;color:{{ $c['dark'] }};">{{ $job_title }}</p>
                  </td>
                </tr>
              </table>

              {{-- Next steps for shortlisted/selected --}}
              @if(in_array($status, ['shortlisted', 'selected']))
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8f9fa;border-radius:10px;padding:20px 24px;">
                    <p style="margin:0 0 14px;font-size:12px;font-weight:700;color:#333;text-transform:uppercase;letter-spacing:1px;">What Happens Next</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      @if($status === 'shortlisted')
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;"><span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">1</span></td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">Our HR team will contact you to schedule an <strong>interview</strong>.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;"><span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">2</span></td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">Keep your phone and email accessible for further communication.</td>
                      </tr>
                      @else
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;"><span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">1</span></td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">You will receive an official <strong>Offer Letter</strong> via email.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;"><span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">2</span></td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">HR will confirm your <strong>joining date</strong> and onboarding schedule.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;"><span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">3</span></td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">Complete your <strong>onboarding documents</strong> and orientation.</td>
                      </tr>
                      @endif
                    </table>
                  </td>
                </tr>
              </table>
              @endif

              <!-- CTA -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td align="center">
                    <a href="{{ url('/') }}"
                       style="display:inline-block;background:linear-gradient(135deg,#ba1c26,#e33842);color:#fff;font-size:15px;font-weight:700;text-decoration:none;padding:13px 40px;border-radius:50px;letter-spacing:0.3px;box-shadow:0 6px 20px rgba(186,28,38,0.35);">
                      Visit Our Website →
                    </a>
                  </td>
                </tr>
              </table>

              <p style="margin:0;font-size:15px;color:#444;line-height:1.7;">
                Warm Regards,<br>
                <strong style="color:#071056;">HR Team</strong><br>
                <span style="color:#ba1c26;font-size:13px;">Wintech Inc</span>
              </p>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:26px 40px;text-align:center;">
             
              <p style="margin:0 0 4px;color:#fff;font-size:13px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 12px;color:rgba(255,255,255,0.45);font-size:11px;letter-spacing:0.5px;">Staffing &nbsp;·&nbsp; Recruitment &nbsp;·&nbsp; IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.28);font-size:11px;">
                This is an automated email. Please do not reply to this message.<br>
                © {{ date('Y') }} Wintech Inc. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
