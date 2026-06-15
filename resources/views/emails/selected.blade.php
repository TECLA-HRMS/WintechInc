<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Congratulations – You've Been Selected!</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Segoe UI',Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg,#071056 0%,#ba1c26 100%);border-radius:16px 16px 0 0;padding:32px 40px 28px;text-align:center;">

              <!-- Logo -->
              <div style="margin-bottom:18px;">
                <img src="{{ url('frontend/images/logos/logo.png') }}"
                     alt="Wintech Inc"
                     style="height:60px;max-width:200px;object-fit:contain;filter:brightness(0) invert(1);">
              </div>

              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);border-radius:50px;padding:5px 18px;margin-bottom:16px;">
                <span style="color:rgba(255,255,255,0.9);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Wintech Inc</span>
              </div>

              <!-- Trophy icon -->
              <div style="margin-bottom:12px;">
                <span style="font-size:48px;line-height:1;">🏆</span>
              </div>

              <h1 style="margin:0 0 6px;color:#fff;font-size:26px;font-weight:700;letter-spacing:-0.3px;">Congratulations, {{ $name }}!</h1>
              <p style="margin:0;color:rgba(255,255,255,0.78);font-size:14px;">You've been selected — welcome to the team!</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <p style="margin:0 0 18px;font-size:15px;color:#444;line-height:1.7;">
                Dear <strong style="color:#071056;">{{ $name }}</strong>,
              </p>

              <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.8;">
                We are absolutely thrilled to inform you that after a thorough review of your application and interview, you have been <strong style="color:#ba1c26;">officially selected</strong> for the position of:
              </p>

              <!-- Job Title Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px solid #ba1c26;border-radius:12px;padding:22px;text-align:center;">
                    <p style="margin:0 0 4px;font-size:11px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Position Offered</p>
                    <p style="margin:0;font-size:22px;font-weight:700;color:#071056;letter-spacing:0.5px;">{{ $job_title }}</p>
                  </td>
                </tr>
              </table>

              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.8;">
                Our HR team will be reaching out to you shortly with the complete details regarding your joining formalities, offer letter, and onboarding process.
              </p>

              <!-- What's Next -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8f9fa;border-radius:10px;padding:20px 24px;">
                    <p style="margin:0 0 14px;font-size:12px;font-weight:700;color:#333;text-transform:uppercase;letter-spacing:1px;">What Happens Next</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">1</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">You will receive an official <strong>Offer Letter</strong> via email.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">2</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">HR will contact you to confirm your <strong>joining date</strong>.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;">3</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">Complete your <strong>onboarding documents</strong> and orientation.</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- CTA Button -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td align="center">
                    <a href="{{ url('/') }}"
                       style="display:inline-block;background:linear-gradient(135deg,#ba1c26,#e33842);color:#fff;font-size:15px;font-weight:700;text-decoration:none;padding:14px 44px;border-radius:50px;letter-spacing:0.3px;box-shadow:0 6px 20px rgba(186,28,38,0.35);">
                      Visit Our Website →
                    </a>
                  </td>
                </tr>
              </table>

              <!-- Closing -->
              <p style="margin:0 0 6px;font-size:15px;color:#555;line-height:1.8;">
                We look forward to welcoming you to the <strong style="color:#071056;">Wintech Inc</strong> family. Once again, congratulations on this well-deserved achievement!
              </p>

              <p style="margin:24px 0 0;font-size:15px;color:#444;line-height:1.7;">
                Warm Regards,<br>
                <strong style="color:#071056;">HR Team</strong><br>
                <span style="color:#ba1c26;font-size:13px;">Wintech Inc</span>
              </p>

            </td>
          </tr>

          <!-- Divider -->
          <tr>
            <td style="background:#ffffff;padding:0 40px;">
              <div style="border-top:1px solid #f0f0f0;"></div>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:28px 40px;text-align:center;">
              <img src="{{ url('frontend/images/logos/logo.png') }}"
                   alt="Wintech Inc"
                   style="height:36px;max-width:140px;object-fit:contain;filter:brightness(0) invert(1);margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;">
              <p style="margin:0 0 4px;color:#fff;font-size:13px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 14px;color:rgba(255,255,255,0.5);font-size:11px;letter-spacing:0.5px;">Staffing &nbsp;·&nbsp; Recruitment &nbsp;·&nbsp; IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.3);font-size:11px;">
                This is an automated email. Please do not reply directly to this message.<br>
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
