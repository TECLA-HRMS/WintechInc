@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $total = $applications->count();
    $thisMonth = $applications->where('created_at', '>=', now()->startOfMonth())->count();
    $today = $applications->where('created_at', '>=', now()->startOfDay())->count();
    $withPhone = $applications->filter(fn($app) => !empty($app->phone))->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-user-check me-2" style="color:var(--primary)"></i>Selected Candidate Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Selected Candidate Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.selected.candidate.report.download.csv', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> CSV
            </a>
            <a href="{{ route('admin.selected.candidate.report.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-user-check"></i></div>
            <div><div class="stat-label">Selected</div><div class="stat-value">{{ $total }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div><div class="stat-label">This Month</div><div class="stat-value">{{ $thisMonth }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-phone"></i></div>
            <div><div class="stat-label">With Phone</div><div class="stat-value">{{ $withPhone }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div><div class="stat-label">Today</div><div class="stat-value">{{ $today }}</div></div>
        </div>
    </div>

    <div class="cr-card">
        <div class="cr-card-body">
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.selected.candidate.report') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name, email, or job title...">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.selected.candidate.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate / Email</th>
                            <th>Phone</th>
                            <th>Job Title</th>
                            <th>Status</th>
                            <th>Applied</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $key => $app)
                            <tr>
                                <td class="sno">{{ $key + 1 }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($app->full_name ?? 'C', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $app->full_name }}</div>
                                            <div class="avatar-email">{{ $app->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $app->phone }}</td>
                                <td>{{ $app->job_title }}</td>
                                <td><span class="status-badge selected">Selected</span></td>
                                <td>
                                    <div class="date-main">{{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                        <h5>No selected candidates found</h5>
                                        <p>Try adjusting your search or filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
