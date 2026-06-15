<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --success: #059669;
        --success-light: #ecfdf5;
        --warning: #d97706;
        --warning-light: #fffbeb;
        --danger: #dc2626;
        --danger-light: #fef2f2;
        --info: #0284c7;
        --info-light: #f0f9ff;
        --text-dark: #111827;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --bg-light: #f9fafb;
    }

    .cr-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }
    .cr-header { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.75rem; }
    .cr-header-left h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .cr-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .cr-breadcrumb a { color: var(--primary); text-decoration: none; }
    .cr-breadcrumb span { color: var(--border); }
    .cr-actions { display: flex; flex-wrap: wrap; gap: 0.5rem; justify-content: flex-end; }

    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-box { background: #fff; border-radius: 12px; padding: 1.25rem 1.5rem; border: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .stat-icon.purple { background: var(--primary-light); color: var(--primary); }
    .stat-icon.green { background: var(--success-light); color: var(--success); }
    .stat-icon.amber { background: var(--warning-light); color: var(--warning); }
    .stat-icon.blue { background: var(--info-light); color: var(--info); }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem; }
    .stat-value { font-size: 1.6rem; font-weight: 700; color: var(--text-dark); line-height: 1; }

    .cr-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,0.05); overflow: hidden; }
    .cr-card-body { padding: 1.5rem; }
    .filter-bar { background: var(--bg-light); border: 1px solid var(--border); border-radius: 10px; padding: 1.25rem; margin-bottom: 1.5rem; }
    .filter-bar .form-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; }
    .filter-bar .form-control,
    .filter-bar .form-select { border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 40px; background: #fff; color: var(--text-dark); box-shadow: none; }
    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
    .search-wrap { position: relative; }
    .search-wrap .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.8rem; pointer-events: none; }
    .search-wrap .form-control { padding-left: 34px; }
    .btn-filter { height: 40px; padding: 0 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; text-decoration: none; border: 0; white-space: nowrap; }
    .btn-apply { background: var(--primary); color: #fff; }
    .btn-apply:hover { background: #4338ca; color: #fff; }
    .btn-reset { background: #fff; border: 1px solid var(--border); color: var(--text-muted); }
    .btn-reset:hover { background: var(--bg-light); color: var(--text-dark); }
    .btn-export { height: 38px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; padding: 0 1rem; text-decoration: none; border: 1px solid transparent; }
    .btn-export.pdf { background: var(--danger-light); color: var(--danger); border-color: #fecaca; }
    .btn-export.csv { background: var(--success-light); color: var(--success); border-color: #bbf7d0; }

    .cr-table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.875rem; }
    .cr-table thead tr th { background: var(--bg-light); color: var(--text-muted); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .cr-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.15s; }
    .cr-table tbody tr:last-child { border-bottom: none; }
    .cr-table tbody tr:hover { background: #fafafa; }
    .cr-table tbody td { padding: 0.9rem 1rem; color: var(--text-dark); vertical-align: middle; }
    .cr-table .sno { font-size: 0.75rem; color: var(--text-muted); font-weight: 600; }
    .avatar-cell { display: flex; align-items: center; gap: 0.75rem; min-width: 180px; }
    .avatar { width: 36px; height: 36px; border-radius: 8px; background: var(--primary-light); color: var(--primary); font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .avatar-name { font-weight: 600; color: var(--text-dark); font-size: 0.875rem; }
    .avatar-email { font-size: 0.75rem; color: var(--text-muted); word-break: break-word; }
    .muted-cell { color: var(--text-muted); font-size: 0.78rem; }
    .date-main { font-size: 0.8rem; color: var(--text-dark); font-weight: 500; white-space: nowrap; }
    .date-sub { font-size: 0.72rem; color: var(--text-muted); white-space: nowrap; }
    .status-badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; text-transform: capitalize; white-space: nowrap; }
    .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .status-badge.pending,
    .status-badge.under_review,
    .status-badge.reviewed { background: var(--warning-light); color: var(--warning); }
    .status-badge.pending::before,
    .status-badge.under_review::before,
    .status-badge.reviewed::before { background: var(--warning); }
    .status-badge.approved,
    .status-badge.accepted,
    .status-badge.active,
    .status-badge.selected,
    .status-badge.shortlisted { background: var(--success-light); color: var(--success); }
    .status-badge.approved::before,
    .status-badge.accepted::before,
    .status-badge.active::before,
    .status-badge.selected::before,
    .status-badge.shortlisted::before { background: var(--success); }
    .status-badge.rejected,
    .status-badge.inactive { background: var(--danger-light); color: var(--danger); }
    .status-badge.rejected::before,
    .status-badge.inactive::before { background: var(--danger); }
    .status-badge.new,
    .status-badge.open,
    .status-badge.published { background: var(--info-light); color: var(--info); }
    .status-badge.new::before,
    .status-badge.open::before,
    .status-badge.published::before { background: var(--info); }
    .status-badge.default { background: var(--bg-light); color: var(--text-muted); }
    .status-badge.default::before { background: var(--text-muted); }
    .action-btn { width: 32px; height: 32px; border-radius: 7px; border: 1px solid var(--border); background: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: all 0.15s; text-decoration: none; }
    .action-btn.view { color: var(--info); border-color: #bae6fd; }
    .action-btn.view:hover { background: var(--info-light); transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.12); }
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state-icon { width: 72px; height: 72px; background: var(--bg-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.75rem; color: var(--text-muted); }
    .empty-state h5 { font-weight: 600; color: var(--text-dark); margin-bottom: 0.4rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.875rem; margin: 0; }
    .cr-pagination { display: flex; justify-content: center; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 1rem; }

    @media (max-width: 992px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .cr-header { flex-direction: column; align-items: flex-start; }
        .cr-actions { justify-content: flex-start; }
    }
    @media (max-width: 576px) {
        .cr-page { padding: 1rem; }
        .stat-grid { grid-template-columns: 1fr; }
    }
</style>
