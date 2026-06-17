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

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.db{font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;background:transparent;padding:32px 24px;display:flex;flex-direction:column;gap:28px;min-height:100vh;color:#0f172a}

/* HERO */
.hero-card{
    background:linear-gradient(160deg, #0b1f45 0%, #0f2d6b 45%, #0b1f45 100%);
    border-radius:24px;
    padding:36px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:24px;
    box-shadow:0 12px 32px rgba(15, 32, 39, 0.25);
    position: relative;
    overflow: hidden;
}
.hero-card::after{
    content:''; position:absolute; top:0; right:0; width:400px; height:400px;
    background:radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform:translate(30%, -30%); pointer-events:none;
}
.hero-badge{
    display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:600;
    color:#fff;background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,0.1);border-radius:99px;padding:6px 14px;margin-bottom:16px;
    text-transform:uppercase; letter-spacing:0.5px;
}
.pulse-dot{width:8px;height:8px;border-radius:50%;background:#10b981;animation:pulse 2s ease-in-out infinite; box-shadow:0 0 10px #10b981;}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.5)}50%{box-shadow:0 0 0 6px rgba(16,185,129,0)}}
.hero-title{font-size:28px;font-weight:800;color:#fff;margin-bottom:8px;line-height:1.2; letter-spacing:-0.5px;}
.hero-sub{font-size:15px;color:rgba(255,255,255,0.75); font-weight:400;}
.hero-right{text-align:right;flex-shrink:0; z-index:1;}
.hero-time{font-size:42px;font-weight:800;color:#fff;letter-spacing:-1.5px;line-height:1;text-shadow:0 2px 10px rgba(0,0,0,0.2);}
.hero-date{font-size:14px;color:rgba(255,255,255,0.6);margin-top:8px; font-weight:500;}

/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}

.sc{
    background:#fff;
    border:none;
    border-radius:20px;
    padding:24px;
    display:flex;
    align-items:center;
    gap:18px;
    box-shadow:0 4px 15px rgba(0,0,0,0.03);
    transition:all .3s cubic-bezier(.4,0,.2,1);
    position:relative;
    overflow:hidden;
}
.sc::after{
    content:''; position:absolute; right:-20px; top:-20px; width:80px; height:80px;
    border-radius:50%; background:currentColor; opacity:0.03; pointer-events:none; transition:transform .3s;
}
.sc:hover{transform:translateY(-5px) scale(1.01);box-shadow:0 12px 30px rgba(0,0,0,.08)}
.sc:hover::after{transform:scale(1.5);}

.sc--blue{color:#3b82f6} .sc--green{color:#10b981} .sc--amber{color:#f59e0b} .sc--purple{color:#8b5cf6}
.sc--teal{color:#14b8a6} .sc--indigo{color:#6366f1} .sc--red{color:#ef4444} .sc--slate{color:#64748b}

/* icon */
.sc__left{flex-shrink:0}
.sc__icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:24px;}
.sc__icon svg{width:26px; height:26px;}
.sc__icon--blue{background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);color:#2563eb;box-shadow:0 4px 10px rgba(37,99,235,0.15);}
.sc__icon--green{background:linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);color:#16a34a;box-shadow:0 4px 10px rgba(22,163,74,0.15);}
.sc__icon--amber{background:linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);color:#d97706;box-shadow:0 4px 10px rgba(217,119,6,0.15);}
.sc__icon--purple{background:linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);color:#7c3aed;box-shadow:0 4px 10px rgba(124,58,237,0.15);}
.sc__icon--teal{background:linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);color:#0d9488;box-shadow:0 4px 10px rgba(13,148,136,0.15);}
.sc__icon--indigo{background:linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);color:#4f46e5;box-shadow:0 4px 10px rgba(79,70,229,0.15);}
.sc__icon--red{background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);color:#dc2626;box-shadow:0 4px 10px rgba(220,38,38,0.15);}
.sc__icon--slate{background:linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);color:#475569;box-shadow:0 4px 10px rgba(71,85,105,0.15);}

/* right content */
.sc__right{flex:1;min-width:0}
.sc__top-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
.sc__lbl{font-size:13px;font-weight:600;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sc__val{font-size:32px;font-weight:800;color:#0f172a;line-height:1;letter-spacing:-1px;margin-bottom:12px}

/* progress bar */
.sc__bar{height:6px;background:#f1f5f9;border-radius:99px;overflow:hidden}
.sc__bar-fill{height:100%;border-radius:99px;transition:width 1s cubic-bezier(0.4,0,0.2,1)}
.sc__bar-fill--blue{background:linear-gradient(90deg, #60a5fa, #3b82f6)}
.sc__bar-fill--green{background:linear-gradient(90deg, #34d399, #10b981)}
.sc__bar-fill--amber{background:linear-gradient(90deg, #fbbf24, #f59e0b)}
.sc__bar-fill--purple{background:linear-gradient(90deg, #a78bfa, #8b5cf6)}
.sc__bar-fill--teal{background:linear-gradient(90deg, #2dd4bf, #14b8a6)}
.sc__bar-fill--indigo{background:linear-gradient(90deg, #818cf8, #6366f1)}
.sc__bar-fill--red{background:linear-gradient(90deg, #f87171, #ef4444)}
.sc__bar-fill--slate{background:linear-gradient(90deg, #94a3b8, #64748b)}

/* badge */
.sc__badge{font-size:11px;font-weight:700;padding:4px 10px;border-radius:99px;white-space:nowrap;flex-shrink:0;margin-left:6px;text-transform:uppercase;letter-spacing:0.5px;}
.sc__badge--blue{background:#eff6ff;color:#2563eb}
.sc__badge--green{background:#f0fdf4;color:#16a34a}
.sc__badge--amber{background:#fffbeb;color:#d97706}
.sc__badge--purple{background:#f5f3ff;color:#7c3aed}
.sc__badge--teal{background:#f0fdfa;color:#0d9488}
.sc__badge--indigo{background:#eef2ff;color:#4f46e5}
.sc__badge--red{background:#fef2f2;color:#dc2626}
.sc__badge--slate{background:#f8fafc;color:#475569}

/* PANELS */
.panel{background:#fff;border:none;border-radius:24px;padding:28px 30px;box-shadow:0 4px 15px rgba(0,0,0,0.03);transition:box-shadow .3s}
.panel:hover{box-shadow:0 8px 25px rgba(0,0,0,.06)}
.panel__head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px}
.panel__title{font-size:18px;font-weight:700;color:#0f172a;letter-spacing:-0.3px;}
.panel__sub{font-size:13px;color:#64748b;margin-top:4px;font-weight:500;}
.mid-grid{display:grid;grid-template-columns:2fr 1fr;gap:20px}
.charts-row{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}

/* SELECT */
.db-select{font-family:'Inter',sans-serif;font-size:13px;font-weight:600;color:#1e293b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:8px 14px;cursor:pointer;outline:none;transition:all .2s;appearance:none;}
.db-select:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,0.1)}
.db-select:hover{background:#f1f5f9;}

/* QUICK ACTIONS */
.qa-list{display:flex;flex-direction:column;gap:12px}
.qa-item{display:flex;align-items:center;gap:14px;padding:12px 16px;border-radius:16px;border:1px solid transparent;background:#f8fafc;font-size:14px;font-weight:600;color:#0f172a;text-decoration:none;transition:all .25s cubic-bezier(.4,0,.2,1)}
.qa-item:hover{background:#fff;border-color:#e2e8f0;box-shadow:0 8px 20px rgba(0,0,0,0.05);transform:translateX(6px);color:#2563eb;}
.qa-item--accent{background:linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);color:#fff;}
.qa-item--accent:hover{background:linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);color:#fff;border-color:transparent;}
.qa-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.qa-icon svg{width:18px;height:18px;}
.qa-icon--blue{background:#eff6ff;color:#3b82f6}
.qa-icon--green{background:#f0fdf4;color:#16a34a}
.qa-icon--amber{background:#fffbeb;color:#d97706}
.qa-icon--purple{background:#f5f3ff;color:#7c3aed}
.qa-icon--white{background:rgba(255,255,255,.25);color:#fff}
.qa-label{flex:1}
.qa-arrow{color:#94a3b8;font-size:16px;transition:transform .2s;}
.qa-item:hover .qa-arrow{transform:translateX(3px);color:inherit;}
.qa-item--accent .qa-arrow{color:rgba(255,255,255,.8)}

/* SECTION LABEL */
.sect-label{font-size:13px;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#475569;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
.sect-label::before{content:'';display:block;width:6px;height:6px;background:#3b82f6;border-radius:50%;}

/* VACANCY */
.vacancy-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.vc{background:#fff;border:none;border-radius:20px;padding:24px;display:flex;flex-direction:column;gap:16px;box-shadow:0 4px 15px rgba(0,0,0,0.03);transition:all .3s;}
.vc:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(0,0,0,.08)}
.vc__top{display:flex;justify-content:space-between;align-items:flex-start;gap:16px}
.vc__title{font-size:16px;font-weight:700;color:#0f172a;line-height:1.3;margin-bottom:4px;}
.vc__co{font-size:13px;color:#64748b;font-weight:500;}
.vc__badge{text-align:right;flex-shrink:0;background:#eff6ff;padding:8px 12px;border-radius:12px;color:#1e40af;}
.vc__num{font-size:24px;font-weight:800;line-height:1;}
.vc__unit{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;display:block;margin-top:2px;opacity:0.8;}
.vc__meta{display:flex;gap:8px;flex-wrap:wrap}
.vc__actions{display:flex;gap:10px;margin-top:auto;}
.vc-empty{text-align:center;padding:50px;color:#64748b;font-size:15px;background:#fff;border-radius:20px;}

/* TAGS */
.tag{font-size:12px;font-weight:600;padding:6px 12px;border-radius:10px;color:#64748b;background:#f1f5f9;border:1px solid transparent;display:inline-flex;align-items:center;gap:4px;}
.tag--green{background:#f0fdf4;color:#16a34a;border-color:#bbf7d0}
.tag--amber{background:#fffbeb;color:#d97706;border-color:#fde68a}
.tag--blue{background:#eff6ff;color:#3b82f6;border-color:#bfdbfe}
.tag--red{background:#fef2f2;color:#dc2626;border-color:#fecaca}

/* BUTTONS */
.btn{font-family:'Inter',sans-serif;font-size:13px;font-weight:600;padding:10px 18px;border-radius:12px;text-decoration:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;justify-content:center;line-height:1;}
.btn--ghost{background:#f8fafc;color:#475569;}
.btn--ghost:hover{background:#e2e8f0;color:#0f172a;}
.btn--blue{background:linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);color:#fff;margin-left:auto;box-shadow:0 4px 10px rgba(37,99,235,0.2);}
.btn--blue:hover{box-shadow:0 6px 15px rgba(37,99,235,0.3);transform:translateY(-1px);}

/* ACTIVITY */
.activity-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.acard{background:#fff;border:none;border-radius:20px;padding:24px;box-shadow:0 4px 15px rgba(0,0,0,0.03);transition:all .3s}
.acard:hover{box-shadow:0 8px 25px rgba(0,0,0,.06)}
.acard__head{display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid #f1f5f9;margin-bottom:12px}
.acard__title{font-size:15px;font-weight:700;color:#0f172a}
.acard__link{font-size:13px;font-weight:600;color:#3b82f6;text-decoration:none;transition:color .2s;}
.acard__link:hover{color:#2563eb;}
.acard__empty{text-align:center;padding:30px 20px;color:#94a3b8;font-size:14px;font-style:italic}
.aitem{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f8fafc;transition:transform .2s;}
.aitem:hover{transform:translateX(4px);}
.aitem:last-child{border-bottom:none;padding-bottom:0;}
.av{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;flex-shrink:0}
.av--blue{background:#eff6ff;color:#3b82f6}
.av--green{background:#f0fdf4;color:#16a34a}
.av--amber{background:#fffbeb;color:#d97706}
.av--purple{background:#f5f3ff;color:#7c3aed}
.abody{flex:1;min-width:0}
.aname{font-size:14px;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:2px;}
.ameta{font-size:12px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

/* RESPONSIVE */
@media(max-width:1400px){.stats-row{grid-template-columns:repeat(2,1fr)}.activity-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:1280px){.charts-row{grid-template-columns:repeat(2,1fr)}.vacancy-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:900px){.mid-grid{grid-template-columns:1fr}.charts-row{grid-template-columns:1fr}.activity-grid{grid-template-columns:repeat(2,1fr)}.vacancy-grid{grid-template-columns:1fr}.sc__val{font-size:28px}}
@media(max-width:600px){.db{padding:20px 16px}.hero-card{flex-direction:column;align-items:flex-start}.stats-row{grid-template-columns:1fr}.activity-grid{grid-template-columns:1fr}}

/* Sneat Layout overrides */
.layout-navbar-fixed .layout-wrapper:not(.layout-horizontal):not(.layout-without-menu) .layout-page{padding-top:22px!important;background-color:#f4f7fe!important}
</style>

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

@endsection
