@extends('layouts.admin')

@section('adminContent')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<div class="al-wrap">
    <div class="al-header">
        <div>
            <div class="al-title">Activity Logs</div>
            <div class="al-sub">Track admin activity across every module in the admin panel.</div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="al-filter">
        <div class="al-field">
            <label>Admin</label>
            <input type="text" name="admin" value="{{ request('admin') }}" placeholder="Name or email">
        </div>
        <div class="al-field">
            <label>Module</label>
            <select name="module">
                <option value="">All Modules</option>
                @foreach($modules as $module)
                    <option value="{{ $module }}" {{ request('module') === $module ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $module)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="al-field">
            <label>Date</label>
            <input type="date" name="date" value="{{ request('date') }}">
        </div>
        <div class="al-actions">
            <button type="submit" class="al-btn al-btn--primary">Filter</button>
            <a href="{{ route('admin.activity-logs.index') }}" class="al-btn al-btn--ghost">Reset</a>
        </div>
    </form>

    <div class="al-panel">
        <div class="al-panel__head">
            <div class="al-panel__title">Recent Activity</div>
            <div class="al-count">{{ $logs->total() }} records</div>
        </div>

        <div class="al-table-wrap">
            <table class="al-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Admin</th>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Request</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="al-time">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</div>
                                <div class="al-muted">{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="al-admin">{{ $log->admin_name ?? 'Unknown' }}</div>
                                <div class="al-muted">{{ $log->admin_email ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="al-chip">{{ ucwords(str_replace('_', ' ', $log->module ?? 'admin')) }}</span>
                            </td>
                            <td>
                                <span class="al-action al-action--{{ strtolower($log->method) }}">
                                    {{ ucwords(str_replace('_', ' ', $log->action ?? $log->method)) }}
                                </span>
                            </td>
                            <td>
                                <div class="al-request">
                                    <span class="al-method">{{ $log->method }}</span>
                                    <span class="al-status">{{ $log->status_code }}</span>
                                </div>
                                <div class="al-route">{{ $log->route_name ?? $log->url }}</div>
                            </td>
                            <td>
                                <div class="al-ip">{{ $log->ip_address ?? '-' }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="al-empty">No activity logs found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="al-pagination">
            {{ $logs->links('includes.admin.pagination') }}
        </div>
    </div>
</div>

<style>
.al-wrap{font-family:'Inter',-apple-system,sans-serif;padding:24px;background:#f1f5f9;min-height:100vh;color:#0f172a}
.al-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
.al-title{font-size:22px;font-weight:700;color:#0f172a}
.al-sub{font-size:13px;color:#64748b;margin-top:4px}
.al-filter{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px;display:grid;grid-template-columns:1.2fr 1fr 1fr auto;gap:12px;align-items:end;margin-bottom:18px}
.al-field label{display:block;font-size:12px;font-weight:600;color:#64748b;margin-bottom:6px}
.al-field input,.al-field select{width:100%;height:39px;border:1px solid #e2e8f0;border-radius:9px;padding:0 12px;font-family:'Inter',sans-serif;font-size:13px;color:#0f172a;background:#fff;outline:none}
.al-field input:focus,.al-field select:focus{border-color:#3b82f6}
.al-actions{display:flex;gap:8px}
.al-btn{height:39px;display:inline-flex;align-items:center;justify-content:center;border-radius:9px;padding:0 15px;font-size:13px;font-weight:600;text-decoration:none;border:1px solid transparent;cursor:pointer;font-family:'Inter',sans-serif;white-space:nowrap}
.al-btn--primary{background:#3b82f6;color:#fff;border-color:#3b82f6}
.al-btn--ghost{background:#fff;color:#64748b;border-color:#e2e8f0}
.al-panel{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden}
.al-panel__head{display:flex;justify-content:space-between;align-items:center;padding:18px 22px;border-bottom:1px solid #f1f5f9}
.al-panel__title{font-size:15px;font-weight:700;color:#0f172a}
.al-count{font-size:12px;color:#64748b;background:#f1f5f9;border-radius:99px;padding:4px 10px}
.al-table-wrap{overflow-x:auto}
.al-table{width:100%;border-collapse:collapse;font-size:13px}
.al-table th{background:#f8fafc;color:#94a3b8;font-size:11px;letter-spacing:.06em;text-transform:uppercase;text-align:left;padding:12px 18px;border-bottom:1px solid #f1f5f9;white-space:nowrap}
.al-table td{padding:14px 18px;border-bottom:1px solid #f8fafc;vertical-align:middle}
.al-table tbody tr:hover{background:#fafbff}
.al-time,.al-admin,.al-ip{font-weight:600;color:#0f172a}
.al-muted,.al-route{font-size:12px;color:#94a3b8;margin-top:2px;max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.al-chip{display:inline-flex;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;border-radius:99px;padding:4px 10px;font-size:12px;font-weight:600;white-space:nowrap}
.al-action{display:inline-flex;border-radius:99px;padding:4px 10px;font-size:12px;font-weight:600;background:#f1f5f9;color:#475569;white-space:nowrap}
.al-action--post{background:#dcfce7;color:#15803d}
.al-action--put,.al-action--patch{background:#fef3c7;color:#b45309}
.al-action--delete{background:#fee2e2;color:#b91c1c}
.al-request{display:flex;gap:6px;align-items:center}
.al-method{font-size:11px;font-weight:700;color:#fff;background:#0f172a;border-radius:6px;padding:3px 6px}
.al-status{font-size:11px;font-weight:700;color:#15803d;background:#dcfce7;border-radius:6px;padding:3px 6px}
.al-empty{text-align:center;color:#94a3b8;padding:38px}
.al-pagination{padding:14px 18px;border-top:1px solid #f1f5f9}
@media(max-width:900px){.al-filter{grid-template-columns:1fr}.al-actions{justify-content:flex-start}.al-wrap{padding:16px}}
.layout-navbar-fixed .layout-wrapper:not(.layout-horizontal):not(.layout-without-menu) .layout-page{padding-top:22px!important;background-color:#f1f5f9!important}
</style>
@endsection
