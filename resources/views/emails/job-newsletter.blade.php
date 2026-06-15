<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Job Opportunity – Wintech Inc</title>
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
              <div style="font-size:44px;line-height:1;margin-bottom:12px;">🚀</div>
              <h1 style="margin:0 0 6px;color:#fff;font-size:24px;font-weight:700;">New Job Opportunity</h1>
              <p style="margin:0;color:rgba(255,255,255,0.75);font-size:14px;">A new job matching your interests has been posted!</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="background:#ffffff;padding:40px 40px 32px;">

              <!-- Job Title Box -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
                <tr>
                  <td style="background:linear-gradient(135deg,#fff5f5,#fff0f0);border:2px solid #ba1c26;border-radius:12px;padding:22px;text-align:center;">
                    <p style="margin:0 0 4px;font-size:11px;font-weight:700;color:#ba1c26;letter-spacing:1.5px;text-transform:uppercase;">Position</p>
                    <p style="margin:0 0 4px;font-size:22px;font-weight:700;color:#071056;">{{ $job['job_title'] }}</p>
                    <p style="margin:0;font-size:13px;color:#6b7280;">{{ $job['company_name'] }} &nbsp;·&nbsp; {{ $job['job_location'] }}</p>
                  </td>
                </tr>
              </table>

              <!-- Meta Grid (table-based for email) -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td width="48%" style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;vertical-align:top;">
                    <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Job Type</div>
                    <div style="font-size:14px;font-weight:600;color:#111827;margin-top:3px;">{{ $job['job_type'] }}</div>
                  </td>
                  <td width="4%"></td>
                  <td width="48%" style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;vertical-align:top;">
                    <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Work Mode</div>
                    <div style="font-size:14px;font-weight:600;color:#111827;margin-top:3px;">{{ $job['work_mode'] }}</div>
                  </td>
                </tr>
              </table>
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
                <tr>
                  <td width="48%" style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;vertical-align:top;">
                    <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Experience</div>
                    <div style="font-size:14px;font-weight:600;color:#111827;margin-top:3px;">{{ $job['experience'] }}</div>
                  </td>
                  <td width="4%"></td>
                  <td width="48%" style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;vertical-align:top;">
                    <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;">Vacancies</div>
                    <div style="font-size:14px;font-weight:600;color:#111827;margin-top:3px;">{{ $job['vacancies'] }}</div>
                  </td>
                </tr>
              </table>

              <!-- Salary -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
                <tr>
                  <td style="background:#fffbeb;border:1px solid #fcd34d;border-radius:10px;padding:14px 18px;text-align:center;">
                    <span style="font-size:16px;font-weight:700;color:#92400e;">
                      💰 ₹{{ number_format($job['salary_from']) }} – ₹{{ number_format($job['salary_to']) }} / month
                    </span>
                  </td>
                </tr>
              </table>

              <!-- CTA -->
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center">
                    <a href="{{ url('/jobs') }}"
                       style="display:inline-block;background:linear-gradient(135deg,#ba1c26,#e33842);color:#fff;font-size:15px;font-weight:700;text-decoration:none;padding:14px 44px;border-radius:50px;letter-spacing:0.3px;box-shadow:0 6px 20px rgba(186,28,38,0.35);">
                      View All Jobs →
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#071056;border-radius:0 0 16px 16px;padding:26px 40px;text-align:center;">
              <p style="margin:0 0 4px;color:#fff;font-size:13px;font-weight:700;">Wintech Inc</p>
              <p style="margin:0 0 12px;color:rgba(255,255,255,0.45);font-size:11px;letter-spacing:0.5px;">Staffing &nbsp;·&nbsp; Recruitment &nbsp;·&nbsp; IT Solutions</p>
              <p style="margin:0;color:rgba(255,255,255,0.28);font-size:11px;">
                You are receiving this because you subscribed to job alerts.<br>
                <a href="{{ url('/newsletter/unsubscribe?email='.urlencode($subscriberEmail ?? '')) }}" style="color:rgba(186,28,38,0.7);text-decoration:underline;">Unsubscribe</a>
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
