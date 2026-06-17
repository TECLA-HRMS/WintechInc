@extends('layouts.site')

@section('content')

<style>
    /* Premium Modern Aesthetics */
    body {
        background: #f4f7fb;
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
        color: #0f172a;
        margin-bottom: 30px;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .page-header-title i {
        color: #b11e24;
        background: #fff1f2;
        padding: 12px;
        border-radius: 14px;
        font-size: 28px;
    }

    /* Floating Cards */
    .premium-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        padding: 30px;
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .premium-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
        border-color: #cbd5e1;
    }

    /* Company Logo */
    .company-logo-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
    }
    .company-logo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
    }
    .company-logo-letter {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #b11e24, #8c1418);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        text-transform: uppercase;
    }

    /* Job Info */
    .job-info {
        flex: 1;
        min-width: 250px;
    }
    .job-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
        text-decoration: none;
        transition: color 0.2s ease;
        display: block;
    }
    .job-title:hover {
        color: #b11e24;
    }
    .company-name {
        font-size: 15px;
        color: #475569;
        font-weight: 600;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    /* Meta Details */
    .job-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        background: #f8fafc;
        padding: 6px 12px;
        border-radius: 8px;
    }
    .meta-item i {
        color: #94a3b8;
    }

    /* Status Section */
    .status-section {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
        min-width: 150px;
    }
    .applied-date {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }
    
    /* Status Badges */
    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        text-transform: capitalize;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-badge.pending { background: #fffbeb; color: #d97706; }
    .status-badge.reviewed { background: #eff6ff; color: #2563eb; }
    .status-badge.shortlisted { background: #fdf4ff; color: #c026d3; }
    .status-badge.hired { background: #f0fdf4; color: #16a34a; }
    .status-badge.rejected { background: #fef2f2; color: #dc2626; }
    .status-badge.default { background: #f8fafc; color: #475569; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .empty-state-icon {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    .empty-state h3 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #64748b;
        margin-bottom: 30px;
    }
    .btn-browse {
        background: linear-gradient(135deg, #b11e24, #8c1418);
        color: #fff;
        border: none;
        padding: 16px 32px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(177, 30, 36, 0.3);
    }
    .btn-browse:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(177, 30, 36, 0.4);
        color: #fff;
    }

    /* Pagination Styling */
    .pagination-wrapper {
        margin-top: 40px;
    }
    .pagination {
        justify-content: center;
        gap: 5px;
    }
    .page-item .page-link {
        border-radius: 10px;
        border: none;
        color: #475569;
        font-weight: 600;
        padding: 10px 16px;
        transition: all 0.2s;
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, #b11e24, #8c1418);
        color: #fff;
        box-shadow: 0 4px 10px rgba(177, 30, 36, 0.2);
    }

    @media (max-width: 768px) {
        .premium-card {
            flex-direction: column;
            align-items: flex-start;
        }
        .status-section {
            align-items: flex-start;
            width: 100%;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
            margin-top: 5px;
            flex-direction: row;
            justify-content: space-between;
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
                                <img loading="lazy" src="{{ asset('uploads/company_logos/' . $app->company_logo) }}" alt="{{ $app->company_name }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
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
                                    <i class="ti-time"></i> {{ str_replace('_', ' ', title_case($app->job_type)) }}
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

