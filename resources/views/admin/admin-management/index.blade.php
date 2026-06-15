@extends('layouts.admin')

@section('adminContent')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<div class="am-wrap">

    {{-- HEADER --}}
    <div class="am-header">
        <div>
            <div class="am-title">Admin Accounts</div>
            <div class="am-sub">Manage all administrator accounts and their permissions.</div>
        </div>
        <a href="{{ route('admin.management.create') }}" class="am-btn-add">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Admin
        </a>
    </div>

    {{-- STATS ROW --}}
    <div class="am-stats">
        <div class="am-stat">
            <div class="am-stat__icon am-stat__icon--blue">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div>
                <div class="am-stat__val">{{ $admins->count() }}</div>
                <div class="am-stat__lbl">Total Admins</div>
            </div>
        </div>
        <div class="am-stat">
            <div class="am-stat__icon am-stat__icon--green">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
                <div class="am-stat__val">{{ $admins->where('status', 1)->count() }}</div>
                <div class="am-stat__lbl">Active</div>
            </div>
        </div>
        <div class="am-stat">
            <div class="am-stat__icon am-stat__icon--red">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
            <div>
                <div class="am-stat__val">{{ $admins->where('status', 0)->count() }}</div>
                <div class="am-stat__lbl">Inactive</div>
            </div>
        </div>
    </div>

    {{-- TABLE PANEL --}}
    <div class="am-panel">
        <div class="am-panel__head">
            <div class="am-panel__title">All Administrators</div>
            <div class="am-search-wrap">
                <svg class="am-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="amSearch" class="am-search" placeholder="Search admins…">
            </div>
        </div>

        <div class="am-table-wrap">
            <table class="am-table" id="amTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Admin</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $i => $admin)
                    <tr>
                        <td class="am-td-num">{{ $i + 1 }}</td>
                        <td>
                            <div class="am-user">
                                <div class="am-avatar">{{ strtoupper(substr($admin->name, 0, 2)) }}</div>
                                <div>
                                    <div class="am-user__name">{{ $admin->name }}</div>
                                    <div class="am-user__email">{{ $admin->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="am-role">{{ ucfirst(str_replace('_', ' ', $admin->role)) }}</span>
                        </td>
                        <td>
                            @if($admin->status)
                                <span class="am-badge am-badge--green">
                                    <span class="am-badge__dot"></span> Active
                                </span>
                            @else
                                <span class="am-badge am-badge--red">
                                    <span class="am-badge__dot"></span> Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="am-actions">
                                <a href="{{ route('admin.management.edit', $admin->id) }}" class="am-btn am-btn--edit" title="Edit">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.management.destroy', $admin->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="am-btn am-btn--delete" title="Delete">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($admins->isEmpty())
            <div class="am-empty">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                <p>No admin accounts found.</p>
                <a href="{{ route('admin.management.create') }}" class="am-btn-add">Add your first admin</a>
            </div>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Delete this admin?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#e2e8f0',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel',
            customClass: { cancelButton: 'swal-cancel-dark' }
        }).then(r => { if (r.isConfirmed) form.submit(); });
    });
});

document.getElementById('amSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#amTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

<style>
.am-wrap{font-family:'Inter',-apple-system,sans-serif;padding:24px;background:#f1f5f9;min-height:100vh;display:flex;flex-direction:column;gap:20px;color:#0f172a}

/* HEADER */
.am-header{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
.am-title{font-size:20px;font-weight:600;color:#0f172a}
.am-sub{font-size:13px;color:#64748b;margin-top:3px}
.am-btn-add{display:inline-flex;align-items:center;gap:7px;background:#3b82f6;color:#fff;font-size:13px;font-weight:500;padding:9px 18px;border-radius:10px;text-decoration:none;transition:background .15s;white-space:nowrap;font-family:'Inter',sans-serif;border:none;cursor:pointer}
.am-btn-add:hover{background:#2563eb;color:#fff}

/* STATS */
.am-stats{display:flex;gap:14px;flex-wrap:wrap}
.am-stat{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:14px;flex:1;min-width:140px}
.am-stat__icon{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.am-stat__icon--blue{background:#dbeafe;color:#2563eb}
.am-stat__icon--green{background:#dcfce7;color:#15803d}
.am-stat__icon--red{background:#fee2e2;color:#b91c1c}
.am-stat__val{font-size:24px;font-weight:700;color:#0f172a;line-height:1}
.am-stat__lbl{font-size:12px;color:#64748b;margin-top:2px}

/* PANEL */
.am-panel{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden}
.am-panel__head{display:flex;justify-content:space-between;align-items:center;padding:18px 22px;border-bottom:1px solid #f1f5f9;gap:12px;flex-wrap:wrap}
.am-panel__title{font-size:15px;font-weight:600;color:#0f172a}
.am-search-wrap{position:relative}
.am-search-icon{position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;pointer-events:none}
.am-search{font-family:'Inter',sans-serif;font-size:13px;color:#0f172a;background:#f8fafc;border:1px solid #e2e8f0;border-radius:9px;padding:7px 12px 7px 32px;outline:none;width:220px;transition:border-color .15s}
.am-search:focus{border-color:#3b82f6}

/* TABLE */
.am-table-wrap{overflow-x:auto}
.am-table{width:100%;border-collapse:collapse;font-size:13px}
.am-table thead tr{background:#f8fafc}
.am-table th{padding:11px 18px;text-align:left;font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap;border-bottom:1px solid #f1f5f9}
.am-table td{padding:14px 18px;border-bottom:1px solid #f8fafc;vertical-align:middle}
.am-table tbody tr:last-child td{border-bottom:none}
.am-table tbody tr:hover{background:#fafbff}
.am-td-num{color:#94a3b8;font-size:12px;font-weight:500;width:40px}

/* USER CELL */
.am-user{display:flex;align-items:center;gap:11px}
.am-avatar{width:36px;height:36px;border-radius:10px;background:#dbeafe;color:#2563eb;font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.am-user__name{font-size:13px;font-weight:600;color:#0f172a}
.am-user__email{font-size:12px;color:#94a3b8;margin-top:1px}

/* ROLE */
.am-role{font-size:12px;font-weight:500;color:#475569;background:#f1f5f9;padding:3px 10px;border-radius:99px}

/* BADGE */
.am-badge{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:500;padding:4px 10px;border-radius:99px}
.am-badge--green{background:#dcfce7;color:#15803d}
.am-badge--red{background:#fee2e2;color:#b91c1c}
.am-badge__dot{width:6px;height:6px;border-radius:50%;background:currentColor;flex-shrink:0}

/* ACTIONS */
.am-actions{display:flex;align-items:center;gap:8px}
.am-btn{display:inline-flex;align-items:center;gap:5px;font-family:'Inter',sans-serif;font-size:12px;font-weight:500;padding:6px 12px;border-radius:8px;cursor:pointer;text-decoration:none;transition:all .15s;border:1px solid transparent}
.am-btn--edit{background:#eff6ff;color:#2563eb;border-color:#bfdbfe}
.am-btn--edit:hover{background:#dbeafe;color:#1d4ed8}
.am-btn--delete{background:#fff;color:#ef4444;border-color:#fecaca}
.am-btn--delete:hover{background:#fee2e2}

/* EMPTY */
.am-empty{display:flex;flex-direction:column;align-items:center;gap:12px;padding:60px 20px;color:#94a3b8;font-size:14px}

/* RESPONSIVE */
@media(max-width:768px){.am-search{width:160px}.am-table th:nth-child(1),.am-table td:nth-child(1){display:none}}
@media(max-width:600px){.am-wrap{padding:16px}.am-header{flex-direction:column;align-items:flex-start}}

.layout-navbar-fixed .layout-wrapper:not(.layout-horizontal):not(.layout-without-menu) .layout-page{padding-top:22px!important;background-color:#f1f5f9!important}
</style>

@endsection
