@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --primary: #4f46e5; --primary-light: #eef2ff;
        --success: #059669; --success-light: #ecfdf5;
        --danger: #dc2626;  --danger-light: #fef2f2;
        --info: #0284c7;    --info-light: #f0f9ff;
        --text-dark: #111827; --text-muted: #6b7280;
        --border: #e5e7eb;  --bg-light: #f9fafb;
    }
    .ec-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    /* Header */
    .ec-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .ec-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .ec-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .ec-breadcrumb a { color: var(--primary); text-decoration: none; }

    /* Add Button */
    .btn-add { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.25rem; background: var(--primary); color: #fff; border: none; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all .2s; }
    .btn-add:hover { background: #4338ca; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.3); }

    /* Stat Cards */
    .stat-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.blue   { background: var(--info-light); color: var(--info); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    /* Main Card */
    .ec-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden; }
    .ec-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .ec-card-title { font-size: 1rem; font-weight: 600; color: var(--text-dark); margin: 0; }
    .ec-card-body { padding: 1.5rem; }

    /* Search Bar */
    .search-wrap { position: relative; max-width: 320px; }
    .search-wrap .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.78rem; pointer-events: none; }
    .search-wrap input { width: 100%; border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 38px; padding-left: 34px; padding-right: 12px; color: var(--text-dark); background: var(--bg-light); outline: none; transition: border-color .2s; }
    .search-wrap input:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

    /* Table */
    .ec-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .ec-table thead th { background: var(--bg-light); color: var(--text-muted); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .ec-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .15s; }
    .ec-table tbody tr:last-child { border-bottom: none; }
    .ec-table tbody tr:hover { background: #fafafa; }
    .ec-table tbody td { padding: 1rem 1rem; color: var(--text-dark); vertical-align: middle; }

    /* Email Avatar */
    .email-cell { display: flex; align-items: center; gap: 0.75rem; }
    .email-av { width: 38px; height: 38px; border-radius: 10px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .email-name { font-weight: 600; color: var(--text-dark); font-size: 0.875rem; }
    .email-addr { font-size: 0.72rem; color: var(--text-muted); }

    /* Action Buttons */
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid var(--border); background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all .15s; text-decoration: none; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,.12); }
    .action-btn.edit { color: var(--primary); border-color: #c7d2fe; }
    .action-btn.edit:hover { background: var(--primary-light); }
    .action-btn.del  { color: var(--danger); border-color: #fecaca; }
    .action-btn.del:hover  { background: var(--danger-light); }

    /* Empty State */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: 1fr; }
        .ec-header { flex-direction: column; align-items: flex-start; gap: .75rem; }
    }
</style>

<div class="ec-page">

    @if (Session::has('messageType') && Session::has('message'))
    <div class="alert alert-{{ Session::get('messageType') }} alert-dismissible fade show" id="message-alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>setTimeout(() => document.getElementById('message-alert')?.remove(), 3000);</script>
    @endif

    <!-- Page Header -->
    <div class="ec-header">
        <div>
            <h1><i class="fa-solid fa-envelope-open-text me-2" style="color:var(--primary)"></i>Email Configuration</h1>
            <div class="ec-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Email Config</span>
            </div>
        </div>
        <a href="{{ route('admin.emailconfig.create') }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Add New Email
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-envelope"></i></div>
            <div>
                <div class="stat-label">Total Emails</div>
                <div class="stat-value">{{ $emails->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-label">Configured</div>
                <div class="stat-value">{{ $emails->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="ec-card">
        <div class="ec-card-header">
            <h2 class="ec-card-title">All Email Addresses</h2>
            <div class="search-wrap">
                <i class="fa-solid fa-magnifying-glass si"></i>
                <input type="text" id="emailSearch" placeholder="Search name or email...">
            </div>
        </div>
        <div class="ec-card-body">
            <div class="table-responsive">
                <table class="ec-table" id="emailTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name / Email</th>
                            <th>Added</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="emailTableBody">
                        @forelse($emails as $email)
                        <tr id="email-row-{{ $email->id }}"
                            data-name="{{ strtolower($email->name) }}"
                            data-email="{{ strtolower($email->email) }}">
                            <td style="font-size:.75rem;color:var(--text-muted);font-weight:600">{{ $loop->iteration }}</td>
                            <td>
                                <div class="email-cell">
                                    <div class="email-av">{{ strtoupper(substr($email->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="email-name">{{ $email->name }}</div>
                                        <div class="email-addr">{{ $email->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.78rem;color:var(--text-muted)">
                                {{ $email->created_at ? $email->created_at->format('M j, Y') : '—' }}
                            </td>
                            <td>
                                <div style="display:flex;gap:.4rem;justify-content:center">
                                    <a href="{{ route('admin.emailconfig.edit', $email->id) }}" class="action-btn edit" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button class="action-btn del" onclick="deleteEmail({{ $email->id }})" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fa-solid fa-envelope"></i></div>
                                    <h5 style="font-weight:600;color:var(--text-dark)">No emails configured</h5>
                                    <p style="color:var(--text-muted);font-size:.875rem;margin:0 0 1rem">Add your first email address to get started.</p>
                                    <a href="{{ route('admin.emailconfig.create') }}" class="btn-add">
                                        <i class="fa-solid fa-plus"></i> Add Email
                                    </a>
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
                <h5 style="font-weight:600;color:var(--text-dark)">No matching emails</h5>
                <p style="color:var(--text-muted);font-size:.875rem;margin:0">Try a different search term.</p>
            </div>

            <!-- Footer count -->
            <div style="padding-top:1rem;border-top:1px solid var(--border);margin-top:.5rem;font-size:.8rem;color:var(--text-muted)">
                Showing <strong id="visibleCount">{{ $emails->count() }}</strong> of <strong>{{ $emails->count() }}</strong> emails
            </div>
        </div>
    </div>
</div>

<script>
// Live search
document.getElementById('emailSearch').addEventListener('input', function () {
    const term = this.value.toLowerCase();
    const rows = document.querySelectorAll('#emailTableBody tr[data-name]');
    let visible = 0;
    rows.forEach(row => {
        const match = row.dataset.name.includes(term) || row.dataset.email.includes(term);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('visibleCount').textContent = visible;
    document.getElementById('noResults').style.display = visible === 0 ? 'block' : 'none';
});

function deleteEmail(id) {
    Swal.fire({
        title: 'Delete this email?',
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
                url: "{{ route('admin.emailconfig.destroy', '') }}/" + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({ title: 'Deleted!', text: response.message, icon: 'success', timer: 1500, showConfirmButton: false });
                        $('#email-row-' + id).fadeOut(300, function () { $(this).remove(); });
                    } else {
                        Swal.fire('Error', 'Failed to delete email', 'error');
                    }
                },
                error: function () { Swal.fire('Error', 'Something went wrong!', 'error'); }
            });
        }
    });
}
</script>
@endsection
