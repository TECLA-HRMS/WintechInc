<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $data['isUpdate'] ? 'Your Admin Account Has Been Updated' : 'Your New Admin Account' }}</title>
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
                <span style="color:rgba(255,255,255,0.9);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Wintech Inc</span>
              </div>
              <div style="font-size:44px;line-height:1;margin-bottom:12px;">ðŸ”</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;letter-spacing:-0.3px;">
                {{ $data['isUpdate'] ? 'Account Updated' : 'Admin Account Created' }}
              </h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">
                {{ $data['isUpdate'] ? 'Your credentials have been updated' : 'Welcome to the admin panel' }}
              </p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <p style="margin:0 0 18px;font-size:15px;color:#444;line-height:1.7;">
                Dear <strong style="color:#071056;">{{ $data['name'] }}</strong>,
              </p>

              @if($data['isUpdate'])
              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.8;">
                Your admin account has been <strong style="color:#ba1c26;">updated</strong>. Below are your current login credentials. Please keep them safe and do not share them with anyone.
              </p>
              @else
              <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.8;">
                A new admin account has been <strong style="color:#ba1c26;">created</strong> for you on the Wintech Inc admin panel. Use the credentials below to log in.
              </p>
              @endif

              <!-- Credentials Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px solid #ba1c26;border-radius:12px;padding:24px;">
                    <p style="margin:0 0 14px;font-size:11px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Your Login Credentials</p>

                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Role</span><br>
                          <strong style="font-size:15px;color:#071056;">{{ $data['role'] }}</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:7px 0;border-bottom:1px solid rgba(186,28,38,0.12);">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Email / Username</span><br>
                          <strong style="font-size:15px;color:#071056;">{{ $data['username'] }}</strong>
                        </td>
                      </tr>
                      @isset($data['password'])
                      <tr>
                        <td style="padding:7px 0;">
                          <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Password</span><br>
                          <strong style="font-size:18px;color:#071056;letter-spacing:3px;font-family:'Courier New',monospace;">{{ $data['password'] }}</strong>
                        </td>
                      </tr>
                      @endisset
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Warning -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#fff8f0;border-left:4px solid #ff9800;border-radius:0 8px 8px 0;padding:14px 18px;">
                    <p style="margin:0;font-size:13px;color:#7a4f00;line-height:1.6;">
                      ðŸ”’ <strong>Security Reminder:</strong> Please change your password after your first login. Never share your credentials with anyone.
                    </p>
                  </td>
                </tr>
              </table>

              <p style="margin:0;font-size:15px;color:#444;line-height:1.7;">
                Warm Regards,<br>
                <strong style="color:#071056;">Admin Team</strong><br>
                <span style="color:#ba1c26;font-size:13px;">Wintech Inc</span>
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
                If you didn't request this, please contact your system administrator immediately.<br>
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

