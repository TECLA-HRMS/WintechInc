@extends('layouts.admin')

@section('adminContent')
<style>
    .st-page { background:#f1f5f9; min-height:100vh; padding:1.5rem; }
    .st-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.75rem; flex-wrap:wrap; gap:.75rem; }
    .st-header h1 { font-size:1.5rem; font-weight:700; color:#111827; margin:0 0 .25rem; }
    .st-breadcrumb { font-size:.8rem; color:#6b7280; }
    .st-breadcrumb a { color:#4f46e5; text-decoration:none; }

    /* Tabs */
    .st-tabs { display:flex; gap:.25rem; border-bottom:2px solid #e5e7eb; margin-bottom:1.75rem; }
    .st-tab { padding:.7rem 1.4rem; border:none; background:none; font-size:.875rem; font-weight:600; color:#6b7280; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; transition:all .2s; border-radius:6px 6px 0 0; }
    .st-tab:hover { color:#4f46e5; background:#f5f3ff; }
    .st-tab.active { color:#4f46e5; border-bottom-color:#4f46e5; background:#eef2ff; }

    /* Card */
    .st-card { background:#fff; border:1px solid #e5e7eb; border-radius:14px; padding:2rem; box-shadow:0 1px 3px rgba(0,0,0,.04); max-width:860px; }
    .st-section-title { font-size:.95rem; font-weight:700; color:#111827; margin-bottom:1.25rem; padding-bottom:.75rem; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; gap:.5rem; }

    /* Fields */
    .st-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
    .st-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:1.25rem; }
    .st-field { margin-bottom:0; }
    .st-field.full { grid-column:1/-1; }
    .st-label { font-size:.8rem; font-weight:600; color:#374151; margin-bottom:.4rem; display:block; }
    .st-input { width:100%; border:1px solid #d1d5db; border-radius:8px; padding:.65rem 1rem; font-size:.875rem; color:#111827; outline:none; transition:border .2s; box-sizing:border-box; }
    .st-input:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,.1); }
    .st-hint { font-size:.75rem; color:#9ca3af; margin-top:.3rem; }

    /* Social row */
    .social-row { display:flex; align-items:center; gap:.75rem; margin-bottom:.85rem; }
    .social-icon { width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
    .si-fb   { background:#dbeafe; color:#1d4ed8; }
    .si-ig   { background:#fce7f3; color:#be185d; }
    .si-tw   { background:#e0f2fe; color:#0284c7; }
    .si-li   { background:#dbeafe; color:#1e40af; }
    .si-yt   { background:#fee2e2; color:#dc2626; }

    /* Logo preview */
    .logo-preview { width:80px; height:80px; border:2px dashed #d1d5db; border-radius:10px; object-fit:contain; background:#f9fafb; padding:4px; }
    .logo-wrap { display:flex; align-items:center; gap:1rem; margin-bottom:.5rem; }

    /* Alert */
    .st-alert { border-radius:10px; border:none; font-size:.875rem; padding:.875rem 1.25rem; margin-bottom:1.5rem; }

    /* Buttons */
    .btn-save { background:#4f46e5; color:#fff; border:none; border-radius:8px; padding:.7rem 2rem; font-size:.9rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.5rem; transition:background .2s; margin-top:1.5rem; }
    .btn-save:hover { background:#4338ca; }

    /* Test mail */
    .btn-test { background:#ecfdf5; color:#059669; border:1px solid #6ee7b7; border-radius:8px; padding:.6rem 1.25rem; font-size:.85rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.5rem; transition:all .2s; margin-top:1.5rem; margin-left:.75rem; }
    .btn-test:hover { background:#d1fae5; }

    /* Password toggle */
    .pw-wrap { position:relative; }
    .pw-wrap .st-input { padding-right:2.5rem; }
    .pw-eye { position:absolute; right:.75rem; top:50%; transform:translateY(-50%); cursor:pointer; color:#9ca3af; font-size:1rem; }

    @media(max-width:640px){ .st-grid,.st-grid-3{ grid-template-columns:1fr; } }
</style>

<div class="st-page">

    @if(session('success_general'))
    <div class="alert alert-success alert-dismissible fade show st-alert">
        <i class="ti ti-circle-check me-2"></i>{{ session('success_general') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('success_appearance'))
    <div class="alert alert-success alert-dismissible fade show st-alert">
        <i class="ti ti-circle-check me-2"></i>{{ session('success_appearance') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('success_email'))
    <div class="alert alert-success alert-dismissible fade show st-alert">
        <i class="ti ti-circle-check me-2"></i>{{ session('success_email') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show st-alert">
        @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="st-header">
        <div>
            <h1><i class="ti ti-settings me-2" style="color:#4f46e5"></i>Settings</h1>
            <div class="st-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> / Settings
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="st-tabs">
        <button class="st-tab active" onclick="switchTab('general', this)">
            <i class="ti ti-adjustments me-1"></i> General Settings
        </button>
        <button class="st-tab" onclick="switchTab('email', this)">
            <i class="ti ti-mail me-1"></i> Email Configuration
        </button>
        <button class="st-tab" onclick="switchTab('appearance', this)">
            <i class="ti ti-palette me-1"></i> Appearance
        </button>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- TAB 1: GENERAL SETTINGS --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div id="tab-general">
        <form action="{{ route('admin.settings.general') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Site Identity --}}
            <div class="st-card" style="margin-bottom:1.5rem">
                <div class="st-section-title">
                    <i class="ti ti-building" style="color:#4f46e5"></i> Site Identity
                </div>

                {{-- Logo --}}
                <div class="st-field" style="margin-bottom:1.25rem">
                    <label class="st-label">Site Logo</label>
                    <div class="logo-wrap">
                        @if($s->get('site_logo'))
                            <img loading="lazy" src="{{ asset($s->get('site_logo')) }}" id="logoPreview" class="logo-preview" alt="Logo">
                        @else
                            <img loading="lazy" src="{{ asset('frontend/images/logos/logo2.jpeg') }}" id="logoPreview" class="logo-preview" alt="Logo">
                        @endif
                        <div>
                            <input type="file" name="site_logo" id="logoInput" accept="image/*"
                                   onchange="previewImg(this,'logoPreview')" style="display:none">
                            <button type="button" onclick="document.getElementById('logoInput').click()"
                                    style="background:#eef2ff;color:#4f46e5;border:1px solid #c7d2fe;border-radius:7px;padding:.45rem 1rem;font-size:.8rem;font-weight:600;cursor:pointer">
                                <i class="ti ti-upload me-1"></i> Upload Logo
                            </button>
                            <div class="st-hint">PNG, JPG, SVG, WEBP — max 2MB</div>
                        </div>
                    </div>
                </div>

                {{-- Favicon --}}
                <div class="st-field" style="margin-bottom:1.5rem">
                    <label class="st-label">Favicon</label>
                    <div class="logo-wrap">
                        @if($s->get('site_favicon'))
                            <img loading="lazy" src="{{ asset($s->get('site_favicon')) }}" id="faviconPreview" class="logo-preview" alt="Favicon" style="width:48px;height:48px">
                        @else
                            <img loading="lazy" src="{{ asset('favicon.ico') }}" id="faviconPreview" class="logo-preview" alt="Favicon" style="width:48px;height:48px">
                        @endif
                        <div>
                            <input type="file" name="site_favicon" id="faviconInput" accept="image/*"
                                   onchange="previewImg(this,'faviconPreview')" style="display:none">
                            <button type="button" onclick="document.getElementById('faviconInput').click()"
                                    style="background:#eef2ff;color:#4f46e5;border:1px solid #c7d2fe;border-radius:7px;padding:.45rem 1rem;font-size:.8rem;font-weight:600;cursor:pointer">
                                <i class="ti ti-upload me-1"></i> Upload Favicon
                            </button>
                            <div class="st-hint">ICO, PNG — max 512KB</div>
                        </div>
                    </div>
                </div>

                <div class="st-grid">
                    <div class="st-field">
                        <label class="st-label">Site Name <span style="color:#dc2626">*</span></label>
                        <input type="text" name="site_name" class="st-input"
                               value="{{ old('site_name', $s->get('site_name', config('app.name'))) }}"
                               placeholder="Wintech Inc" required>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Contact Email <span style="color:#dc2626">*</span></label>
                        <input type="email" name="site_email" class="st-input"
                               value="{{ old('site_email', $s->get('site_email', '')) }}"
                               placeholder="info@wintechinc.in" required>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Phone Number</label>
                        <input type="text" name="site_phone" class="st-input"
                               value="{{ old('site_phone', $s->get('site_phone', '')) }}"
                               placeholder="+91 98765 43210">
                    </div>
                    <div class="st-field full">
                        <label class="st-label">Office Address</label>
                        <input type="text" name="site_address" class="st-input"
                               value="{{ old('site_address', $s->get('site_address', '')) }}"
                               placeholder="123 Main Street, City, State - 600001">
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="st-card" style="margin-bottom:1.5rem">
                <div class="st-section-title">
                    <i class="ti ti-share" style="color:#4f46e5"></i> Social Media Links
                </div>

                <div class="social-row">
                    <div class="social-icon si-fb"><i class="fa-brands fa-facebook-f"></i></div>
                    <div style="flex:1">
                        <label class="st-label">Facebook</label>
                        <input type="url" name="fb_link" class="st-input"
                               value="{{ old('fb_link', $s->get('fb_link', '')) }}"
                               placeholder="https://facebook.com/yourpage">
                    </div>
                </div>

                <div class="social-row">
                    <div class="social-icon si-ig"><i class="fa-brands fa-instagram"></i></div>
                    <div style="flex:1">
                        <label class="st-label">Instagram</label>
                        <input type="url" name="instagram_link" class="st-input"
                               value="{{ old('instagram_link', $s->get('instagram_link', '')) }}"
                               placeholder="https://instagram.com/yourpage">
                    </div>
                </div>

                <div class="social-row">
                    <div class="social-icon si-tw"><i class="fa-brands fa-x-twitter"></i></div>
                    <div style="flex:1">
                        <label class="st-label">Twitter / X</label>
                        <input type="url" name="twitter_link" class="st-input"
                               value="{{ old('twitter_link', $s->get('twitter_link', '')) }}"
                               placeholder="https://x.com/yourhandle">
                    </div>
                </div>

                <div class="social-row">
                    <div class="social-icon si-li"><i class="fa-brands fa-linkedin-in"></i></div>
                    <div style="flex:1">
                        <label class="st-label">LinkedIn</label>
                        <input type="url" name="linkedin_link" class="st-input"
                               value="{{ old('linkedin_link', $s->get('linkedin_link', '')) }}"
                               placeholder="https://linkedin.com/company/yourcompany">
                    </div>
                </div>

                <div class="social-row">
                    <div class="social-icon si-yt"><i class="fa-brands fa-youtube"></i></div>
                    <div style="flex:1">
                        <label class="st-label">YouTube</label>
                        <input type="url" name="youtube_link" class="st-input"
                               value="{{ old('youtube_link', $s->get('youtube_link', '')) }}"
                               placeholder="https://youtube.com/@yourchannel">
                    </div>
                </div>
            </div>

            {{-- Google Map --}}
            <div class="st-card" style="margin-bottom:1.5rem">
                <div class="st-section-title">
                    <i class="ti ti-map-pin" style="color:#4f46e5"></i> Google Map
                </div>

                <div class="st-field">
                    <label class="st-label">Google Map Embed URL</label>
                    <input type="url" name="google_map_url" class="st-input"
                           value="{{ old('google_map_url', $s->get('google_map_url', '')) }}"
                           placeholder="https://www.google.com/maps/embed?pb=...">
                    <div class="st-hint">Go to Google Maps → Share → Embed a map → Copy the src URL from iframe</div>
                </div>
            </div>

            <button type="submit" class="btn-save">
                <i class="ti ti-device-floppy"></i> Save General Settings
            </button>
        </form>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- TAB 2: EMAIL CONFIGURATION --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div id="tab-email" style="display:none">
        <form action="{{ route('admin.settings.email') }}" method="POST">
            @csrf

            <div class="st-card">
                <div class="st-section-title">
                    <i class="ti ti-server" style="color:#4f46e5"></i> SMTP Configuration
                    <span style="font-size:.75rem;font-weight:400;color:#6b7280;margin-left:.5rem">Changes are written directly to your .env file</span>
                </div>

                <div class="st-grid">
                    <div class="st-field">
                        <label class="st-label">Mail Host <span style="color:#dc2626">*</span></label>
                        <input type="text" name="mail_host" class="st-input"
                               value="{{ old('mail_host', env('MAIL_HOST', 'smtp.gmail.com')) }}"
                               placeholder="smtp.gmail.com" required>
                        <div class="st-hint">e.g. smtp.gmail.com, smtp.mailtrap.io</div>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Mail Port <span style="color:#dc2626">*</span></label>
                        <input type="number" name="mail_port" class="st-input"
                               value="{{ old('mail_port', env('MAIL_PORT', 587)) }}"
                               placeholder="587" required>
                        <div class="st-hint">587 (TLS) · 465 (SSL) · 25 (None)</div>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Encryption <span style="color:#dc2626">*</span></label>
                        <select name="mail_encryption" class="st-input" required>
                            @foreach(['tls' => 'TLS (Recommended)', 'ssl' => 'SSL', 'none' => 'None'] as $val => $label)
                                <option value="{{ $val }}" {{ env('MAIL_ENCRYPTION', 'tls') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Username (Email) <span style="color:#dc2626">*</span></label>
                        <input type="email" name="mail_username" class="st-input"
                               value="{{ old('mail_username', env('MAIL_USERNAME', '')) }}"
                               placeholder="you@gmail.com" required>
                    </div>
                    <div class="st-field">
                        <label class="st-label">Password / App Password <span style="color:#dc2626">*</span></label>
                        <div class="pw-wrap">
                            <input type="password" name="mail_password" id="mailPw" class="st-input"
                                   value="{{ old('mail_password', env('MAIL_PASSWORD', '')) }}"
                                   placeholder="••••••••••••" required>
                            <span class="pw-eye" onclick="togglePw()">
                                <i class="ti ti-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        <div class="st-hint">For Gmail use an <a href="https://myaccount.google.com/apppasswords" target="_blank" style="color:#4f46e5">App Password</a></div>
                    </div>
                    <div class="st-field">
                        <label class="st-label">From Address <span style="color:#dc2626">*</span></label>
                        <input type="email" name="mail_from_address" class="st-input"
                               value="{{ old('mail_from_address', env('MAIL_FROM_ADDRESS', '')) }}"
                               placeholder="noreply@wintechinc.in" required>
                    </div>
                    <div class="st-field full">
                        <label class="st-label">From Name <span style="color:#dc2626">*</span></label>
                        <input type="text" name="mail_from_name" class="st-input"
                               value="{{ old('mail_from_name', trim(env('MAIL_FROM_NAME', ''), '"')) }}"
                               placeholder="Wintech Inc" required>
                    </div>
                </div>

                {{-- Current .env preview --}}
                <div style="background:#0f172a;border-radius:10px;padding:1rem 1.25rem;margin-top:1.5rem;font-family:monospace;font-size:.8rem;color:#94a3b8;line-height:1.8">
                    <div style="color:#64748b;font-size:.72rem;margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.08em">Current .env values</div>
                    <div><span style="color:#7dd3fc">MAIL_HOST</span>=<span style="color:#86efac">{{ env('MAIL_HOST') }}</span></div>
                    <div><span style="color:#7dd3fc">MAIL_PORT</span>=<span style="color:#86efac">{{ env('MAIL_PORT') }}</span></div>
                    <div><span style="color:#7dd3fc">MAIL_ENCRYPTION</span>=<span style="color:#86efac">{{ env('MAIL_ENCRYPTION') }}</span></div>
                    <div><span style="color:#7dd3fc">MAIL_USERNAME</span>=<span style="color:#86efac">{{ env('MAIL_USERNAME') }}</span></div>
                    <div><span style="color:#7dd3fc">MAIL_PASSWORD</span>=<span style="color:#fbbf24">••••••••</span></div>
                    <div><span style="color:#7dd3fc">MAIL_FROM_ADDRESS</span>=<span style="color:#86efac">{{ env('MAIL_FROM_ADDRESS') }}</span></div>
                    <div><span style="color:#7dd3fc">MAIL_FROM_NAME</span>=<span style="color:#86efac">{{ env('MAIL_FROM_NAME') }}</span></div>
                </div>

                <div style="display:flex;align-items:center;flex-wrap:wrap;gap:.75rem">
                    <button type="submit" class="btn-save" style="margin-top:1.5rem">
                        <i class="ti ti-device-floppy"></i> Save & Apply
                    </button>
                    <button type="button" class="btn-test" onclick="sendTestMail()">
                        <i class="ti ti-send"></i> Send Test Email
                    </button>
                </div>
                <div id="testResult" style="margin-top:.75rem;font-size:.85rem"></div>
            </div>
        </form>
    </div>

</div>

<script>
function switchTab(tab, btn) {
    document.getElementById('tab-general').style.display = tab === 'general' ? '' : 'none';
    document.getElementById('tab-email').style.display   = tab === 'email'   ? '' : 'none';
    document.querySelectorAll('.st-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

function previewImg(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById(previewId).src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}

function togglePw() {
    const pw = document.getElementById('mailPw');
    const ic = document.getElementById('eyeIcon');
    if (pw.type === 'password') {
        pw.type = 'text';
        ic.className = 'ti ti-eye-off';
    } else {
        pw.type = 'password';
        ic.className = 'ti ti-eye';
    }
}

function sendTestMail() {
    const res = document.getElementById('testResult');
    res.innerHTML = '<span style="color:#6b7280"><i class="ti ti-loader-2 me-1"></i>Sending...</span>';
    fetch('{{ route("admin.settings.test-mail") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    })
    .then(r => r.json())
    .then(d => {
        res.innerHTML = d.success
            ? '<span style="color:#059669"><i class="ti ti-circle-check me-1"></i>' + d.message + '</span>'
            : '<span style="color:#dc2626"><i class="ti ti-alert-circle me-1"></i>' + d.message + '</span>';
    })
    .catch(() => res.innerHTML = '<span style="color:#dc2626">Request failed.</span>');
}

// Auto-open email tab if email errors exist
@if(session('success_appearance'))
switchTab('appearance', document.querySelectorAll('.st-tab')[2]);
@elseif(session('success_email') || (old('mail_host')))
switchTab('email', document.querySelectorAll('.st-tab')[1]);
@endif
</script>
@endsection


