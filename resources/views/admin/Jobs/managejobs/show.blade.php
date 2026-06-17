@extends('layouts.admin')

@section('adminContent')
<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-primary">
                <i class="fa fa-briefcase me-2"></i> Job Details
            </h4>
            <p class="text-muted mb-0">View complete information about this job posting</p>
        </div>
        <a href="{{ route('admin.managejobs.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-arrow-left me-1"></i> Back to Jobs
        </a>
    </div>

    <!-- Main Job Card -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <!-- Card Header with Status -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center">
                @if($job->company_logo)
                    <img loading="lazy" src="{{ asset($job->company_logo) }}" alt="Company Logo" class="rounded me-3" style="width: 40px; height: 40px; object-fit: contain; background: white; padding: 4px;">
                @endif
                <div>
                    <h5 class="mb-0">{{ $job->company_name }}</h5>
                    <small class="opacity-75">{{ $job->job_title }}</small>
                </div>
            </div>
            <span class="badge badge-lg px-3 py-2 
                @if($job->status == 'Open') bg-success 
                @elseif($job->status == 'Closed') bg-danger 
                @else bg-secondary @endif">
                {{ ucfirst($job->status) }}
            </span>
        </div>

        <div class="card-body p-4">
            <!-- Key Information Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-map-marker-alt text-danger me-2"></i>
                            <span class="text-muted small">Location</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $job->job_location }}</h6>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-laptop text-info me-2"></i>
                            <span class="text-muted small">Work Mode</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $job->work_mode }}</h6>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-clock text-warning me-2"></i>
                            <span class="text-muted small">Job Type</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $job->job_type }}</h6>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-chart-line text-success me-2"></i>
                            <span class="text-muted small">Experience</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $job->experience }}</h6>
                    </div>
                </div>
            </div>

            <!-- Secondary Information -->
            <div class="row g-4 mb-4">
                <div class="col-md-4 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-users text-secondary me-2"></i>
                            <span class="text-muted small">Vacancies</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">{{ $job->vacancies }}</h6>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-money-bill-wave text-success me-2"></i>
                            <span class="text-muted small">Salary Range</span>
                        </div>
                        <h6 class="mb-0 fw-semibold text-success">₹{{ $job->salary_from }} - ₹{{ $job->salary_to }}</h6>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <div class="info-card p-3 rounded-3 border h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-calendar-alt text-primary me-2"></i>
                            <span class="text-muted small">Date Range</span>
                        </div>
                        <h6 class="mb-0 fw-semibold">
                            {{ \Carbon\Carbon::parse($job->start_date)->format('d M Y') }} 
                            <i class="fa fa-long-arrow-alt-right mx-1 text-secondary"></i> 
                            {{ \Carbon\Carbon::parse($job->end_date)->format('d M Y') }}
                        </h6>
                    </div>
                </div>
            </div>

            <!-- Job Details Sections -->
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="detail-section h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fa fa-tasks text-primary"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Job Function</h6>
                        </div>
                        <p class="text-muted mb-0">{{ $job->job_function }}</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="detail-section h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container bg-info bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fa fa-list-check text-info"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Responsibilities</h6>
                        </div>
                        <div class="text-muted">
                            {!! nl2br(e($job->responsibilities)) !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="detail-section h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fa fa-lightbulb text-warning"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Requirements</h6>
                        </div>
                        <div class="text-muted">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Description Section -->
            <div class="mt-5 pt-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-container bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                        <i class="fa fa-align-left text-secondary"></i>
                    </div>
                    <h6 class="mb-0 fw-bold">Job Description</h6>
                </div>
                <div class="description-content p-3 rounded-3 border bg-light">
                    <div class="text-muted" style="white-space: pre-line;">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    }
    
    .info-card {
        transition: all 0.3s ease;
        background: white;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .detail-section {
        padding: 1.5rem;
        border-radius: 0.75rem;
        background: white;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .icon-container {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .description-content {
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,0.08);
    }
    
    .badge-lg {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
    }
    
    .rounded-4 {
        border-radius: 0.75rem !important;
    }
</style>
@endsection
