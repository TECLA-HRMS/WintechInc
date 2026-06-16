<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your New Password â€“ Wintech Inc</title>
</head>
<body style="margin:0;padding:0;background:#f0f2f5;font-family:'Segoe UI',Arial,sans-serif;">

  <!-- Wrapper -->
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
              <div style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);border-radius:12px;padding:10px 22px;margin-bottom:16px;">
                <span style="color:#fff;font-size:13px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Wintech Inc</span>
              </div>
             
              <div style="margin-bottom:12px;"><img src="https://img.icons8.com/ios-filled/100/ffffff/key.png" alt="Icon" style="height:48px;width:48px;display:inline-block;"></div>
              <h1 style="margin:0;color:#fff;font-size:24px;font-weight:700;letter-spacing:-0.3px;">Your New Password</h1>
              <p style="margin:8px 0 0;color:rgba(255,255,255,0.75);font-size:14px;">Account Security Notification</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <p style="margin:0 0 20px;font-size:15px;color:#444;line-height:1.6;">
                Hello, <strong style="color:#1a1a1a;">{{ $email }}</strong>
              </p>

              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.7;">
                We received a request to reset your password. A new temporary password has been generated for your account. Please use it to log in and change it immediately.
              </p>

              <!-- Password Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px dashed #ba1c26;border-radius:12px;padding:24px;text-align:center;">
                    <p style="margin:0 0 6px;font-size:12px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Your Temporary Password</p>
                    <p style="margin:0;font-size:28px;font-weight:700;color:#071056;letter-spacing:6px;font-family:'Courier New',monospace;">{{ $newPassword }}</p>
                  </td>
                </tr>
              </table>

              <!-- Steps -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#f8f9fa;border-radius:10px;padding:20px 24px;">
                    <p style="margin:0 0 12px;font-size:13px;font-weight:700;color:#333;text-transform:uppercase;letter-spacing:.8px;">Next Steps</p>
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="padding:5px 0;vertical-align:top;">
                          <span style="display:inline-block;width:22px;height:22px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:22px;margin-right:10px;">1</span>
                        </td>
                        <td style="padding:5px 0;font-size:14px;color:#555;line-height:1.5;">Log in using the temporary password above.</td>
                      </tr>
                      <tr>
                        <td style="padding:5px 0;vertical-align:top;">
                          <span style="display:inline-block;width:22px;height:22px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:22px;margin-right:10px;">2</span>
                        </td>
                        <td style="padding:5px 0;font-size:14px;color:#555;line-height:1.5;">Go to <strong>Settings â†’ Change Password</strong>.</td>
                      </tr>
                      <tr>
                        <td style="padding:5px 0;vertical-align:top;">
                          <span style="display:inline-block;width:22px;height:22px;background:#ba1c26;color:#fff;border-radius:50%;font-size:11px;font-weight:700;text-align:center;line-height:22px;margin-right:10px;">3</span>
                        </td>
                        <td style="padding:5px 0;font-size:14px;color:#555;line-height:1.5;">Set a strong new password of your choice.</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Login Button -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td align="center">
                    <a href="{{ url('/login') }}" style="display:inline-block;background:linear-gradient(135deg,#ba1c26,#e33842);color:#fff;font-size:15px;font-weight:700;text-decoration:none;padding:14px 40px;border-radius:50px;letter-spacing:.3px;box-shadow:0 6px 20px rgba(186,28,38,0.35);">
                      Login to Your Account â†’
                    </a>
                  </td>
                </tr>
              </table>

              <!-- Warning -->
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="background:#fff8f0;border-left:4px solid #ff9800;border-radius:0 8px 8px 0;padding:14px 18px;">
                    <p style="margin:0;font-size:13px;color:#7a4f00;line-height:1.6;">
                      âš ï¸ <strong>Didn't request this?</strong> If you did not request a password reset, please ignore this email. Your account remains secure.
                    </p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:28px 40px;text-align:center;">

              <img src="{{ url('frontend/images/logos/logo.png') }}"
                   alt="Wintech Inc"
                   style="height:36px;max-width:140px;object-fit:contain;filter:brightness(0) invert(1);margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;">
              <p style="margin:0 0 6px;color:#fff;font-size:14px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 14px;color:rgba(255,255,255,0.5);font-size:12px;">Staffing Â· Recruitment Â· IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.35);font-size:11px;">
                This is an automated email. Please do not reply to this message.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>

