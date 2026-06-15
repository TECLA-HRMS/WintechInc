<!-- Topbar -->
<header class="pro-topbar" id="layout-navbar">

    {{-- Left --}}
    <div class="pt-left">
        <button class="pt-toggle d-xl-none" id="mobileMenuToggle" title="Toggle Menu">
            <i class="ti ti-menu-2"></i>
        </button>
        {{-- Mobile brand --}}
        <a href="{{ route('admin.dashboard') }}" class="pt-mobile-brand d-flex d-xl-none align-items-center gap-2 text-decoration-none">
            <img src="{{ asset('frontend/images/logos/logo.png') }}" alt="Logo" class="pt-mobile-logo">
            <div>
                <div class="pt-brand-name">Wintech Inc</div>
                <div class="pt-brand-sub">Placement Services</div>
            </div>
        </a>
        {{-- Desktop page info --}}
        <div class="pt-page-info d-none d-xl-flex align-items-center gap-3">
            <div class="pt-page-divider"></div>
            <div>
                <div class="pt-page-title" id="pt-page-title">Admin Panel</div>
                <div class="pt-page-sub">Wintech Inc</div>
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="pt-right">

        {{-- Greeting --}}
        <div class="pt-greeting d-none d-lg-flex">
            <i class="ti ti-sun" id="greetIcon"></i>
            <span id="greetText">Good Morning</span>
        </div>

        <div class="pt-vdivider"></div>

        {{-- Clock --}}
        <div class="pt-clock">
            <i class="ti ti-clock"></i>
            <span id="topbarClock">--:--:--</span>
        </div>

        <div class="pt-vdivider"></div>

        {{-- Notifications --}}
        <div class="dropdown" id="notifDropdown">
            <button class="pt-icon-btn" id="notifBtn" data-bs-toggle="dropdown" data-bs-auto-close="outside" title="Notifications">
                <i class="ti ti-bell"></i>
                <span class="pt-notif-dot d-none" id="notifDot"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end pt-notif-drop" id="notifMenu">
                <div class="pt-drop-head">
                    <span class="pt-drop-title"><i class="ti ti-bell me-1"></i>Notifications</span>
                    <span class="pt-notif-badge" id="notifCount">0</span>
                </div>
                <div class="pt-notif-list" id="notifList">
                    <div class="pt-notif-loading">
                        <div class="pt-spinner"></div>
                        <span>Loading...</span>
                    </div>
                </div>
                <div class="pt-drop-footer">
                    <a href="{{ route('admin.resume.index') }}">View all activity</a>
                </div>
            </div>
        </div>

        <div class="pt-vdivider"></div>

        {{-- User Dropdown --}}
        <div class="pt-user-dropdown" id="userDropdownWrap">
            <button class="pt-user-btn" id="userDropdownBtn" onclick="toggleUserDrop(event)">
                <div class="pt-user-ava">
                    <i class="ti ti-user-circle"></i>
                    <span class="pt-ava-dot"></span>
                </div>
                <div class="pt-user-info d-none d-sm-block">
                    @php $authAdmin = DB::table('admins')->where('id', session('admin_id'))->first(); @endphp
                    <div class="pt-user-name">{{ $authAdmin->name ?? 'Administrator' }}</div>
                    <div class="pt-user-role">{{ ucfirst(str_replace('_', ' ', $authAdmin->role ?? 'Admin')) }}</div>
                </div>
                <i class="ti ti-chevron-down pt-chevron" id="userChevron"></i>
            </button>
        </div>

        {{-- Dropdown teleported to body to avoid overflow clipping --}}
        <div class="pt-user-drop" id="userDropMenu" style="display:none;position:fixed;z-index:99999;">
                {{-- Profile Header --}}
                <div class="pt-drop-profile">
                    <div class="pt-dp-ava-wrap">
                        <i class="ti ti-user-circle pt-dp-icon"></i>
                        <span class="pt-dp-dot"></span>
                    </div>
                    <div class="pt-dp-info">
                        <div class="pt-dp-name">{{ $authAdmin->name ?? 'Administrator' }}</div>
                        <div class="pt-dp-role">{{ ucfirst(str_replace('_', ' ', $authAdmin->role ?? 'Admin')) }}</div>
                        <div class="pt-dp-company">
                            <i class="ti ti-building me-1"></i>Wintech Inc
                        </div>
                    </div>
                </div>

                <div class="pt-drop-divider"></div>

                <a class="pt-drop-item" href="{{ route('admin.dashboard') }}">
                    <span class="pt-di-icon" style="background:#eef2ff;color:#4f46e5"><i class="ti ti-layout-dashboard"></i></span>
                    Dashboard
                </a>
                <a class="pt-drop-item" href="{{ route('admin.resume.index') }}">
                    <span class="pt-di-icon" style="background:#ecfdf5;color:#059669"><i class="ti ti-file-description"></i></span>
                    Applications
                </a>
                <a class="pt-drop-item" href="{{ route('admin.managejobs.index') }}">
                    <span class="pt-di-icon" style="background:#fffbeb;color:#d97706"><i class="ti ti-briefcase"></i></span>
                    Job Management
                </a>
                <a class="pt-drop-item" href="{{ route('admin.settings.index') }}">
                    <span class="pt-di-icon" style="background:#f3e8ff;color:#7e22ce"><i class="ti ti-settings"></i></span>
                    Settings
                </a>

                <div class="pt-drop-divider"></div>

                <a class="pt-drop-item pt-drop-logout" href="{{ route('admin.logout') }}">
                    <span class="pt-di-icon" style="background:#fef2f2;color:#dc2626"><i class="ti ti-logout"></i></span>
                    Sign Out
                </a>
        </div>

    </div>
</header>

<style>
.pro-topbar {
    position: sticky; top: 0; z-index: 1030;
    height: 64px; display: flex; align-items: center; justify-content: space-between;
    padding: 0 24px; background: #fff;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06); gap: 16px;
    overflow: visible;
}
.pt-left  { display: flex; align-items: center; gap: 14px; min-width: 0; }
.pt-right { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }
.pt-vdivider { width: 1px; height: 26px; background: #e5e7eb; margin: 0 4px; }

/* Toggle */
.pt-toggle {
    width: 38px; height: 38px; border-radius: 10px; border: none; background: none;
    display: flex; align-items: center; justify-content: center;
    color: #4f46e5; font-size: 20px; cursor: pointer; transition: background .2s; flex-shrink: 0;
}
.pt-toggle:hover { background: #eef2ff; }

/* Mobile brand */
.pt-mobile-logo {
    width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
    object-fit: contain; background: #fff; padding: 3px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.pt-brand-name { font-size: 13px; font-weight: 800; color: #111827; line-height: 1.2; }
.pt-brand-sub  { font-size: 9.5px; color: #6b7280; font-weight: 500; line-height: 1.2; }

/* Desktop page info */
.pt-page-divider { width: 1px; height: 32px; background: #e5e7eb; }
.pt-page-title { font-size: 15px; font-weight: 700; color: #111827; line-height: 1.2; }
.pt-page-sub   { font-size: 11px; color: #9ca3af; font-weight: 500; line-height: 1.2; }

/* Greeting */
.pt-greeting {
    align-items: center; gap: 6px; font-size: 12.5px; font-weight: 600; color: #374151;
    background: #f9fafb; border: 1px solid #e5e7eb;
    padding: 6px 14px; border-radius: 50px; white-space: nowrap;
}
.pt-greeting .ti { color: #f59e0b; font-size: 14px; }

/* Clock */
.pt-clock {
    display: flex; align-items: center; gap: 6px;
    font-size: 12.5px; font-weight: 700; color: #4f46e5;
    background: #eef2ff; border: 1px solid #c7d2fe;
    padding: 6px 14px; border-radius: 50px; white-space: nowrap;
    font-variant-numeric: tabular-nums;
}

/* Notification bell */
.pt-icon-btn {
    position: relative; width: 38px; height: 38px; border-radius: 10px;
    border: 1px solid #e5e7eb; background: #fff;
    display: flex; align-items: center; justify-content: center;
    color: #6b7280; font-size: 18px; cursor: pointer; transition: all .2s;
}
.pt-icon-btn:hover { border-color: #4f46e5; color: #4f46e5; background: #eef2ff; }
.pt-notif-dot {
    position: absolute; top: 6px; right: 6px;
    width: 9px; height: 9px; background: #ef4444; border-radius: 50%; border: 2px solid #fff;
    animation: notifPulse 2s infinite;
}
@keyframes notifPulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,.5); }
    50%      { box-shadow: 0 0 0 5px rgba(239,68,68,0); }
}

/* Notification dropdown */
.pt-notif-drop {
    border: 1px solid #e5e7eb; border-radius: 16px; padding: 0;
    box-shadow: 0 12px 40px rgba(0,0,0,0.13); min-width: 330px;
    margin-top: 10px !important; overflow: hidden;
}
.pt-drop-head {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 16px 12px; border-bottom: 1px solid #f3f4f6;
    background: #fafafa;
}
.pt-drop-title { font-size: 13.5px; font-weight: 700; color: #111827; }
.pt-notif-badge {
    font-size: 11px; font-weight: 700; background: #eef2ff; color: #4f46e5;
    padding: 3px 10px; border-radius: 20px; min-width: 28px; text-align: center;
}
.pt-notif-list { padding: 8px; max-height: 320px; overflow-y: auto; }
.pt-notif-list::-webkit-scrollbar { width: 4px; }
.pt-notif-list::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }

.pt-notif-item {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px; border-radius: 10px; transition: background .15s; cursor: pointer;
    text-decoration: none;
}
.pt-notif-item:hover { background: #f3f4f6; }
.pt-ni-icon {
    width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.pt-ni-body { flex: 1; min-width: 0; }
.pt-ni-text { font-size: 12.5px; font-weight: 600; color: #111827; line-height: 1.4; }
.pt-ni-time { font-size: 11px; color: #9ca3af; margin-top: 2px; }

/* Loading state */
.pt-notif-loading {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    padding: 24px; color: #9ca3af; font-size: 13px;
}
.pt-spinner {
    width: 18px; height: 18px; border: 2px solid #e5e7eb;
    border-top-color: #4f46e5; border-radius: 50%; animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* Empty state */
.pt-notif-empty {
    text-align: center; padding: 28px 16px; color: #9ca3af; font-size: 13px;
}
.pt-notif-empty i { font-size: 28px; display: block; margin-bottom: 8px; color: #d1d5db; }

.pt-drop-footer {
    padding: 10px 16px; border-top: 1px solid #f3f4f6; text-align: center; background: #fafafa;
}
.pt-drop-footer a {
    font-size: 12.5px; font-weight: 600; color: #4f46e5; text-decoration: none;
}
.pt-drop-footer a:hover { text-decoration: underline; }

/* User dropdown wrapper */
.pt-user-dropdown { position: relative; }

/* User button */
.pt-user-btn {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border: 1.5px solid #e5e7eb; border-radius: 50px;
    padding: 5px 14px 5px 5px; cursor: pointer; transition: all .2s;
}
.pt-user-btn:hover { border-color: #4f46e5; background: #eef2ff; }

/* User avatar icon */
.pt-user-ava {
    position: relative; width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #818cf8);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 22px; flex-shrink: 0;
}
.pt-ava-dot {
    position: absolute; bottom: 1px; right: 1px;
    width: 9px; height: 9px; background: #22c55e; border-radius: 50%; border: 2px solid #fff;
}
.pt-user-info { display: flex; flex-direction: column; line-height: 1.2; text-align: left; }
.pt-user-name { font-size: 12.5px; font-weight: 700; color: #111827; }
.pt-user-role { font-size: 10.5px; color: #9ca3af; }
.pt-user-btn.dropdown-toggle::after { display: none; }
.pt-chevron { font-size: 13px; color: #9ca3af; transition: transform .2s; }
.pt-user-dropdown.open .pt-chevron { transform: rotate(180deg); }

/* User dropdown menu */
.pt-user-drop {
    position: fixed;
    z-index: 99999;
    border: 1px solid #e5e7eb; border-radius: 18px; padding: 0;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12); min-width: 260px;
    overflow: hidden; background: #fff;
}
.pt-drop-profile {
    display: flex; align-items: center; gap: 12px;
    padding: 16px; background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
}
.pt-dp-ava-wrap { position: relative; flex-shrink: 0; }
.pt-dp-icon { font-size: 48px; color: rgba(255,255,255,0.9); display: block; }
.pt-dp-dot {
    position: absolute; bottom: 4px; right: 2px;
    width: 11px; height: 11px; background: #22c55e; border-radius: 50%; border: 2px solid #1e3a8a;
}
.pt-dp-info { flex: 1; min-width: 0; }
.pt-dp-name    { font-size: 14px; font-weight: 800; color: #fff; margin-bottom: 1px; }
.pt-dp-role    { font-size: 11.5px; color: rgba(255,255,255,0.7); margin-bottom: 4px; }
.pt-dp-company { font-size: 10.5px; color: rgba(255,255,255,0.5); display: flex; align-items: center; }

.pt-drop-divider { height: 1px; background: #f3f4f6; margin: 4px 0; }
.pt-drop-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; font-size: 13px; font-weight: 500; color: #374151;
    text-decoration: none; transition: background .15s;
}
.pt-drop-item:hover { background: #f9fafb; color: #111827; }
.pt-di-icon {
    width: 30px; height: 30px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 14px;
}
.pt-drop-logout { color: #dc2626 !important; font-weight: 600; }
.pt-drop-logout:hover { background: #fef2f2 !important; }

@media (max-width: 576px) {
    .pro-topbar { padding: 0 14px; }
    .pt-clock, .pt-greeting { display: none !important; }
    .pt-vdivider { display: none; }
    .pt-notif-drop { min-width: 290px; }
}
</style>

<script>
(function(){
    // Clock
    function tick(){
        const el = document.getElementById('topbarClock');
        if(!el) return;
        el.textContent = new Date().toLocaleTimeString('en-IN',{hour:'2-digit',minute:'2-digit',second:'2-digit',hour12:true});
    }
    tick(); setInterval(tick, 1000);

    // Greeting
    const h = new Date().getHours();
    const gt = document.getElementById('greetText');
    const gi = document.getElementById('greetIcon');
    if(gt){
        if(h < 12){ gt.textContent='Good Morning'; gi.className='ti ti-sun'; }
        else if(h < 17){ gt.textContent='Good Afternoon'; gi.className='ti ti-sun-high'; }
        else { gt.textContent='Good Evening'; gi.className='ti ti-moon'; }
    }

    // Page title
    const pt = document.getElementById('pt-page-title');
    if(pt && document.title){
        pt.textContent = document.title.split('|')[0]?.trim() || 'Admin Panel';
    }

    // ===== Real Notifications =====
    let notifLoaded = false;

    function loadNotifications(){
        if(notifLoaded) return;
        notifLoaded = true;

        fetch('{{ route("admin.notifications.feed") }}')
            .then(r => r.json())
            .then(data => {
                const list  = document.getElementById('notifList');
                const badge = document.getElementById('notifCount');
                const dot   = document.getElementById('notifDot');

                badge.textContent = data.count > 0 ? data.count : '0';

                if(data.count > 0){
                    dot.classList.remove('d-none');
                }

                if(!data.items || data.items.length === 0){
                    list.innerHTML = `
                        <div class="pt-notif-empty">
                            <i class="ti ti-bell-off"></i>
                            No new notifications
                        </div>`;
                    return;
                }

                list.innerHTML = data.items.map(n => `
                    <a href="${n.link}" class="pt-notif-item">
                        <div class="pt-ni-icon" style="background:${n.bg};color:${n.color}">
                            <i class="ti ${n.icon}"></i>
                        </div>
                        <div class="pt-ni-body">
                            <div class="pt-ni-text">${n.text}</div>
                            <div class="pt-ni-time"><i class="ti ti-clock me-1"></i>${n.ago}</div>
                        </div>
                    </a>
                `).join('');
            })
            .catch(() => {
                document.getElementById('notifList').innerHTML = `
                    <div class="pt-notif-empty">
                        <i class="ti ti-wifi-off"></i>
                        Could not load notifications
                    </div>`;
            });
    }

    // Load on dropdown open
    document.getElementById('notifBtn')?.addEventListener('click', loadNotifications);

    // Auto-refresh every 60s
    setInterval(() => { notifLoaded = false; }, 60000);
})();

function toggleUserDrop(e) {
    e.stopPropagation();
    const menu = document.getElementById('userDropMenu');
    const btn  = document.getElementById('userDropdownBtn');
    const wrap = document.getElementById('userDropdownWrap');

    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        wrap.classList.remove('open');
        return;
    }

    // Position relative to button using fixed coords
    const rect = btn.getBoundingClientRect();
    menu.style.top   = (rect.bottom + 8) + 'px';
    menu.style.right = (window.innerWidth - rect.right) + 'px';
    menu.style.left  = 'auto';
    menu.style.display = 'block';
    wrap.classList.add('open');

    // Move to body if not already there
    if (menu.parentElement !== document.body) {
        document.body.appendChild(menu);
    }
}
document.addEventListener('click', function(e) {
    const menu = document.getElementById('userDropMenu');
    const btn  = document.getElementById('userDropdownBtn');
    if (menu && !menu.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {
        menu.style.display = 'none';
        document.getElementById('userDropdownWrap')?.classList.remove('open');
    }
});
</script>
<!-- / Topbar -->
