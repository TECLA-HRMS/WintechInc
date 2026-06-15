@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

@php
    $total = $contacts->count();
    $thisMonth = $contacts->where('created_at', '>=', now()->startOfMonth())->count();
    $today = $contacts->where('created_at', '>=', now()->startOfDay())->count();
    $withPhone = $contacts->filter(fn($contact) => !empty($contact->phonenumber))->count();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-message me-2" style="color:var(--primary)"></i>Contact Report</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Contact Report</span>
            </div>
        </div>
        <div class="cr-actions">
            <a href="{{ route('admin.contact.download', request()->query()) }}" class="btn-export csv">
                <i class="fa fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('admin.contact.download.pdf', request()->query()) }}" class="btn-export pdf">
                <i class="fa fa-file-pdf"></i> PDF
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-inbox"></i></div>
            <div><div class="stat-label">Total</div><div class="stat-value">{{ $total }}</div></div>
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
                <form method="GET" action="{{ route('admin.contact.report') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.contact.report') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i> Reset</a>
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
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td class="sno">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="avatar">{{ strtoupper(substr($contact->name ?? 'C', 0, 1)) }}</div>
                                        <div>
                                            <div class="avatar-name">{{ $contact->name }}</div>
                                            <div class="avatar-email">{{ $contact->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $contact->phonenumber ?? 'N/A' }}</td>
                                <td>{{ $contact->subject ?? '-' }}</td>
                                <td class="muted-cell">{{ Str::limit($contact->description ?? '-', 80) }}</td>
                                <td>
                                    <div class="date-main">{{ $contact->created_at->format('M j, Y') }}</div>
                                    <div class="date-sub">{{ $contact->created_at->format('g:i A') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon"><i class="fa-solid fa-folder-open"></i></div>
                                        <h5>No contacts found</h5>
                                        <p>Try adjusting your date filters.</p>
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
