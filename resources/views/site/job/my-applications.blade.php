@extends('layouts.site')

@section('content')

<style>
    /* Premium Modern Aesthetics - Navy Theme */
    :root {
        --brand: #071056;
        --brand-light: #16248c;
        --brand-faint: rgba(7, 16, 86, 0.05);
        --bg-main: #f4f7fa;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    body {
        background: var(--bg-main);
        font-family: 'Inter', sans-serif;
    }
    
    .applications-layout {
        padding: 60px 0 100px;
    }

    /* Top Spacer */
    .modern-spacer {
        height: 40px;
    }

    .page-header-title {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 35px;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .page-header-title i {
        color: var(--brand);
        background: var(--brand-faint);
        padding: 14px;
        border-radius: 16px;
        font-size: 26px;
        box-shadow: 0 4px 10px rgba(7, 16, 86, 0.08);
    }

    /* Floating Cards */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0,0,0,0.01);
        margin-bottom: 20px;
        padding: 28px 32px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 24px;
        position: relative;
        overflow: hidden;
    }
    
    .premium-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--brand), var(--brand-light));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .premium-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(7, 16, 86, 0.06);
        border-color: #cbd5e1;
    }
    
    .premium-card:hover::before {
        opacity: 1;
    }

    /* Company Logo */
    .company-logo-wrapper {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .company-logo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
    }
    .company-logo-letter {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--brand), var(--brand-light));
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    /* Job Info */
    .job-info {
        flex: 1;
        min-width: 250px;
    }
    .job-title {
        font-size: 19px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        text-decoration: none;
        transition: color 0.2s ease;
        display: block;
        letter-spacing: -0.3px;
    }
    .job-title:hover {
        color: var(--brand-light);
    }
    .company-name {
        font-size: 14.5px;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .company-name i {
        color: #94a3b8;
    }
    
    /* Meta Details */
    .job-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-muted);
        background: #f8fafc;
        padding: 6px 12px;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
    }
    .meta-item i {
        color: var(--brand-light);
        opacity: 0.8;
    }

    /* Status Section */
    .status-section {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
        min-width: 160px;
    }
    .applied-date {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .applied-date i {
        font-size: 12px;
        color: #cbd5e1;
    }
    
    /* Status Badges */
    .status-badge {
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.2px;
    }
    .status-badge.pending { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
    .status-badge.reviewed { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
    .status-badge.shortlisted { background: #fdf4ff; color: #c026d3; border: 1px solid #fae8ff; }
    .status-badge.hired { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
    .status-badge.rejected { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
    .status-badge.default { background: #f8fafc; color: #475569; border: 1px solid #f1f5f9; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        border: 1px solid var(--border-color);
    }
    .empty-state-icon {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 120px;
        background: #f8fafc;
        border-radius: 50%;
    }
    .empty-state h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 35px;
        font-size: 15px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }
    .btn-browse {
        background: linear-gradient(135deg, var(--brand), var(--brand-light));
        color: #ffffff;
        border: none;
        padding: 14px 32px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 6px 15px rgba(7, 16, 86, 0.2);
    }
    .btn-browse:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(7, 16, 86, 0.3);
        color: #ffffff;
    }

    /* Pagination Styling */
    .pagination-wrapper {
        margin-top: 40px;
    }
    .pagination {
        justify-content: center;
        gap: 6px;
    }
    .page-item .page-link {
        border-radius: 10px;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.2s;
        background: #fff;
    }
    .page-item .page-link:hover {
        background: #f8fafc;
        color: var(--text-primary);
        border-color: #cbd5e1;
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--brand), var(--brand-light));
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 4px 10px rgba(7, 16, 86, 0.2);
    }

    @media (max-width: 768px) {
        .premium-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
        }
        .status-section {
            align-items: center;
            width: 100%;
            border-top: 1px solid var(--border-color);
            padding-top: 18px;
            margin-top: 5px;
            flex-direction: row;
            justify-content: space-between;
        }
        .company-logo-wrapper {
            width: 60px;
            height: 60px;
        }
    }
</style>

<div class="modern-spacer"></div>

<div class="applications-layout">
    <div class="container">
        
        <h1 class="page-header-title">
            <i class="ti-briefcase"></i> My Job Applications
        </h1>

        @if(session('message'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert" style="border-radius: 16px; border:none; background:#eff6ff; color:#1e40af; font-weight:600; padding:20px;">
                <i class="ti-info-alt mr-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top:5px;"></button>
            </div>
        @endif

        @if($applications->count() > 0)
            <div class="applications-list">
                @foreach($applications as $app)
                    <div class="premium-card">
                        
                        <!-- Logo -->
                        <div class="company-logo-wrapper">
                            @if(!empty($app->company_logo))
                                <img src="{{ asset('uploads/company_logos/' . $app->company_logo) }}" alt="{{ $app->company_name }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="company-logo-letter" style="display: none;">
                                    {{ strtoupper(substr($app->company_name ?? 'C', 0, 1)) }}
                                </div>
                            @else
                                <div class="company-logo-letter">
                                    {{ strtoupper(substr($app->company_name ?? 'C', 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="job-info">
                            <a href="{{ route('jobs.show', $app->job_id) }}" class="job-title">
                                {{ $app->job_title }}
                            </a>
                            <div class="company-name">
                                <i class="ti-home"></i> {{ $app->company_name }}
                            </div>
                            
                            <div class="job-meta">
                                @if($app->job_location)
                                <div class="meta-item">
                                    <i class="ti-location-pin"></i> {{ $app->job_location }}
                                </div>
                                @endif
                                
                                @if($app->job_type)
                                <div class="meta-item">
                                    <i class="ti-time"></i> {{ ucwords(str_replace('_', ' ', $app->job_type)) }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="status-section">
                            @php
                                $statusClass = 'default';
                                $statusLabel = $app->status ?? 'Applied';
                                $lowerStatus = strtolower($statusLabel);
                                
                                if (in_array($lowerStatus, ['pending', 'applied'])) $statusClass = 'pending';
                                elseif (in_array($lowerStatus, ['reviewed', 'viewed'])) $statusClass = 'reviewed';
                                elseif (in_array($lowerStatus, ['shortlisted', 'interview'])) $statusClass = 'shortlisted';
                                elseif (in_array($lowerStatus, ['hired', 'accepted', 'selected'])) $statusClass = 'hired';
                                elseif (in_array($lowerStatus, ['rejected', 'declined'])) $statusClass = 'rejected';
                            @endphp
                            
                            <div class="status-badge {{ $statusClass }}">
                                @if($statusClass == 'pending') <i class="ti-time"></i>
                                @elseif($statusClass == 'hired') <i class="ti-check"></i>
                                @elseif($statusClass == 'rejected') <i class="ti-close"></i>
                                @else <i class="ti-info-alt"></i> @endif
                                {{ $statusLabel }}
                            </div>
                            
                            <div class="applied-date">
                                Applied: {{ \Carbon\Carbon::parse($app->created_at)->format('M d, Y') }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper d-flex justify-content-center">
                {{ $applications->links() }}
            </div>

        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="ti-files"></i>
                </div>
                <h3>No Applications Yet</h3>
                <p>You haven't applied for any jobs yet. Discover exciting opportunities that match your skills!</p>
                <a href="{{ route('jobs.index') }}" class="btn-browse">
                    <i class="ti-search"></i> Browse Jobs
                </a>
            </div>
        @endif

    </div>
</div>

<link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">

@endsection
