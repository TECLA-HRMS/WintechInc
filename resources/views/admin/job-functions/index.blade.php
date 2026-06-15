@extends('layouts.admin')

@section('adminContent')
<style>
    .nl-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }
    .nl-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: .75rem; }
    .nl-header h1 { font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0 0 .25rem; }
    .nl-breadcrumb { font-size: .8rem; color: #6b7280; }
    .nl-breadcrumb a { color: #4f46e5; text-decoration: none; }
    .nl-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
    .nl-table { width: 100%; border-collapse: collapse; font-size: .875rem; }
    .nl-table th { background: #f9fafb; padding: .75rem 1rem; text-align: left; font-size: .75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid #e5e7eb; }
    .nl-table td { padding: .875rem 1rem; border-bottom: 1px solid #f3f4f6; color: #111827; vertical-align: middle; }
    .nl-table tr:last-child td { border-bottom: none; }
    .nl-table tr:hover td { background: #f9fafb; }
    .badge-active   { background: #ecfdf5; color: #059669; padding: .25rem .65rem; border-radius: 20px; font-size: .72rem; font-weight: 600; }
    .badge-inactive { background: #f3f4f6; color: #6b7280; padding: .25rem .65rem; border-radius: 20px; font-size: .72rem; font-weight: 600; }
    .btn-sm-act { padding: .3rem .7rem; border-radius: 6px; font-size: .78rem; font-weight: 500; border: none; cursor: pointer; }
    .btn-edit { background: #eef2ff; color: #4f46e5; }
    .btn-del  { background: #fef2f2; color: #dc2626; }
    .nl-alert { border-radius: 10px; border: none; font-size: .875rem; padding: .875rem 1.25rem; margin-bottom: 1.25rem; }
    
    /* Pagination */
    .nl-pagination { display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; border-top: 1px solid #e5e7eb; }
    .nl-pagination .info { font-size: .8rem; color: #6b7280; }
    .pagination-nav { display: flex; align-items: center; gap: 0.5rem; }
    .pagination-nav .page-link { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid #e5e7eb; border-radius: 6px; color: #111827; text-decoration: none; font-size: 0.875rem; transition: all 0.15s; }
    .pagination-nav .page-link:hover { background: #eef2ff; border-color: #4f46e5; color: #4f46e5; }
    .pagination-nav .page-link.active { background: #4f46e5; border-color: #4f46e5; color: white; }
    .pagination-nav .page-link.disabled { opacity: 0.5; cursor: not-allowed; }
    .pagination-nav .page-link.disabled:hover { background: transparent; border-color: #e5e7eb; color: #111827; }
    
    /* Status Tabs */
    .status-tabs { display: flex; gap: 0; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; }
    .status-tab { padding: 0.75rem 1.5rem; background: transparent; border: none; color: #6b7280; font-size: 0.875rem; font-weight: 500; cursor: pointer; text-decoration: none; border-bottom: 2px solid transparent; transition: all 0.2s; display: flex; align-items: center; gap: 0.5rem; }
    .status-tab:hover { color: #4f46e5; background: #f8fafc; }
    .status-tab.active { color: #4f46e5; border-bottom-color: #4f46e5; background: #f8fafc; }
    .status-count { background: #e5e7eb; color: #6b7280; font-size: 0.75rem; padding: 0.125rem 0.5rem; border-radius: 12px; font-weight: 600; }
    .status-tab.active .status-count { background: #eef2ff; color: #4f46e5; }
</style>

<div class="nl-page">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show nl-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="nl-header">
        <div>
            <h1><i class="ti ti-briefcase me-2" style="color:#4f46e5"></i>Job Functions</h1>
            <div class="nl-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> / Job Functions
            </div>
        </div>
        <a href="{{ route('admin.job-functions.create') }}" style="background:#4f46e5;color:#fff;border:none;border-radius:8px;padding:.65rem 1.5rem;font-size:.875rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem">
            <i class="ti ti-plus"></i> Add New Job Function
        </a>
    </div>

    <div class="nl-card">
        <table class="nl-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobFunctions as $jobFunction)
                <tr>
                    <td>{{ ($jobFunctions->currentPage() - 1) * $jobFunctions->perPage() + $loop->iteration }}</td>
                    <td>{{ $jobFunction->name }}</td>
                    <td>
                        <span class="{{ $jobFunction->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                            {{ ucfirst($jobFunction->status) }}
                        </span>
                    </td>
                    <td>{{ $jobFunction->created_at->format('d M Y') }}</td>
                    <td style="display:flex;gap:.5rem">
                        <a href="{{ route('admin.job-functions.edit', $jobFunction->id) }}" class="btn-sm-act btn-edit">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.job-functions.destroy', $jobFunction->id) }}" method="POST"
                              onsubmit="return confirm('Delete this job function?')">
                            @csrf @method('DELETE')
                            <button class="btn-sm-act btn-del"><i class="ti ti-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:2.5rem;color:#6b7280">
                        No job functions found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($jobFunctions->hasPages())
        <div class="nl-pagination">
            <div class="info">
                Showing {{ $jobFunctions->firstItem() ?? 0 }} to {{ $jobFunctions->lastItem() ?? 0 }} of {{ $jobFunctions->total() }} job functions
            </div>
            <div class="pagination-nav">
                @if($jobFunctions->onFirstPage())
                    <span class="page-link disabled"><i class="ti ti-chevron-left"></i></span>
                @else
                    <a href="{{ $jobFunctions->previousPageUrl() }}" class="page-link"><i class="ti ti-chevron-left"></i></a>
                @endif
                
                @foreach($jobFunctions->getUrlRange(1, $jobFunctions->lastPage()) as $page => $url)
                    @if($page == $jobFunctions->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach
                
                @if($jobFunctions->hasMorePages())
                    <a href="{{ $jobFunctions->nextPageUrl() }}" class="page-link"><i class="ti ti-chevron-right"></i></a>
                @else
                    <span class="page-link disabled"><i class="ti ti-chevron-right"></i></span>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
