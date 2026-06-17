@extends('layouts.site')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ========================================
   CSS VARIABLES
======================================== */
:root {
  --brand: #071056;
  --brand-dark: #040b3a;
  --brand-light: #1a3ed4;
  --brand-glow: rgba(7, 16, 86, 0.35);

  --sidebar-bg: #060d40;
  --sidebar-border: #0e1a6e;
  --sidebar-hover: #0a1560;
  --sidebar-active: linear-gradient(135deg, #071056, #1a3ed4);

  --page-bg: #f0f2f7;
  --card-bg: #ffffff;
  --card-border: rgba(0,0,0,0.06);
  --card-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.06);
  --card-shadow-hover: 0 4px 12px rgba(0,0,0,0.06), 0 12px 40px rgba(0,0,0,0.1);

  --text-primary: #0d1117;
  --text-secondary: #57606a;
  --text-muted: #8b949e;

  --input-bg: #f6f8fa;
  --input-border: #d0d7de;
  --input-focus-border: #071056;
  --input-focus-shadow: 0 0 0 3px rgba(7, 16, 86, 0.14);

  --success: #1a7f37;
  --success-bg: #dafbe1;
  --danger: #cf222e;
  --danger-bg: #ffebe9;
  --warning: #9a6700;
  --info: #0969da;
}

/* ========================================
   BASE
======================================== */
* { box-sizing: border-box; margin: 0; padding: 0; }

.sp-root {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  background: var(--page-bg);
  min-height: 100vh;
  -webkit-font-smoothing: antialiased;
}

/* ========================================
   PAGE HERO BANNER
======================================== */
.sp-hero {
  background: var(--sidebar-bg);
  background-image:
    radial-gradient(ellipse 80% 50% at 20% -10%, rgba(26,62,212,0.35) 0%, transparent 60%),
    radial-gradient(ellipse 60% 40% at 80% 110%, rgba(7,16,86,0.4) 0%, transparent 60%);
  padding: 48px 0 80px;
  position: relative;
  overflow: hidden;
}

.sp-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
  background-size: 48px 48px;
  mask-image: linear-gradient(180deg, transparent, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0.5) 60%, transparent);
}

.sp-hero-inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 32px;
  position: relative;
  z-index: 1;
}

.sp-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(26,62,212,0.18);
  border: 1px solid rgba(26,62,212,0.4);
  color: #7ea6ff;
  font-size: 12px;
  font-weight: 600;
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: 20px;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}

.sp-hero-badge::before {
  content: '';
  width: 6px;
  height: 6px;
  background: #7ea6ff;
  border-radius: 50%;
  animation: pulse-dot 2s ease infinite;
}

@keyframes pulse-dot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.5; transform: scale(0.7); }
}

.sp-hero h1 {
  font-size: clamp(28px, 4vw, 42px);
  font-weight: 800;
  color: #ffffff;
  letter-spacing: -0.03em;
  line-height: 1.15;
  margin-bottom: 12px;
}

.sp-hero h1 span {
  background: linear-gradient(135deg, #7ea6ff, #a5c8ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.sp-hero p {
  color: #8b949e;
  font-size: 16px;
  font-weight: 400;
}

/* ========================================
   MAIN LAYOUT
======================================== */
.sp-body {
  max-width: 1280px;
  margin: -44px auto 80px;
  padding: 0 32px;
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: 260px 1fr;
  gap: 24px;
  align-items: start;
}

@media (max-width: 991px) {
  .sp-body {
    grid-template-columns: 1fr;
    margin-top: -32px;
    padding: 0 20px;
    gap: 16px;
  }
}

@media (max-width: 575px) {
  .sp-body { padding: 0 14px; gap: 14px; }
  .sp-hero { padding: 36px 0 70px; }
  .sp-hero-inner { padding: 0 20px; }
}

/* ========================================
   SIDEBAR
======================================== */
.sp-sidebar {
  background: var(--sidebar-bg);
  border: 1px solid var(--sidebar-border);
  border-radius: 20px;
  overflow: hidden;
  position: sticky;
  top: 100px;
  box-shadow: 0 8px 40px rgba(0,0,0,0.2);
}

@media (max-width: 991px) {
  .sp-sidebar {
    position: static;
    border-radius: 16px;
  }
}

.sp-sidebar-profile {
  padding: 28px 20px 20px;
  text-align: center;
  border-bottom: 1px solid var(--sidebar-border);
  background: linear-gradient(180deg, rgba(7,16,86,0.08) 0%, transparent 100%);
}

.sp-avatar {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 12px;
  font-size: 26px;
  font-weight: 800;
  color: #fff;
  position: relative;
  box-shadow: 0 0 0 3px rgba(7,16,86,0.3), 0 0 0 6px rgba(7,16,86,0.1);
  letter-spacing: -0.02em;
}

.sp-avatar-online {
  position: absolute;
  bottom: 3px;
  right: 3px;
  width: 14px;
  height: 14px;
  background: #1a7f37;
  border-radius: 50%;
  border: 2px solid var(--sidebar-bg);
}

.sp-sidebar-name {
  font-size: 15px;
  font-weight: 700;
  color: #f0f6fc;
  margin-bottom: 4px;
  letter-spacing: -0.01em;
}

.sp-sidebar-email {
  font-size: 12px;
  color: #8b949e;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.sp-sidebar-nav {
  padding: 12px;
}

.sp-nav-group-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: #484f58;
  padding: 8px 12px 4px;
  margin-top: 4px;
}

.sp-nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 11px 14px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 500;
  color: #8b949e;
  cursor: pointer;
  border: none;
  background: transparent;
  width: 100%;
  text-align: left;
  transition: all 0.2s ease;
  margin-bottom: 2px;
  position: relative;
  text-decoration: none;
}

.sp-nav-item:hover {
  background: var(--sidebar-hover);
  color: #f0f6fc;
}

.sp-nav-item.active {
  background: var(--sidebar-active);
  color: #fff;
  font-weight: 600;
  box-shadow: 0 4px 16px rgba(7,16,86,0.3);
}

.sp-nav-item.active .sp-nav-icon {
  filter: drop-shadow(0 0 6px rgba(255,255,255,0.4));
}

.sp-nav-icon {
  width: 18px;
  height: 18px;
  flex-shrink: 0;
  opacity: 0.8;
  transition: all 0.2s;
}

.sp-nav-item.active .sp-nav-icon,
.sp-nav-item:hover .sp-nav-icon {
  opacity: 1;
}

.sp-nav-item-badge {
  margin-left: auto;
  background: rgba(7,16,86,0.2);
  color: #f87171;
  font-size: 10px;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 999px;
  border: 1px solid rgba(7,16,86,0.3);
}

.sp-nav-item.active .sp-nav-item-badge {
  background: rgba(255,255,255,0.2);
  color: #fff;
  border-color: rgba(255,255,255,0.3);
}

/* Mobile sidebar */
@media (max-width: 991px) {
  .sp-sidebar-profile { padding: 24px 16px 16px; border-bottom: none; }
  .sp-avatar { width: 64px; height: 64px; font-size: 22px; margin-bottom: 8px; }
  .sp-sidebar-name { font-size: 16px; }
  .sp-sidebar-nav {
    display: flex;
    flex-wrap: nowrap;
    gap: 8px;
    padding: 12px 16px 16px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none; /* Hide scrollbar for Firefox */
    border-top: 1px solid rgba(255,255,255,0.05);
  }
  .sp-sidebar-nav::-webkit-scrollbar { display: none; } /* Hide scrollbar for Chrome/Safari */
  .sp-nav-group-label { display: none; }
  .sp-nav-item {
    flex: 0 0 auto;
    width: auto;
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 99px;
    margin-bottom: 0;
    white-space: nowrap;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
  }
  .sp-nav-item.active {
    background: linear-gradient(135deg, var(--brand), var(--brand-light));
    border-color: transparent;
  }
  .sp-nav-item-badge { display: none; }
}

/* ========================================
   CONTENT PANEL
======================================== */
.sp-panel {
  background: var(--card-bg);
  border: 1px solid var(--card-border);
  border-radius: 20px;
  box-shadow: var(--card-shadow);
  overflow: hidden;
}

.sp-section {
  display: none;
  animation: sp-fade 0.35s cubic-bezier(0.16,1,0.3,1);
}

.sp-section.active { display: block; }

@keyframes sp-fade {
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ========================================
   SECTION HEADER
======================================== */
.sp-section-header {
  padding: 36px 40px 28px;
  border-bottom: 1px solid #f3f4f6;
  background: linear-gradient(180deg, #fafbfc 0%, #ffffff 100%);
}

.sp-section-header-top {
  display: flex;
  align-items: flex-start;
  gap: 16px;
}

.sp-section-icon {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 20px;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(7,16,86,0.25);
}

.sp-section-header h2 {
  font-size: 22px;
  font-weight: 800;
  color: var(--text-primary);
  letter-spacing: -0.02em;
  margin-bottom: 4px;
}

.sp-section-header p {
  font-size: 14px;
  color: var(--text-muted);
  font-weight: 400;
}

@media (max-width: 767px) {
  .sp-section-header { padding: 28px 24px 20px; }
}
@media (max-width: 575px) {
  .sp-section-header { padding: 22px 18px 18px; }
  .sp-section-icon { width: 40px; height: 40px; font-size: 16px; border-radius: 12px; }
  .sp-section-header h2 { font-size: 18px; }
}

/* ========================================
   SECTION BODY
======================================== */
.sp-section-body {
  padding: 36px 40px;
}

@media (max-width: 767px) {
  .sp-section-body { padding: 28px 24px; }
}
@media (max-width: 575px) {
  .sp-section-body { padding: 22px 18px; }
}

/* ========================================
   STATS ROW
======================================== */
.sp-stats-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 16px;
  margin-bottom: 36px;
}

.sp-stat {
  background: linear-gradient(135deg, #fafbfc, #f3f4f6);
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  padding: 20px 22px;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.sp-stat::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  right: 0; height: 3px;
  background: linear-gradient(90deg, var(--brand), var(--brand-light));
  border-radius: 16px 16px 0 0;
}

.sp-stat:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.sp-stat-icon {
  font-size: 22px;
  margin-bottom: 12px;
  display: block;
  color: var(--brand);
}

.sp-stat-value {
  font-size: 24px;
  font-weight: 800;
  color: var(--text-primary);
  letter-spacing: -0.03em;
  margin-bottom: 4px;
}

.sp-stat-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

/* ========================================
   FORM ELEMENTS
======================================== */
.sp-subsection-title {
  font-size: 13px;
  font-weight: 700;
  color: var(--text-primary);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding-bottom: 12px;
  margin-bottom: 20px;
  border-bottom: 2px solid #f3f4f6;
  display: flex;
  align-items: center;
  gap: 10px;
}

.sp-subsection-title::before {
  content: '';
  display: block;
  width: 3px;
  height: 16px;
  background: linear-gradient(180deg, var(--brand), var(--brand-light));
  border-radius: 2px;
}

.sp-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent);
  margin: 32px 0;
}

.sp-grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-bottom: 20px;
}

.sp-grid-2:last-child { margin-bottom: 0; }

@media (max-width: 640px) {
  .sp-grid-2 { grid-template-columns: 1fr; gap: 20px; }
}

.sp-form-group {
  margin-bottom: 20px;
}

.sp-grid-2 .sp-form-group {
  margin-bottom: 0;
}

.sp-form-group:last-child { margin-bottom: 0; }

.sp-label {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 600;
  color: var(--text-secondary);
  margin-bottom: 8px;
  letter-spacing: 0.01em;
}

.sp-label-required {
  color: var(--brand);
  font-size: 14px;
}

.sp-input {
  width: 100%;
  padding: 11px 16px;
  background: var(--input-bg);
  border: 1.5px solid var(--input-border);
  border-radius: 10px;
  font-size: 14px;
  font-weight: 400;
  color: var(--text-primary);
  font-family: 'Inter', sans-serif;
  transition: all 0.2s ease;
  appearance: none;
}

.sp-input::placeholder { color: #adb5bd; }

.sp-input:hover {
  border-color: #b0b7c3;
  background: #fff;
}

.sp-input:focus {
  outline: none;
  border-color: var(--input-focus-border);
  background: #fff;
  box-shadow: var(--input-focus-shadow);
}

.sp-input:disabled {
  background: #f0f2f5;
  color: var(--text-muted);
  cursor: not-allowed;
  border-color: #e0e4e9;
}

.sp-select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%238b949e' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 40px;
  cursor: pointer;
}

textarea.sp-input {
  resize: vertical;
  min-height: 110px;
  line-height: 1.6;
}

.sp-input-hint {
  font-size: 12px;
  color: var(--text-muted);
  margin-top: 6px;
}

/* File upload */
.sp-file-drop {
  border: 2px dashed var(--input-border);
  border-radius: 12px;
  padding: 32px;
  text-align: center;
  background: var(--input-bg);
  cursor: pointer;
  transition: all 0.25s ease;
}

.sp-file-drop:hover, .sp-file-drop.dragover {
  border-color: var(--brand);
  background: rgba(7,16,86,0.03);
}

.sp-file-drop-icon {
  font-size: 32px;
  color: var(--text-muted);
  margin-bottom: 12px;
  display: block;
}

.sp-file-drop p {
  font-size: 14px;
  color: var(--text-secondary);
  margin-bottom: 4px;
}

.sp-file-drop span {
  font-size: 12px;
  color: var(--text-muted);
}

.sp-file-drop input[type="file"] {
  display: none;
}

/* ========================================
   TOGGLE SWITCHES
======================================== */
.sp-toggle-list {
  border: 1px solid #e5e7eb;
  border-radius: 14px;
  overflow: hidden;
  margin-bottom: 8px;
}

.sp-toggle-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  padding: 18px 22px;
  border-bottom: 1px solid #f3f4f6;
  transition: background 0.2s;
}

.sp-toggle-item:last-child { border-bottom: none; }
.sp-toggle-item:hover { background: #fafbfc; }

.sp-toggle-text h4 {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 3px;
}

.sp-toggle-text p {
  font-size: 13px;
  color: var(--text-muted);
  line-height: 1.5;
}

.sp-switch {
  position: relative;
  width: 48px;
  height: 26px;
  flex-shrink: 0;
}

.sp-switch input { opacity: 0; width: 0; height: 0; position: absolute; }

.sp-switch-track {
  position: absolute;
  inset: 0;
  background: #d1d5db;
  border-radius: 999px;
  cursor: pointer;
  transition: 0.35s cubic-bezier(0.16,1,0.3,1);
}

.sp-switch-track::after {
  content: '';
  position: absolute;
  top: 3px; left: 3px;
  width: 20px; height: 20px;
  background: #fff;
  border-radius: 50%;
  transition: 0.35s cubic-bezier(0.16,1,0.3,1);
  box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

.sp-switch input:checked ~ .sp-switch-track {
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  box-shadow: 0 2px 8px rgba(7,16,86,0.3);
}

.sp-switch input:checked ~ .sp-switch-track::after {
  transform: translateX(22px);
}

/* ========================================
   ACTION CARDS
======================================== */
.sp-action-card {
  display: flex;
  align-items: flex-start;
  gap: 18px;
  padding: 22px 24px;
  border: 1px solid #e5e7eb;
  border-radius: 14px;
  background: #fafbfc;
  margin-bottom: 14px;
  transition: all 0.25s ease;
}

.sp-action-card:hover {
  border-color: #d0d7de;
  background: #fff;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  transform: translateY(-1px);
}

.sp-action-card-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}

.sp-action-card-icon.blue { background: #dbeafe; color: #1d4ed8; }
.sp-action-card-icon.green { background: #dcfce7; color: #16a34a; }
.sp-action-card-icon.purple { background: #ede9fe; color: #7c3aed; }
.sp-action-card-icon.orange { background: #ffedd5; color: #c2410c; }
.sp-action-card-icon.red { background: #fee2e2; color: #dc2626; }
.sp-action-card-icon.gray { background: #f3f4f6; color: #4b5563; }

.sp-action-card-body {
  flex: 1;
  min-width: 0;
}

.sp-action-card-body h4 {
  font-size: 15px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.sp-action-card-body p {
  font-size: 13px;
  color: var(--text-muted);
  line-height: 1.55;
  margin-bottom: 14px;
}

.sp-action-card.danger-card {
  border-color: #fecaca;
  background: #fff5f5;
}

.sp-action-card.danger-card h4 { color: #dc2626; }
.sp-action-card.danger-card p { color: #ef4444; }

.sp-action-card.success-card {
  border-color: #86efac;
  background: #f0fdf4;
}

/* ========================================
   BUTTONS
======================================== */
.sp-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 10px 22px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  border: none;
  transition: all 0.25s cubic-bezier(0.16,1,0.3,1);
  letter-spacing: 0.01em;
  text-decoration: none;
  position: relative;
}

.sp-btn:disabled { opacity: 0.55; cursor: not-allowed; }

.sp-btn.loading { pointer-events: none; color: transparent !important; }
.sp-btn.loading::after {
  content: '';
  position: absolute;
  width: 18px; height: 18px;
  top: 50%; left: 50%;
  margin: -9px 0 0 -9px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top-color: #fff;
  border-radius: 50%;
  animation: sp-spin 0.6s linear infinite;
}

@keyframes sp-spin { to { transform: rotate(360deg); } }

.sp-btn-primary {
  background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
  color: #fff;
  box-shadow: 0 4px 14px rgba(7,16,86,0.25), inset 0 1px 0 rgba(255,255,255,0.1);
}

.sp-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(7,16,86,0.35), inset 0 1px 0 rgba(255,255,255,0.1);
}

.sp-btn-primary:active { transform: translateY(0); }

.sp-btn-secondary {
  background: #ffffff;
  color: var(--text-secondary);
  border: 1.5px solid var(--input-border);
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.sp-btn-secondary:hover {
  background: #f6f8fa;
  border-color: #b0b7c3;
  color: var(--text-primary);
  transform: translateY(-1px);
}

.sp-btn-danger {
  background: linear-gradient(135deg, #dc2626, #ef4444);
  color: #fff;
  box-shadow: 0 4px 14px rgba(220,38,38,0.25);
}

.sp-btn-danger:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(220,38,38,0.35);
}

.sp-btn-sm {
  padding: 8px 16px;
  font-size: 13px;
  border-radius: 8px;
  gap: 6px;
}

.sp-btn-row {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-top: 28px;
}

/* ========================================
   ALERTS
======================================== */
.sp-alert {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 14px 18px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 24px;
  animation: sp-fade 0.3s ease;
}

.sp-alert i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }

.sp-alert-success {
  background: var(--success-bg);
  color: var(--success);
  border: 1px solid #86efac;
}

.sp-alert-danger {
  background: var(--danger-bg);
  color: var(--danger);
  border: 1px solid #fca5a5;
}

/* ========================================
   CHIP TAGS (Job Functions)
======================================== */
.sp-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.sp-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  border: 1.5px solid var(--input-border);
  border-radius: 999px;
  font-size: 13px;
  font-weight: 500;
  color: var(--text-secondary);
  background: var(--input-bg);
  cursor: pointer;
  transition: all 0.2s ease;
  user-select: none;
}

.sp-chip:hover {
  border-color: var(--brand);
  color: var(--brand);
  background: rgba(7,16,86,0.04);
}

.sp-chip.checked {
  border-color: var(--brand);
  color: var(--brand);
  background: rgba(7,16,86,0.08);
  font-weight: 600;
}

.sp-chip input { display: none; }

/* ========================================
   PROFILE PICTURE UPLOAD
======================================== */
.sp-photo-upload {
  display: flex;
  align-items: center;
  gap: 24px;
  padding: 20px 24px;
  background: #f8fafc;
  border: 1px solid #e5e7eb;
  border-radius: 14px;
  margin-bottom: 28px;
}

.sp-photo-preview {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  font-weight: 800;
  color: #fff;
  flex-shrink: 0;
  letter-spacing: -0.02em;
  overflow: hidden;
}

.sp-photo-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}

.sp-photo-info h4 {
  font-size: 15px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.sp-photo-info p {
  font-size: 12px;
  color: var(--text-muted);
  margin-bottom: 12px;
}

/* ========================================
   PROGRESS BAR
======================================== */
.sp-progress-wrap {
  background: #e5e7eb;
  border-radius: 999px;
  height: 8px;
  overflow: hidden;
  margin-top: 10px;
}

.sp-progress-bar {
  height: 100%;
  border-radius: 999px;
  background: linear-gradient(90deg, var(--brand), var(--brand-light));
  transition: width 1s cubic-bezier(0.16,1,0.3,1);
}

/* ========================================
   RESPONSIVE OVERRIDES
======================================== */
@media (max-width: 575px) {
  .sp-photo-upload { flex-direction: column; text-align: center; }
  .sp-btn-row { flex-direction: column; }
  .sp-btn-row .sp-btn { width: 100%; }
  .sp-action-card { flex-direction: column; gap: 14px; }
}
</style>


{{-- ===================== MARKUP ===================== --}}

<div class="sp-root">

  {{-- Hero Banner --}}
  <div class="sp-hero">
    <div class="sp-hero-inner">
      <div class="sp-hero-badge">Account Settings</div>
      <h1>Your <span>Settings</span></h1>
      <p>Manage your account, profile, security and preferences</p>
    </div>
  </div>

  {{-- Body --}}
  <div class="sp-body">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sp-sidebar">
      <div class="sp-sidebar-profile">
        <div class="sp-avatar">
          @if($user->profile_picture)
            <img loading="lazy" src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Avatar" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
          @else
            {{ strtoupper(substr($user->first_name ?? $user->name ?? 'U', 0, 1)) }}
          @endif
          <div class="sp-avatar-online"></div>
        </div>
        <div class="sp-sidebar-name">{{ $user->first_name ?? $user->name ?? 'User' }} {{ $user->last_name ?? '' }}</div>
        <div class="sp-sidebar-email">{{ $user->email }}</div>
      </div>

      <nav class="sp-sidebar-nav">
        <div class="sp-nav-group-label">General</div>
        <button class="sp-nav-item active" data-section="account" id="nav-account">
          <i class="fa-solid fa-user sp-nav-icon"></i>
          <span>Account</span>
        </button>
        <button class="sp-nav-item" data-section="profile" id="nav-profile">
          <i class="fa-solid fa-id-card sp-nav-icon"></i>
          <span>Profile</span>
        </button>

        <div class="sp-nav-group-label">Preferences</div>
        <button class="sp-nav-item" data-section="job-preferences" id="nav-job-preferences">
          <i class="fa-solid fa-briefcase sp-nav-icon"></i>
          <span>Job Preferences</span>
        </button>
        <button class="sp-nav-item" data-section="notifications" id="nav-notifications">
          <i class="fa-solid fa-bell sp-nav-icon"></i>
          <span>Notifications</span>
        </button>

        <button class="sp-nav-item" data-section="resume" id="nav-resume">
          <i class="fa-solid fa-file-pdf sp-nav-icon"></i>
          <span>Resume</span>
        </button>

        <div class="sp-nav-group-label">Data</div>
        <button class="sp-nav-item" data-section="data" id="nav-data">
          <i class="fa-solid fa-database sp-nav-icon"></i>
          <span>Data &amp; Storage</span>
          <span class="sp-nav-item-badge">!</span>
        </button>
      </nav>
    </aside>

    {{-- ===== CONTENT PANEL ===== --}}
    <main class="sp-panel">

      {{-- Flash Messages --}}
      @if(session('success'))
        <div style="padding:20px 36px 0;">
          <div class="sp-alert sp-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div style="padding:20px 36px 0;">
          <div class="sp-alert sp-alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
          </div>
        </div>
      @endif

      {{-- ========================
           ACCOUNT SECTION
      ======================== --}}
      <div class="sp-section active" id="account">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-user"></i></div>
            <div>
              <h2>Account Settings</h2>
              <p>Manage your login credentials and contact information</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">

          {{-- Stats --}}
          <div class="sp-stats-row">
            <div class="sp-stat">
              <span class="sp-stat-icon"><i class="fa-solid fa-chart-pie"></i></span>
              <div class="sp-stat-value">{{ $user->profile_completion ?? 0 }}%</div>
              <div class="sp-stat-label">Profile Complete</div>
              <div class="sp-progress-wrap" style="margin-top:12px;">
                <div class="sp-progress-bar" style="width:{{ $user->profile_completion ?? 0 }}%"></div>
              </div>
            </div>
            <div class="sp-stat">
              <span class="sp-stat-icon"><i class="fa-solid fa-calendar-check"></i></span>
              <div class="sp-stat-value" style="font-size:18px;">{{ $user->created_at->diffForHumans() }}</div>
              <div class="sp-stat-label">Member Since</div>
            </div>
          </div>

          <form action="{{ route('settings.account') }}" method="POST">
            @csrf

            <div class="sp-subsection-title">Contact Information</div>
            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-solid fa-envelope" style="color:var(--text-muted);font-size:12px;"></i>
                  Email Address
                </label>
                <input type="email" class="sp-input" value="{{ $user->email }}" disabled>
                <div class="sp-input-hint">Email cannot be changed. Contact support to update.</div>
              </div>
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-solid fa-phone" style="color:var(--text-muted);font-size:12px;"></i>
                  Phone Number
                </label>
                <input type="text" name="phone" class="sp-input" value="{{ $user->phone ?? '' }}" placeholder="e.g. +91 98765 43210">
              </div>
            </div>

            <div class="sp-divider"></div>
            <div class="sp-subsection-title">Change Password</div>

            <div class="sp-form-group">
              <label class="sp-label">
                <i class="fa-solid fa-lock" style="color:var(--text-muted);font-size:12px;"></i>
                Current Password
              </label>
              <input type="password" name="current_password" class="sp-input" placeholder="Enter your current password">
            </div>

            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">New Password</label>
                <input type="password" name="new_password" class="sp-input" placeholder="Minimum 8 characters">
              </div>
              <div class="sp-form-group">
                <label class="sp-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="sp-input" placeholder="Repeat new password">
              </div>
            </div>

            <div class="sp-btn-row">
              <button type="submit" class="sp-btn sp-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- ========================
           PROFILE SECTION
      ======================== --}}
      <div class="sp-section" id="profile">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-id-card"></i></div>
            <div>
              <h2>Profile Information</h2>
              <p>Update your personal details and public profile</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">

          <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Photo --}}
            <div class="sp-photo-upload">
              <div class="sp-photo-preview">
                @if($user->profile_picture)
                  <img loading="lazy" src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile Photo">
                @else
                  {{ strtoupper(substr($user->first_name ?? $user->name ?? 'U', 0, 1)) }}
                @endif
              </div>
              <div class="sp-photo-info">
                <h4>Profile Photo</h4>
                <p>JPG, PNG or GIF. Max 2MB recommended.</p>
                <label class="sp-btn sp-btn-secondary sp-btn-sm" style="cursor:pointer;">
                  <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  Upload Photo
                  <input type="file" name="profile_picture" accept="image/*" style="display:none;" onchange="previewPhoto(this)">
                </label>
              </div>
            </div>

            <div class="sp-subsection-title">Personal Details</div>
            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">First Name</label>
                <input type="text" name="first_name" class="sp-input" value="{{ $user->first_name ?? '' }}" placeholder="John">
              </div>
              <div class="sp-form-group">
                <label class="sp-label">Last Name</label>
                <input type="text" name="last_name" class="sp-input" value="{{ $user->last_name ?? '' }}" placeholder="Doe">
              </div>
            </div>

            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-solid fa-location-dot" style="color:var(--text-muted);font-size:12px;"></i>
                  Location
                </label>
                <input type="text" name="location" class="sp-input" value="{{ $user->location ?? '' }}" placeholder="City, State">
              </div>
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-solid fa-briefcase" style="color:var(--text-muted);font-size:12px;"></i>
                  Current Job Title
                </label>
                <input type="text" name="job_title" class="sp-input" value="{{ $user->job_title ?? '' }}" placeholder="e.g., Software Engineer">
              </div>
            </div>

            <div class="sp-form-group">
              <label class="sp-label">Bio / About Me</label>
              <textarea name="bio" class="sp-input" rows="4" placeholder="Tell employers about yourself, your skills and experience...">{{ $user->bio ?? '' }}</textarea>
            </div>

            <div class="sp-divider"></div>
            <div class="sp-subsection-title">Online Presence</div>

            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-brands fa-linkedin" style="color:#0a66c2;font-size:13px;"></i>
                  LinkedIn Profile
                </label>
                <input type="url" name="linkedin_url" class="sp-input" value="{{ $user->linkedin_url ?? '' }}" placeholder="https://linkedin.com/in/yourprofile">
              </div>
              <div class="sp-form-group">
                <label class="sp-label">
                  <i class="fa-solid fa-globe" style="color:var(--text-muted);font-size:12px;"></i>
                  Portfolio Website
                </label>
                <input type="url" name="portfolio_url" class="sp-input" value="{{ $user->portfolio_url ?? '' }}" placeholder="https://yourportfolio.com">
              </div>
            </div>

            <div class="sp-btn-row">
              <button type="submit" class="sp-btn sp-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                Save Profile
              </button>
              <button type="reset" class="sp-btn sp-btn-secondary">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- ========================
           JOB PREFERENCES SECTION
      ======================== --}}
      <div class="sp-section" id="job-preferences">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-briefcase"></i></div>
            <div>
              <h2>Job Preferences</h2>
              <p>Let us know what kind of roles you are looking for</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">
          <form action="{{ route('settings.job-preferences') }}" method="POST">
            @csrf
            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">Preferred Job Type</label>
                <select name="preferred_job_type" class="sp-input">
                  <option value="Full-Time" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                  <option value="Part-Time" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                  <option value="Contract" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                  <option value="Freelance" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                  <option value="Internship" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
              </div>
              <div class="sp-form-group">
                <label class="sp-label">Job Search Status</label>
                <select name="preferred_job_status" class="sp-input">
                  <option value="Actively looking" {{ ($settings['job']['preferred_job_status'] ?? '') == 'Actively looking' ? 'selected' : '' }}>Actively looking</option>
                  <option value="Open to offers" {{ ($settings['job']['preferred_job_status'] ?? '') == 'Open to offers' ? 'selected' : '' }}>Open to offers</option>
                  <option value="Not looking" {{ ($settings['job']['preferred_job_status'] ?? '') == 'Not looking' ? 'selected' : '' }}>Not looking</option>
                </select>
              </div>
            </div>

            <div class="sp-form-group">
              <label class="sp-label">Preferred Location</label>
              <input type="text" name="preferred_location" class="sp-input" value="{{ $settings['job']['preferred_location'] ?? '' }}" placeholder="e.g. Remote, New York, London">
            </div>

            <div class="sp-grid-2">
              <div class="sp-form-group">
                <label class="sp-label">Expected Salary (Min)</label>
                <input type="number" name="expected_salary_min" class="sp-input" value="{{ $settings['job']['expected_salary_min'] ?? '' }}" placeholder="e.g. 50000">
              </div>
              <div class="sp-form-group">
                <label class="sp-label">Expected Salary (Max)</label>
                <input type="number" name="expected_salary_max" class="sp-input" value="{{ $settings['job']['expected_salary_max'] ?? '' }}" placeholder="e.g. 90000">
              </div>
            </div>

            <div class="sp-form-group">
              <label class="sp-label">Job Posted Timeframe</label>
              <select name="job_posted_timeframe" class="sp-input">
                <option value="Any Time" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Any Time' ? 'selected' : '' }}>Any Time</option>
                <option value="Last 24 Hours" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 24 Hours' ? 'selected' : '' }}>Last 24 Hours</option>
                <option value="Last 7 Days" {{ ($settings['job']['job_posted_timeframe'] ?? 'Last 7 Days') == 'Last 7 Days' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="Last 14 Days" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 14 Days' ? 'selected' : '' }}>Last 14 Days</option>
                <option value="Last 30 Days" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 30 Days' ? 'selected' : '' }}>Last 30 Days</option>
              </select>
            </div>

            <div class="sp-form-group">
              <label class="sp-label">Preferred Job Functions</label>
              <div style="display:flex;flex-wrap:wrap;gap:10px;">
                @php $userFunctions = $notifPrefs->preferred_job_functions ?? []; @endphp
                @foreach($jobFunctions ?? [] as $jf)
                  <label style="display:flex;align-items:center;gap:6px;font-size:14px;color:var(--text-secondary);cursor:pointer;">
                    <input type="checkbox" name="preferred_job_functions[]" value="{{ $jf }}" {{ in_array($jf, $userFunctions) ? 'checked' : '' }}>
                    {{ $jf }}
                  </label>
                @endforeach
              </div>
            </div>

            <div class="sp-btn-row">
              <button type="submit" class="sp-btn sp-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                Save Preferences
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- ========================
           NOTIFICATIONS SECTION
      ======================== --}}
      <div class="sp-section" id="notifications">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-bell"></i></div>
            <div>
              <h2>Notification Settings</h2>
              <p>Control what emails and alerts you receive</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">
          <form action="{{ route('settings.notifications') }}" method="POST">
            @csrf
            <div class="sp-toggle-list">
              <div class="sp-toggle-item">
                <div class="sp-toggle-text">
                  <h4>Job Alerts</h4>
                  <p>Get notified when jobs matching your preferences are posted</p>
                </div>
                <label class="sp-switch">
                  <input type="checkbox" name="job_alerts" {{ ($settings['notifications']['job_alerts'] ?? true) ? 'checked' : '' }}>
                  <span class="sp-switch-track"></span>
                </label>
              </div>
              <div class="sp-toggle-item">
                <div class="sp-toggle-text">
                  <h4>Application Updates</h4>
                  <p>Receive updates when the status of your job application changes</p>
                </div>
                <label class="sp-switch">
                  <input type="checkbox" name="application_updates" {{ ($settings['notifications']['application_updates'] ?? true) ? 'checked' : '' }}>
                  <span class="sp-switch-track"></span>
                </label>
              </div>
              <div class="sp-toggle-item">
                <div class="sp-toggle-text">
                  <h4>Profile Views</h4>
                  <p>Get notified when an employer views your profile or resume</p>
                </div>
                <label class="sp-switch">
                  <input type="checkbox" name="profile_views" {{ ($settings['notifications']['profile_views'] ?? true) ? 'checked' : '' }}>
                  <span class="sp-switch-track"></span>
                </label>
              </div>
              <div class="sp-toggle-item">
                <div class="sp-toggle-text">
                  <h4>Marketing & Promotions</h4>
                  <p>Receive occasional updates about our platform features and offers</p>
                </div>
                <label class="sp-switch">
                  <input type="checkbox" name="marketing_emails" {{ ($settings['notifications']['marketing_emails'] ?? false) ? 'checked' : '' }}>
                  <span class="sp-switch-track"></span>
                </label>
              </div>
            </div>
            <div class="sp-btn-row">
              <button type="submit" class="sp-btn sp-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                Save Notifications
              </button>
            </div>
          </form>
        </div>
      </div>



      {{-- ========================
           RESUME SECTION
      ======================== --}}
      <div class="sp-section" id="resume">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-file-pdf"></i></div>
            <div>
              <h2>Resume Management</h2>
              <p>Upload and manage your professional resume</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">

          @if($user->resume)
            <div class="sp-subsection-title">Current Resume</div>
            <div class="sp-action-card success-card">
              <div class="sp-action-card-icon green"><i class="fa-solid fa-file-pdf"></i></div>
              <div class="sp-action-card-body">
                <h4 style="color:#16a34a;">{{ $user->resume }}</h4>
                <p>Your resume is uploaded and visible to recruiters. Keep it up to date!</p>
                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                  <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="sp-btn sp-btn-secondary sp-btn-sm">
                    <i class="fa-solid fa-eye"></i> View
                  </a>
                  <a href="{{ asset('resume/' . $user->resume) }}" download class="sp-btn sp-btn-secondary sp-btn-sm">
                    <i class="fa-solid fa-download"></i> Download
                  </a>
                  <button type="button" class="sp-btn sp-btn-danger sp-btn-sm" onclick="deleteResume()">
                    <i class="fa-solid fa-trash"></i> Delete
                  </button>
                </div>
              </div>
            </div>
            <div class="sp-divider"></div>
          @endif

          <div class="sp-subsection-title">{{ $user->resume ? 'Replace Resume' : 'Upload Resume' }}</div>

          <form action="{{ route('settings.uploadResume') }}" method="POST" enctype="multipart/form-data" id="resumeForm">
            @csrf
            <label class="sp-file-drop" for="resumeInput" id="resumeDropZone">
              <span class="sp-file-drop-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
              <p id="resumeFileName"><strong>Click to upload</strong> or drag & drop your file here</p>
              <span>Accepted formats: PDF, DOC, DOCX &nbsp;•&nbsp; Max size: 5MB</span>
              <input type="file" name="resume" id="resumeInput" accept=".pdf,.doc,.docx" required>
            </label>

            <div class="sp-btn-row">
              <button type="submit" class="sp-btn sp-btn-primary">
                <i class="fa-solid fa-upload"></i>
                Upload Resume
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- ========================
           DATA & STORAGE SECTION
      ======================== --}}
      <div class="sp-section" id="data">
        <div class="sp-section-header">
          <div class="sp-section-header-top">
            <div class="sp-section-icon"><i class="fa-solid fa-database"></i></div>
            <div>
              <h2>Data &amp; Storage</h2>
              <p>Manage your data, cache and account deletion</p>
            </div>
          </div>
        </div>
        <div class="sp-section-body">

          <div class="sp-subsection-title">Data Management</div>

          <div class="sp-action-card">
            <div class="sp-action-card-icon orange"><i class="fa-solid fa-broom"></i></div>
            <div class="sp-action-card-body">
              <h4>Clear Cache</h4>
              <p>Clear cached data to improve performance and free up storage space on your device.</p>
              <button type="button" class="sp-btn sp-btn-secondary sp-btn-sm" onclick="clearCache()">
                <i class="fa-solid fa-broom"></i>
                Clear Cache
              </button>
            </div>
          </div>

          <div class="sp-action-card">
            <div class="sp-action-card-icon gray"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div class="sp-action-card-body">
              <h4>Delete Browsing History</h4>
              <p>Remove your job search history, recently viewed jobs, and browsing activity from our servers.</p>
              <button type="button" class="sp-btn sp-btn-secondary sp-btn-sm" onclick="deleteBrowsingHistory()">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Delete History
              </button>
            </div>
          </div>

          <div class="sp-action-card">
            <div class="sp-action-card-icon blue"><i class="fa-solid fa-download"></i></div>
            <div class="sp-action-card-body">
              <h4>Download Your Data</h4>
              <p>Request a full copy of your profile, applications, and activity data as a downloadable archive.</p>
              <a href="{{ route('settings.downloadData') }}" class="sp-btn sp-btn-secondary sp-btn-sm">
                <i class="fa-solid fa-download"></i>
                Request Download
              </a>
            </div>
          </div>

          <div class="sp-divider"></div>
          <div class="sp-subsection-title" style="color:#dc2626;">Danger Zone</div>

          <div class="sp-action-card danger-card">
            <div class="sp-action-card-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="sp-action-card-body">
              <h4>Delete Account</h4>
              <p>Permanently delete your account and all associated data including applications, profile, and settings. This action is irreversible and cannot be undone.</p>
              <button type="button" class="sp-btn sp-btn-danger sp-btn-sm" onclick="confirmDeleteAccount()">
                <i class="fa-solid fa-trash"></i>
                Delete My Account
              </button>
            </div>
          </div>

        </div>
      </div>

    </main>
  </div>
</div>

<script>
/* ========================================
   Tab Navigation
======================================== */
document.querySelectorAll('.sp-nav-item[data-section]').forEach(btn => {
  btn.addEventListener('click', function () {
    const target = this.dataset.section;

    // Update sidebar active
    document.querySelectorAll('.sp-nav-item').forEach(n => n.classList.remove('active'));
    this.classList.add('active');

    // Update panel section
    document.querySelectorAll('.sp-section').forEach(s => s.classList.remove('active'));
    document.getElementById(target)?.classList.add('active');

    // On mobile, scroll panel into view
    if (window.innerWidth <= 991) {
      document.querySelector('.sp-panel')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
  });
});

/* ========================================
   Profile Photo Preview
======================================== */
function previewPhoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.querySelector('.sp-photo-preview');
      if (preview) {
        preview.innerHTML = `<img loading="lazy" src="${e.target.result}" alt="Preview">`;
      }
    };
    reader.readAsDataURL(input.files[0]);
  }
}

/* ========================================
   Resume Drop Zone
======================================== */
const resumeInput = document.getElementById('resumeInput');
const resumeDropZone = document.getElementById('resumeDropZone');
const resumeFileName = document.getElementById('resumeFileName');

if (resumeInput) {
  resumeInput.addEventListener('change', function () {
    if (this.files.length > 0) {
      resumeFileName.innerHTML = `<strong>${this.files[0].name}</strong> — Ready to upload`;
      resumeDropZone.style.borderColor = 'var(--brand)';
      resumeDropZone.style.background = 'rgba(7,16,86,0.04)';
    }
  });
}

if (resumeDropZone) {
  resumeDropZone.addEventListener('dragover', e => {
    e.preventDefault();
    resumeDropZone.classList.add('dragover');
  });
  resumeDropZone.addEventListener('dragleave', () => resumeDropZone.classList.remove('dragover'));
  resumeDropZone.addEventListener('drop', e => {
    e.preventDefault();
    resumeDropZone.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file && resumeInput) {
      const dt = new DataTransfer();
      dt.items.add(file);
      resumeInput.files = dt.files;
      resumeFileName.innerHTML = `<strong>${file.name}</strong> — Ready to upload`;
      resumeDropZone.style.borderColor = 'var(--brand)';
    }
  });
}

/* ========================================
   Form Loading States
======================================== */
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', function () {
    const btn = this.querySelector('button[type="submit"]');
    if (btn && !btn.classList.contains('loading')) {
      btn.classList.add('loading');
      btn.disabled = true;
    }
  });
});

/* ========================================
   Auto-resize textareas
======================================== */
document.querySelectorAll('textarea.sp-input').forEach(ta => {
  ta.addEventListener('input', function () {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
  });
});

/* ========================================
   Resume Validation
======================================== */
const resumeForm = document.getElementById('resumeForm');
if (resumeForm) {
  resumeForm.addEventListener('submit', function (e) {
    const fi = this.querySelector('input[type="file"]');
    if (fi && fi.files.length > 0) {
      const file = fi.files[0];
      if (file.size > 5 * 1024 * 1024) { e.preventDefault(); showToast('File must be less than 5MB', 'danger'); return; }
      const allowed = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
      if (!allowed.includes(file.type)) { e.preventDefault(); showToast('Only PDF, DOC and DOCX files are allowed', 'danger'); return; }
    }
  });
}

/* ========================================
   Toast notification (replaces alert)
======================================== */
function showToast(message, type = 'success') {
  const existing = document.getElementById('sp-toast');
  if (existing) existing.remove();

  const toast = document.createElement('div');
  toast.id = 'sp-toast';
  toast.style.cssText = `
    position:fixed;bottom:28px;right:28px;z-index:9999;
    padding:14px 22px;border-radius:12px;font-size:14px;font-weight:600;
    font-family:'Inter',sans-serif;display:flex;align-items:center;gap:10px;
    max-width:360px;box-shadow:0 8px 32px rgba(0,0,0,0.15);
    animation:toastIn .35s cubic-bezier(.16,1,.3,1);
    ${type === 'danger'
      ? 'background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;'
      : 'background:#dafbe1;color:#16a34a;border:1px solid #86efac;'}
  `;
  toast.innerHTML = `<i class="fa-solid fa-${type === 'danger' ? 'circle-exclamation' : 'circle-check'}"></i>${message}`;
  document.head.insertAdjacentHTML('beforeend', '<style>@keyframes toastIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}</style>');
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 4000);
}

/* ========================================
   Data Actions
======================================== */
function clearCache() {
  if (!confirm('Clear all cached data? This cannot be undone.')) return;
  fetch('{{ route("settings.clearCache") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
  }).then(r => r.json()).then(d => {
    if (d.success) showToast('Cache cleared successfully!');
  }).catch(() => showToast('Something went wrong.', 'danger'));
}

function deleteBrowsingHistory() {
  if (!confirm('Delete your browsing history? This cannot be undone.')) return;
  fetch('{{ route("settings.deleteBrowsingHistory") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
  }).then(r => r.json()).then(d => {
    if (d.success) showToast('Browsing history deleted.');
  }).catch(() => showToast('Something went wrong.', 'danger'));
}

function deleteResume() {
  if (!confirm('Delete your resume? This cannot be undone.')) return;
  fetch('{{ route("settings.deleteResume") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
  }).then(r => r.json()).then(d => {
    if (d.success) { showToast('Resume deleted.'); setTimeout(() => location.reload(), 1200); }
    else showToast('Error: ' + d.message, 'danger');
  });
}

function confirmDeleteAccount() {
  const pw = prompt('⚠️ WARNING: This will permanently delete your account.\n\nEnter your password to confirm:');
  if (!pw) return;
  const conf = prompt('Type "DELETE" to confirm account deletion:');
  if (conf !== 'DELETE') { showToast('Account deletion cancelled.', 'danger'); return; }
  fetch('{{ route("settings.deleteAccount") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
    body: JSON.stringify({ password: pw, confirmation: conf })
  }).then(r => r.json()).then(d => {
    if (d.success) { showToast('Account deleted. Redirecting...'); setTimeout(() => window.location.href = d.redirect, 1500); }
    else showToast('Error: ' + d.message, 'danger');
  }).catch(() => showToast('An error occurred.', 'danger'));
}

function enable2FA()         { showToast('Two-Factor Authentication coming soon!', 'success'); }
function viewSessions()      { showToast('Active sessions feature coming soon!', 'success'); }
function viewLoginHistory()  { showToast('Login history feature coming soon!', 'success'); }
</script>

@endsection


