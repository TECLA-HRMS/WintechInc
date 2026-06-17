@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --brand: #071056; 
        --brand-light: #16248c;
        --brand-faint: rgba(7, 16, 86, 0.05);
        --success: #059669; --success-light: #ecfdf5;
        --warning: #d97706; --warning-light: #fffbeb;
        --danger: #dc2626;  --danger-light: #fef2f2;
        --info: #0284c7;    --info-light: #f0f9ff;
        --text-dark: #0f172a; --text-secondary: #475569; --text-muted: #64748b;
        --border: #e2e8f0;  --bg-main: #f4f7fb; --bg-light: #f8fafc;
    }

    body { font-family: 'Inter', sans-serif; }
    .sp-page { background: var(--bg-main); min-height: 100vh; padding: 2rem 1.5rem; }

    /* Header */
    .sp-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; }
    .sp-header h1 { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin: 0 0 0.4rem; letter-spacing: -0.5px; }
    .sp-breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; font-weight: 500; color: var(--text-muted); }
    .sp-breadcrumb a { color: var(--brand); text-decoration: none; transition: color 0.2s; }
    .sp-breadcrumb a:hover { color: var(--brand-light); }

    /* Back Button */
    .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.25rem; border: 1px solid var(--border); border-radius: 12px; background: #fff; color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all .2s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); border-color: #cbd5e1; transform: translateY(-1px); }

    /* Profile Hero */
    .profile-hero { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,.03); transition: all 0.3s; position: relative; overflow: hidden; }
    .profile-hero::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: linear-gradient(180deg, var(--brand), var(--brand-light)); }
    .profile-av { width: 96px; height: 96px; border-radius: 20px; background: linear-gradient(135deg, var(--brand), var(--brand-light)); color: #fff; font-size: 2.5rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; box-shadow: 0 8px 20px rgba(7, 16, 86, 0.2); border: 2px solid #fff; }
    .profile-av img { width: 100%; height: 100%; object-fit: cover; }
    .profile-name { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin: 0 0 0.5rem; letter-spacing: -0.3px; }
    .profile-meta { display: flex; flex-wrap: wrap; gap: 1.25rem; margin-top: 0.75rem; }
    .profile-meta-item { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; font-weight: 500; color: var(--text-secondary); background: var(--bg-light); padding: 6px 12px; border-radius: 8px; border: 1px solid var(--border); }
    .profile-meta-item i { color: var(--brand-light); opacity: 0.8; }

    /* Completion bar */
    .completion-wrap { display: flex; align-items: center; gap: 0.75rem; }
    .completion-bar { width: 140px; height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden; }
    .completion-fill { height: 100%; border-radius: 10px; transition: width 0.5s ease; }
    .completion-fill.high { background: linear-gradient(90deg, #10b981, #059669); }
    .completion-fill.mid  { background: linear-gradient(90deg, #f59e0b, #d97706); }
    .completion-fill.low  { background: linear-gradient(90deg, #ef4444, #dc2626); }
    .completion-pct { font-size: 0.85rem; font-weight: 700; color: var(--text-dark); }

    /* Info Card */
    .info-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,.02); margin-bottom: 1.5rem; transition: transform 0.2s; }
    .info-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,.04); }
    .info-card-header { padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border); background: #fff; display: flex; align-items: center; gap: 0.75rem; }
    .info-card-header h6 { margin: 0; font-size: 0.9rem; font-weight: 800; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.5px; }
    .card-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
    .info-card-body { padding: 1.75rem; }

    /* Info Grid */
    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
    .info-grid.full { grid-template-columns: 1fr; }
    .info-item { background: var(--bg-light); border: 1px solid var(--border); border-radius: 12px; padding: 1rem 1.25rem; transition: background 0.2s; }
    .info-item:hover { background: #fff; border-color: #cbd5e1; }
    .info-item-label { font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.4rem; }
    .info-item-value { font-size: 0.95rem; font-weight: 600; color: var(--text-dark); }
    .info-item-value a { color: var(--brand); text-decoration: none; }
    .info-item-value a:hover { text-decoration: underline; }

    /* Section Table */
    .sp-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .sp-table thead th { background: var(--bg-light); color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 1rem 1.25rem; border-bottom: 2px solid var(--border); white-space: nowrap; }
    .sp-table tbody tr { transition: background .2s; }
    .sp-table tbody tr:hover { background: var(--bg-main); }
    .sp-table tbody td { padding: 1rem 1.25rem; color: var(--text-dark); vertical-align: middle; border-bottom: 1px solid var(--border); }
    .sp-table tbody tr:last-child td { border-bottom: none; }

    /* Timeline for experience */
    .timeline { position: relative; padding-left: 2rem; }
    .timeline::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background: var(--border); }
    .timeline-item { position: relative; padding-bottom: 2rem; }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-dot { position: absolute; left: -2.35rem; top: 0.25rem; width: 14px; height: 14px; border-radius: 50%; background: var(--border); border: 3px solid #fff; box-shadow: 0 0 0 2px var(--border); }
    .timeline-dot.active { background: var(--success); box-shadow: 0 0 0 2px var(--success-light); }
    .timeline-title { font-size: 1rem; font-weight: 800; color: var(--text-dark); margin: 0 0 0.25rem; }
    .timeline-company { font-size: 0.85rem; font-weight: 500; color: var(--text-secondary); margin: 0 0 0.6rem; }
    .timeline-meta { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .timeline-tag { font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.8rem; border-radius: 20px; background: var(--bg-light); color: var(--text-secondary); border: 1px solid var(--border); }
    .timeline-tag.active { background: var(--success-light); color: var(--success); border-color: #a7f3d0; }

    /* Skill Tags */
    .skill-tag { display: inline-flex; align-items: center; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; background: #fff; color: var(--text-dark); border: 1px solid var(--border); margin: 0.25rem; box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: all 0.2s; }
    .skill-tag:hover { background: var(--brand-faint); border-color: var(--brand-light); color: var(--brand); transform: translateY(-1px); }

    /* Resume Button */
    .resume-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.75rem; border-radius: 12px; background: linear-gradient(135deg, #ef4444, #b91c1c); color: #fff; font-size: 0.9rem; font-weight: 700; text-decoration: none; transition: all .3s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 4px 15px rgba(220,38,38,.2); }
    .resume-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(220,38,38,.3); color: #fff; }

    /* Empty state */
    .empty-mini { text-align: center; padding: 2.5rem 1.5rem; color: var(--text-muted); font-size: 0.9rem; font-weight: 500; background: var(--bg-light); border-radius: 12px; border: 1px dashed var(--border); }
    .empty-mini i { font-size: 2rem; display: block; margin-bottom: 0.75rem; color: #cbd5e1; }

    /* Gender badge */
    .gender-badge { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: capitalize; }
    .gender-badge.male   { background: var(--info-light); color: var(--info); border: 1px solid #bae6fd; }
    .gender-badge.female { background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; }
    .gender-badge.other  { background: var(--bg-light); color: var(--text-secondary); border: 1px solid var(--border); }

    @media (max-width: 768px) {
        .sp-page { padding: 1.5rem 1rem; }
        .profile-hero { flex-direction: column; align-items: center; text-align: center; padding: 2rem 1.5rem; gap: 1.25rem; }
        .profile-meta { justify-content: center; }
        .d-flex.align-items-center.gap-3.flex-wrap { justify-content: center; }
        .completion-wrap { justify-content: center; }
        .sp-header { flex-direction: column; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
        .info-grid { grid-template-columns: 1fr; }
        .info-card-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .info-card-header span { margin-left: 0 !important; }
    }
</style>

<div class="sp-page">

    <!-- Header -->
    <div class="sp-header">
        <div>
            <h1><i class="fa-solid fa-user me-2" style="color:var(--primary)"></i>{{ $user->first_name }} {{ $user->last_name }}</h1>
            <div class="sp-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.profiles.index') }}">admin.profiles</a>
                <span>/</span>
                <span>{{ $user->first_name }} {{ $user->last_name }}</span>
            </div>
        </div>
        <a href="{{ route('admin.profiles.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Profile Hero -->
    @php
        $completion = $user->profile_completion ?? 0;
        $fillClass  = $completion >= 70 ? 'high' : ($completion >= 40 ? 'mid' : 'low');
        $gender     = strtolower($user->gender ?? '');
    @endphp
    <div class="profile-hero">
        <div class="profile-av">
            @if($user->profile_picture)
                <img loading="lazy" src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="">
            @else
                {{ strtoupper(substr($user->first_name, 0, 1)) }}
            @endif
        </div>
        <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <p class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</p>
                @if($gender)
                <span class="gender-badge {{ $gender }}">
                    <i class="fa-solid fa-{{ $gender == 'male' ? 'mars' : ($gender == 'female' ? 'venus' : 'genderless') }}"></i>
                    {{ ucfirst($gender) }}
                </span>
                @endif
            </div>
            <div class="profile-meta">
                <span class="profile-meta-item"><i class="fa-solid fa-envelope"></i> {{ $user->email }}</span>
                @if($user->phone)
                <span class="profile-meta-item"><i class="fa-solid fa-phone"></i> {{ $user->phone }}</span>
                @endif
                @if($user->location)
                <span class="profile-meta-item"><i class="fa-solid fa-location-dot"></i> {{ $user->location }}</span>
                @endif
                @if($user->pincode)
                <span class="profile-meta-item"><i class="fa-solid fa-map-pin"></i> {{ $user->pincode }}</span>
                @endif
            </div>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span style="font-size:.72rem;font-weight:600;color:var(--text-muted)">Profile Completion</span>
                <div class="completion-wrap">
                    <div class="completion-bar">
                        <div class="completion-fill {{ $fillClass }}" style="width:{{ $completion }}%"></div>
                    </div>
                    <span class="completion-pct">{{ round($completion) }}%</span>
                </div>
            </div>
        </div>
        <div class="text-end d-none d-md-block">
            <div style="font-size:.72rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em">Joined</div>
            <div style="font-size:.9rem;font-weight:600;color:var(--text-dark)">{{ $user->created_at->format('M j, Y') }}</div>
            <div style="font-size:.75rem;color:var(--text-muted)">{{ $user->created_at->format('g:i A') }}</div>
        </div>
    </div>

    <div class="row g-3">

        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Personal Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--primary-light);color:var(--primary)"><i class="fa-solid fa-id-card"></i></div>
                    <h6>Personal Information</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-label">First Name</div>
                            <div class="info-item-value">{{ $user->first_name ?? '—' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Last Name</div>
                            <div class="info-item-value">{{ $user->last_name ?? '—' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Email</div>
                            <div class="info-item-value"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Phone</div>
                            <div class="info-item-value">
                                @if($user->phone)<a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>@else —@endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Gender</div>
                            <div class="info-item-value">{{ ucfirst($user->gender ?? '—') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Pincode</div>
                            <div class="info-item-value">{{ $user->pincode ?? '—' }}</div>
                        </div>
                        <div class="info-item" style="grid-column:1/-1">
                            <div class="info-item-label">Address</div>
                            <div class="info-item-value">{{ $user->address ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:#f3e8ff;color:#7c3aed"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h6>Education</h6>
                    @if($user->educations && $user->educations->count() > 0)
                    <span style="margin-left:auto;background:var(--primary-light);color:var(--primary);padding:.2rem .6rem;border-radius:20px;font-size:.72rem;font-weight:600">
                        {{ $user->educations->count() }} {{ Str::plural('Entry', $user->educations->count()) }}
                    </span>
                    @endif
                </div>
                <div class="info-card-body">
                    @if($user->educations && $user->educations->count() > 0)
                    <div class="table-responsive">
                        <table class="sp-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Degree</th>
                                    <th>Institution</th>
                                    <th>Subject</th>
                                    <th>GPA</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->educations as $i => $edu)
                                <tr>
                                    <td style="color:var(--text-muted);font-size:.75rem;font-weight:600">{{ $i + 1 }}</td>
                                    <td><strong>{{ $edu->degree ?? '—' }}</strong></td>
                                    <td>{{ $edu->institution ?? '—' }}</td>
                                    <td>{{ $edu->subject ?? '—' }}</td>
                                    <td>{{ $edu->gpa ?? '—' }}</td>
                                    <td>{{ $edu->year ?? '—' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-mini"><i class="fa-solid fa-graduation-cap"></i>No education details added.</div>
                    @endif
                </div>
            </div>

            <!-- Experience -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--success-light);color:var(--success)"><i class="fa-solid fa-briefcase"></i></div>
                    <h6>Experience</h6>
                    @if($user->experiences && $user->experiences->count() > 0)
                    <span style="margin-left:auto;background:var(--success-light);color:var(--success);padding:.2rem .6rem;border-radius:20px;font-size:.72rem;font-weight:600">
                        {{ $user->experiences->count() }} {{ Str::plural('Entry', $user->experiences->count()) }}
                    </span>
                    @endif
                </div>
                <div class="info-card-body">
                    @if($user->experiences && $user->experiences->count() > 0)
                    <div class="timeline">
                        @foreach($user->experiences as $exp)
                        <div class="timeline-item">
                            <div class="timeline-dot {{ $exp->currently_working ? 'active' : '' }}"></div>
                            <div class="timeline-title">{{ $exp->job_title ?? '—' }}</div>
                            <div class="timeline-company">
                                <i class="fa-solid fa-building" style="font-size:.7rem;margin-right:.3rem"></i>{{ $exp->company ?? '—' }}
                                @if($exp->location) · <i class="fa-solid fa-location-dot" style="font-size:.7rem;margin-right:.2rem"></i>{{ $exp->location }}@endif
                            </div>
                            <div class="timeline-meta">
                                <span class="timeline-tag">{{ ucfirst(str_replace('_',' ',$exp->employment_type ?? 'Full-time')) }}</span>
                                <span class="timeline-tag">{{ ucfirst($exp->start_month ?? '') }} {{ $exp->start_year ?? '' }} – {{ $exp->currently_working ? 'Present' : (ucfirst($exp->end_month ?? '') . ' ' . ($exp->end_year ?? '')) }}</span>
                                @if($exp->currently_working)<span class="timeline-tag active">Currently Working</span>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-mini"><i class="fa-solid fa-briefcase"></i>No experience details added.</div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="col-lg-4">

            <!-- Skills -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--warning-light);color:var(--warning)"><i class="fa-solid fa-lightbulb"></i></div>
                    <h6>Skills</h6>
                    @if($user->skills && $user->skills->count() > 0)
                    <span style="margin-left:auto;background:var(--warning-light);color:var(--warning);padding:.2rem .6rem;border-radius:20px;font-size:.72rem;font-weight:600">
                        {{ $user->skills->count() }}
                    </span>
                    @endif
                </div>
                <div class="info-card-body">
                    @if($user->skills && $user->skills->count() > 0)
                        <div style="display:flex;flex-wrap:wrap;gap:.25rem">
                            @foreach($user->skills as $skill)
                                <span class="skill-tag">{{ $skill->skill_name }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-mini"><i class="fa-solid fa-lightbulb"></i>No skills added.</div>
                    @endif
                </div>
            </div>

            <!-- Resume -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--danger-light);color:var(--danger)"><i class="fa-solid fa-file-pdf"></i></div>
                    <h6>Resume</h6>
                </div>
                <div class="info-card-body">
                    @if($user->resume)
                        <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="resume-btn">
                            <i class="fa-solid fa-file-pdf"></i> View Resume
                        </a>
                    @else
                        <div class="empty-mini"><i class="fa-solid fa-file-pdf"></i>No resume uploaded.</div>
                    @endif
                </div>
            </div>

            <!-- System Info -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="card-icon" style="background:var(--bg-light);color:var(--text-muted)"><i class="fa-solid fa-circle-info"></i></div>
                    <h6>System Information</h6>
                </div>
                <div class="info-card-body">
                    <div style="display:flex;flex-direction:column;gap:.75rem">
                        <div class="info-item">
                            <div class="info-item-label">User ID</div>
                            <div class="info-item-value" style="font-family:monospace">#{{ $user->id }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Registered</div>
                            <div class="info-item-value">{{ $user->created_at->format('M j, Y g:i A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Last Updated</div>
                            <div class="info-item-value">{{ $user->updated_at->format('M j, Y g:i A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Profile Completion</div>
                            <div class="info-item-value">
                                <div class="completion-wrap">
                                    <div class="completion-bar" style="width:100px">
                                        <div class="completion-fill {{ $fillClass }}" style="width:{{ $completion }}%"></div>
                                    </div>
                                    <span class="completion-pct">{{ round($completion) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

