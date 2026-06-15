@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $userCollection = $users->getCollection();
    $total = $users->total();
    $thisMonth = $userCollection->where('created_at', '>=', now()->startOfMonth())->count();
    $withResume = $userCollection->filter(fn($user) => !empty($user->resume))->count();
    $today = $userCollection->where('created_at', '>=', now()->startOfDay())->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-users me-2" style="color:var(--primary)"></i>Profile Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Profile Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.profile.report.download.csv', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> CSV
            </a>
            <a href="{{ route('admin.profile.report.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div><div class="stat-label">Total</div><div class="stat-value">{{ $total }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div><div class="stat-label">This Month</div><div class="stat-value">{{ $thisMonth }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-file-lines"></i></div>
            <div><div class="stat-label">With Resume</div><div class="stat-value">{{ $withResume }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div><div class="stat-label">Today</div><div class="stat-value">{{ $today }}</div></div>
        </div>
    </div>

    <div class="cr-card">
        <div class="cr-card-body">
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.profile.report') }}">
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
                                <input type="text" name="search" class="form-control" placeholder="Name or email..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.profile.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i></a>
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
                            <th>Phone</th>
                            <th>Education</th>
                            <th>Experience</th>
                            <th>Skills</th>
                            <th>Resume</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            @php
                                $educations = $user->educations ?? collect();
                                $experiences = $user->experiences ?? collect();
                                $skills = ($user->skills ?? collect())->pluck('skill_name')->take(3)->join(', ');
                                $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
                            @endphp
                            <tr>
                                <td class="sno">{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($name ?: 'U', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $name ?: 'Unnamed User' }}</div>
                                            <div class="avatar-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td class="muted-cell">
                                    @if($educations->count())
                                        {{ $educations->map(fn($edu) => trim(($edu->degree ?? '') . ' - ' . ($edu->institution ?? '')))->filter()->take(2)->join('; ') }}
                                    @else
                                        No Education
                                    @endif
                                </td>
                                <td class="muted-cell">
                                    @if($experiences->count())
                                        {{ $experiences->map(fn($exp) => trim(($exp->job_title ?? '') . ' - ' . ($exp->company ?? '')))->filter()->take(2)->join('; ') }}
                                    @else
                                        No Experience
                                    @endif
                                </td>
                                <td class="muted-cell">{{ $skills ?: '-' }}</td>
                                <td>
                                    @if($user->resume)
                                        <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="action-btn view" title="View Resume"><i class="fa-solid fa-eye"></i></a>
                                    @else
                                        <span class="muted-cell">No Resume</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-main">{{ $user->created_at->format('M j, Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                        <h5>No profiles found</h5>
                                        <p>Try adjusting your search or filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="cr-pagination">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
