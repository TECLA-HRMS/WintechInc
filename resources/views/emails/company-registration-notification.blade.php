<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Company Registration</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Segoe UI',Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg,#071056 0%,#ba1c26 100%);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">

              <!-- Logo -->
              <div style="margin-bottom:18px;">
                <img src="{{ url('frontend/images/logos/logo.png') }}"
                     alt="Wintech Inc"
                     style="height:60px;max-width:200px;object-fit:contain;filter:brightness(0) invert(1);">
              </div>
              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);border-radius:50px;padding:5px 18px;margin-bottom:16px;">
                <span style="color:rgba(255,255,255,0.9);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Admin Notification</span>
              </div>
              <div style="font-size:44px;line-height:1;margin-bottom:12px;">ðŸ“‹</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;">New Company Registration</h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">A new company has submitted a registration request</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <p style="margin:0 0 18px;font-size:15px;color:#444;line-height:1.7;">
                Hello <strong style="color:#071056;">Admin</strong>,
              </p>

              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.8;">
                A new company registration has been submitted. Please review the details below and take appropriate action in the admin panel.
              </p>

              <!-- Contact Info -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px solid #ba1c26;border-radius:12px;padding:24px;">
                    <p style="margin:0 0 14px;font-size:11px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Contact Information</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Name</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->name }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Email</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->email }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Mobile</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->mobile }}</strong>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Company Details -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:12px;padding:24px;">
                    <p style="margin:0 0 14px;font-size:11px;font-weight:700;color:#374151;letter-spacing:1.5px;text-transform:uppercase;">Company Details</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #f0f0f0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Company Name</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->company_name ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #f0f0f0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Website</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->company_website ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Location</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->location ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Position Details -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:12px;padding:24px;">
                    <p style="margin:0 0 14px;font-size:11px;font-weight:700;color:#374151;letter-spacing:1.5px;text-transform:uppercase;">Position Details</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #f0f0f0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Position</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->position ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid #f0f0f0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Salary Expected</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->salary ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Experience</span><br>
                          <strong style="font-size:14px;color:#111827;">{{ $registration->experience ?? 'Not provided' }}</strong>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Meta -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#fff8f0;border-left:4px solid #ff9800;border-radius:0 8px 8px 0;padding:14px 18px;">
                    <p style="margin:0;font-size:13px;color:#7a4f00;line-height:1.6;">
                      ðŸ“… <strong>Submitted:</strong> {{ $registration->created_at->format('F j, Y \a\t g:i A') }}
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                      ðŸŒ <strong>IP:</strong> {{ $registration->ip_address }}
                    </p>
                  </td>
                </tr>
              </table>

              <p style="margin:0;font-size:15px;color:#444;line-height:1.7;">
                Please log in to the admin panel to review and respond to this registration.
              </p>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:26px 40px;text-align:center;">

              <img src="{{ url('frontend/images/logos/logo.png') }}"
                   alt="Wintech Inc"
                   style="height:36px;max-width:140px;object-fit:contain;filter:brightness(0) invert(1);margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;">
              <p style="margin:0 0 4px;color:#fff;font-size:13px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 12px;color:rgba(255,255,255,0.45);font-size:11px;letter-spacing:0.5px;">Staffing &nbsp;Â·&nbsp; Recruitment &nbsp;Â·&nbsp; IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.28);font-size:11px;">
                This is an automated admin notification. Please do not reply to this message.<br>
                Â© {{ date('Y') }} Wintech Inc. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>

