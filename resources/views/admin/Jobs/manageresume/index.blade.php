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
        --purple: #7c3aed;
        --purple-light: #f5f3ff;
        --text-dark: #111827;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --bg-light: #f9fafb;
    }

    .cr-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    /* Page Header */
    .cr-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .cr-header-left h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .cr-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .cr-breadcrumb a { color: var(--primary); text-decoration: none; }
    .cr-breadcrumb span { color: var(--border); }

    /* Stat Cards */
    .stat-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.amber  { background: var(--warning-light); color: var(--warning); }
    .stat-icon.blue   { background: var(--info-light); color: var(--info); }
    .stat-icon.red    { background: var(--danger-light); color: var(--danger); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    /* Main Card */
    .cr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,0.05); overflow: hidden; }
    .cr-card-body { padding: 1.5rem; }

    /* Filter Bar */
    .filter-bar { background: var(--bg-light); border: 1px solid var(--border); border-radius: 10px; padding: 1.25rem; margin-bottom: 1.5rem; }
    .filter-bar .form-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; }
    .filter-bar .form-control,
    .filter-bar .form-select { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 40px; background: #fff; color: var(--text-dark); box-shadow: none; }
    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
    .search-wrap { position: relative; }
    .search-wrap .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.8rem; pointer-events: none; }
    .search-wrap .form-control { padding-left: 34px; }
    .btn-filter { height: 40px; padding: 0 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; }
    .btn-apply { background: var(--primary); border: none; color: #fff; }
    .btn-apply:hover { background: #4338ca; color: #fff; }
    .btn-reset { background: #fff; border: 1px solid var(--border); color: var(--text-muted); }
    .btn-reset:hover { background: var(--bg-light); color: var(--text-dark); }

    /* Table */
    .cr-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .cr-table thead tr th { background: var(--bg-light); color: var(--text-muted); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .cr-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.15s; }
    .cr-table tbody tr:last-child { border-bottom: none; }
    .cr-table tbody tr:hover { background: #fafafa; }
    .cr-table tbody td { padding: 0.9rem 1rem; color: var(--text-dark); vertical-align: middle; }
    .cr-table .sno { font-size: 0.75rem; color: var(--text-muted); font-weight: 600; }

    /* Avatar */
    .avatar-cell { display: flex; align-items: center; gap: 0.75rem; }
    .avatar { width: 36px; height: 36px; border-radius: 8px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .avatar-name { font-weight: 600; color: var(--text-dark); font-size: 0.875rem; }
    .avatar-sub { font-size: 0.75rem; color: var(--text-muted); }

    /* Status Badge */
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; text-transform: capitalize; }
    .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
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

    /* Status Select */
    .status-select { border-radius: 20px; font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.75rem; height: auto; min-width: 130px; cursor: pointer; border: 1px solid var(--border); }
    .status-select:focus { box-shadow: 0 0 0 3px rgba(79,70,229,0.1); border-color: var(--primary); }
    .status-select.pending     { background: var(--warning-light); color: var(--warning); border-color: #fcd34d; }
    .status-select.reviewed    { background: var(--info-light); color: var(--info); border-color: #7dd3fc; }
    .status-select.shortlisted { background: var(--primary-light); color: var(--primary); border-color: #a5b4fc; }
    .status-select.selected    { background: var(--success-light); color: var(--success); border-color: #6ee7b7; }
    .status-select.rejected    { background: var(--danger-light); color: var(--danger); border-color: #fca5a5; }

    /* Action Buttons */
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid var(--border); background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all 0.15s; text-decoration: none; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.12); }
    .action-btn.view { color: var(--info); border-color: #bae6fd; }
    .action-btn.view:hover { background: var(--info-light); }
    .action-btn.del  { color: var(--danger); border-color: #fecaca; }
    .action-btn.del:hover  { background: var(--danger-light); }

    /* Resume btn */
    .resume-btn { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; background: var(--danger-light); color: var(--danger); border: 1px solid #fca5a5; text-decoration: none; transition: all 0.15s; }
    .resume-btn:hover { background: #fee2e2; color: var(--danger); }

    /* Pagination */
    .cr-pagination { display: flex; justify-content: space-between; align-items: center; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 0.5rem; }
    .cr-pagination .info { font-size: 0.8rem; color: var(--text-muted); }
    .page-btn { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.35rem 0.75rem; border-radius: 7px; border: 1px solid var(--border); background: #fff; color: var(--text-dark); font-size: 0.8rem; font-weight: 500; text-decoration: none; transition: all 0.15s; cursor: pointer; }
    .page-btn:hover:not(.disabled):not(.active) { background: var(--primary-light); border-color: var(--primary); color: var(--primary); }
    .page-btn.active { background: var(--primary); border-color: var(--primary); color: #fff; cursor: default; }
    .page-btn.disabled { background: var(--bg-light); color: #c0c0c0; cursor: not-allowed; border-color: var(--border); }

    /* Empty State */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }
    .empty-state h5 { font-weight: 600; color: var(--text-dark); margin-bottom: 0.4rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.875rem; margin: 0; }

    /* Alert */
    .cr-alert { border-radius: 10px; border: none; font-size: 0.875rem; padding: 0.875rem 1.25rem; margin-bottom: 1.25rem; }

    /* Status Tabs */
    .status-tabs { display: flex; gap: 0.25rem; margin-bottom: 1.5rem; background: var(--bg-light); padding: 0.5rem; border-radius: 12px; border: 1px solid var(--border); }
    .status-tab { flex: 1; padding: 0.75rem 1rem; border-radius: 8px; background: transparent; border: none; font-size: 0.875rem; font-weight: 600; color: var(--text-muted); cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; }
    .status-tab:hover { background: rgba(255,255,255,0.7); color: var(--text-dark); }
    .status-tab.active { background: #fff; color: var(--text-dark); box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
    .status-tab .count { background: var(--border); color: var(--text-muted); padding: 0.2rem 0.5rem; border-radius: 12px; font-size: 0.7rem; font-weight: 700; min-width: 20px; text-align: center; }
    .status-tab.active .count { background: var(--primary); color: #fff; }
    .status-tab.all.active .count { background: var(--purple); }
    .status-tab.pending.active .count { background: var(--warning); }
    .status-tab.reviewed.active .count { background: var(--info); }
    .status-tab.shortlisted.active .count { background: var(--primary); }
    .status-tab.selected.active .count { background: var(--success); }
    .status-tab.rejected.active .count { background: var(--danger); }

    @media (max-width: 992px) { .stat-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } .cr-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; } .status-tabs { flex-wrap: wrap; } .status-tab { flex: 1 1 calc(50% - 0.125rem); min-width: 120px; } }
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
            <h1><i class="fa-solid fa-file-lines me-2" style="color:var(--primary)"></i>Job Applications</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Job Applications</span>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    @php
        $total       = \Illuminate\Support\Facades\DB::table('job_applications')->count();
        $pending     = \Illuminate\Support\Facades\DB::table('job_applications')->where('status','pending')->count();
        $reviewed    = \Illuminate\Support\Facades\DB::table('job_applications')->where('status','reviewed')->count();
        $shortlisted = \Illuminate\Support\Facades\DB::table('job_applications')->where('status','shortlisted')->count();
        $selected    = \Illuminate\Support\Facades\DB::table('job_applications')->where('status','selected')->count();
        $rejected    = \Illuminate\Support\Facades\DB::table('job_applications')->where('status','rejected')->count();
        $currentStatus = request('status', 'all');
    @endphp
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $pending }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-thumbtack"></i></div>
            <div>
                <div class="stat-label">Shortlisted</div>
                <div class="stat-value">{{ $shortlisted }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-label">Selected</div>
                <div class="stat-value">{{ $selected }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon red"><i class="fa-solid fa-circle-xmark"></i></div>
            <div>
                <div class="stat-label">Rejected</div>
                <div class="stat-value">{{ $rejected }}</div>
            </div>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="status-tabs">
        <a href="{{ request()->fullUrlWithQuery(['status' => null, 'page' => null]) }}" class="status-tab all {{ $currentStatus == 'all' || !$currentStatus ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            All Applications
            <span class="count">{{ $total }}</span>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'pending', 'page' => null]) }}" class="status-tab pending {{ $currentStatus == 'pending' ? 'active' : '' }}">
            <i class="fa-solid fa-clock"></i>
            Pending
            <span class="count">{{ $pending }}</span>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'reviewed', 'page' => null]) }}" class="status-tab reviewed {{ $currentStatus == 'reviewed' ? 'active' : '' }}">
            <i class="fa-solid fa-eye"></i>
            Reviewed
            <span class="count">{{ $reviewed }}</span>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'shortlisted', 'page' => null]) }}" class="status-tab shortlisted {{ $currentStatus == 'shortlisted' ? 'active' : '' }}">
            <i class="fa-solid fa-thumbtack"></i>
            Shortlisted
            <span class="count">{{ $shortlisted }}</span>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'selected', 'page' => null]) }}" class="status-tab selected {{ $currentStatus == 'selected' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-check"></i>
            Selected
            <span class="count">{{ $selected }}</span>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'rejected', 'page' => null]) }}" class="status-tab rejected {{ $currentStatus == 'rejected' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-xmark"></i>
            Rejected
            <span class="count">{{ $rejected }}</span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="cr-card">
        <div class="cr-card-body">

            <div class="filter-bar">
                <form method="GET" action="{{ request()->url() }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" class="form-control"
                                       placeholder="Name, email, job title, company..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="latest" {{ request('sort','latest') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="name"   {{ request('sort') == 'name'   ? 'selected' : '' }}>Name A–Z</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply">
                                <i class="fa-solid fa-filter"></i> Apply
                            </button>
                            <a href="{{ request()->fullUrlWithQuery(['search' => null, 'sort' => null, 'page' => null]) }}" class="btn-filter btn-reset">
                                <i class="fa-solid fa-rotate-right"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate</th>
                            <th>Contact</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Applied</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $index => $application)
                        {{-- index offset for paginated rows --}}
                        <tr id="application-row-{{ $application->id }}">
                            <td class="sno">{{ ($applications->currentPage() - 1) * $applications->perPage() + $loop->iteration }}</td>

                            <!-- Candidate -->
                            <td>
                                <div class="avatar-cell">
                                    <div class="avatar">{{ strtoupper(substr($application->full_name, 0, 1)) }}</div>
                                    <div>
                                        <div class="avatar-name">{{ $application->full_name }}</div>
                                        <div class="avatar-sub">{{ $application->job_type ?? '' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td>
                                <div style="font-size:0.8rem">
                                    <a href="mailto:{{ $application->email }}" style="color:var(--text-dark);text-decoration:none">
                                        <i class="fa-solid fa-envelope me-1" style="color:var(--text-muted)"></i>{{ $application->email }}
                                    </a>
                                </div>
                                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px">
                                    <a href="tel:{{ $application->phone }}" style="color:var(--text-muted);text-decoration:none">
                                        <i class="fa-solid fa-phone me-1"></i>{{ $application->phone }}
                                    </a>
                                </div>
                            </td>

                            <!-- Job Title -->
                            <td>
                                <div style="font-weight:600;color:var(--text-dark)">{{ $application->job_title ?? '—' }}</div>
                            </td>

                            <!-- Company -->
                            <td>{{ $application->company_name ?? '—' }}</td>

                            <!-- Location -->
                            <td>
                                <i class="fa-solid fa-location-dot me-1" style="color:var(--text-muted)"></i>
                                {{ $application->location ?? '—' }}
                            </td>

                            <!-- Resume -->
                            <td>
                                @if (!empty($application->resume))
                                    <div style="display:flex;gap:0.3rem;flex-wrap:wrap">
                                        <a href="{{ route('admin.resume.view-resume', $application->id) }}" target="_blank" class="resume-btn">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.resume.view-resume', $application->id) }}?download=1" class="resume-btn" style="background:var(--info-light);color:var(--info);border-color:#7dd3fc">
                                            <i class="fa-solid fa-download"></i> Download
                                        </a>
                                    </div>
                                @else
                                    <span style="font-size:0.75rem;color:var(--text-muted)">No File</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                <form action="{{ route('admin.resume.updateStatus', $application->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                            class="status-select form-select {{ $application->status }}"
                                            onchange="this.form.submit()">
                                        <option value="pending"     {{ $application->status == 'pending'     ? 'selected' : '' }}>Pending</option>
                                        <option value="reviewed"    {{ $application->status == 'reviewed'    ? 'selected' : '' }}>Reviewed</option>
                                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                        <option value="selected"    {{ $application->status == 'selected'    ? 'selected' : '' }}>Selected</option>
                                        <option value="rejected"    {{ $application->status == 'rejected'    ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Applied Date -->
                            <td>
                                <div style="font-size:0.8rem;color:var(--text-dark);font-weight:500">
                                    {{ \Carbon\Carbon::parse($application->created_at)->format('M j, Y') }}
                                </div>
                                <div style="font-size:0.72rem;color:var(--text-muted)">
                                    {{ \Carbon\Carbon::parse($application->created_at)->format('g:i A') }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div style="display:flex;gap:0.4rem;justify-content:center">
                                    <a href="{{ route('admin.resume.show', $application->id) }}" class="action-btn view" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="action-btn del" title="Delete"
                                            onclick="deleteApplication({{ $application->id }}, '{{ addslashes($application->full_name) }}', '{{ addslashes($application->job_title ?? 'N/A') }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                    <h5>No applications found</h5>
                                    <p>Try adjusting your search or filter criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($applications->hasPages())
            <div class="cr-pagination">
                <div class="info">
                    Showing <strong>{{ $applications->firstItem() ?? 0 }}</strong> – <strong>{{ $applications->lastItem() ?? 0 }}</strong> of <strong>{{ $applications->total() }}</strong> entries
                </div>
                <div style="display:flex;align-items:center;gap:0.4rem">
                    {{-- Previous --}}
                    @if($applications->onFirstPage())
                        <span class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i> Prev</span>
                    @else
                        <a href="{{ $applications->previousPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-left"></i> Prev</a>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $start = max(1, $applications->currentPage() - 2);
                        $end = min($applications->lastPage(), $applications->currentPage() + 2);
                    @endphp
                    
                    @if($start > 1)
                        <a href="{{ $applications->url(1) }}" class="page-btn">1</a>
                        @if($start > 2)
                            <span class="page-btn disabled">…</span>
                        @endif
                    @endif
                    
                    @for($page = $start; $page <= $end; $page++)
                        @if($page == $applications->currentPage())
                            <span class="page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $applications->url($page) }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endfor
                    
                    @if($end < $applications->lastPage())
                        @if($end < $applications->lastPage() - 1)
                            <span class="page-btn disabled">…</span>
                        @endif
                        <a href="{{ $applications->url($applications->lastPage()) }}" class="page-btn">{{ $applications->lastPage() }}</a>
                    @endif

                    {{-- Next --}}
                    @if($applications->hasMorePages())
                        <a href="{{ $applications->nextPageUrl() }}" class="page-btn">Next <i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="page-btn disabled">Next <i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
            @else
            <div style="padding-top:1rem;border-top:1px solid var(--border);font-size:0.8rem;color:var(--text-muted)">
                Showing <strong>{{ $applications->total() }}</strong> {{ Str::plural('entry', $applications->total()) }}
            </div>
            @endif

        </div>
    </div>
</div>

<!-- Hidden delete forms -->
@foreach($applications as $application)
<form id="delete-form-{{ $application->id }}" action="{{ route('admin.resume.destroy', $application->id) }}" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>
@endforeach

<script>
function deleteApplication(id, name, jobTitle) {
    Swal.fire({
        title: "Delete this application?",
        html: "<strong>" + name + "</strong><br><small style='color:#6b7280'>For: " + jobTitle + "</small>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "Cancel",
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
