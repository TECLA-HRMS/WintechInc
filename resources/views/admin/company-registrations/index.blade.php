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

    /* Page Header */
    .cr-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
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
    .stat-icon.blue   { background: var(--info-light); color: var(--info); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    /* Main Card */
    .cr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,0.05); overflow: hidden; }
    .cr-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .cr-card-title { font-size: 1rem; font-weight: 600; color: var(--text-dark); margin: 0; }
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
    .avatar-email { font-size: 0.75rem; color: var(--text-muted); }

    /* Status Badge */
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; text-transform: capitalize; }
    .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .status-badge.pending  { background: var(--warning-light); color: var(--warning); }
    .status-badge.pending::before  { background: var(--warning); }
    .status-badge.approved { background: var(--success-light); color: var(--success); }
    .status-badge.approved::before { background: var(--success); }
    .status-badge.rejected { background: var(--danger-light); color: var(--danger); }
    .status-badge.rejected::before { background: var(--danger); }
    .status-badge.new      { background: var(--info-light); color: var(--info); }
    .status-badge.new::before      { background: var(--info); }

    /* Action Buttons */
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid var(--border); background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all 0.15s; text-decoration: none; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.12); }
    .action-btn.view  { color: var(--info); border-color: #bae6fd; }
    .action-btn.view:hover  { background: var(--info-light); }
    .action-btn.del   { color: var(--danger); border-color: #fecaca; }
    .action-btn.del:hover   { background: var(--danger-light); }

    /* Pagination */
    .cr-pagination { display: flex; justify-content: space-between; align-items: center; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 0.5rem; }
    .cr-pagination .info { font-size: 0.8rem; color: var(--text-muted); }
    .cr-pagination .pagination { margin: 0; }
    .cr-pagination .page-link { border-radius: 7px !important; margin: 0 2px; border: 1px solid var(--border); color: var(--text-dark); font-size: 0.8rem; padding: 0.35rem 0.65rem; }
    .cr-pagination .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: #fff; }
    .cr-pagination .page-link:hover { background: var(--primary-light); border-color: var(--primary); color: var(--primary); }

    /* Empty State */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }
    .empty-state h5 { font-weight: 600; color: var(--text-dark); margin-bottom: 0.4rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.875rem; margin: 0; }

    /* Alert */
    .cr-alert { border-radius: 10px; border: none; font-size: 0.875rem; padding: 0.875rem 1.25rem; margin-bottom: 1.25rem; }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .cr-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
    }
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
            <h1><i class="fa-solid fa-building me-2" style="color:var(--primary)"></i>Company Registrations</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Company Registrations</span>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-label">Total</div>
                <div class="stat-value">{{ $registrations->total() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div>
                <div class="stat-label">This Month</div>
                <div class="stat-value">{{ $registrations->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $registrations->where('status', 'pending')->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div>
                <div class="stat-label">Today</div>
                <div class="stat-value">{{ $registrations->where('created_at', '>=', now()->startOfDay())->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="cr-card">
      
        <div class="cr-card-body">

            <!-- Filter Bar -->
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.company.registrations.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" class="form-control" placeholder="Name, company, email, mobile..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="new"      {{ request('status') == 'new'      ? 'selected' : '' }}>New</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="latest" {{ request('sort','latest') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="name"   {{ request('sort') == 'name'   ? 'selected' : '' }}>Name A–Z</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply">
                                <i class="fa-solid fa-filter"></i> Apply
                            </button>
                            <a href="{{ route('admin.company.registrations.index') }}" class="btn-filter btn-reset">
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
                            <th>Name / Email</th>
                            <th>Logo</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr id="registration-row-{{ $registration->id }}">
                            <td class="sno">{{ ($registrations->currentPage() - 1) * $registrations->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="avatar-cell">
                                    <div class="avatar">{{ strtoupper(substr($registration->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="avatar-name">{{ $registration->name }}</div>
                                        <div class="avatar-email">{{ $registration->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($registration->company_logo_path)
                                    <img src="{{ asset($registration->company_logo_path) }}" alt="Logo" style="width:38px;height:38px;border-radius:8px;object-fit:cover;border:1px solid var(--border);">
                                @else
                                    <div style="width:38px;height:38px;border-radius:8px;background:var(--bg-light);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:1rem;border:1px solid var(--border);"><i class="fa-solid fa-building"></i></div>
                                @endif
                            </td>
                            <td>{{ $registration->company_name ?? '—' }}</td>
                            <td>{{ $registration->position ?? '—' }}</td>
                            <td>{{ $registration->mobile }}</td>
                            <td>
                                <span class="status-badge {{ $registration->status }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>
                                <div style="font-size:0.8rem;color:var(--text-dark);font-weight:500">{{ $registration->created_at->format('M j, Y') }}</div>
                                <div style="font-size:0.72rem;color:var(--text-muted)">{{ $registration->created_at->format('g:i A') }}</div>
                            </td>
                            <td>
                                <div style="display:flex;gap:0.4rem;justify-content:center">
                                    <a href="{{ route('admin.company.registrations.show', $registration->id) }}" class="action-btn view" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="action-btn del" onclick="deleteRegistration({{ $registration->id }})" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                    <h5>No registrations found</h5>
                                    <p>Try adjusting your search or filter criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($registrations->hasPages())
            <div class="cr-pagination">
                <div class="info">
                    Showing <strong>{{ $registrations->firstItem() ?? 0 }}</strong> – <strong>{{ $registrations->lastItem() ?? 0 }}</strong> of <strong>{{ $registrations->total() }}</strong> entries
                </div>
                <ul class="pagination">
                    <li class="page-item {{ $registrations->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $registrations->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}">&laquo;</a>
                    </li>
                    @foreach($registrations->getUrlRange(1, $registrations->lastPage()) as $page => $url)
                    <li class="page-item {{ $registrations->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}&{{ http_build_query(request()->except('page')) }}">{{ $page }}</a>
                    </li>
                    @endforeach
                    <li class="page-item {{ !$registrations->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $registrations->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}">&raquo;</a>
                    </li>
                </ul>
            </div>
            @endif

        </div>
    </div>
</div>

<script>
function deleteRegistration(id) {
    Swal.fire({
        title: "Delete this registration?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "Cancel",
    }).then(function(result) {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.company.registrations.destroy', '') }}/" + id,
                type: "DELETE",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({ title: "Deleted!", text: response.message, icon: "success", timer: 1500, showConfirmButton: false });
                        $("#registration-row-" + id).fadeOut(300, function() { $(this).remove(); });
                    } else {
                        Swal.fire("Error", "Failed to delete registration", "error");
                    }
                },
                error: function() { Swal.fire("Error", "Something went wrong!", "error"); }
            });
        }
    });
}
</script>
@endsection
