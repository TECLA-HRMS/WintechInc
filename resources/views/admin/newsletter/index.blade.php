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
    .btn-toggle { background: #eef2ff; color: #4f46e5; }
    .btn-del    { background: #fef2f2; color: #dc2626; }
    .nl-alert { border-radius: 10px; border: none; font-size: .875rem; padding: .875rem 1.25rem; margin-bottom: 1.25rem; }
    .stat-row { display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .stat-box { background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 1rem 1.5rem; flex: 1; min-width: 140px; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
    .stat-label { font-size: .72rem; color: #6b7280; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: #111827; }
</style>

<div class="nl-page">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show nl-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show nl-alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="nl-header">
        <div>
            <h1><i class="ti ti-mail me-2" style="color:#4f46e5"></i>Newsletter Management</h1>
            <div class="nl-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> / Newsletter
            </div>
        </div>
        <a href="{{ route('admin.newsletter.compose') }}" style="background:#4f46e5;color:#fff;border:none;border-radius:8px;padding:.65rem 1.5rem;font-size:.875rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem">
            <i class="ti ti-send"></i> Send Newsletter
        </a>
    </div>

    <div class="stat-row">
        <div class="stat-box">
            <div class="stat-label">Registered Users</div>
            <div class="stat-value" style="color:#4f46e5">{{ $totalUsers }}</div>
        </div>
    </div>

    <div class="nl-card">
        <table class="nl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: '—' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:2.5rem;color:#6b7280">No registered users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 1rem 1.5rem;">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
