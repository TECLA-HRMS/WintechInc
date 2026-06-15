<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wintech Inc Newsletter</title>
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
              <div style="font-size:44px;line-height:1;margin-bottom:12px;">📢</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;">Wintech Inc Newsletter</h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">Latest updates just for you</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;font-size:15px;color:#374151;line-height:1.8;">
              {!! nl2br(e($mailBody)) !!}
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:26px 40px;text-align:center;">
              <p style="margin:0 0 4px;color:#fff;font-size:13px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 12px;color:rgba(255,255,255,0.45);font-size:11px;letter-spacing:0.5px;">Staffing &nbsp;·&nbsp; Recruitment &nbsp;·&nbsp; IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.28);font-size:11px;">
                You are receiving this because you subscribed to our newsletter.<br>
                <a href="{{ url('/newsletter/unsubscribe?email='.urlencode($subscriberEmail)) }}" style="color:rgba(186,28,38,0.7);text-decoration:underline;">Unsubscribe</a>
                &nbsp;·&nbsp; © {{ date('Y') }} Wintech Inc.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
