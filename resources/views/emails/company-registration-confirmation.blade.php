<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Registration Confirmation</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Segoe UI',Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg,#071056 0%,#ba1c26 100%);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);border-radius:50px;padding:5px 18px;margin-bottom:16px;">
                <span style="color:rgba(255,255,255,0.9);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Wintech Inc</span>
              </div>
              <div style="font-size:44px;line-height:1;margin-bottom:12px;">🏢</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;">Registration Received!</h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">Thank you for registering with us</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <p style="margin:0 0 18px;font-size:15px;color:#444;line-height:1.7;">
                Dear <strong style="color:#071056;">{{ $registration->name }}</strong>,
              </p>

              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.8;">
                Thank you for registering your company with <strong style="color:#ba1c26;">Wintech Inc</strong> We have successfully received your details and our team will review your information and get back to you shortly.
              </p>

              <!-- Details Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px solid #ba1c26;border-radius:12px;padding:24px;">
                    <p style="margin:0 0 14px;font-size:11px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Submitted Details</p>

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
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Mobile</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->mobile }}</strong>
                        </td>
                      </tr>
                      @if($registration->company_name)
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Company</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->company_name }}</strong>
                        </td>
                      </tr>
                      @endif
                      @if($registration->position)
                      <tr>
                        <td style="padding:7px 0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Position</span><br>
                          <strong style="font-size:14px;color:#071056;">{{ $registration->position }}</strong>
                        </td>
                      </tr>
                      @endif
                    </table>
                  </td>
                </tr>
              </table>

              <!-- What's Next -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8f9fa;border-radius:10px;padding:20px 24px;">
                    <p style="margin:0 0 12px;font-size:12px;font-weight:700;color:#333;text-transform:uppercase;letter-spacing:1px;">What Happens Next</p>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-block;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:24px;">1</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">Our team will <strong>review your registration</strong> details.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-block;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:24px;">2</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">A representative will <strong>contact you</strong> within 1–2 business days.</td>
                      </tr>
                      <tr>
                        <td style="padding:6px 0;vertical-align:top;width:34px;">
                          <span style="display:inline-block;width:24px;height:24px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:24px;">3</span>
                        </td>
                        <td style="padding:6px 0;font-size:14px;color:#555;line-height:1.5;">We'll discuss your <strong>staffing requirements</strong> and next steps.</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <p style="margin:0;font-size:15px;color:#444;line-height:1.7;">
                Warm Regards,<br>
                <strong style="color:#071056;">Business Development Team</strong><br>
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
