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

    .show-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    /* Header */
    .show-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .show-header h1 { font-size: 1.4rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .show-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .show-breadcrumb a { color: var(--primary); text-decoration: none; }

    /* Status Badge */
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize; }
    .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .status-badge.pending  { background: var(--warning-light); color: var(--warning); }
    .status-badge.pending::before  { background: var(--warning); }
    .status-badge.approved { background: var(--success-light); color: var(--success); }
    .status-badge.approved::before { background: var(--success); }
    .status-badge.rejected { background: var(--danger-light); color: var(--danger); }
    .status-badge.rejected::before { background: var(--danger); }
    .status-badge.new      { background: var(--info-light); color: var(--info); }
    .status-badge.new::before      { background: var(--info); }
    .status-badge.contacted      { background: #f3e8ff; color: #7c3aed; }
    .status-badge.contacted::before { background: #7c3aed; }
    .status-badge.under_review   { background: #fff7ed; color: #c2410c; }
    .status-badge.under_review::before { background: #c2410c; }
    .status-badge.accepted       { background: var(--success-light); color: var(--success); }
    .status-badge.accepted::before { background: var(--success); }

    /* Profile Hero */
    .profile-hero { background: #fff; border: 1px solid var(--border); border-radius: 14px; padding: 2rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,.05); }
    .profile-avatar { width: 72px; height: 72px; border-radius: 16px; background: var(--primary-light); color: var(--primary); font-size: 1.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .profile-name { font-size: 1.25rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .profile-meta { display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 0.5rem; }
    .profile-meta-item { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .profile-meta-item i { color: var(--primary); font-size: 0.75rem; }

    /* Info Card */
    .info-card { background: #fff; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.05); margin-bottom: 1.25rem; }
    .info-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--bg-light); display: flex; align-items: center; gap: 0.6rem; }
    .info-card-header h6 { margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.05em; }
    .info-card-header .card-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; }
    .info-card-body { padding: 1.25rem 1.5rem; }

    /* Info Row */
    .info-row { display: flex; padding: 0.65rem 0; border-bottom: 1px solid #f3f4f6; }
    .info-row:last-child { border-bottom: none; }
    .info-label { width: 160px; flex-shrink: 0; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.04em; padding-top: 0.1rem; }
    .info-value { flex: 1; font-size: 0.875rem; color: var(--text-dark); font-weight: 500; }
    .info-value a { color: var(--primary); text-decoration: none; }
    .info-value a:hover { text-decoration: underline; }

    /* Status Form */
    .status-form-card { background: #fff; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.05); margin-bottom: 1.25rem; }
    .status-form-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); background: linear-gradient(135deg, var(--primary-light), #e0e7ff); display: flex; align-items: center; gap: 0.6rem; }
    .status-form-header h6 { margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; }
    .status-form-body { padding: 1.5rem; }
    .form-label-sm { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; }
    .form-control-sm-custom { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; padding: 0.55rem 0.85rem; color: var(--text-dark); width: 100%; outline: none; transition: border-color .2s, box-shadow .2s; background: #fff; }
    .form-control-sm-custom:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.1); }
    .btn-update { background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 0.6rem 1.5rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: all .2s; }
    .btn-update:hover { background: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.3); }

    /* Back Button */
    .btn-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.1rem; border: 1px solid var(--border); border-radius: 8px; background: #fff; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all .2s; }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); border-color: #d1d5db; }

    /* Attachment Buttons */
    .attach-btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.9rem; border-radius: 7px; font-size: 0.8rem; font-weight: 600; text-decoration: none; transition: all .2s; }
    .attach-btn.pdf { background: var(--danger-light); color: var(--danger); border: 1px solid #fecaca; }
    .attach-btn.pdf:hover { background: #fee2e2; }
    .attach-btn.img { background: var(--info-light); color: var(--info); border: 1px solid #bae6fd; }
    .attach-btn.img:hover { background: #e0f2fe; }

    @media (max-width: 768px) {
        .profile-hero { flex-direction: column; align-items: flex-start; }
        .show-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
        .info-label { width: 120px; }
    }
</style>

<div class="show-page">

    <!-- Header -->
    <div class="show-header">
        <div>
            <h1><i class="fa-solid fa-building me-2" style="color:var(--primary)"></i>Registration #{{ $companyRegistration->id }}</h1>
            <div class="show-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.company.registrations.index') }}">Company Registrations</a>
                <span>/</span>
                <span>Details</span>
            </div>
        </div>
        <a href="{{ route('admin.company.registrations.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Profile Hero -->
    <div class="profile-hero">
        <div class="profile-avatar">{{ strtoupper(substr($companyRegistration->name, 0, 1)) }}</div>
        <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <p class="profile-name">{{ $companyRegistration->name }}</p>
                <span class="status-badge {{ str_replace(' ', '_', strtolower($companyRegistration->status)) }}">
                    {{ ucfirst(str_replace('_', ' ', $companyRegistration->status)) }}
                </span>
            </div>
            <div class="profile-meta">
                @if($companyRegistration->company_name)
                <span class="profile-meta-item"><i class="fa-solid fa-building"></i> {{ $companyRegistration->company_name }}</span>
                @endif
                @if($companyRegistration->position)
                <span class="profile-meta-item"><i class="fa-solid fa-briefcase"></i> {{ $companyRegistration->position }}</span>
                @endif
                <span class="profile-meta-item"><i class="fa-solid fa-envelope"></i> {{ $companyRegistration->email }}</span>
                <span class="profile-meta-item"><i class="fa-solid fa-phone"></i> {{ $companyRegistration->mobile }}</span>
                @if($companyRegistration->location)
                <span class="profile-meta-item"><i class="fa-solid fa-location-dot"></i> {{ $companyRegistration->location }}</span>
                @endif
            </div>
        </div>
        <div class="text-end d-none d-md-block">
            <div style="font-size:0.72rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em">Submitted</div>
            <div style="font-size:0.9rem;font-weight:600;color:var(--text-dark)">{{ $companyRegistration->created_at->format('M j, Y') }}</div>
            <div style="font-size:0.78rem;color:var(--text-muted)">{{ $companyRegistration->created_at->format('g:i A') }}</div>
        </div>
    </div>

    <div class="row g-3">

        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Personal Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--primary-light);color:var(--primary)"><i class="fa-solid fa-user"></i></div>
                    <h6>Personal Information</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $companyRegistration->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value"><a href="mailto:{{ $companyRegistration->email }}">{{ $companyRegistration->email }}</a></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Mobile</span>
                        <span class="info-value"><a href="tel:{{ $companyRegistration->mobile }}">{{ $companyRegistration->mobile }}</a></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Location</span>
                        <span class="info-value">{{ $companyRegistration->location ?? '—' }}</span>
                    </div>
                </div>
            </div>

            <!-- Company Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:#f3e8ff;color:#7c3aed"><i class="fa-solid fa-building"></i></div>
                    <h6>Company Information</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Company Name</span>
                        <span class="info-value">{{ $companyRegistration->company_name ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Website</span>
                        <span class="info-value">
                            @if($companyRegistration->company_website)
                                <a href="{{ $companyRegistration->company_website }}" target="_blank">{{ $companyRegistration->company_website }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:.7rem"></i></a>
                            @else —
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Position</span>
                        <span class="info-value">{{ $companyRegistration->position ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Salary Expected</span>
                        <span class="info-value">{{ $companyRegistration->salary ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Experience</span>
                        <span class="info-value">{{ $companyRegistration->experience ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Address</span>
                        <span class="info-value">{{ $companyRegistration->address ?? '—' }}</span>
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--info-light);color:var(--info)"><i class="fa-solid fa-file-lines"></i></div>
                    <h6>Job Description</h6>
                </div>
                <div class="info-card-body">
                    <p style="font-size:0.875rem;color:var(--text-dark);line-height:1.7;margin:0">
                        {{ $companyRegistration->job_desc ?? 'No description provided.' }}
                    </p>
                </div>
            </div>

            <!-- Attachments -->
            @if($companyRegistration->job_brief_url || $companyRegistration->company_logo_url)
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--warning-light);color:var(--warning)"><i class="fa-solid fa-paperclip"></i></div>
                    <h6>Attachments</h6>
                </div>
                <div class="info-card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($companyRegistration->job_brief_url)
                            <a href="{{ $companyRegistration->job_brief_url }}" target="_blank" class="attach-btn pdf">
                                <i class="fa-solid fa-file-pdf"></i> Job Brief
                            </a>
                        @endif
                        @if($companyRegistration->company_logo_url)
                            <a href="{{ $companyRegistration->company_logo_url }}" target="_blank" class="attach-btn img">
                                <i class="fa-solid fa-image"></i> Company Logo
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Right Column -->
        <div class="col-lg-4">

            <!-- Update Status -->
            <div class="status-form-card">
                <div class="status-form-header">
                    <i class="fa-solid fa-pen-to-square" style="color:var(--primary)"></i>
                    <h6>Update Status</h6>
                </div>
                <div class="status-form-body">
                    <form method="POST" action="{{ route('admin.company.registrations.update-status', $companyRegistration->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-sm">Status</label>
                            <select name="status" class="form-control-sm-custom" required>
                                @foreach($companyRegistration->getStatusOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ $companyRegistration->status == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-sm">Admin Notes</label>
                            <textarea name="admin_notes" class="form-control-sm-custom" rows="4" placeholder="Add notes or comments...">{{ $companyRegistration->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn-update w-100 justify-content-center">
                            <i class="fa-solid fa-check"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- System Info -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--bg-light);color:var(--text-muted)"><i class="fa-solid fa-circle-info"></i></div>
                    <h6>System Information</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Submitted</span>
                        <span class="info-value">
                            <div>{{ $companyRegistration->created_at->format('M j, Y') }}</div>
                            <div style="font-size:.75rem;color:var(--text-muted)">{{ $companyRegistration->created_at->format('g:i A') }}</div>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Last Updated</span>
                        <span class="info-value">
                            <div>{{ $companyRegistration->updated_at->format('M j, Y') }}</div>
                            <div style="font-size:.75rem;color:var(--text-muted)">{{ $companyRegistration->updated_at->format('g:i A') }}</div>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">IP Address</span>
                        <span class="info-value" style="font-family:monospace;font-size:.8rem">{{ $companyRegistration->ip_address ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Record ID</span>
                        <span class="info-value" style="font-family:monospace;font-size:.8rem">#{{ $companyRegistration->id }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
