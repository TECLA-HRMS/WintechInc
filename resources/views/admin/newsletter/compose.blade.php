@extends('layouts.admin')

@section('adminContent')
<style>
    .nl-page  { background:#f1f5f9; min-height:100vh; padding:1.5rem; }
    .nl-header{ display:flex; justify-content:space-between; align-items:center; margin-bottom:1.75rem; flex-wrap:wrap; gap:.75rem; }
    .nl-header h1 { font-size:1.5rem; font-weight:700; color:#111827; margin:0 0 .25rem; }
    .nl-breadcrumb{ font-size:.8rem; color:#6b7280; }
    .nl-breadcrumb a{ color:#4f46e5; text-decoration:none; }

    .nl-card  { background:#fff; border:1px solid #e5e7eb; border-radius:14px; padding:2rem; box-shadow:0 1px 3px rgba(0,0,0,.04); max-width:820px; }
    .nl-label { font-size:.8rem; font-weight:600; color:#374151; margin-bottom:.4rem; display:block; }
    .nl-input { width:100%; border:1px solid #d1d5db; border-radius:8px; padding:.65rem 1rem; font-size:.9rem; color:#111827; outline:none; transition:border .2s; box-sizing:border-box; }
    .nl-input:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,.1); }
    .nl-textarea { width:100%; border:1px solid #d1d5db; border-radius:8px; padding:.75rem 1rem; font-size:.9rem; color:#111827; outline:none; resize:vertical; min-height:220px; transition:border .2s; box-sizing:border-box; }
    .nl-textarea:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,.1); }
    .nl-field { margin-bottom:1.4rem; }

    /* Audience cards */
    .audience-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem; }
    .audience-card { border:2px solid #e5e7eb; border-radius:12px; padding:1.1rem 1.25rem; cursor:pointer; transition:all .2s; position:relative; user-select:none; }
    .audience-card:hover { border-color:#a5b4fc; background:#fafbff; }
    .audience-card.selected { border-color:#4f46e5; background:#eef2ff; }
    .audience-card input[type=checkbox] { position:absolute; opacity:0; width:0; height:0; }
    .audience-card .ac-check { width:20px; height:20px; border:2px solid #d1d5db; border-radius:5px; display:inline-flex; align-items:center; justify-content:center; margin-right:.6rem; flex-shrink:0; transition:all .2s; }
    .audience-card.selected .ac-check { background:#4f46e5; border-color:#4f46e5; color:#fff; }
    .audience-card .ac-top { display:flex; align-items:center; margin-bottom:.4rem; }
    .audience-card .ac-icon { width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1rem; margin-right:.75rem; flex-shrink:0; }
    .audience-card .ac-title { font-weight:700; font-size:.95rem; color:#111827; }
    .audience-card .ac-count { font-size:.8rem; color:#6b7280; margin-top:.15rem; }
    .ac-icon-sub  { background:#eef2ff; color:#4f46e5; }
    .ac-icon-user { background:#ecfdf5; color:#059669; }

    /* Summary bar */
    .nl-summary { background:#f0fdf4; border:1px solid #86efac; border-radius:8px; padding:.75rem 1rem; font-size:.875rem; color:#166534; margin-bottom:1.5rem; display:flex; align-items:center; gap:.5rem; }
    .nl-summary.warn { background:#fffbeb; border-color:#fcd34d; color:#92400e; }

    .preview-box { background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:1rem; font-size:.85rem; color:#374151; min-height:60px; white-space:pre-wrap; }
    .char-count  { font-size:.75rem; color:#9ca3af; text-align:right; margin-top:.25rem; }

    .btn-send { background:#4f46e5; color:#fff; border:none; border-radius:8px; padding:.7rem 2rem; font-size:.9rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.5rem; transition:background .2s; }
    .btn-send:hover { background:#4338ca; }
    .btn-send:disabled { background:#a5b4fc; cursor:not-allowed; }
    .btn-back { background:#fff; color:#6b7280; border:1px solid #d1d5db; border-radius:8px; padding:.7rem 1.5rem; font-size:.9rem; font-weight:500; text-decoration:none; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-back:hover { background:#f9fafb; color:#374151; }
    .nl-alert { border-radius:10px; border:none; font-size:.875rem; padding:.875rem 1.25rem; margin-bottom:1.25rem; }

    @media(max-width:600px){ .audience-grid{ grid-template-columns:1fr; } }
</style>

<div class="nl-page">

    @if($errors->any())
    <div class="alert alert-danger nl-alert">
        @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
    </div>
    @endif

    <div class="nl-header">
        <div>
            <h1><i class="ti ti-send me-2" style="color:#4f46e5"></i>Compose Newsletter</h1>
            <div class="nl-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> /
                <a href="{{ route('admin.newsletter.index') }}">Newsletter</a> /
                Compose
            </div>
        </div>
        <a href="{{ route('admin.newsletter.index') }}" class="btn-back">
            <i class="ti ti-arrow-left"></i> Back
        </a>
    </div>

    <div class="nl-card">

        <form action="{{ route('admin.newsletter.send') }}" method="POST" id="composeForm">
            @csrf

            {{-- STEP 1: Audience --}}
            <div class="nl-field">
                <label class="nl-label" style="font-size:.9rem;color:#111827;margin-bottom:.75rem">
                    <i class="ti ti-users me-1" style="color:#4f46e5"></i>
                    Step 1 — Choose Recipients
                </label>

                <div class="audience-grid">

                    {{-- Newsletter Subscribers --}}
                    <label class="audience-card {{ in_array('subscribers', old('send_to', [])) ? 'selected' : '' }}"
                           id="card-subscribers" onclick="toggleCard(this)">
                        <input type="checkbox" name="send_to[]" value="subscribers"
                               id="chk-subscribers"
                               {{ in_array('subscribers', old('send_to', [])) ? 'checked' : '' }}>
                        <div class="ac-top">
                            <div class="ac-check"><i class="ti ti-check" style="font-size:.75rem"></i></div>
                            <div class="ac-icon ac-icon-sub"><i class="ti ti-mail-forward"></i></div>
                            <div>
                                <div class="ac-title">Newsletter Subscribers</div>
                                <div class="ac-count">{{ $totalSubscribers }} active subscriber(s)</div>
                            </div>
                        </div>
                    </label>

                    {{-- Registered Users --}}
                    <label class="audience-card {{ in_array('users', old('send_to', [])) ? 'selected' : '' }}"
                           id="card-users" onclick="toggleCard(this)">
                        <input type="checkbox" name="send_to[]" value="users"
                               id="chk-users"
                               {{ in_array('users', old('send_to', [])) ? 'checked' : '' }}>
                        <div class="ac-top">
                            <div class="ac-check"><i class="ti ti-check" style="font-size:.75rem"></i></div>
                            <div class="ac-icon ac-icon-user"><i class="ti ti-users"></i></div>
                            <div>
                                <div class="ac-title">Registered Users</div>
                                <div class="ac-count">{{ $totalUsers }} registered user(s)</div>
                            </div>
                        </div>
                    </label>

                </div>

                {{-- Dynamic summary --}}
                <div class="nl-summary warn" id="summaryBar">
                    <i class="ti ti-info-circle"></i>
                    <span id="summaryText">Please select at least one recipient group.</span>
                </div>
            </div>

            {{-- STEP 2: Subject --}}
            <div class="nl-field">
                <label class="nl-label">
                    <i class="ti ti-pencil me-1" style="color:#4f46e5"></i>
                    Step 2 — Subject <span style="color:#dc2626">*</span>
                </label>
                <input type="text" name="subject" class="nl-input"
                       placeholder="e.g. New Jobs Available This Week!"
                       value="{{ old('subject') }}" required maxlength="255">
            </div>

            {{-- STEP 3: Body --}}
            <div class="nl-field">
                <label class="nl-label">
                    <i class="ti ti-align-left me-1" style="color:#4f46e5"></i>
                    Step 3 — Message Body <span style="color:#dc2626">*</span>
                </label>
                <textarea name="body" id="bodyField" class="nl-textarea"
                          placeholder="Write your newsletter content here..."
                          required oninput="updatePreview(this)">{{ old('body') }}</textarea>
                <div class="char-count"><span id="charCount">0</span> characters</div>
            </div>

            {{-- Live preview --}}
            <div class="nl-field">
                <label class="nl-label" style="color:#6b7280">
                    <i class="ti ti-eye me-1"></i> Live Preview
                </label>
                <div class="preview-box" id="previewBox">Your message will appear here...</div>
            </div>

            <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-top:.5rem">
                <button type="submit" class="btn-send" id="sendBtn" disabled>
                    <i class="ti ti-send"></i> Send Newsletter
                </button>
                <a href="{{ route('admin.newsletter.index') }}" class="btn-back">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
const SUB_COUNT  = {{ $totalSubscribers }};
const USER_COUNT = {{ $totalUsers }};

function toggleCard(label) {
    const chk = label.querySelector('input[type=checkbox]');
    // Let the browser toggle the checkbox naturally, then sync UI
    setTimeout(() => {
        label.classList.toggle('selected', chk.checked);
        updateSummary();
    }, 0);
}

function updateSummary() {
    const subChecked  = document.getElementById('chk-subscribers').checked;
    const userChecked = document.getElementById('chk-users').checked;
    const bar         = document.getElementById('summaryBar');
    const txt         = document.getElementById('summaryText');
    const btn         = document.getElementById('sendBtn');

    if (!subChecked && !userChecked) {
        bar.className = 'nl-summary warn';
        txt.textContent = 'Please select at least one recipient group.';
        btn.disabled = true;
        return;
    }

    // Estimate (may overlap, dedup happens server-side)
    let parts = [];
    if (subChecked)  parts.push(SUB_COUNT  + ' subscriber(s)');
    if (userChecked) parts.push(USER_COUNT + ' registered user(s)');

    bar.className = 'nl-summary';
    txt.innerHTML = '<strong>Ready to send</strong> — recipients: ' + parts.join(' + ') + ' (duplicates removed automatically).';
    btn.disabled = false;
}

function updatePreview(el) {
    document.getElementById('charCount').textContent = el.value.length;
    document.getElementById('previewBox').textContent = el.value || 'Your message will appear here...';
}

// Confirm before submit
document.getElementById('composeForm').addEventListener('submit', function(e) {
    const txt = document.getElementById('summaryText').textContent;
    if (!confirm('Send newsletter?\n\n' + txt)) e.preventDefault();
});

// Init
updateSummary();
updatePreview(document.getElementById('bodyField'));
</script>
@endsection
