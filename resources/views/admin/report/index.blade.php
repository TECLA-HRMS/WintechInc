@extends('layouts.admin')

@section('adminContent')
@include('admin.report.partials.report-style')

<style>
    .report-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; }
    .report-card { background: #fff; border: 1px solid var(--border); border-radius: 14px; padding: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 1rem; min-height: 250px; }
    .report-card-top { display: flex; align-items: center; justify-content: space-between; }
    .report-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; background: var(--primary-light); color: var(--primary); }
    .report-total { font-size: 1.8rem; font-weight: 700; color: var(--text-dark); }
    .report-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.4rem; }
    .report-desc { color: var(--text-muted); font-size: 0.86rem; line-height: 1.55; margin: 0; }
    .report-meta { display: flex; justify-content: space-between; align-items: center; background: var(--bg-light); border: 1px solid var(--border); border-radius: 10px; padding: 0.75rem 0.9rem; font-size: 0.78rem; color: var(--text-muted); }
    .report-meta strong { color: var(--text-dark); }
    .report-actions { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; margin-top: auto; }
    .report-action { height: 38px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; text-decoration: none; font-size: 0.78rem; font-weight: 700; border: 1px solid var(--border); }
    .report-action.view { background: var(--info-light); color: var(--info); border-color: #bae6fd; }
    .report-action.csv { background: var(--success-light); color: var(--success); border-color: #bbf7d0; }
    .report-action.pdf { background: var(--danger-light); color: var(--danger); border-color: #fecaca; }
    @media (max-width: 1100px) { .report-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 700px) { .report-grid { grid-template-columns: 1fr; } .report-actions { grid-template-columns: 1fr; } }
</style>

@php
    $totalRecords = $summary->sum('total');
    $activeReports = $summary->count();
    $latestReport = $summary->filter(fn($report) => !empty($report['latest']))->sortByDesc('latest')->first();
@endphp

<div class="cr-page">
    <div class="cr-header">
        <div class="cr-header-left">
            <h1><i class="fa-solid fa-chart-line me-2" style="color:var(--primary)"></i>Reports</h1>
            <div class="cr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Reports</span>
            </div>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-layer-group"></i></div>
            <div><div class="stat-label">Reports</div><div class="stat-value">{{ $activeReports }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-database"></i></div>
            <div><div class="stat-label">Records</div><div class="stat-value">{{ number_format($totalRecords) }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-calendar-check"></i></div>
            <div><div class="stat-label">Latest</div><div class="stat-value" style="font-size:1rem">{{ $latestReport && $latestReport['latest'] ? \Carbon\Carbon::parse($latestReport['latest'])->format('d M') : 'None' }}</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-file-export"></i></div>
            <div><div class="stat-label">Formats</div><div class="stat-value">2</div></div>
        </div>
    </div>

    <div class="cr-card">
        <div class="cr-card-body">
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.reports.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name, email, job, company...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <input type="text" name="status" value="{{ request('status') }}" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply"><i class="fa-solid fa-filter"></i> Apply</button>
                            <a href="{{ route('admin.reports.index') }}" class="btn-filter btn-reset"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="report-grid">
                @foreach($summary as $report)
                    <div class="report-card">
                        <div class="report-card-top">
                            <div class="report-icon"><i class="{{ $report['icon'] }}"></i></div>
                            <div class="report-total">{{ number_format($report['total']) }}</div>
                        </div>
                        <div>
                            <h3 class="report-title">{{ $report['title'] }}</h3>
                            <p class="report-desc">{{ $report['description'] }}</p>
                        </div>
                        <div class="report-meta">
                            <span>Latest</span>
                            <strong>{{ $report['latest'] ? \Carbon\Carbon::parse($report['latest'])->format('d M Y') : 'No data' }}</strong>
                        </div>
                        <div class="report-actions">
                            <a href="{{ route($report['view_route'], request()->query()) }}" class="report-action view">
                                <i class="ti ti-eye"></i> View
                            </a>
                            <a href="{{ route('admin.reports.export', array_merge(['report' => $report['key'], 'format' => 'csv'], request()->query())) }}" class="report-action csv">
                                <i class="ti ti-file-spreadsheet"></i> CSV
                            </a>
                            <a href="{{ route('admin.reports.export', array_merge(['report' => $report['key'], 'format' => 'pdf'], request()->query())) }}" class="report-action pdf">
                                <i class="ti ti-file-type-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
