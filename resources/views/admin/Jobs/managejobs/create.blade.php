@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --success: #059669;
        --success-light: #ecfdf5;
        --warning: #d97706;
        --warning-light: #fffbeb;
        --danger: #dc2626;
        --danger-light: #fef2f2;
        --info: #0284c7;
        --info-light: #f0f9ff;
        --text-dark: #111827;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --bg-light: #f9fafb;
    }

    .cr-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    .cr-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 0.75rem; }
    .cr-header-left h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .cr-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .cr-breadcrumb a { color: var(--primary); text-decoration: none; }
    .cr-breadcrumb span { color: var(--border); }

    /* Card */
    .cr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 1.25rem; }
    .cr-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 0.6rem; }
    .cr-card-header-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
    .cr-card-title { font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin: 0; }
    .cr-card-body { padding: 1.5rem; }

    /* Form Fields */
    .form-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block; }
    .form-control, .form-select {
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.875rem;
        height: 42px;
        color: var(--text-dark);
        background: #fff;
        box-shadow: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        outline: none;
    }
    textarea.form-control { height: auto; resize: vertical; }
    .form-control.is-invalid, .form-select.is-invalid { border-color: var(--danger); }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.8rem; pointer-events: none; }
    .input-icon-wrap .form-control,
    .input-icon-wrap .form-select { padding-left: 34px; }
    .field-hint { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.3rem; }

    /* Section divider label */
    .section-divider { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); padding: 0.5rem 0; border-bottom: 1px solid var(--border); margin-bottom: 1.25rem; }

    /* Back btn */
    .btn-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1.25rem; border-radius: 8px; border: 1px solid var(--border); background: #fff; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.15s; }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); }

    /* Submit btn */
    .btn-submit { background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 0.75rem 2rem; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: all 0.15s; width: 100%; justify-content: center; }
    .btn-submit:hover { background: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.3); }
    .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    /* Sidebar sticky */
    .sidebar-sticky { position: sticky; top: 1.5rem; }

    /* Preview card */
    .preview-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; background: var(--primary-light); color: var(--primary); }
    .preview-row { display: flex; justify-content: space-between; align-items: center; padding: 0.55rem 0; border-bottom: 1px solid #f3f4f6; font-size: 0.82rem; }
    .preview-row:last-child { border-bottom: none; }
    .preview-row .key { color: var(--text-muted); }
    .preview-row .val { font-weight: 600; color: var(--text-dark); text-align: right; max-width: 60%; word-break: break-word; }

    /* Required star */
    .req { color: var(--danger); }

    @media (max-width: 768px) { .sidebar-sticky { position: static; } }
</style>

<div class="cr-page">

    <!-- Header -->
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-plus-circle me-2" style="color:var(--primary)"></i>Create New Job</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.managejobs.index') }}">Job Management</a>
                <span>/</span>
                <span>Create</span>
            </div>
        </div>
        <a href="{{ route('admin.managejobs.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.managejobs.store') }}" method="POST" id="jobForm" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">

            {{-- LEFT: Form --}}
            <div class="col-lg-8">

                {{-- Basic Info --}}
                <div class="cr-card">
                    <div class="cr-card-header">
                        <div class="cr-card-header-icon" style="background:var(--primary-light);color:var(--primary)">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <h6 class="cr-card-title">Basic Information</h6>
                    </div>
                    <div class="cr-card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Job Title <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-pen input-icon"></i>
                                    <input type="text" class="form-control" name="job_title" id="job_title"
                                           placeholder="e.g. Software Developer, Chef Master" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Job Type <span class="req">*</span></label>
                                <select class="form-select" name="job_type" id="job_type" required>
                                    <option value="" disabled selected>Select Job Type</option>
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Part-Time">Part-Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Work Mode <span class="req">*</span></label>
                                <select class="form-select" name="work_mode" required>
                                    <option value="" disabled selected>Select Work Mode</option>
                                    <option value="On-Site">On-Site</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Job Function <span class="req">*</span></label>
                                <select class="form-select" name="job_function" required>
                                    <option value="" disabled selected>Select Job Function</option>
                                    @foreach(\App\Models\JobFunction::where('status', 'active')->orderBy('name')->get() as $func)
                                        <option value="{{ $func->name }}">{{ $func->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status <span class="req">*</span></label>
                                <select class="form-select" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Company Info --}}
                <div class="cr-card">
                    <div class="cr-card-header">
                        <div class="cr-card-header-icon" style="background:var(--info-light);color:var(--info)">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h6 class="cr-card-title">Company Details</h6>
                    </div>
                    <div class="cr-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Company Name <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-building input-icon"></i>
                                    <input type="text" class="form-control" name="company_name" id="company_name"
                                           placeholder="e.g. TechPro Solutions" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Job Location <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-location-dot input-icon"></i>
                                    <input type="text" class="form-control" name="job_location"
                                           placeholder="e.g. Chennai, India" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Company Logo</label>
                                <input type="file" class="form-control" name="company_logo" accept="image/*" style="height:auto;padding:0.5rem">
                                <p class="field-hint"><i class="fa-solid fa-circle-info me-1"></i>Accepted: JPG, PNG, GIF — Max 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Job Details --}}
                <div class="cr-card">
                    <div class="cr-card-header">
                        <div class="cr-card-header-icon" style="background:var(--success-light);color:var(--success)">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <h6 class="cr-card-title">Job Details</h6>
                    </div>
                    <div class="cr-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">No. of Vacancies <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-users input-icon"></i>
                                    <input type="number" class="form-control" name="vacancies"
                                           placeholder="e.g. 5" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Experience Required <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-clock input-icon"></i>
                                    <input type="text" class="form-control" name="experience"
                                           placeholder="e.g. 2-3 years" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Annual Salary From (INR) <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-indian-rupee-sign input-icon"></i>
                                    <input type="number" class="form-control" name="salary_from" id="salary_from"
                                           placeholder="Min salary" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Annual Salary To (INR)<span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-indian-rupee-sign input-icon"></i>
                                    <input type="number" class="form-control" name="salary_to" id="salary_to"
                                           placeholder="Max salary" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Date <span class="req">*</span></label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Expiry Date <span class="req">*</span></label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Skills (comma separated) <span class="req">*</span></label>
                                <div class="input-icon-wrap">
                                    <i class="fa-solid fa-tags input-icon"></i>
                                    <input type="text" class="form-control" name="skills"
                                           placeholder="e.g. Laravel, React, MySQL" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Descriptions --}}
                <div class="cr-card">
                    <div class="cr-card-header">
                        <div class="cr-card-header-icon" style="background:var(--warning-light);color:var(--warning)">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <h6 class="cr-card-title">Descriptions</h6>
                    </div>
                    <div class="cr-card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Job Description <span class="req">*</span></label>
                                <textarea class="form-control" name="description" rows="4"
                                          placeholder="Enter detailed job description..." required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Responsibilities <span class="req">*</span></label>
                                <textarea class="form-control" name="responsibilities" rows="4"
                                          placeholder="Enter responsibilities (one per line)..." required></textarea>
                                <p class="field-hint"><i class="fa-solid fa-lightbulb me-1"></i>Enter each responsibility on a new line</p>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Requirements <span class="req">*</span></label>
                                <textarea class="form-control" name="requirements" rows="4"
                                          placeholder="Enter requirements (one per line)..." required></textarea>
                                <p class="field-hint"><i class="fa-solid fa-lightbulb me-1"></i>Enter each requirement on a new line</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar-sticky">

                    {{-- Publish Card --}}
                    <div class="cr-card">
                        <div class="cr-card-header">
                            <div class="cr-card-header-icon" style="background:var(--success-light);color:var(--success)">
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <h6 class="cr-card-title">Publish Job</h6>
                        </div>
                        <div class="cr-card-body">
                            <p style="font-size:0.82rem;color:var(--text-muted);margin-bottom:1.25rem">
                                Review all fields before publishing. Fields marked <span class="req">*</span> are required.
                            </p>
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span id="submitText">Publish Job</span>
                                <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                            <a href="{{ route('admin.managejobs.index') }}"
                               style="display:block;text-align:center;margin-top:0.75rem;font-size:0.82rem;color:var(--text-muted);text-decoration:none">
                                Cancel &amp; go back
                            </a>
                        </div>
                    </div>

                    {{-- Live Preview --}}
                    <div class="cr-card">
                        <div class="cr-card-header">
                            <div class="cr-card-header-icon" style="background:var(--primary-light);color:var(--primary)">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <h6 class="cr-card-title">Live Preview</h6>
                        </div>
                        <div class="cr-card-body">
                            <div id="preview-title" style="font-size:1rem;font-weight:700;color:var(--text-dark);margin-bottom:0.5rem">—</div>
                            <div id="preview-company" style="font-size:0.82rem;color:var(--text-muted);margin-bottom:1rem">—</div>
                            <div id="preview-type" class="preview-badge mb-3">—</div>
                            <div>
                                <div class="preview-row">
                                    <span class="key">Location</span>
                                    <span class="val" id="prev-location">—</span>
                                </div>
                                <div class="preview-row">
                                    <span class="key">Work Mode</span>
                                    <span class="val" id="prev-workmode">—</span>
                                </div>
                                <div class="preview-row">
                                    <span class="key">Experience</span>
                                    <span class="val" id="prev-exp">—</span>
                                </div>
                                <div class="preview-row">
                                    <span class="key">Salary</span>
                                    <span class="val" id="prev-salary">—</span>
                                </div>
                                <div class="preview-row">
                                    <span class="key">Vacancies</span>
                                    <span class="val" id="prev-vacancies">—</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tips --}}
                    <div class="cr-card">
                        <div class="cr-card-header">
                            <div class="cr-card-header-icon" style="background:var(--warning-light);color:var(--warning)">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <h6 class="cr-card-title">Tips</h6>
                        </div>
                        <div class="cr-card-body" style="display:flex;flex-direction:column;gap:0.6rem">
                            @foreach([
                                'Use a clear, specific job title to attract the right candidates.',
                                'List skills as comma-separated values for best results.',
                                'Enter responsibilities and requirements one per line.',
                                'Set a realistic expiry date to keep listings fresh.'
                            ] as $tip)
                            <div style="display:flex;gap:0.6rem;font-size:0.8rem;color:var(--text-muted)">
                                <i class="fa-solid fa-circle-check mt-1 flex-shrink-0" style="color:var(--success)"></i>
                                <span>{{ $tip }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Submit spinner
    const form = document.getElementById('jobForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitText.textContent = 'Publishing...';
        submitSpinner.classList.remove('d-none');
    });

    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            submitBtn.disabled = false;
            submitText.textContent = 'Publish Job';
            submitSpinner.classList.add('d-none');
        }
    });

    // Live preview
    function val(id) { return document.getElementById(id)?.value || ''; }

    function updatePreview() {
        const title    = val('job_title');
        const company  = val('company_name');
        const type     = val('job_type');
        const location = document.querySelector('[name=job_location]')?.value || '';
        const workmode = document.querySelector('[name=work_mode]')?.value || '';
        const exp      = document.querySelector('[name=experience]')?.value || '';
        const from     = document.querySelector('[name=salary_from]')?.value || '';
        const to       = document.querySelector('[name=salary_to]')?.value || '';
        const vac      = document.querySelector('[name=vacancies]')?.value || '';

        document.getElementById('preview-title').textContent   = title   || '—';
        document.getElementById('preview-company').textContent = company || '—';
        document.getElementById('preview-type').textContent    = type    || '—';
        document.getElementById('prev-location').textContent   = location || '—';
        document.getElementById('prev-workmode').textContent   = workmode || '—';
        document.getElementById('prev-exp').textContent        = exp     || '—';
        document.getElementById('prev-salary').textContent     = (from && to) ? '₹' + Number(from).toLocaleString('en-IN') + ' – ₹' + Number(to).toLocaleString('en-IN') : '—';
        document.getElementById('prev-vacancies').textContent  = vac     || '—';
    }

    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', updatePreview);
        el.addEventListener('change', updatePreview);
    });
});
</script>

@endsection
