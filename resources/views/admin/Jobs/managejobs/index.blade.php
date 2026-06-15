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

    /* Stat Cards */
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.amber  { background: var(--warning-light); color: var(--warning); }
    .stat-icon.red    { background: var(--danger-light); color: var(--danger); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    /* Filter Bar */
    .filter-bar { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
    .filter-bar .form-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; }
    .filter-bar .form-control,
    .filter-bar .form-select { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 40px; background: #fff; color: var(--text-dark); box-shadow: none; }
    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
    .search-wrap { position: relative; }
    .search-wrap .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.8rem; pointer-events: none; }
    .search-wrap .form-control { padding-left: 34px; }
    .btn-filter { height: 40px; padding: 0 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer; border: none; }
    .btn-apply { background: var(--primary); color: #fff; }
    .btn-apply:hover { background: #4338ca; color: #fff; }
    .btn-reset { background: #fff; border: 1px solid var(--border) !important; color: var(--text-muted); text-decoration: none; }
    .btn-reset:hover { background: var(--bg-light); color: var(--text-dark); }
    .btn-create { background: var(--primary); color: #fff; height: 40px; padding: 0 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; transition: all 0.15s; }
    .btn-create:hover { background: #4338ca; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.3); }

    /* Jobs Grid */
    .jobs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.25rem; }

    /* Job Card */
    .job-card { background: #fff; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
    .job-card:hover { border-color: var(--primary); box-shadow: 0 8px 24px rgba(79,70,229,0.12); transform: translateY(-3px); }

    /* Card Top */
    .jc-top { padding: 1.25rem; border-bottom: 1px solid var(--border); background: var(--bg-light); display: flex; justify-content: space-between; align-items: center; }
    .jc-type-badge { display: inline-flex; align-items: center; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .badge-full-time  { background: #dbeafe; color: #1e40af; }
    .badge-part-time  { background: var(--warning-light); color: var(--warning); }
    .badge-contract   { background: #ede9fe; color: #5b21b6; }
    .badge-internship { background: var(--success-light); color: var(--success); }
    .badge-default    { background: var(--bg-light); color: var(--text-muted); border: 1px solid var(--border); }
    .jc-time { font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.3rem; }

    /* Card Body */
    .jc-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; gap: 0.9rem; }
    .jc-title { font-size: 1.05rem; font-weight: 700; color: var(--text-dark); margin: 0; line-height: 1.4; }
    .job-card:hover .jc-title { color: var(--primary); }

    .jc-company { display: flex; align-items: center; gap: 0.75rem; }
    .jc-logo { width: 40px; height: 40px; border-radius: 8px; border: 1px solid var(--border); object-fit: cover; flex-shrink: 0; }
    .jc-logo-placeholder { width: 40px; height: 40px; border-radius: 8px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; flex-shrink: 0; }
    .jc-company-name { font-size: 0.875rem; font-weight: 600; color: var(--text-dark); margin: 0 0 0.15rem; }
    .jc-location { font-size: 0.75rem; color: var(--text-muted); margin: 0; }

    .jc-meta { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .jc-meta-item { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.75rem; color: var(--text-muted); background: var(--bg-light); border: 1px solid var(--border); border-radius: 6px; padding: 0.25rem 0.6rem; }

    .jc-salary { display: flex; align-items: center; gap: 0.5rem; background: var(--warning-light); border: 1px solid #fcd34d; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.82rem; font-weight: 600; color: #92400e; }

    /* Status Badge */
    .jc-status { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
    .jc-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .status-open       { background: var(--success-light); color: var(--success); }
    .status-open::before       { background: var(--success); }
    .status-closed     { background: #f3f4f6; color: #374151; }
    .status-closed::before     { background: #9ca3af; }
    .status-cancelled  { background: var(--danger-light); color: var(--danger); }
    .status-cancelled::before  { background: var(--danger); }

    /* Card Footer */
    .jc-footer { padding: 1rem 1.25rem; border-top: 1px solid var(--border); background: var(--bg-light); display: flex; gap: 0.6rem; }
    .jc-btn { flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.5rem 0.75rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.15s; text-decoration: none; border: 1px solid var(--border); background: #fff; }
    .jc-btn:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.1); }
    .jc-btn-edit  { color: var(--primary); border-color: #a5b4fc; }
    .jc-btn-edit:hover  { background: var(--primary-light); color: var(--primary); }
    .jc-btn-del   { color: var(--danger); border-color: #fca5a5; }
    .jc-btn-del:hover   { background: var(--danger-light); color: var(--danger); }
    .delete-form { flex: 1; display: flex; }
    .delete-form .jc-btn { width: 100%; }

    /* Empty State */
    .empty-state { grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: #fff; border: 2px dashed var(--border); border-radius: 14px; }
    .empty-state-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }
    .empty-state h5 { font-weight: 600; color: var(--text-dark); margin-bottom: 0.4rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.875rem; margin: 0 0 1.25rem; }

    /* Alert */
    .cr-alert { border-radius: 10px; border: none; font-size: 0.875rem; padding: 0.875rem 1.25rem; margin-bottom: 1.25rem; }

    @media (max-width: 992px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } .jobs-grid { grid-template-columns: 1fr; } .cr-header { flex-direction: column; align-items: flex-start; } }
</style>

<div class="cr-page">

    @if (Session::has('messageType') && Session::has('message'))
    <div class="alert alert-{{ Session::get('messageType') }} alert-dismissible fade show cr-alert" id="message-alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>setTimeout(() => document.getElementById('message-alert')?.remove(), 3000);</script>
    @endif

    <!-- Page Header -->
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-briefcase me-2" style="color:var(--primary)"></i>Job Management</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Job Management</span>
            </div>
        </div>
        <a href="{{ route('admin.managejobs.create') }}" class="btn-create">
            <i class="fa-solid fa-plus"></i> Create New Job
        </a>
    </div>

    <!-- Stat Cards -->
    @php
        $total     = $manageJobs->count();
        $open      = $manageJobs->where('status','Open')->count();
        $closed    = $manageJobs->where('status','Closed')->count();
        $cancelled = $manageJobs->where('status','Cancelled')->count();
    @endphp
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-briefcase"></i></div>
            <div>
                <div class="stat-label">Total Jobs</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-label">Open</div>
                <div class="stat-value">{{ $open }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-lock"></i></div>
            <div>
                <div class="stat-label">Closed</div>
                <div class="stat-value">{{ $closed }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon red"><i class="fa-solid fa-ban"></i></div>
            <div>
                <div class="stat-label">Cancelled</div>
                <div class="stat-value">{{ $cancelled }}</div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <div class="search-wrap">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Job title, company...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select id="filterStatus" class="form-select">
                    <option value="">All Status</option>
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Job Type</label>
                <select id="filterType" class="form-select">
                    <option value="">All Types</option>
                    <option value="full-time">Full-Time</option>
                    <option value="part-time">Part-Time</option>
                    <option value="contract">Contract</option>
                    <option value="internship">Internship</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="button" class="btn-filter btn-apply" onclick="filterJobs()">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <button type="button" class="btn-filter btn-reset" onclick="resetFilters()">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Jobs Grid -->
    <div class="jobs-grid" id="jobsContainer">
        @forelse($manageJobs as $job)
        <div class="job-card-wrapper"
             data-status="{{ $job->status }}"
             data-type="{{ strtolower($job->job_type) }}"
             data-title="{{ strtolower($job->job_title) }}"
             data-company="{{ strtolower($job->company_name ?? '') }}">
            <div class="job-card">

                <!-- Top -->
                <div class="jc-top">
                    @php
                        $typeKey = strtolower(str_replace(' ', '-', $job->job_type ?? ''));
                        $badgeClass = in_array($typeKey, ['full-time','part-time','contract','internship']) ? 'badge-'.$typeKey : 'badge-default';
                    @endphp
                    <span class="jc-type-badge {{ $badgeClass }}">{{ $job->job_type ?? 'N/A' }}</span>
                    <span class="jc-time">
                        <i class="fa-regular fa-clock"></i>
                        {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                    </span>
                </div>

                <!-- Body -->
                <div class="jc-body">
                    <h3 class="jc-title">{{ $job->job_title }}</h3>

                    <!-- Company -->
                    <div class="jc-company">
                        @if($job->company_logo)
                            <img src="{{ asset($job->company_logo) }}" alt="{{ $job->company_name }}" class="jc-logo">
                        @else
                            <div class="jc-logo-placeholder">{{ strtoupper(substr($job->company_name ?? 'C', 0, 1)) }}</div>
                        @endif
                        <div>
                            <p class="jc-company-name">{{ $job->company_name ?? 'Company' }}</p>
                            <p class="jc-location">
                                <i class="fa-solid fa-location-dot me-1"></i>{{ $job->job_location ?? 'Location' }}
                            </p>
                        </div>
                    </div>

                    <!-- Meta -->
                    <div class="jc-meta">
                        @if($job->job_function)
                        <span class="jc-meta-item">
                            <i class="fa-solid fa-layer-group"></i> {{ $job->job_function }}
                        </span>
                        @endif
                        @if($job->work_mode)
                        <span class="jc-meta-item">
                            <i class="fa-solid fa-display"></i> {{ $job->work_mode }}
                        </span>
                        @endif
                        @if($job->department)
                        <span class="jc-meta-item">
                            <i class="fa-solid fa-building"></i> {{ $job->department }}
                        </span>
                        @endif
                    </div>

                    <!-- Salary -->
                    @if($job->salary_from && $job->salary_to)
                    <div class="jc-salary">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        ₹{{ number_format($job->salary_from) }} – ₹{{ number_format($job->salary_to) }}
                    </div>
                    @endif

                    <!-- Status -->
                    <div>
                        <span class="jc-status status-{{ strtolower($job->status) }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="jc-footer">
                    <a href="{{ route('admin.managejobs.edit', $job->id) }}" class="jc-btn jc-btn-edit">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    <form action="{{ route('admin.managejobs.destroy', $job->id) }}" method="POST" class="delete-form"
                          onsubmit="return confirm('Delete this job posting?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="jc-btn jc-btn-del">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
            <h5>No Jobs Found</h5>
            <p>Start by creating your first job posting.</p>
            <a href="{{ route('admin.managejobs.create') }}" class="btn-create">
                <i class="fa-solid fa-plus"></i> Create New Job
            </a>
        </div>
        @endforelse
    </div>

</div>

<script>
function filterJobs() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('filterStatus').value;
    const type   = document.getElementById('filterType').value.toLowerCase();

    document.querySelectorAll('.job-card-wrapper').forEach(card => {
        const matchSearch = !search || card.dataset.title.includes(search) || card.dataset.company.includes(search);
        const matchStatus = !status || card.dataset.status === status;
        const matchType   = !type   || card.dataset.type === type;
        card.style.display = (matchSearch && matchStatus && matchType) ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterType').value = '';
    document.querySelectorAll('.job-card-wrapper').forEach(c => c.style.display = '');
}

document.getElementById('searchInput').addEventListener('keyup', filterJobs);
document.getElementById('filterStatus').addEventListener('change', filterJobs);
document.getElementById('filterType').addEventListener('change', filterJobs);
</script>

@endsection
