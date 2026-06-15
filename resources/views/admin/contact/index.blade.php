@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --primary: #4f46e5; --primary-light: #eef2ff;
        --success: #059669; --success-light: #ecfdf5;
        --warning: #d97706; --warning-light: #fffbeb;
        --danger: #dc2626;  --danger-light: #fef2f2;
        --info: #0284c7;    --info-light: #f0f9ff;
        --text-dark: #111827; --text-muted: #6b7280;
        --border: #e5e7eb;  --bg-light: #f9fafb;
    }
    .ct-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    .ct-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .ct-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .ct-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .ct-breadcrumb a { color: var(--primary); text-decoration: none; }

    /* Stat Cards */
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.amber  { background: var(--warning-light); color: var(--warning); }
    .stat-icon.blue   { background: var(--info-light); color: var(--info); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    /* Main Card */
    .ct-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden; }
    .ct-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap; }
    .ct-card-title { font-size: 1rem; font-weight: 600; color: var(--text-dark); margin: 0; }
    .ct-card-body { padding: 1.5rem; }

    /* Search */
    .search-wrap { position: relative; }
    .search-wrap .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.78rem; pointer-events: none; }
    .search-wrap input { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 38px; padding-left: 34px; padding-right: 12px; width: 260px; color: var(--text-dark); background: var(--bg-light); outline: none; transition: border-color .2s; }
    .search-wrap input:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

    /* Table */
    .ct-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .ct-table thead th { background: var(--bg-light); color: var(--text-muted); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .ct-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .15s; }
    .ct-table tbody tr:last-child { border-bottom: none; }
    .ct-table tbody tr:hover { background: #fafafa; }
    .ct-table tbody td { padding: 0.9rem 1rem; color: var(--text-dark); vertical-align: middle; }

    /* Contact Avatar Cell */
    .ct-cell { display: flex; align-items: center; gap: 0.75rem; }
    .ct-av { width: 36px; height: 36px; border-radius: 9px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .ct-name { font-weight: 600; color: var(--text-dark); font-size: 0.875rem; }
    .ct-email { font-size: 0.72rem; color: var(--text-muted); }

    /* Subject badge */
    .subject-tag { display: inline-block; background: var(--primary-light); color: var(--primary); font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.65rem; border-radius: 20px; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    /* Description truncate */
    .desc-text { font-size: 0.8rem; color: var(--text-muted); max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; cursor: pointer; }

    /* Action Button */
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid #fecaca; background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all .15s; color: var(--danger); }
    .action-btn:hover { background: var(--danger-light); transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,.1); }

    /* Empty State */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }

    /* Pagination */
    .ct-pagination { display: flex; justify-content: space-between; align-items: center; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: .5rem; }
    .ct-pagination .info { font-size: .8rem; color: var(--text-muted); }
    .pagination-nav { display: flex; align-items: center; gap: 0.5rem; }
    .pagination-nav .page-link { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 6px; color: var(--text-dark); text-decoration: none; font-size: 0.875rem; transition: all 0.15s; }
    .pagination-nav .page-link:hover { background: var(--primary-light); border-color: var(--primary); color: var(--primary); }
    .pagination-nav .page-link.active { background: var(--primary); border-color: var(--primary); color: white; }
    .pagination-nav .page-link.disabled { opacity: 0.5; cursor: not-allowed; }
    .pagination-nav .page-link.disabled:hover { background: transparent; border-color: var(--border); color: var(--text-dark); }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: repeat(2,1fr); }
        .ct-header { flex-direction: column; align-items: flex-start; gap: .75rem; }
    }
</style>

<div class="ct-page">

    @if (Session::has('messageType') && Session::has('message'))
    <div class="alert alert-{{ Session::get('messageType') }} alert-dismissible fade show" id="message-alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>setTimeout(() => document.getElementById('message-alert')?.remove(), 3000);</script>
    @endif

    <!-- Page Header -->
    <div class="ct-header">
        <div>
            <h1><i class="fa-solid fa-address-book me-2" style="color:var(--primary)"></i>Contacts</h1>
            <div class="ct-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Contacts</span>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-address-book"></i></div>
            <div>
                <div class="stat-label">Total Contacts</div>
                <div class="stat-value">{{ $totalContacts }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-calendar-check"></i></div>
            <div>
                <div class="stat-label">This Month</div>
                <div class="stat-value">{{ \App\Models\Contact::where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-label">Today</div>
                <div class="stat-value">{{ \App\Models\Contact::where('created_at', '>=', now()->startOfDay())->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-envelope"></i></div>
            <div>
                <div class="stat-label">This Week</div>
                <div class="stat-value">{{ \App\Models\Contact::where('created_at', '>=', now()->startOfWeek())->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="ct-card">
        <div class="ct-card-header">
            <h2 class="ct-card-title">All Contacts</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="search-wrap">
                    <i class="fa-solid fa-magnifying-glass si"></i>
                    <input type="text" id="contactSearch" placeholder="Search name, email, subject...">
                </div>
                <span style="background:var(--primary-light);color:var(--primary);padding:.3rem .9rem;border-radius:20px;font-size:.78rem;font-weight:600;white-space:nowrap">
                    <span id="visibleCount">{{ $contacts->count() }}</span> of {{ $totalContacts }} Records
                </span>
            </div>
        </div>
        <div class="ct-card-body">
            <div class="table-responsive">
                <table class="ct-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name / Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="contactTableBody">
                        @forelse($contacts as $contact)
                        <tr id="contact-row-{{ $contact->id }}"
                            data-name="{{ strtolower($contact->name) }}"
                            data-email="{{ strtolower($contact->email) }}"
                            data-subject="{{ strtolower($contact->subject ?? '') }}">
                            <td style="font-size:.75rem;color:var(--text-muted);font-weight:600">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="ct-cell">
                                    <div class="ct-av">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="ct-name">{{ $contact->name }}</div>
                                        <div class="ct-email">{{ $contact->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.8rem">{{ $contact->phonenumber ?? '—' }}</td>
                            <td>
                                @if($contact->subject)
                                    <span class="subject-tag" title="{{ $contact->subject }}">{{ $contact->subject }}</span>
                                @else
                                    <span style="color:var(--text-muted);font-size:.8rem">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="desc-text" title="{{ $contact->description }}">
                                    {{ $contact->description ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div style="font-size:.78rem;color:var(--text-dark);font-weight:500">{{ $contact->created_at->format('M j, Y') }}</div>
                                <div style="font-size:.7rem;color:var(--text-muted)">{{ $contact->created_at->format('g:i A') }}</div>
                            </td>
                            <td style="text-align:center">
                                <button class="action-btn" onclick="deleteContact({{ $contact->id }})" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fa-solid fa-address-book"></i></div>
                                    <h5 style="font-weight:600;color:var(--text-dark)">No contacts yet</h5>
                                    <p style="color:var(--text-muted);font-size:.875rem;margin:0">Contact form submissions will appear here.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- No search results -->
            <div id="noResults" style="display:none;text-align:center;padding:2.5rem 1rem">
                <div class="empty-icon" style="margin:0 auto 1rem"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h5 style="font-weight:600;color:var(--text-dark)">No matching contacts</h5>
                <p style="color:var(--text-muted);font-size:.875rem;margin:0">Try a different search term.</p>
            </div>

            <!-- Footer -->
            <div class="ct-pagination">
                <div class="info">
                    Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }} contacts
                </div>
                @if($contacts->hasPages())
                <div class="pagination-nav">
                    @if($contacts->onFirstPage())
                        <span class="page-link disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $contacts->previousPageUrl() }}" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif
                    
                    @foreach($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                        @if($page == $contacts->currentPage())
                            <span class="page-link active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($contacts->hasMorePages())
                        <a href="{{ $contacts->nextPageUrl() }}" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="page-link disabled"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Live search
document.getElementById('contactSearch').addEventListener('input', function () {
    const term = this.value.toLowerCase();
    const rows = document.querySelectorAll('#contactTableBody tr[data-name]');
    let visible = 0;
    rows.forEach(row => {
        const match = row.dataset.name.includes(term) ||
                      row.dataset.email.includes(term) ||
                      row.dataset.subject.includes(term);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('visibleCount').textContent = visible;
    document.getElementById('noResults').style.display = visible === 0 && term !== '' ? 'block' : 'none';
});

function deleteContact(id) {
    Swal.fire({
        title: 'Delete this contact?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.contact.destroy', '') }}/" + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({ title: 'Deleted!', text: response.message, icon: 'success', timer: 1500, showConfirmButton: false });
                        $('#contact-row-' + id).fadeOut(300, function () { $(this).remove(); });
                    } else {
                        Swal.fire('Error', 'Failed to delete contact', 'error');
                    }
                },
                error: function () { Swal.fire('Error', 'Something went wrong!', 'error'); }
            });
        }
    });
}
</script>
@endsection
