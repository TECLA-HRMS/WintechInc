@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $total = $registrations->total();
    $thisMonth = $registrations->getCollection()->where('created_at', '>=', now()->startOfMonth())->count();
    $pending = $registrations->getCollection()->whereIn('status', ['pending', 'new', 'under_review'])->count();
    $today = $registrations->getCollection()->where('created_at', '>=', now()->startOfDay())->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-building me-2" style="color:var(--primary)"></i>Company Registration Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Company Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.company.download.excel', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('admin.company.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-building"></i></div>
            <div><div class="stat-label">Total</div><div class="stat-value">{{ $total }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div><div class="stat-label">This Month</div><div class="stat-value">{{ $thisMonth }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div><div class="stat-label">Pending</div><div class="stat-value">{{ $pending }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div><div class="stat-label">Today</div><div class="stat-value">{{ $today }}</div></div>
        </div>
    </div>

    <div class="cr-card">
        <div class="cr-card-body">
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.company.report') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="all">All Status</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name, company, email, mobile...">
                            </div>
                        </div>
                        <div class="col-12 d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.company.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name / Email</th>
                            <th>Mobile</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                            <tr>
                                <td class="sno">{{ $registrations->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($registration->name ?? 'C', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $registration->name }}</div>
                                            <div class="avatar-email">{{ $registration->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $registration->mobile ?? 'N/A' }}</td>
                                <td>{{ $registration->company_name ?? '-' }}</td>
                                <td class="muted-cell">{{ Str::limit($registration->address ?? '-', 60) }}</td>
                                <td><span class="status-badge {{ $registration->status ?: 'default' }}">{{ str_replace('_', ' ', $registration->status ?: 'N/A') }}</span></td>
                                <td>
                                    <div class="date-main">{{ $registration->created_at->format('M j, Y') }}</div>
                                    <div class="date-sub">{{ $registration->created_at->format('g:i A') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
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

            @if($registrations->hasPages())
                <div class="cr-pagination">
                    @include('includes.admin.pagination', ['paginator' => $registrations])
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
