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
    .pr-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }
    .pr-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .pr-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .pr-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .pr-breadcrumb a { color: var(--primary); text-decoration: none; }
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green  { background: var(--success-light); color: var(--success); }
    .stat-icon.amber  { background: var(--warning-light); color: var(--warning); }
    .stat-icon.blue   { background: var(--info-light); color: var(--info); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }
    .pr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden; }
    .pr-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .pr-card-title { font-size: 1rem; font-weight: 600; color: var(--text-dark); margin: 0; }
    .pr-card-body { padding: 1.5rem; }
    .filter-bar { background: var(--bg-light); border: 1px solid var(--border); border-radius: 10px; padding: 1.25rem; margin-bottom: 1.5rem; }
    .filter-label { font-size: 0.72rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block; }
    .filter-bar .form-control,
    .filter-bar .form-select { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 40px; background: #fff; color: var(--text-dark); box-shadow: none; }
    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.1); }
    .search-wrap { position: relative; }
    .search-wrap .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.78rem; pointer-events: none; }
    .search-wrap .form-control { padding-left: 34px; }
    .btn-filter { height: 40px; padding: 0 1.2rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer; text-decoration: none; }
    .btn-apply { background: var(--primary); color: #fff; border: none; }
    .btn-apply:hover { background: #4338ca; color: #fff; }
    .btn-reset { background: #fff; border: 1px solid var(--border); color: var(--text-muted); }
    .btn-reset:hover { background: var(--bg-light); color: var(--text-dark); }
    .active-tags { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem; }
    .active-tag { display: inline-flex; align-items: center; gap: 0.35rem; background: var(--primary-light); color: var(--primary); font-size: 0.72rem; font-weight: 600; padding: 0.3rem 0.7rem; border-radius: 20px; }
    .active-tag a { color: var(--primary); text-decoration: none; font-size: 1rem; line-height: 1; }
    .pr-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .pr-table thead tr th { background: var(--bg-light); color: var(--text-muted); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .pr-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .15s; }
    .pr-table tbody tr:last-child { border-bottom: none; }
    .pr-table tbody tr:hover { background: #fafafa; }
    .pr-table tbody td { padding: 0.9rem 1rem; color: var(--text-dark); vertical-align: middle; }
    .av-cell { display: flex; align-items: center; gap: 0.75rem; }
    .av { width: 38px; height: 38px; border-radius: 10px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
    .av img { width: 100%; height: 100%; object-fit: cover; }
    .av-name { font-weight: 600; color: var(--text-dark); font-size: 0.875rem; }
    .av-email { font-size: 0.72rem; color: var(--text-muted); }
    .completion-wrap { display: flex; align-items: center; gap: 0.5rem; }
    .completion-bar { flex: 1; height: 6px; background: #e5e7eb; border-radius: 10px; overflow: hidden; min-width: 60px; }
    .completion-fill { height: 100%; border-radius: 10px; }
    .completion-fill.high { background: var(--success); }
    .completion-fill.mid  { background: var(--warning); }
    .completion-fill.low  { background: var(--danger); }
    .completion-pct { font-size: 0.72rem; font-weight: 700; color: var(--text-muted); white-space: nowrap; }
    .gender-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.65rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
    .gender-badge.male   { background: var(--info-light); color: var(--info); }
    .gender-badge.female { background: #fdf2f8; color: #9d174d; }
    .gender-badge.other  { background: var(--bg-light); color: var(--text-muted); }
    .resume-yes { background: var(--success-light); color: var(--success); padding: 0.25rem 0.65rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; }
    .resume-yes:hover { background: #d1fae5; color: var(--success); }
    .resume-no  { background: var(--bg-light); color: var(--text-muted); padding: 0.25rem 0.65rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid var(--border); background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all .15s; text-decoration: none; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,.12); }
    .action-btn.view { color: var(--info); border-color: #bae6fd; }
    .action-btn.view:hover { background: var(--info-light); }
    .action-btn.del  { color: var(--danger); border-color: #fecaca; }
    .action-btn.del:hover  { background: var(--danger-light); }
    .pr-pagination { display: flex; justify-content: space-between; align-items: center; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 0.5rem; }
    .pr-pagination .info { font-size: 0.8rem; color: var(--text-muted); }
    .pr-pagination .pagination { margin: 0; }
    .pr-pagination .page-link { border-radius: 7px !important; margin: 0 2px; border: 1px solid var(--border); color: var(--text-dark); font-size: 0.8rem; padding: 0.35rem 0.65rem; }
    .pr-pagination .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: #fff; }
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }
    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .pr-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
    }
</style>

<div class="pr-page">

    @if (Session::has('messageType') && Session::has('message'))
    <div class="alert alert-{{ Session::get('messageType') }} alert-dismissible fade show" id="message-alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>setTimeout(() => document.getElementById('message-alert')?.remove(), 3000);</script>
    @endif

    <!-- Page Header -->
    <div class="pr-header">
        <div>
            <h1><i class="fa-solid fa-users me-2" style="color:var(--primary)"></i>User Profiles</h1>
            <div class="pr-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Profiles</span>
            </div>
        </div>
    </div>

    @php
        $totalUsers    = \App\Models\User::count();
        $withResume    = \App\Models\User::whereNotNull('resume')->where('resume','!=','')->count();
        $maleCount     = \App\Models\User::where('gender','male')->count();
        $femaleCount   = \App\Models\User::where('gender','female')->count();
        $thisMonth     = \App\Models\User::where('created_at','>=',now()->startOfMonth())->count();
    @endphp
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa-solid fa-file-lines"></i></div>
            <div>
                <div class="stat-label">With Resume</div>
                <div class="stat-value">{{ $withResume }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon amber"><i class="fa-solid fa-venus-mars"></i></div>
            <div>
                <div class="stat-label">Male / Female</div>
                <div class="stat-value" style="font-size:1.1rem">{{ $maleCount }} / {{ $femaleCount }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa-solid fa-calendar-plus"></i></div>
            <div>
                <div class="stat-label">This Month</div>
                <div class="stat-value">{{ $thisMonth }}</div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="pr-card">
       
        <div class="pr-card-body">

            <!-- Filter Bar -->
            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.profiles.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="filter-label">Search</label>
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass si"></i>
                                <input type="text" name="search" class="form-control" placeholder="Name, email, phone..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="filter-label">Location</label>
                            <select name="location" class="form-select">
                                <option value="">All Locations</option>
                                @foreach(\App\Models\User::whereNotNull('location')->where('location','!=','')->distinct()->orderBy('location')->pluck('location') as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ ucfirst($loc) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="filter-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">All Genders</option>
                                <option value="male"   {{ request('gender') == 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other"  {{ request('gender') == 'other'  ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="filter-label">Resume</label>
                            <select name="resume" class="form-select">
                                <option value="">All</option>
                                <option value="yes" {{ request('resume') == 'yes' ? 'selected' : '' }}>Has Resume</option>
                                <option value="no"  {{ request('resume') == 'no'  ? 'selected' : '' }}>No Resume</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="filter-label">Profile %</label>
                            <select name="completion" class="form-select">
                                <option value="">All Completion</option>
                                <option value="high" {{ request('completion') == 'high' ? 'selected' : '' }}>High (≥70%)</option>
                                <option value="mid"  {{ request('completion') == 'mid'  ? 'selected' : '' }}>Medium (40–69%)</option>
                                <option value="low"  {{ request('completion') == 'low'  ? 'selected' : '' }}>Low (&lt;40%)</option>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex gap-2">
                            <button type="submit" class="btn-filter btn-apply" title="Apply Filters">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.profiles.index') }}" class="btn-filter btn-reset" title="Reset">
                                <i class="fa-solid fa-rotate-right"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Active Filter Tags -->
            @if(request()->hasAny(['search','location','gender','resume','completion']))
            <div class="active-tags">
                @if(request('search'))
                    <span class="active-tag">Search: "{{ request('search') }}" <a href="{{ request()->fullUrlWithoutQuery(['search']) }}">×</a></span>
                @endif
                @if(request('location'))
                    <span class="active-tag">Location: {{ ucfirst(request('location')) }} <a href="{{ request()->fullUrlWithoutQuery(['location']) }}">×</a></span>
                @endif
                @if(request('gender'))
                    <span class="active-tag">Gender: {{ ucfirst(request('gender')) }} <a href="{{ request()->fullUrlWithoutQuery(['gender']) }}">×</a></span>
                @endif
                @if(request('resume'))
                    <span class="active-tag">Resume: {{ request('resume') == 'yes' ? 'Has Resume' : 'No Resume' }} <a href="{{ request()->fullUrlWithoutQuery(['resume']) }}">×</a></span>
                @endif
                @if(request('completion'))
                    @php $cMap = ['high'=>'High (≥70%)','mid'=>'Medium (40–69%)','low'=>'Low (<40%)']; @endphp
                    <span class="active-tag">Profile: {{ $cMap[request('completion')] ?? '' }} <a href="{{ request()->fullUrlWithoutQuery(['completion']) }}">×</a></span>
                @endif
                <a href="{{ route('admin.profiles.index') }}" style="font-size:.72rem;font-weight:600;color:var(--danger);text-decoration:none;padding:.3rem .7rem;border-radius:20px;border:1px solid #fecaca;background:var(--danger-light)">Clear All</a>
            </div>
            @endif

            <!-- Results count -->
            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.75rem">
                Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> – <strong>{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ $users->total() }}</strong> users
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="pr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name / Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Location</th>
                            <th>Profile</th>
                            <th>Resume</th>
                            <th>Joined</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        @php
                            $completion = $user->profile_completion ?? 0;
                            $fillClass  = $completion >= 70 ? 'high' : ($completion >= 40 ? 'mid' : 'low');
                            $hasResume  = !empty($user->resume);
                            $gender     = strtolower($user->gender ?? '');
                        @endphp
                        <tr id="user-row-{{ $user->id }}">
                            <td style="font-size:.75rem;color:var(--text-muted);font-weight:600">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="av-cell">
                                    <div class="av">
                                        @if(!empty($user->profile_picture))
                                            <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="">
                                        @else
                                            {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="av-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                                        <div class="av-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.8rem">{{ $user->phone ?? '—' }}</td>
                            <td>
                                @if($gender)
                                <span class="gender-badge {{ $gender }}">
                                    <i class="fa-solid fa-{{ $gender == 'male' ? 'mars' : ($gender == 'female' ? 'venus' : 'genderless') }}"></i>
                                    {{ ucfirst($gender) }}
                                </span>
                                @else
                                <span style="color:var(--text-muted);font-size:.8rem">—</span>
                                @endif
                            </td>
                            <td style="font-size:.8rem">{{ $user->location ?? '—' }}</td>
                            <td>
                                <div class="completion-wrap">
                                    <div class="completion-bar">
                                        <div class="completion-fill {{ $fillClass }}" style="width:{{ $completion }}%"></div>
                                    </div>
                                    <span class="completion-pct">{{ round($completion) }}%</span>
                                </div>
                            </td>
                            <td>
                                @if($hasResume)
                                    <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="resume-yes">
                                        <i class="fa-solid fa-file-pdf"></i> View
                                    </a>
                                @else
                                    <span class="resume-no">None</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size:.78rem;color:var(--text-dark);font-weight:500">{{ $user->created_at->format('M j, Y') }}</div>
                                <div style="font-size:.7rem;color:var(--text-muted)">{{ $user->created_at->format('g:i A') }}</div>
                            </td>
                            <td>
                                <div style="display:flex;gap:.4rem;justify-content:center">
                                    <a href="{{ route('admin.profile.show', $user->id) }}" class="action-btn view" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="action-btn del" onclick="deleteUser({{ $user->id }})" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fa-solid fa-users"></i></div>
                                    <h5 style="font-weight:600;color:var(--text-dark)">No users found</h5>
                                    <p style="color:var(--text-muted);font-size:.875rem;margin:0">Try adjusting your filters.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pr-pagination">
                <div class="info">
                    Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> – <strong>{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ $users->total() }}</strong> users
                </div>
                <div>{{ $users->appends(request()->query())->links() }}</div>
            </div>

        </div>
    </div>
</div>

<script>
function deleteUser(id) {
    Swal.fire({
        title: 'Delete this user?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
    }).then(function (result) {
        if (result.isConfirmed) {
            let url = "{{ route('admin.profile.destroy', ':id') }}".replace(':id', id);
            $.ajax({
                url: url,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({ title: 'Deleted!', icon: 'success', timer: 1500, showConfirmButton: false });
                        $('#user-row-' + id).fadeOut(300, function () { $(this).remove(); });
                    } else {
                        Swal.fire('Error', response.message || 'Failed to delete user', 'error');
                    }
                },
                error: function () { Swal.fire('Error', 'Something went wrong!', 'error'); }
            });
        }
    });
}
</script>
@endsection
