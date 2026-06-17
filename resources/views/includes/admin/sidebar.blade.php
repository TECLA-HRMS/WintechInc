@php
$admin = DB::table('admins')->where('id', session('admin_id'))->first();
$permissions = [];

if ($admin && $admin->permissions) {
    $permissions = json_decode($admin->permissions, true);
}

if (!function_exists('hasPermission')) {
    function hasPermission($key, $permissions, $admin = null) {
        if ($admin && $admin->role === 'super_admin') return true;
        return in_array($key, $permissions ?? []) || $key === 'dashboard';
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin($admin = null) {
        return $admin && $admin->role === 'super_admin';
    }
}
@endphp

{{-- Mobile overlay --}}
<div class="sb-overlay" id="sbOverlay"></div>

<!-- Sidebar -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    {{-- Brand --}}
    <div class="sb-brand-area">
        <a href="{{ route('admin.dashboard') }}" class="sb-brand-link">
            <img loading="lazy" src="{{ asset('logo.png') }}" alt="Wintech Inc Logo" class="sb-logo">
            <div class="sb-texts">
                <span class="sb-title">Wintech Inc</span>
                <span class="sb-subtitle">HR & IT Solutions</span>
            </div>
        </a>
        <button class="sb-close-btn d-xl-none" id="sbCloseBtn" title="Close menu">
            <i class="ti ti-x"></i>
        </button>
    </div>

    {{-- Nav label --}}
    <div class="sb-nav-label">NAVIGATION</div>

    {{-- Menu --}}
    <ul class="menu-inner sb-menu">

        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-smart-home"></i></span>
                <span class="sb-link-text">Dashboard</span>
            </a>
        </li>

        @if(hasPermission('resume_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/resume*') ? 'active' : '' }}">
            <a href="{{ route('admin.resume.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-file-description"></i></span>
                <span class="sb-link-text">Resumes</span>
            </a>
        </li>
        @endif

        @if(hasPermission('user_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/profiles*') ? 'active' : '' }}">
            <a href="{{ route('admin.profiles.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-users"></i></span>
                <span class="sb-link-text">User Management</span>
            </a>
        </li>
        @endif

        @if(hasPermission('company_registration', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/company-registrations*') ? 'active' : '' }}">
            <a href="{{ route('admin.company.registrations.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-building"></i></span>
                <span class="sb-link-text">Company Registration</span>
            </a>
        </li>
        @endif

        @if(hasPermission('job_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/managejobs*') ? 'active' : '' }}">
            <a href="{{ route('admin.managejobs.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-briefcase"></i></span>
                <span class="sb-link-text">Job Management</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/job-functions*') ? 'active' : '' }}">
            <a href="{{ route('admin.job-functions.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-list-details"></i></span>
                <span class="sb-link-text">Job Functions</span>
            </a>
        </li>
        @endif

        @if(hasPermission('enquiries', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/contact*') ? 'active' : '' }}">
            <a href="{{ route('admin.contact.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-message-circle"></i></span>
                <span class="sb-link-text">Enquiries</span>
            </a>
        </li>
        @endif

        @if(hasPermission('blog_management', $permissions, $admin) || isSuperAdmin($admin))
        <li class="menu-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-pencil"></i></span>
                <span class="sb-link-text">Blog Management</span>
            </a>
        </li>
        @endif

        @if(hasPermission('email_config', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/emailconfig*') ? 'active' : '' }}">
            <a href="{{ route('admin.emailconfig.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-mail"></i></span>
                <span class="sb-link-text">Email Configuration</span>
            </a>
        </li>
        @endif

        @if(hasPermission('admin_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/management*') ? 'active' : '' }}">
            <a href="{{ route('admin.management.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-shield-lock"></i></span>
                <span class="sb-link-text">Admin Management</span>
            </a>
        </li>
        @endif

        @if(hasPermission('newsletter_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/newsletter*') ? 'active' : '' }}">
            <a href="{{ route('admin.newsletter.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-send"></i></span>
                <span class="sb-link-text">Newsletter</span>
            </a>
        </li>
        @endif

        @if(hasPermission('activity_logs', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/activity-logs*') ? 'active' : '' }}">
            <a href="{{ route('admin.activity-logs.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-history"></i></span>
                <span class="sb-link-text">Activity Logs</span>
            </a>
        </li>
        @endif

        @if(hasPermission('report_management', $permissions, $admin))
        <li class="menu-item {{ request()->is('admin/reports*') || request()->is('admin/*-report*') ? 'active' : '' }}">
            <a href="{{ route('admin.reports.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-chart-bar"></i></span>
                <span class="sb-link-text">Reports</span>
            </a>
        </li>
        @endif

        @if(isSuperAdmin($admin))
        <li class="menu-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <span class="sb-icon-wrap"><i class="ti ti-settings"></i></span>
                <span class="sb-link-text">Settings</span>
            </a>
        </li>
        @endif

    </ul>

    {{-- Spacer --}}
    <div class="sb-spacer"></div>

    {{-- Version tag --}}
    <div class="sb-version-tag">
        <i class="ti ti-circle-check me-1"></i> v1.0 &nbsp;·&nbsp; Wintech Admin
    </div>

</aside>

<style>
/* ── Base ── */
#layout-menu {
    position: fixed;
    top: 0; left: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(160deg, #0b1f45 0%, #0f2d6b 45%, #0b1f45 100%);
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 24px rgba(11,31,69,0.45);
    z-index: 1050;
    overflow: hidden;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
}

/* ── Overlay (mobile) ── */
.sb-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 1049;
    backdrop-filter: blur(2px);
}
.sb-overlay.active { display: block; }

/* ── Mobile: hidden off-screen ── */
@media (max-width: 1199px) {
    #layout-menu { transform: translateX(-100%); }
    #layout-menu.sb-open { transform: translateX(0); }
}

/* ── Brand area ── */
.sb-brand-area {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 18px;
    background: rgba(0,0,0,0.3);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    flex-shrink: 0;
}
.sb-brand-link {
    display: flex; align-items: center; gap: 12px;
    text-decoration: none; flex: 1; min-width: 0;
}
.sb-logo {
    width: 84px; height: 44px;
    border-radius: 12px;
    object-fit: contain;
    background: #fff;
    padding: 4px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.3);
    flex-shrink: 0;
    transition: transform .25s;
}
.sb-brand-link:hover .sb-logo { transform: scale(1.07) rotate(-4deg); }
.sb-texts { display: flex; flex-direction: column; line-height: 1.25; overflow: hidden; }
.sb-title    { font-size: 15px; font-weight: 800; color: #fff; white-space: nowrap; letter-spacing: .3px; }
.sb-subtitle { font-size: 10px; color: rgba(255,255,255,0.5); font-weight: 500; white-space: nowrap; }

.sb-close-btn {
    width: 32px; height: 32px; border-radius: 8px; border: none;
    background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.8);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; cursor: pointer; flex-shrink: 0;
    transition: background .2s;
}
.sb-close-btn:hover { background: rgba(255,255,255,0.2); color: #fff; }

/* ── Nav label ── */
.sb-nav-label {
    font-size: 9.5px; font-weight: 700; letter-spacing: 1.2px;
    color: rgba(255,255,255,0.3);
    padding: 14px 20px 6px;
    flex-shrink: 0;
}

/* ── Menu list ── */
.sb-menu {
    list-style: none; margin: 0; padding: 0 10px;
    overflow-y: auto; flex: 1;
}
.sb-menu::-webkit-scrollbar { width: 3px; }
.sb-menu::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 3px; }

/* ── Menu items ── */
.sb-menu .menu-item { margin: 2px 0; border-radius: 10px; }

.sb-menu .menu-link {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: 10px;
    color: rgba(255,255,255,0.7) !important;
    font-size: 13.5px; font-weight: 500;
    text-decoration: none;
    transition: all .2s ease;
}
.sb-menu .menu-link:hover {
    background: rgba(255,255,255,0.1);
    color: #fff !important;
}

/* Active item */
.sb-menu .menu-item.active .menu-link {
    background: linear-gradient(90deg, rgba(232, 69, 69, 0.85), rgba(223, 28, 106, 0.7));
    color: #fff !important;
    box-shadow: 0 4px 14px rgba(232, 69, 69, 0.35);
}

/* Icon wrap */
.sb-icon-wrap {
    width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    background: rgba(255,255,255,0.08);
    transition: background .2s;
}
.sb-menu .menu-link:hover .sb-icon-wrap { background: rgba(255,255,255,0.15); }
.sb-menu .menu-item.active .menu-link .sb-icon-wrap {
    background: rgba(255,255,255,0.2);
}

.sb-link-text { flex: 1; }

/* ── Spacer ── */
.sb-spacer { flex: 1; min-height: 12px; }

/* ── Version tag ── */
.sb-version-tag {
    font-size: 10px; color: rgba(255,255,255,0.25);
    text-align: center; padding: 10px 16px 16px;
    border-top: 1px solid rgba(255,255,255,0.06);
    flex-shrink: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menu    = document.getElementById('layout-menu');
    const overlay = document.getElementById('sbOverlay');
    const closeBtn = document.getElementById('sbCloseBtn');

    // Header hamburger button (from header.blade.php)
    const mobileToggle = document.getElementById('mobileMenuToggle');

    function openSidebar()  { menu.classList.add('sb-open');    overlay.classList.add('active'); }
    function closeSidebar() { menu.classList.remove('sb-open'); overlay.classList.remove('active'); }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
            menu.classList.contains('sb-open') ? closeSidebar() : openSidebar();
        });
    }

    if (closeBtn)  closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    // Close on nav link tap (mobile UX)
    menu.querySelectorAll('.menu-link').forEach(function(link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 1200) closeSidebar();
        });
    });
});
</script>

