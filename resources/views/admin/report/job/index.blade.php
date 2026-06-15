@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $jobCollection = $jobs->getCollection();
    $total = $jobs->total();
    $thisMonth = $jobCollection->where('created_at', '>=', now()->startOfMonth())->count();
    $active = $jobCollection->filter(fn($job) => in_array($job->status, ['active', 'open', 'published']))->count();
    $today = $jobCollection->where('created_at', '>=', now()->startOfDay())->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-briefcase me-2" style="color:var(--primary)"></i>Job Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Job Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.job.report.download.csv', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> CSV
            </a>
            <a href="{{ route('admin.job.report.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-briefcase"></i></div>
            <div><div class="stat-label">Total</div><div class="stat-value">{{ $total }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div><div class="stat-label">This Month</div><div class="stat-value">{{ $thisMonth }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-circle-check"></i></div>
            <div><div class="stat-label">Active</div><div class="stat-value">{{ $active }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div><div class="stat-label">Today</div><div class="stat-value">{{ $today }}</div></div>
        </div>
    </div>

    <div class="cr-card">
        <div class="cr-card-body">
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.job.report') }}">
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
                                <input type="text" name="search" class="form-control" placeholder="Title, company, or location..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.job.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job / Company</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Experience</th>
                            <th>Skills</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $index => $job)
                            <tr>
                                <td class="sno">{{ $jobs->firstItem() + $index }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($job->job_title ?? 'J', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $job->job_title }}</div>
                                            <div class="avatar-email">{{ $job->company_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ ucfirst($job->job_type) }}</td>
                                <td>{{ $job->job_location }}</td>
                                <td>{{ $job->experience }}</td>
                                <td class="muted-cell">{{ Str::limit($job->skills, 40) }}</td>
                                <td><span class="status-badge {{ $job->status ?: 'default' }}">{{ ucfirst($job->status ?: 'N/A') }}</span></td>
                                <td>
                                    <div class="date-main">{{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                        <h5>No jobs found</h5>
                                        <p>Try adjusting your search or filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($jobs->hasPages())
                <div class="cr-pagination">
                    @include('includes.admin.pagination', ['paginator' => $jobs])
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
