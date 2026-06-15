@extends('layouts.admin')

@section('adminContent')
@php
$admin = DB::table('admins')->where('id', session('admin_id'))->first();
$permissions = [];

if ($admin && $admin->permissions) {
    $permissions = json_decode($admin->permissions, true) ?: [];
}

if (!function_exists('canSeeAdminModule')) {
    function canSeeAdminModule($key, $permissions, $admin = null) {
        if ($admin && $admin->role === 'super_admin') return true;
        return in_array($key, $permissions ?? []);
    }
}
@endphp

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<div class="db">

    {{-- HERO --}}
    <header class="hero-card">
        <div class="hero-left">
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                All systems operational
            </div>
            <h1 class="hero-title">Welcome back to your Dashboard</h1>
            <p class="hero-sub">Here's what's happening across your platform today.</p>
        </div>
        <div class="hero-right">
            <div class="hero-time" id="heroClock">--:--</div>
            <div class="hero-date" id="heroDate">---</div>
        </div>
    </header>

    {{-- STAT CARDS --}}
    <div class="stats-row">

        <div class="sc sc--blue">
            <div class="sc__left">
                <div class="sc__icon sc__icon--blue">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Total Enquiries</span>
                    <span class="sc__badge sc__badge--blue">Contacts</span>
                </div>
                <div class="sc__val">{{ $totalContacts }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--blue" style="width:72%"></div></div>
            </div>
        </div>

        <div class="sc sc--green">
            <div class="sc__left">
                <div class="sc__icon sc__icon--green">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Total Jobs</span>
                    <span class="sc__badge sc__badge--green">All jobs</span>
                </div>
                <div class="sc__val">{{ $totalJobs }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--green" style="width:60%"></div></div>
            </div>
        </div>

        <div class="sc sc--amber">
            <div class="sc__left">
                <div class="sc__icon sc__icon--amber">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Pending Applications</span>
                    <span class="sc__badge sc__badge--amber">Awaiting</span>
                </div>
                <div class="sc__val">{{ $pendingApplications }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--amber" style="width:45%"></div></div>
            </div>
        </div>

        <div class="sc sc--purple">
            <div class="sc__left">
                <div class="sc__icon sc__icon--purple">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Companies</span>
                    <span class="sc__badge sc__badge--purple">Registered</span>
                </div>
                <div class="sc__val">{{ $totalCompanyRegistrations }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--purple" style="width:55%"></div></div>
            </div>
        </div>

        <div class="sc sc--teal">
            <div class="sc__left">
                <div class="sc__icon sc__icon--teal">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Accepted</span>
                    <span class="sc__badge sc__badge--teal">Approved</span>
                </div>
                <div class="sc__val">{{ $acceptedApplications }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--teal" style="width:80%"></div></div>
            </div>
        </div>

        <div class="sc sc--indigo">
            <div class="sc__left">
                <div class="sc__icon sc__icon--indigo">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Total Applications</span>
                    <span class="sc__badge sc__badge--indigo">All</span>
                </div>
                <div class="sc__val">{{ $totalApplications }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--indigo" style="width:90%"></div></div>
            </div>
        </div>

        <div class="sc sc--red">
            <div class="sc__left">
                <div class="sc__icon sc__icon--red">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Active Jobs</span>
                    <span class="sc__badge sc__badge--red">Live</span>
                </div>
                <div class="sc__val">{{ $activeJobs }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--red" style="width:65%"></div></div>
            </div>
        </div>

        <div class="sc sc--slate">
            <div class="sc__left">
                <div class="sc__icon sc__icon--slate">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
            </div>
            <div class="sc__right">
                <div class="sc__top-row">
                    <span class="sc__lbl">Total Users</span>
                    <span class="sc__badge sc__badge--slate">Registered</span>
                </div>
                <div class="sc__val">{{ $totalUsers }}</div>
                <div class="sc__bar"><div class="sc__bar-fill sc__bar-fill--slate" style="width:50%"></div></div>
            </div>
        </div>

    </div>

    {{-- MIDDLE: CHART + QUICK ACTIONS --}}
    <div class="mid-grid">
        <div class="panel">
            <div class="panel__head">
                <div>
                    <div class="panel__title">Monthly applications</div>
                    <div class="panel__sub">Volume per month</div>
                </div>
                <select id="applicationYearFilter" class="db-select">
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <canvas id="applicationChart" height="140"></canvas>
        </div>
        <div class="panel">
            <div class="panel__head">
                <div class="panel__title">Quick actions</div>
            </div>
            <div class="qa-list">
                @if(canSeeAdminModule('user_management', $permissions, $admin))
                <a href="{{ route('admin.profiles.index') }}" class="qa-item">
                    <span class="qa-icon qa-icon--blue"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></span>
                    <span class="qa-label">Manage users</span>
                    <span class="qa-arrow">→</span>
                </a>
                @endif
                @if(canSeeAdminModule('company_registration', $permissions, $admin))
                <a href="{{ route('admin.company.registrations.index') }}" class="qa-item">
                    <span class="qa-icon qa-icon--green"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></span>
                    <span class="qa-label">Company registrations</span>
                    <span class="qa-arrow">→</span>
                </a>
                @endif
                @if(canSeeAdminModule('job_management', $permissions, $admin))
                <a href="{{ route('admin.managejobs.index') }}" class="qa-item">
                    <span class="qa-icon qa-icon--amber"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg></span>
                    <span class="qa-label">Manage jobs</span>
                    <span class="qa-arrow">→</span>
                </a>
                <a href="{{ route('admin.managejobs.create') }}" class="qa-item qa-item--accent">
                    <span class="qa-icon qa-icon--white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                    <span class="qa-label">Post new job</span>
                    <span class="qa-arrow">→</span>
                </a>
                @endif
                @if(canSeeAdminModule('resume_management', $permissions, $admin))
                <a href="{{ route('admin.resume.index') }}" class="qa-item">
                    <span class="qa-icon qa-icon--purple"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                    <span class="qa-label">Manage applications</span>
                    <span class="qa-arrow">→</span>
                </a>
                @endif
            </div>
        </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="charts-row">
        <div class="panel">
            <div class="panel__head">
                <div><div class="panel__title">Enquiries</div><div class="panel__sub">Monthly</div></div>
                <select id="yearFilter" class="db-select">@foreach($years as $year)<option value="{{ $year }}">{{ $year }}</option>@endforeach</select>
            </div>
            <canvas id="contactChart" height="120"></canvas>
        </div>
        <div class="panel">
            <div class="panel__head">
                <div><div class="panel__title">Company registrations</div><div class="panel__sub">Growth</div></div>
                <select id="companyYearFilter" class="db-select">@foreach($years as $year)<option value="{{ $year }}">{{ $year }}</option>@endforeach</select>
            </div>
            <canvas id="companyChart" height="120"></canvas>
        </div>
        <div class="panel">
            <div class="panel__head">
                <div><div class="panel__title">Job postings</div><div class="panel__sub">Per month</div></div>
                <select id="jobYearFilter" class="db-select">@foreach($years as $year)<option value="{{ $year }}">{{ $year }}</option>@endforeach</select>
            </div>
            <canvas id="jobChart" height="120"></canvas>
        </div>
    </div>

    {{-- HIGH VACANCY --}}
    @if(canSeeAdminModule('job_management', $permissions, $admin))
    <div>
        <div class="sect-label">High vacancy openings</div>
        <div class="vacancy-grid">
            @forelse($highVacancyJobs as $job)
            <div class="vc">
                <div class="vc__top">
                    <div class="vc__info">
                        <div class="vc__title">{{ $job->job_title }}</div>
                        <div class="vc__co">{{ $job->company_name }}</div>
                    </div>
                    <div class="vc__badge">
                        <span class="vc__num">{{ $job->vacancies }}</span>
                        <span class="vc__unit">spots</span>
                    </div>
                </div>
                <div class="vc__meta">
                    <span class="tag">📍 {{ $job->job_location }}</span>
                    <span class="tag {{ $job->status === 'active' ? 'tag--green' : 'tag--amber' }}">{{ ucfirst($job->status) }}</span>
                </div>
                <div class="vc__actions">
                    <a href="{{ route('admin.managejobs.edit', $job->id) }}" class="btn btn--ghost">Edit</a>
                    <a href="{{ route('admin.managejobs.show', $job->id) }}" class="btn btn--blue">View</a>
                </div>
            </div>
            @empty
            <div class="vc-empty">
                <p>No high vacancy jobs yet.</p>
                <a href="{{ route('admin.managejobs.create') }}" class="btn btn--blue">Post a job</a>
            </div>
            @endforelse
        </div>
    </div>
    @endif

    {{-- RECENT ACTIVITY --}}
    <div>
        <div class="sect-label">Recent activity</div>
        <div class="activity-grid">
            @if(canSeeAdminModule('user_management', $permissions, $admin))
            <div class="acard">
                <div class="acard__head">
                    <span class="acard__title">Recent users</span>
                    <a href="{{ route('admin.profiles.index') }}" class="acard__link">See all →</a>
                </div>
                @forelse($recentUsers as $user)
                <div class="aitem">
                    <div class="av av--blue">{{ substr($user->first_name,0,1) }}{{ substr($user->last_name,0,1) }}</div>
                    <div class="abody">
                        <div class="aname">{{ $user->first_name }} {{ $user->last_name }}</div>
                        <div class="ameta">{{ $user->email }}</div>
                    </div>
                    <span class="tag {{ $user->email_verified_at ? 'tag--green' : 'tag--amber' }}">{{ $user->phone ?? 'No phone' }}</span>
                </div>
                @empty
                <div class="acard__empty">No users found</div>
                @endforelse
            </div>
            @endif

            @if(canSeeAdminModule('company_registration', $permissions, $admin))
            <div class="acard">
                <div class="acard__head">
                    <span class="acard__title">Company registrations</span>
                    <a href="{{ route('admin.company.registrations.index') }}" class="acard__link">See all →</a>
                </div>
                @forelse($recentCompanies as $company)
                <div class="aitem">
                    <div class="av av--green">🏢</div>
                    <div class="abody">
                        <div class="aname">{{ $company->company_name }}</div>
                        <div class="ameta">{{ $company->name }} · {{ $company->position }}</div>
                    </div>
                    <span class="tag {{ $company->status === 'approved' ? 'tag--green' : ($company->status === 'pending' ? 'tag--amber' : 'tag--red') }}">{{ ucfirst(str_replace('_',' ',$company->status)) }}</span>
                </div>
                @empty
                <div class="acard__empty">No registrations found</div>
                @endforelse
            </div>
            @endif

            @if(canSeeAdminModule('job_management', $permissions, $admin))
            <div class="acard">
                <div class="acard__head">
                    <span class="acard__title">Recent job postings</span>
                    <a href="{{ route('admin.managejobs.index') }}" class="acard__link">See all →</a>
                </div>
                @forelse($recentJobs as $job)
                <div class="aitem">
                    <div class="av av--amber">💼</div>
                    <div class="abody">
                        <div class="aname">{{ $job->job_title }}</div>
                        <div class="ameta">{{ $job->company_name }} · {{ $job->job_location }}</div>
                    </div>
                    <span class="tag {{ $job->status === 'active' ? 'tag--green' : 'tag--amber' }}">{{ ucfirst($job->status) }}</span>
                </div>
                @empty
                <div class="acard__empty">No jobs found</div>
                @endforelse
            </div>
            @endif

            @if(canSeeAdminModule('resume_management', $permissions, $admin))
            <div class="acard">
                <div class="acard__head">
                    <span class="acard__title">Recent applications</span>
                    <a href="{{ route('admin.resume.index') }}" class="acard__link">See all →</a>
                </div>
                @forelse($recentApplications as $application)
                <div class="aitem">
                    <div class="av av--purple">👤</div>
                    <div class="abody">
                        <div class="aname">{{ $application->first_name }} {{ $application->last_name }}</div>
                        <div class="ameta">{{ $application->job_title }} · {{ $application->company_name }}</div>
                    </div>
                    <span class="tag {{ $application->status === 'accepted' ? 'tag--green' : ($application->status === 'pending' ? 'tag--amber' : ($application->status === 'under_review' ? 'tag--blue' : 'tag--red')) }}">{{ ucfirst($application->status) }}</span>
                </div>
                @empty
                <div class="acard__empty">No applications found</div>
                @endforelse
            </div>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function(){
    function tick(){
        const n=new Date(),h=n.getHours(),m=n.getMinutes();
        document.getElementById('heroClock').textContent=(h<10?'0':'')+h+':'+(m<10?'0':'')+m;
        document.getElementById('heroDate').textContent=n.toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric'});
    }
    tick(); setInterval(tick,1000);
})();

document.addEventListener('DOMContentLoaded',function(){
    const contactStats     = @json($contactStats);
    const companyStats     = @json($companyStats);
    const jobStats         = @json($jobStats);
    const applicationStats = @json($applicationStats);

    function byYear(data){
        const m={};
        data.forEach(i=>{if(!m[i.year])m[i.year]=Array(12).fill(0);m[i.year][i.month-1]=i.total;});
        return m;
    }
    const cby=byYear(contactStats),coby=byYear(companyStats),jby=byYear(jobStats),aby=byYear(applicationStats);
    const months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const font={family:"'Inter',sans-serif",size:11};
    const tip={backgroundColor:'#0f172a',titleColor:'#e2e8f0',bodyColor:'#94a3b8',padding:10,cornerRadius:8,titleFont:{...font,size:13},bodyFont:font};

    function opts(){
        return{responsive:true,maintainAspectRatio:true,
            scales:{
                x:{grid:{display:false},ticks:{color:'#94a3b8',font}},
                y:{grid:{color:'rgba(0,0,0,0.05)',borderDash:[3,3]},border:{display:false},beginAtZero:true,ticks:{color:'#94a3b8',font,maxTicksLimit:5}}
            },
            plugins:{legend:{display:false},tooltip:tip}
        };
    }
    function bar(id,data,color){
        return new Chart(document.getElementById(id),{type:'bar',data:{labels:months,datasets:[{data,backgroundColor:color,borderRadius:5,borderSkipped:false}]},options:opts()});
    }
    function line(id,data,color){
        const rgba=color.replace('rgb','rgba').replace(')',',0.08)');
        return new Chart(document.getElementById(id),{type:'line',data:{labels:months,datasets:[{data,borderColor:color,backgroundColor:rgba,borderWidth:2,pointBackgroundColor:color,pointRadius:3,pointHoverRadius:5,tension:0.4,fill:true}]},options:opts()});
    }

    const v=id=>document.getElementById(id).value;
    const cc=bar('contactChart',    cby[v('yearFilter')]            ||Array(12).fill(0),'#3b82f6');
    const co=line('companyChart',   coby[v('companyYearFilter')]    ||Array(12).fill(0),'rgb(16,185,129)');
    const jc=bar('jobChart',        jby[v('jobYearFilter')]         ||Array(12).fill(0),'#f59e0b');
    const ac=line('applicationChart',aby[v('applicationYearFilter')]||Array(12).fill(0),'rgb(99,102,241)');

    function bind(id,chart,data){
        document.getElementById(id).addEventListener('change',function(){
            chart.data.datasets[0].data=data[this.value]||Array(12).fill(0);chart.update();
        });
    }
    bind('yearFilter',cc,cby);
    bind('companyYearFilter',co,coby);
    bind('jobYearFilter',jc,jby);
    bind('applicationYearFilter',ac,aby);
});
</script>

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.db{font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;background:#f1f5f9;padding:24px;display:flex;flex-direction:column;gap:20px;min-height:100vh;color:#0f172a}

/* HERO */
.hero-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:28px 32px;display:flex;justify-content:space-between;align-items:center;gap:24px}
.hero-badge{display:inline-flex;align-items:center;gap:7px;font-size:12px;font-weight:500;color:#16a34a;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:99px;padding:4px 12px;margin-bottom:12px}
.pulse-dot{width:6px;height:6px;border-radius:50%;background:#22c55e;animation:pulse 2s ease-in-out infinite}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,.4)}50%{box-shadow:0 0 0 5px rgba(34,197,94,0)}}
.hero-title{font-size:22px;font-weight:600;color:#0f172a;margin-bottom:4px;line-height:1.3}
.hero-sub{font-size:14px;color:#64748b}
.hero-right{text-align:right;flex-shrink:0}
.hero-time{font-size:36px;font-weight:600;color:#0f172a;letter-spacing:-1px;line-height:1}
.hero-date{font-size:13px;color:#94a3b8;margin-top:4px}

/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}

.sc{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:16px;
    padding:18px 20px;
    display:flex;
    align-items:center;
    gap:16px;
    transition:transform .2s,box-shadow .2s;
    position:relative;
    overflow:hidden;
}
.sc::before{
    content:'';
    position:absolute;
    left:0;top:0;bottom:0;
    width:4px;
    border-radius:16px 0 0 16px;
}
.sc:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(0,0,0,.09)}

/* left accent bar color */
.sc--blue::before{background:#3b82f6}
.sc--green::before{background:#16a34a}
.sc--amber::before{background:#d97706}
.sc--purple::before{background:#7c3aed}
.sc--teal::before{background:#0d9488}
.sc--indigo::before{background:#4f46e5}
.sc--red::before{background:#dc2626}
.sc--slate::before{background:#475569}

/* icon */
.sc__left{flex-shrink:0}
.sc__icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center}
.sc__icon--blue{background:#dbeafe;color:#2563eb}
.sc__icon--green{background:#dcfce7;color:#15803d}
.sc__icon--amber{background:#fef3c7;color:#b45309}
.sc__icon--purple{background:#ede9fe;color:#6d28d9}
.sc__icon--teal{background:#ccfbf1;color:#0f766e}
.sc__icon--indigo{background:#e0e7ff;color:#4338ca}
.sc__icon--red{background:#fee2e2;color:#b91c1c}
.sc__icon--slate{background:#e2e8f0;color:#334155}

/* right content */
.sc__right{flex:1;min-width:0}
.sc__top-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.sc__lbl{font-size:12px;font-weight:500;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sc__val{font-size:28px;font-weight:700;color:#0f172a;line-height:1;letter-spacing:-0.5px;margin-bottom:10px}

/* progress bar */
.sc__bar{height:4px;background:#f1f5f9;border-radius:99px;overflow:hidden}
.sc__bar-fill{height:100%;border-radius:99px;transition:width .6s ease}
.sc__bar-fill--blue{background:#3b82f6}
.sc__bar-fill--green{background:#16a34a}
.sc__bar-fill--amber{background:#d97706}
.sc__bar-fill--purple{background:#7c3aed}
.sc__bar-fill--teal{background:#0d9488}
.sc__bar-fill--indigo{background:#4f46e5}
.sc__bar-fill--red{background:#dc2626}
.sc__bar-fill--slate{background:#475569}

/* badge */
.sc__badge{font-size:10px;font-weight:600;padding:2px 8px;border-radius:99px;white-space:nowrap;flex-shrink:0;margin-left:6px}
.sc__badge--blue{background:#dbeafe;color:#1d4ed8}
.sc__badge--green{background:#dcfce7;color:#15803d}
.sc__badge--amber{background:#fef3c7;color:#92400e}
.sc__badge--purple{background:#ede9fe;color:#5b21b6}
.sc__badge--teal{background:#ccfbf1;color:#0f766e}
.sc__badge--indigo{background:#e0e7ff;color:#3730a3}
.sc__badge--red{background:#fee2e2;color:#991b1b}
.sc__badge--slate{background:#e2e8f0;color:#1e293b}

/* PANELS */
.panel{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:22px 24px;transition:box-shadow .2s}
.panel:hover{box-shadow:0 4px 16px rgba(0,0,0,.06)}
.panel__head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:18px}
.panel__title{font-size:15px;font-weight:600;color:#0f172a}
.panel__sub{font-size:12px;color:#94a3b8;margin-top:2px}
.mid-grid{display:grid;grid-template-columns:2fr 1fr;gap:16px}
.charts-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}

/* SELECT */
.db-select{font-family:'Inter',sans-serif;font-size:13px;color:#475569;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:5px 10px;cursor:pointer;outline:none;transition:border-color .15s}
.db-select:focus{border-color:#3b82f6}

/* QUICK ACTIONS */
.qa-list{display:flex;flex-direction:column;gap:8px}
.qa-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;border:1px solid #e2e8f0;background:#f8fafc;font-size:13px;font-weight:500;color:#0f172a;text-decoration:none;transition:all .15s}
.qa-item:hover{border-color:#3b82f6;background:#eff6ff;color:#0f172a}
.qa-item--accent{background:#3b82f6;border-color:#3b82f6;color:#fff}
.qa-item--accent:hover{background:#2563eb;border-color:#2563eb;color:#fff}
.qa-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.qa-icon--blue{background:#eff6ff;color:#3b82f6}
.qa-icon--green{background:#f0fdf4;color:#16a34a}
.qa-icon--amber{background:#fffbeb;color:#d97706}
.qa-icon--purple{background:#f5f3ff;color:#7c3aed}
.qa-icon--white{background:rgba(255,255,255,.2);color:#fff}
.qa-label{flex:1}
.qa-arrow{color:#94a3b8;font-size:14px}
.qa-item--accent .qa-arrow{color:rgba(255,255,255,.7)}

/* SECTION LABEL */
.sect-label{font-size:11px;font-weight:600;letter-spacing:.09em;text-transform:uppercase;color:#94a3b8;margin-bottom:12px}

/* VACANCY */
.vacancy-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.vc{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;display:flex;flex-direction:column;gap:12px;transition:box-shadow .2s}
.vc:hover{box-shadow:0 4px 20px rgba(0,0,0,.08)}
.vc__top{display:flex;justify-content:space-between;align-items:flex-start;gap:12px}
.vc__title{font-size:14px;font-weight:600;color:#0f172a}
.vc__co{font-size:12px;color:#64748b;margin-top:2px}
.vc__badge{text-align:right;flex-shrink:0}
.vc__num{font-size:26px;font-weight:600;color:#3b82f6;line-height:1}
.vc__unit{font-size:11px;color:#94a3b8}
.vc__meta{display:flex;gap:6px;flex-wrap:wrap}
.vc__actions{display:flex;gap:8px}
.vc-empty{text-align:center;padding:40px;color:#64748b;font-size:14px}

/* TAGS */
.tag{font-size:11px;font-weight:500;padding:3px 9px;border-radius:99px;border:1px solid #e2e8f0;color:#64748b;background:#f8fafc}
.tag--green{background:#f0fdf4;color:#16a34a;border-color:#bbf7d0}
.tag--amber{background:#fffbeb;color:#d97706;border-color:#fde68a}
.tag--blue{background:#eff6ff;color:#3b82f6;border-color:#bfdbfe}
.tag--red{background:#fef2f2;color:#dc2626;border-color:#fecaca}

/* BUTTONS */
.btn{font-family:'Inter',sans-serif;font-size:12px;font-weight:500;padding:6px 14px;border-radius:8px;text-decoration:none;cursor:pointer;transition:all .15s;display:inline-block}
.btn--ghost{border:1px solid #e2e8f0;color:#475569;background:transparent}
.btn--ghost:hover{border-color:#94a3b8}
.btn--blue{border:1px solid #bfdbfe;background:#eff6ff;color:#3b82f6;margin-left:auto}
.btn--blue:hover{background:#dbeafe}

/* ACTIVITY */
.activity-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:5px}
.acard{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;transition:box-shadow .2s}
.acard:hover{box-shadow:0 4px 16px rgba(0,0,0,.06)}
.acard__head{display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px solid #f1f5f9;margin-bottom:6px}
.acard__title{font-size:14px;font-weight:600;color:#0f172a}
.acard__link{font-size:12px;color:#3b82f6;text-decoration:none}
.acard__link:hover{text-decoration:underline}
.acard__empty{text-align:center;padding:20px;color:#94a3b8;font-size:13px;font-style:italic}
.aitem{display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid #f8fafc}
.aitem:last-child{border-bottom:none}
.av{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0}
.av--blue{background:#eff6ff;color:#3b82f6}
.av--green{background:#f0fdf4;color:#16a34a}
.av--amber{background:#fffbeb;color:#d97706}
.av--purple{background:#f5f3ff;color:#7c3aed}
.abody{flex:1;min-width:0}
.aname{font-size:13px;font-weight:500;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ameta{font-size:12px;color:#94a3b8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:1px}

/* RESPONSIVE */
@media(max-width:1280px){.activity-grid{grid-template-columns:repeat(2,1fr)}.charts-row{grid-template-columns:repeat(2,1fr)}.vacancy-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:900px){.mid-grid{grid-template-columns:1fr}.stats-row{grid-template-columns:repeat(2,1fr)}.charts-row{grid-template-columns:1fr}.activity-grid{grid-template-columns:repeat(2,1fr)}.vacancy-grid{grid-template-columns:1fr}.sc__val{font-size:24px}}
@media(max-width:600px){.db{padding:16px}.hero-card{flex-direction:column;align-items:flex-start}.stats-row{grid-template-columns:repeat(2,1fr)}.activity-grid{grid-template-columns:1fr}}

.layout-navbar-fixed .layout-wrapper:not(.layout-horizontal):not(.layout-without-menu) .layout-page{padding-top:22px!important;background-color:#f1f5f9!important}
</style>

@endsection
