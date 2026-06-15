@extends('admin.layouts.app')

@section('content')
<style>
.applicants-header {
  background: white;
  padding: 24px;
  border-radius: 8px;
  margin-bottom: 24px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.job-info h2 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 8px;
}

.job-meta {
  display: flex;
  gap: 20px;
  color: #6b7280;
  font-size: 14px;
}

.applicants-table {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.table {
  margin-bottom: 0;
}

.table th {
  background: #f9fafb;
  font-weight: 600;
  color: #374151;
  border-bottom: 2px solid #e5e7eb;
}

.status-badge {
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 600;
  text-transform: capitalize;
}

.status-pending { background: #fef3c7; color: #92400e; }
.status-reviewed { background: #dbeafe; color: #1e40af; }
.status-shortlisted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #991b1b; }
.status-selected { background: #dcfce7; color: #166534; }

.status-select {
  padding: 4px 8px;
  border-radius: 6px;
  border: 1px solid #d1d5db;
  font-size: 13px;
}

.btn-view-resume {
  padding: 4px 12px;
  font-size: 13px;
  background: #0066ff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn-view-resume:hover {
  background: #0052cc;
}
</style>

<div class="container-fluid">
  <div class="applicants-header">
    <div class="job-info">
      <h2>{{ $job->job_title }}</h2>
      <div class="job-meta">
        <span><i class="fa fa-building"></i> {{ $job->company_name }}</span>
        <span><i class="fa fa-map-marker"></i> {{ $job->job_location }}</span>
        <span><i class="fa fa-briefcase"></i> {{ $job->job_type }}</span>
        <span><i class="fa fa-users"></i> {{ $applicants->total() }} Applicants</span>
      </div>
    </div>
  </div>

  <div class="applicants-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Applicant Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Applied Date</th>
          <th>Status</th>
          <th>Resume</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applicants as $applicant)
          <tr>
            <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
            <td>{{ $applicant->email }}</td>
            <td>{{ $applicant->phone }}</td>
            <td>{{ $applicant->location ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('M d, Y') }}</td>
            <td>
              <select class="status-select" onchange="updateStatus({{ $applicant->id }}, this.value)">
                <option value="pending" {{ $applicant->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="reviewed" {{ $applicant->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                <option value="shortlisted" {{ $applicant->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                <option value="rejected" {{ $applicant->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="selected" {{ $applicant->status == 'selected' ? 'selected' : '' }}>Selected</option>
              </select>
            </td>
            <td>
              @if($applicant->resume)
                <a href="{{ asset('applications/' . $applicant->resume) }}" target="_blank" class="btn-view-resume">
                  <i class="fa fa-file-pdf"></i> View
                </a>
              @else
                <span class="text-muted">No resume</span>
              @endif
            </td>
            <td>
              <button class="btn btn-sm btn-info" onclick="viewDetails({{ $applicant->id }})">
                <i class="fa fa-eye"></i>
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center py-4">No applications yet</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $applicants->links() }}
  </div>
</div>

<script>
function updateStatus(applicationId, status) {
  fetch(`/admin/job-applications/${applicationId}/status`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ status: status })
  })
  .then(response => response.json())
  .then(data => {
    if(data.success) {
      alert('Status updated successfully');
    }
  })
  .catch(error => console.error('Error:', error));
}

function viewDetails(applicationId) {
  // Implement view details modal
  alert('View details for application ID: ' + applicationId);
}
</script>
@endsection
