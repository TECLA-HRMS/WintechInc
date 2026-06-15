@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $applicationCollection = $applications->getCollection();
    $total = $applications->total();
    $thisMonth = $applicationCollection->where('created_at', '>=', now()->startOfMonth())->count();
    $pending = $applicationCollection->where('status', 'pending')->count();
    $today = $applicationCollection->where('created_at', '>=', now()->startOfDay())->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-file-lines me-2" style="color:var(--primary)"></i>Job Applications Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Job Applications Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.job-applications.report.download.csv', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> CSV
            </a>
            <a href="{{ route('admin.job-applications.report.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-file-lines"></i></div>
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
                <form method="GET" action="{{ route('admin.job-applications.report') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" class="form-control" placeholder="Job, company, applicant, or email..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.job-applications.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Application</th>
                            <th>Job / Company</th>
                            <th>Applicant / Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Applied</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $index => $application)
                            <tr>
                                <td class="sno">{{ $applications->firstItem() + $index }}</td>
                                <td>#APP{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($application->job_title ?? 'J', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $application->job_title }}</div>
                                            <div class="avatar-email">{{ $application->company_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="avatar-name">{{ $application->full_name }}</div>
                                    <div class="avatar-email">{{ $application->email }}</div>
                                </td>
                                <td>{{ $application->phone }}</td>
                                <td><span class="status-badge {{ $application->status ?: 'default' }}">{{ ucfirst($application->status ?: 'N/A') }}</span></td>
                                <td>
                                    <div class="date-main">{{ \Carbon\Carbon::parse($application->created_at)->format('M d, Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                        <h5>No job applications found</h5>
                                        <p>Try adjusting your search or filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($applications->hasPages())
                <div class="cr-pagination">
                    @include('includes.admin.pagination', ['paginator' => $applications])
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
