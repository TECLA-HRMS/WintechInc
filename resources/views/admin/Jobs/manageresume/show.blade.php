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

    .cr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 1.25rem; }
    .cr-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 0.6rem; }
    .cr-card-header-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
    .cr-card-title { font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin: 0; }
    .cr-card-body { padding: 1.5rem; }

    /* Candidate Hero */
    .candidate-hero { display: flex; align-items: center; gap: 1.25rem; padding: 1.5rem; border-bottom: 1px solid var(--border); }
    .candidate-avatar { width: 64px; height: 64px; border-radius: 14px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 1.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .candidate-hero-name { font-size: 1.2rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.2rem; }
    .candidate-hero-sub { font-size: 0.82rem; color: var(--text-muted); }
    .ref-badge { display: inline-block; background: var(--primary-light); color: var(--primary); font-size: 0.72rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 20px; margin-top: 0.3rem; }

    /* Info Grid */
    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
    .info-item label { font-size: 0.7rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem; }
    .info-item p { font-size: 0.875rem; color: var(--text-dark); margin: 0; font-weight: 500; }
    .info-item a { color: var(--primary); text-decoration: none; }
    .info-item a:hover { text-decoration: underline; }

    /* Status Badge */
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600; text-transform: capitalize; }
    .status-badge::before { content: ''; width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .status-badge.pending     { background: var(--warning-light); color: var(--warning); }
    .status-badge.pending::before     { background: var(--warning); }
    .status-badge.reviewed    { background: var(--info-light); color: var(--info); }
    .status-badge.reviewed::before    { background: var(--info); }
    .status-badge.shortlisted { background: var(--primary-light); color: var(--primary); }
    .status-badge.shortlisted::before { background: var(--primary); }
    .status-badge.selected    { background: var(--success-light); color: var(--success); }
    .status-badge.selected::before    { background: var(--success); }
    .status-badge.rejected    { background: var(--danger-light); color: var(--danger); }
    .status-badge.rejected::before    { background: var(--danger); }

    /* Sidebar action buttons */
    .sidebar-action { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: #fff; font-size: 0.85rem; font-weight: 500; color: var(--text-dark); text-decoration: none; transition: all 0.15s; cursor: pointer; width: 100%; text-align: left; }
    .sidebar-action:hover { transform: translateY(-1px); box-shadow: 0 3px 10px rgba(0,0,0,0.08); color: var(--text-dark); }
    .sidebar-action .sa-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
    .sa-icon.blue   { background: var(--info-light); color: var(--info); }
    .sa-icon.green  { background: var(--success-light); color: var(--success); }
    .sa-icon.red    { background: var(--danger-light); color: var(--danger); }
    .sa-icon.purple { background: var(--primary-light); color: var(--primary); }

    /* Cover letter */
    .cover-letter-text { font-size: 0.875rem; color: var(--text-dark); line-height: 1.8; white-space: pre-wrap; background: var(--bg-light); border: 1px solid var(--border); border-radius: 10px; padding: 1.25rem; margin: 0; }

    /* Summary rows */
    .summary-row { display: flex; justify-content: space-between; align-items: center; padding: 0.6rem 0; border-bottom: 1px solid #f3f4f6; font-size: 0.82rem; }
    .summary-row:last-child { border-bottom: none; }
    .summary-row .key { color: var(--text-muted); }
    .summary-row .val { font-weight: 600; color: var(--text-dark); }

    /* Alert */
    .cr-alert { border-radius: 10px; border: none; font-size: 0.875rem; padding: 0.875rem 1.25rem; margin-bottom: 1.25rem; }

    /* Back btn */
    .btn-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1.25rem; border-radius: 8px; border: 1px solid var(--border); background: #fff; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.15s; }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); }

    @media (max-width: 768px) { .info-grid { grid-template-columns: 1fr; } }
</style>

<div class="cr-page">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show cr-alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show cr-alert">
        <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Page Header -->
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-file-lines me-2" style="color:var(--primary)"></i>Application Details</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.resume.index') }}">Job Applications</a>
                <span>/</span>
                <span>Details</span>
            </div>
        </div>
        <a href="{{ route('admin.resume.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="row g-4">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">

            {{-- Candidate Hero --}}
            <div class="cr-card">
                <div class="candidate-hero">
                    @if(!empty($application->profile_picture))
                        <img loading="lazy" src="{{ asset('profile_pictures/' . $application->profile_picture) }}" alt="" style="width:64px;height:64px;border-radius:14px;object-fit:cover;flex-shrink:0">
                    @else
                        <div class="candidate-avatar">{{ strtoupper(substr($application->full_name, 0, 1)) }}</div>
                    @endif
                    <div>
                        <div class="candidate-hero-name d-flex align-items-center gap-2">
                            {{ $application->full_name }}
                            @if(!empty($application->user_id))
                                <a href="{{ route('admin.profile.show', $application->user_id) }}" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.75rem; border-radius: 4px;">Show Profile</a>
                            @endif
                        </div>
                        <div class="candidate-hero-sub">
                            <i class="fa-solid fa-envelope me-1"></i>{{ $application->email }}
                            &nbsp;&nbsp;
                            <i class="fa-solid fa-phone me-1"></i>{{ $application->phone }}
                        </div>
                        <div class="ref-badge">APP-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>
                <div class="cr-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Gender</label>
                            <p>{{ ucfirst($application->gender ?? 'Not specified') }}</p>
                        </div>
                        <div class="info-item">
                            <label>Location</label>
                            <p><i class="fa-solid fa-location-dot me-1" style="color:var(--text-muted)"></i>{{ $application->location ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Address</label>
                            <p>{{ $application->address ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Pincode</label>
                            <p>{{ $application->pincode ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Experience</label>
                            <p>{{ $application->experience ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Notice Period</label>
                            <p>{{ $application->notice_period ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Current CTC</label>
                            <p>{{ $application->current_ctc ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Expected CTC</label>
                            <p>{{ $application->expected_ctc ?? 'Not provided' }}</p>
                        </div>
                        @if($application->linkedin)
                        <div class="info-item" style="grid-column:span 2">
                            <label>LinkedIn</label>
                            <p><a href="{{ $application->linkedin }}" target="_blank">{{ $application->linkedin }}</a></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Job Information --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--primary-light);color:var(--primary)">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h6 class="cr-card-title">Job Information</h6>
                </div>
                <div class="cr-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Job Title</label>
                            <p style="color:var(--primary);font-weight:700">{{ $application->job_title ?? 'N/A' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Company</label>
                            <p>{{ $application->company_name ?? 'N/A' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Job Type</label>
                            <p>{{ $application->job_type ?? 'N/A' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Job Location</label>
                            <p>{{ $application->job_location ?? 'N/A' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Salary Range</label>
                            <p>
                                @if($application->salary_from && $application->salary_to)
                                    ₹{{ number_format($application->salary_from) }} – ₹{{ number_format($application->salary_to) }}
                                @else
                                    Not specified
                                @endif
                            </p>
                        </div>
                        <div class="info-item">
                            <label>Department</label>
                            <p>{{ $application->department ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cover Letter --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--info-light);color:var(--info)">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h6 class="cr-card-title">Cover Letter</h6>
                </div>
                <div class="cr-card-body">
                    @if($application->cover_letter)
                        <p class="cover-letter-text">{{ $application->cover_letter }}</p>
                    @else
                        <div style="text-align:center;padding:2rem;color:var(--text-muted)">
                            <i class="fa-solid fa-file-circle-xmark fa-2x mb-2 d-block"></i>
                            No cover letter provided
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">

            {{-- Status Card --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--warning-light);color:var(--warning)">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                    </div>
                    <h6 class="cr-card-title">Application Status</h6>
                </div>
                <div class="cr-card-body" style="text-align:center">
                    <div class="mb-3">
                        <span class="status-badge {{ $application->status }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    <p style="font-size:0.78rem;color:var(--text-muted);margin-bottom:1rem">
                        Applied on {{ \Carbon\Carbon::parse($application->created_at)->format('F j, Y \a\t g:i A') }}
                    </p>
                    <button type="button"
                            class="btn-filter btn-apply"
                            style="width:100%;justify-content:center;height:38px;border-radius:8px;font-size:0.85rem"
                            data-bs-toggle="modal" data-bs-target="#update_status">
                        <i class="fa-solid fa-pen me-1"></i> Update Status
                    </button>
                </div>
            </div>

            {{-- Resume Card --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--danger-light);color:var(--danger)">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <h6 class="cr-card-title">Resume</h6>
                </div>
                <div class="cr-card-body" style="text-align:center">
                    @if($application->resume)
                        <i class="fa-solid fa-file-pdf fa-3x mb-3" style="color:var(--danger)"></i>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('admin.resume.view-resume', $application->id) }}" target="_blank"
                               class="sidebar-action" style="flex:1;justify-content:center">
                                <span class="sa-icon blue"><i class="fa-solid fa-eye"></i></span>
                                View
                            </a>
                            <a href="{{ route('admin.resume.view-resume', $application->id) }}?download=1"
                               class="sidebar-action" style="flex:1;justify-content:center">
                                <span class="sa-icon purple"><i class="fa-solid fa-download"></i></span>
                                Download
                            </a>
                        </div>
                    @else
                        <div style="padding:1.5rem;color:var(--text-muted)">
                            <i class="fa-solid fa-file-circle-xmark fa-2x mb-2 d-block"></i>
                            No resume uploaded
                        </div>
                    @endif
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--success-light);color:var(--success)">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h6 class="cr-card-title">Quick Actions</h6>
                </div>
                <div class="cr-card-body" style="display:flex;flex-direction:column;gap:0.6rem">
                    @if(!empty($application->user_id))
                    <a href="{{ route('admin.profile.show', $application->user_id) }}" class="sidebar-action">
                        <span class="sa-icon purple"><i class="fa-solid fa-user"></i></span>
                        View User Profile
                    </a>
                    @endif
                    <a href="mailto:{{ $application->email }}" class="sidebar-action">
                        <span class="sa-icon blue"><i class="fa-solid fa-envelope"></i></span>
                        Send Email
                    </a>
                    <a href="tel:{{ $application->phone }}" class="sidebar-action">
                        <span class="sa-icon green"><i class="fa-solid fa-phone"></i></span>
                        Call Candidate
                    </a>
                    <button type="button" class="sidebar-action" data-bs-toggle="modal" data-bs-target="#delete_application">
                        <span class="sa-icon red"><i class="fa-solid fa-trash"></i></span>
                        Delete Application
                    </button>
                </div>
            </div>

            {{-- Summary --}}
            <div class="cr-card">
                <div class="cr-card-header">
                    <div class="cr-card-header-icon" style="background:var(--bg-light);color:var(--text-muted)">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h6 class="cr-card-title">Application Summary</h6>
                </div>
                <div class="cr-card-body">
                    <div class="summary-row">
                        <span class="key">Reference</span>
                        <span class="val" style="color:var(--primary)">APP-{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="key">Job ID</span>
                        <span class="val">#{{ $application->job_id }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="key">Job Type</span>
                        <span class="val">{{ $application->job_type ?? 'N/A' }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="key">Applied</span>
                        <span class="val">{{ \Carbon\Carbon::parse($application->created_at)->format('M j, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="key">Last Updated</span>
                        <span class="val">{{ \Carbon\Carbon::parse($application->updated_at)->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Update Status Modal --}}
<div class="modal fade" id="update_status" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:14px;overflow:hidden">
            <div class="modal-header border-0" style="background:var(--primary-light);padding:1.25rem 1.5rem">
                <h6 class="modal-title fw-bold" style="color:var(--primary)">
                    <i class="fa-solid fa-pen me-2"></i>Update Application Status
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.resume.updateStatus', $application->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body" style="padding:1.5rem">
                    <div style="background:var(--bg-light);border:1px solid var(--border);border-radius:10px;padding:1rem;margin-bottom:1.25rem;font-size:0.85rem">
                        <div><span style="color:var(--text-muted)">Candidate:</span> <strong>{{ $application->full_name }}</strong></div>
                        <div class="mt-1"><span style="color:var(--text-muted)">Job:</span> <strong style="color:var(--primary)">{{ $application->job_title ?? 'N/A' }}</strong></div>
                        <div class="mt-1"><span style="color:var(--text-muted)">Current Status:</span>
                            <span class="status-badge {{ $application->status }} ms-1">{{ ucfirst($application->status) }}</span>
                        </div>
                    </div>
                    <label style="font-size:0.75rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:0.4rem">
                        New Status <span style="color:var(--danger)">*</span>
                    </label>
                    <select name="status" class="form-select" required
                            style="border-radius:8px;border:1px solid var(--border);font-size:0.875rem;height:42px">
                        <option value="">Select Status</option>
                        <option value="pending"     {{ $application->status == 'pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed"    {{ $application->status == 'reviewed'    ? 'selected' : '' }}>Reviewed</option>
                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="selected"    {{ $application->status == 'selected'    ? 'selected' : '' }}>Selected</option>
                        <option value="rejected"    {{ $application->status == 'rejected'    ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="modal-footer border-0" style="padding:1rem 1.5rem;gap:0.5rem">
                    <button type="button" class="btn btn-light px-4" style="border-radius:8px" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius:8px">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="delete_application" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:14px;overflow:hidden">
            <div class="modal-header border-0" style="background:var(--danger);padding:1.25rem 1.5rem">
                <h6 class="modal-title fw-bold text-white">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Confirm Deletion
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" style="padding:2rem 1.5rem">
                <i class="fa-solid fa-trash-can fa-3x mb-3" style="color:var(--danger)"></i>
                <p class="fw-semibold mb-1" style="color:var(--text-dark)">Are you sure you want to delete this application?</p>
                <p style="font-size:0.82rem;color:var(--text-muted);margin:0">
                    <strong>{{ $application->full_name }}</strong> — {{ $application->job_title ?? 'N/A' }}
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center" style="padding-bottom:1.5rem;gap:0.75rem">
                <button type="button" class="btn btn-light px-4" style="border-radius:8px" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.resume.destroy', $application->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius:8px">
                        <i class="fa-solid fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

