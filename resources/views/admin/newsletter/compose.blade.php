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

    /* Summary bar */
    .nl-summary { background:#f0fdf4; border:1px solid #86efac; border-radius:8px; padding:.75rem 1rem; font-size:.875rem; color:#166534; margin-bottom:1.5rem; display:flex; align-items:center; gap:.5rem; }

    .preview-box { background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:1rem; font-size:.85rem; color:#374151; min-height:60px; white-space:pre-wrap; }
    .char-count  { font-size:.75rem; color:#9ca3af; text-align:right; margin-top:.25rem; }

    .btn-send { background:#4f46e5; color:#fff; border:none; border-radius:8px; padding:.7rem 2rem; font-size:.9rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:.5rem; transition:background .2s; }
    .btn-send:hover { background:#4338ca; }
    .btn-back { background:#fff; color:#6b7280; border:1px solid #d1d5db; border-radius:8px; padding:.7rem 1.5rem; font-size:.9rem; font-weight:500; text-decoration:none; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-back:hover { background:#f9fafb; color:#374151; }
    .nl-alert { border-radius:10px; border:none; font-size:.875rem; padding:.875rem 1.25rem; margin-bottom:1.25rem; }
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

        <form action="{{ route('admin.newsletter.send') }}" method="POST" id="composeForm" enctype="multipart/form-data">
            @csrf

            {{-- STEP 1: Audience --}}
            <div class="nl-field">
                <label class="nl-label" style="font-size:.9rem;color:#111827;margin-bottom:.75rem">
                    <i class="ti ti-users me-1" style="color:#4f46e5"></i>
                    Step 1 — Audience (Optional Target)
                </label>

                <div style="margin-bottom: 1rem;">
                    <select name="job_function_id" class="nl-input" id="targetJobFunction">
                        <option value="">All Registered Users ({{ $totalUsers }} users)</option>
                        @foreach($jobFunctions as $jf)
                            <option value="{{ $jf->id }}" {{ old('job_function_id') == $jf->id ? 'selected' : '' }}>{{ $jf->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="nl-summary" id="audienceSummary">
                    <i class="ti ti-check"></i>
                    <span>This newsletter will be sent to all <strong>{{ $totalUsers }}</strong> registered users.</span>
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

            {{-- STEP 3: Image Upload (Optional) --}}
            <div class="nl-field">
                <label class="nl-label">
                    <i class="ti ti-image me-1" style="color:#4f46e5"></i>
                    Step 3 — Featured Image (Optional)
                </label>
                <input type="file" name="image" class="nl-input" accept="image/png, image/jpeg, image/jpg, image/gif" style="padding:.5rem 1rem">
                <div style="font-size:.75rem; color:#6b7280; margin-top:.4rem;">Supported formats: JPEG, PNG, GIF (Max 2MB).</div>
            </div>

            {{-- STEP 4: Body --}}
            <div class="nl-field">
                <label class="nl-label">
                    <i class="ti ti-align-left me-1" style="color:#4f46e5"></i>
                    Step 4 — Message Body <span style="color:#dc2626">*</span>
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
                <button type="submit" class="btn-send" id="sendBtn">
                    <i class="ti ti-send"></i> Send Newsletter
                </button>
                <a href="{{ route('admin.newsletter.index') }}" class="btn-back">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function updatePreview(el) {
    document.getElementById('charCount').textContent = el.value.length;
    document.getElementById('previewBox').textContent = el.value || 'Your message will appear here...';
}

// Confirm before submit
document.getElementById('composeForm').addEventListener('submit', function(e) {
    const jf = document.getElementById('targetJobFunction');
    const targetText = jf.options[jf.selectedIndex].text;
    if (!confirm('Are you sure you want to send this newsletter to ' + targetText + '?')) e.preventDefault();
});

// Init
updatePreview(document.getElementById('bodyField'));
</script>
@endsection
