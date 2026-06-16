@extends('layouts.site')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ═══════════════════════════════════════════
   ELITE PROFILE — COMPLETE REDESIGN v2
   Inspired by Linear, Vercel, Notion dashboards
═══════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
  --ink:#0d0d14;
  --ink-2:#1a1a2e;
  --ink-3:#2d2d45;
  --accent:#b11e24;
  --accent-soft:rgba(177,30,36,0.1);
  --accent-glow:rgba(177,30,36,0.25);
  --navy:#071056;
  --navy-soft:rgba(7,16,86,0.06);
  --surface:#ffffff;
  --surface-2:#f7f8fc;
  --surface-3:#eef0f8;
  --border:rgba(0,0,0,0.07);
  --border-strong:rgba(0,0,0,0.12);
  --text-primary:#111827;
  --text-secondary:#6b7280;
  --text-muted:#9ca3af;
  --radius:14px;
  --radius-sm:8px;
  --radius-lg:20px;
  --shadow-xs:0 1px 3px rgba(0,0,0,0.04),0 1px 2px rgba(0,0,0,0.04);
  --shadow-sm:0 4px 12px rgba(0,0,0,0.05),0 1px 3px rgba(0,0,0,0.04);
  --shadow-md:0 12px 32px rgba(0,0,0,0.08),0 2px 8px rgba(0,0,0,0.04);
  --shadow-lg:0 24px 64px rgba(0,0,0,0.1),0 4px 16px rgba(0,0,0,0.04);
  --font:'Inter',system-ui,sans-serif;
  --transition:all 0.2s cubic-bezier(0.4,0,0.2,1);
}

body { background: var(--surface-2); font-family: var(--font); color: var(--text-primary); }

/* ── PAGE WRAPPER ──────────────────────────── */
.pf-page {
  padding: 120px 24px 80px;
  min-height: 100vh;
  max-width: 1280px;
  margin: 0 auto;
}

/* ── FLASH ALERTS ──────────────────────────── */
.pf-alert {
  display: flex; align-items: center; gap: 12px;
  padding: 14px 20px;
  border-radius: var(--radius-sm);
  font-size: 14px; font-weight: 500;
  margin-bottom: 24px;
}
.pf-alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
.pf-alert-danger   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

/* ── LAYOUT GRID ───────────────────────────── */
.pf-layout {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 28px;
  align-items: start;
}

@media(max-width:1024px){
  .pf-layout { grid-template-columns: 1fr; }
}

/* ══════════════════════════════════════════
   LEFT PANEL — PROFILE CARD
══════════════════════════════════════════ */
.pf-sidebar {
  position: sticky;
  top: 100px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.pf-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}

/* Hero card */
.pf-hero-card {
  background: linear-gradient(145deg, var(--ink-2) 0%, #0f0f2a 100%);
  border: none;
  padding: 36px 24px 28px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.pf-hero-card::before {
  content:'';
  position:absolute;
  top:-60px; right:-40px;
  width:200px; height:200px;
  border-radius:50%;
  background:radial-gradient(circle, rgba(177,30,36,.35) 0%, transparent 70%);
  pointer-events:none;
}
.pf-hero-card::after {
  content:'';
  position:absolute;
  bottom:-50px; left:-30px;
  width:160px; height:160px;
  border-radius:50%;
  background:radial-gradient(circle, rgba(7,16,86,.6) 0%, transparent 70%);
  pointer-events:none;
}

.pf-avatar-ring {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  cursor: pointer;
  z-index: 1;
}
.pf-avatar-ring::before {
  content:'';
  position:absolute;
  inset:-3px;
  border-radius:50%;
  background:conic-gradient(var(--accent) 0%, #ff6b6b 25%, var(--navy) 50%, #4f62d9 75%, var(--accent) 100%);
  z-index:0;
}
.pf-avatar-wrap {
  position: relative;
  width: 96px; height: 96px;
  border-radius: 50%;
  overflow: hidden;
  background: var(--surface);
  border: 3px solid var(--surface);
  display: flex; align-items: center; justify-content: center;
  z-index: 1;
}
.pf-avatar-wrap img { width:100%; height:100%; object-fit:cover; }
.pf-avatar-initials {
  font-size: 32px; font-weight: 800; color: var(--navy);
  font-family: var(--font);
}
.pf-avatar-overlay {
  position: absolute; inset: 0; border-radius: 50%;
  background: rgba(7,16,86,0.7);
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transition: var(--transition);
  color: #fff; font-size: 18px;
  z-index: 2;
}
.pf-avatar-ring:hover .pf-avatar-overlay { opacity: 1; }

.pf-hero-name {
  font-size: 20px; font-weight: 800; color: #fff;
  letter-spacing: -0.4px; margin-bottom: 5px;
}
.pf-hero-role {
  font-size: 13px; font-weight: 500; color: rgba(255,255,255,.55);
  margin-bottom: 16px;
}
.pf-hero-tags {
  display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;
}
.pf-hero-tag {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 11px; font-weight: 600; color: rgba(255,255,255,.7);
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.1);
  padding: 5px 12px; border-radius: 99px;
}

/* Progress ring */
.pf-strength-bar {
  padding: 18px 24px 14px;
  border-bottom: 1px solid var(--border);
  background: var(--surface);
}
.pf-strength-label {
  display: flex; justify-content: space-between; align-items: center;
  font-size: 12px; font-weight: 600; color: var(--text-secondary);
  text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px;
}
.pf-strength-val { color: var(--accent); font-size: 14px; font-weight: 800; }
.pf-strength-track {
  height: 6px; background: var(--surface-3); border-radius: 99px; overflow: hidden;
}
.pf-strength-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--navy), var(--accent));
  border-radius: 99px;
  transition: width 1s cubic-bezier(0.4,0,0.2,1);
}

/* Stats row */
.pf-stats {
  display: grid; grid-template-columns: repeat(3,1fr);
  border-bottom: 1px solid var(--border);
}
.pf-stat {
  padding: 18px 12px; text-align: center;
  border-right: 1px solid var(--border);
}
.pf-stat:last-child { border-right: none; }
.pf-stat-val {
  font-size: 22px; font-weight: 800; color: var(--navy);
  font-feature-settings: "tnum";
}
.pf-stat-lbl {
  font-size: 10px; font-weight: 700; color: var(--text-muted);
  text-transform: uppercase; letter-spacing: 0.6px; margin-top: 2px;
}

/* Contact info */
.pf-info-section { padding: 20px 20px; }
.pf-info-title {
  font-size: 10px; font-weight: 800; color: var(--navy);
  text-transform: uppercase; letter-spacing: 1.2px;
  margin-bottom: 14px; display: flex; align-items: center; gap: 8px;
}
.pf-info-title::after { content:''; flex:1; height:1px; background:var(--border); }
.pf-info-row {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 10px 0; border-bottom: 1px solid var(--border);
  font-size: 13px;
}
.pf-info-row:last-child { border-bottom: none; }
.pf-info-icon {
  width: 30px; height: 30px; flex-shrink: 0;
  border-radius: 8px; background: var(--navy-soft);
  display: flex; align-items: center; justify-content: center;
  color: var(--navy); font-size: 12px;
}
.pf-info-key { color: var(--text-muted); font-size: 11px; font-weight: 500; margin-bottom: 2px; }
.pf-info-val { color: var(--text-primary); font-weight: 600; word-break: break-all; }

/* Navigation menu */
.pf-nav { padding: 12px 12px; display: flex; flex-direction: column; gap: 4px; }
.pf-nav-item {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 14px; border-radius: 10px;
  background: transparent; border: none; cursor: pointer;
  font-family: var(--font); font-size: 14px; font-weight: 600;
  color: var(--text-secondary); transition: var(--transition);
  width: 100%; text-align: left;
}
.pf-nav-item:hover { background: var(--surface-2); color: var(--text-primary); }
.pf-nav-item.active {
  background: var(--navy); color: #fff;
  box-shadow: 0 6px 16px rgba(7,16,86,0.2);
}
.pf-nav-icon {
  width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  background: rgba(255,255,255,0.08); font-size: 14px;
}
.pf-nav-item:not(.active) .pf-nav-icon { background: var(--surface-3); color: var(--text-secondary); }
.pf-nav-badge {
  margin-left: auto;
  font-size: 10px; font-weight: 700;
  padding: 3px 8px; border-radius: 99px;
  background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.9);
}
.pf-nav-item:not(.active) .pf-nav-badge { background: var(--accent-soft); color: var(--accent); }

/* ══════════════════════════════════════════
   RIGHT PANEL — FORM CONTENT
══════════════════════════════════════════ */
.pf-main { display: flex; flex-direction: column; gap: 0; }

.pf-panel {
  display: none;
  flex-direction: column;
  gap: 20px;
}
.pf-panel.active { display: flex; }

/* Section header */
.pf-section-hdr {
  display: flex; align-items: center; justify-content: space-between;
  padding: 28px 36px 22px;
  border-bottom: 1px solid var(--border);
  background: var(--surface);
  border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}
.pf-section-hdr h2 {
  font-size: 20px; font-weight: 800; color: var(--text-primary);
  display: flex; align-items: center; gap: 12px; letter-spacing: -0.3px;
}
.pf-section-icon {
  width: 38px; height: 38px; border-radius: 10px;
  background: var(--navy-soft); color: var(--navy);
  display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.pf-section-sub { font-size: 13px; font-weight: 400; color: var(--text-muted); }

/* Form body */
.pf-form-body {
  background: var(--surface);
  border-radius: 0 0 var(--radius-lg) var(--radius-lg);
  padding: 32px 36px 36px;
}

/* Field groups */
.pf-field-group {
  margin-bottom: 28px;
}
.pf-field-group-title {
  font-size: 11px; font-weight: 800; color: var(--navy);
  text-transform: uppercase; letter-spacing: 1px;
  margin-bottom: 20px; padding-bottom: 12px;
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; gap: 8px;
}
.pf-field-group-title i { color: var(--accent); font-size: 12px; }

.pf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.pf-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
.pf-full { grid-column: 1 / -1; }
@media(max-width:640px){ .pf-grid, .pf-grid-3 { grid-template-columns: 1fr; } }

/* Form fields */
.pf-field { display: flex; flex-direction: column; gap: 6px; }
.pf-label {
  font-size: 12px; font-weight: 700; color: var(--text-primary);
  display: flex; align-items: center; gap: 4px;
}
.pf-label-req { color: var(--accent); }
.pf-input, .pf-select {
  width: 100%; height: 46px;
  padding: 0 16px;
  background: var(--surface-2);
  border: 1.5px solid var(--border-strong);
  border-radius: 10px;
  font-family: var(--font); font-size: 14px; color: var(--text-primary);
  outline: none; transition: var(--transition);
  appearance: none; -webkit-appearance: none;
}
.pf-input::placeholder { color: var(--text-muted); }
.pf-input:focus, .pf-select:focus {
  border-color: var(--navy);
  background: var(--surface);
  box-shadow: 0 0 0 3px rgba(7,16,86,0.08);
}
.pf-select-wrap { position: relative; }
.pf-select-wrap::after {
  content: '\f078'; font-family:'Font Awesome 6 Free'; font-weight:900;
  position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
  font-size: 11px; color: var(--text-muted); pointer-events: none;
}
.pf-select { padding-right: 40px; cursor: pointer; }
.pf-error { font-size: 12px; color: var(--accent); font-weight: 500; }

/* Avatar upload */
.pf-avatar-upload {
  display: flex; align-items: center; gap: 24px;
  padding: 24px;
  background: var(--surface-2);
  border: 1.5px dashed var(--border-strong);
  border-radius: var(--radius);
  cursor: pointer; transition: var(--transition);
}
.pf-avatar-upload:hover { border-color: var(--navy); background: var(--navy-soft); }
.pf-avatar-upload-preview {
  width: 80px; height: 80px; border-radius: 50%;
  background: var(--surface);
  border: 2px solid var(--border-strong);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; overflow: hidden;
  font-size: 26px; font-weight: 800; color: var(--navy);
}
.pf-avatar-upload-preview img { width:100%; height:100%; object-fit:cover; }
.pf-avatar-upload-info h4 { font-size: 15px; font-weight: 700; color: var(--text-primary); margin-bottom: 4px; }
.pf-avatar-upload-info p { font-size: 12px; color: var(--text-muted); line-height: 1.5; }
.pf-avatar-actions { display: flex; gap: 10px; margin-top: 12px; }
.pf-btn-sm {
  font-size: 12px; font-weight: 700; padding: 7px 16px;
  border-radius: 8px; cursor: pointer; transition: var(--transition);
  border: 1.5px solid transparent; font-family: var(--font);
}
.pf-btn-sm-navy { background: var(--navy); color: #fff; }
.pf-btn-sm-navy:hover { opacity: 0.85; }
.pf-btn-sm-ghost { background: transparent; border-color: var(--border-strong); color: var(--text-secondary); }
.pf-btn-sm-ghost:hover { border-color: var(--accent); color: var(--accent); }

/* Resume upload */
.pf-resume-zone {
  display: flex; align-items: center; gap: 16px;
  padding: 20px 24px;
  background: var(--surface-2);
  border: 1.5px dashed var(--border-strong);
  border-radius: var(--radius);
  cursor: pointer; transition: var(--transition);
}
.pf-resume-zone:hover { border-color: var(--navy); background: var(--navy-soft); }
.pf-resume-icon {
  width: 48px; height: 48px; border-radius: 12px;
  background: var(--navy-soft); color: var(--navy);
  display: flex; align-items: center; justify-content: center;
  font-size: 20px; flex-shrink: 0;
}
.pf-resume-text h5 { font-size: 14px; font-weight: 700; color: var(--text-primary); margin-bottom: 3px; }
.pf-resume-text p { font-size: 12px; color: var(--text-muted); }
.pf-resume-badge {
  margin-left: auto; display: flex; align-items: center; gap: 10px;
}
.pf-file-pill {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 8px 16px;
  background: #ecfdf5; border: 1px solid #a7f3d0;
  border-radius: 99px; font-size: 12px; font-weight: 700; color: #065f46;
}
.pf-file-pill i { font-size: 14px; }
.pf-file-view {
  width: 34px; height: 34px; border-radius: 8px;
  background: var(--navy-soft); color: var(--navy);
  display: flex; align-items: center; justify-content: center;
  font-size: 14px; transition: var(--transition);
  text-decoration: none;
}
.pf-file-view:hover { background: var(--navy); color: #fff; }

/* Entry cards */
.pf-entry {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 16px;
  box-shadow: var(--shadow-xs);
  transition: var(--transition);
}
.pf-entry:hover { box-shadow: var(--shadow-sm); border-color: var(--border-strong); }
.pf-entry-hdr {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px;
  background: var(--surface-2);
  border-bottom: 1px solid var(--border);
}
.pf-entry-title {
  display: flex; align-items: center; gap: 10px;
  font-size: 14px; font-weight: 700; color: var(--text-primary);
}
.pf-entry-num {
  width: 24px; height: 24px; border-radius: 6px;
  background: var(--navy); color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 800;
}
.pf-entry-body { padding: 20px; }
.btn-del {
  font-size: 11px; font-weight: 700; color: var(--accent);
  background: var(--accent-soft); border: 1px solid rgba(177,30,36,0.15);
  padding: 6px 14px; border-radius: 8px; cursor: pointer;
  transition: var(--transition); font-family: var(--font);
}
.btn-del:hover { background: var(--accent); color: #fff; }

/* Checkbox */
.pf-check-row {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 14px; background: var(--surface-2);
  border-radius: 8px; border: 1px solid var(--border);
}
.pf-check-row input[type="checkbox"] { accent-color: var(--navy); width:16px; height:16px; cursor:pointer; }
.pf-check-row label { font-size: 13px; font-weight: 500; color: var(--text-primary); cursor: pointer; }

/* Date pair */
.pf-date-pair { display: flex; gap: 10px; }
.pf-date-pair .pf-select-wrap { flex: 1; }

/* Add entry button */
.btn-add-entry {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 13px; font-weight: 700; font-family: var(--font);
  padding: 11px 22px; border-radius: 10px;
  background: var(--navy-soft); color: var(--navy);
  border: 1.5px solid rgba(7,16,86,0.15);
  cursor: pointer; transition: var(--transition);
}
.btn-add-entry:hover { background: var(--navy); color: #fff; transform: translateY(-1px); }

/* Skills section */
.pf-skills-search {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 16px;
  background: var(--surface-2); border: 1.5px solid var(--border-strong);
  border-radius: 10px; margin-bottom: 20px;
}
.pf-skills-search i { color: var(--text-muted); font-size: 14px; }
.pf-skills-search input {
  border: none; outline: none; background: transparent;
  font-family: var(--font); font-size: 14px; color: var(--text-primary);
  flex: 1;
}
.pf-skills-search input::placeholder { color: var(--text-muted); }
.pf-add-skill-btn {
  background: var(--accent); color: #fff; border: none;
  padding: 8px 18px; border-radius: 8px;
  font-family: var(--font); font-size: 12px; font-weight: 700;
  cursor: pointer; transition: var(--transition);
  display: flex; align-items: center; gap: 6px;
}
.pf-add-skill-btn:hover { opacity: 0.85; transform: translateY(-1px); }

.pf-skills-sublabel {
  font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
  color: var(--text-muted); margin-bottom: 12px; margin-top: 20px;
}
.pf-chips { display: flex; flex-wrap: wrap; gap: 8px; }
.pf-chip {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 7px 14px; border-radius: 99px;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: var(--transition); border: 1.5px solid var(--border-strong);
  background: var(--surface); color: var(--text-secondary);
}
.pf-chip:hover { border-color: var(--navy); color: var(--navy); background: var(--navy-soft); }
.pf-chip.selected {
  background: var(--navy); color: #fff;
  border-color: var(--navy);
  box-shadow: 0 4px 12px rgba(7,16,86,0.2);
}
.pf-chip.selected .rm { opacity: 0.7; transition: var(--transition); font-size: 11px; margin-left: 2px; }
.pf-chip.selected .rm:hover { opacity: 1; }
.pf-no-skills { font-size: 13px; color: var(--text-muted); font-weight: 500; font-style: italic; }

/* Save button */
.pf-save-wrap {
  padding: 24px 36px;
  background: var(--surface);
  border-top: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
  border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}
.pf-save-hint { font-size: 12px; color: var(--text-muted); display: flex; align-items: center; gap: 6px; }
.pf-save-btn {
  display: inline-flex; align-items: center; gap: 10px;
  font-size: 14px; font-weight: 800; font-family: var(--font);
  padding: 14px 40px; border-radius: 12px;
  background: linear-gradient(135deg, var(--navy) 0%, #1a2eb5 100%);
  color: #fff; border: none; cursor: pointer;
  transition: var(--transition);
  box-shadow: 0 8px 24px rgba(7,16,86,0.25);
}
.pf-save-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(7,16,86,0.35); }
.pf-save-btn:active { transform: translateY(0); }

/* Mobile tabs */
.pf-mobile-tabs {
  display: none;
  overflow-x: auto; scrollbar-width: none;
  gap: 8px; padding-bottom: 16px;
}
.pf-mobile-tabs::-webkit-scrollbar { display: none; }
.pf-mobile-tab {
  flex-shrink: 0; display: flex; align-items: center; gap: 8px;
  padding: 10px 18px; border-radius: 99px;
  background: var(--surface); border: 1.5px solid var(--border);
  font-size: 13px; font-weight: 700; color: var(--text-secondary);
  cursor: pointer; transition: var(--transition); font-family: var(--font);
}
.pf-mobile-tab.active { background: var(--navy); color: #fff; border-color: var(--navy); }
@media(max-width:1024px) {
  .pf-sidebar { position: static; }
  .pf-hero-card + .pf-card { display: none; }
  .pf-card:has(.pf-nav) { display: none; }
  .pf-mobile-tabs { display: flex; }
}

/* Responsive padding */
@media(max-width:768px) {
  .pf-page { padding: 100px 16px 60px; }
  .pf-section-hdr, .pf-form-body, .pf-save-wrap { padding-left: 20px; padding-right: 20px; }
  .pf-save-wrap { flex-direction: column; gap: 16px; }
  .pf-save-btn { width: 100%; justify-content: center; }
}
</style>

<div class="pf-page">

  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="pf-alert pf-alert-success">
      <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="pf-alert pf-alert-danger">
      <i class="fa-solid fa-triangle-exclamation"></i> Please fix the highlighted errors below.
    </div>
  @endif

  {{-- Mobile Tabs --}}
  <div class="pf-mobile-tabs d-flex" id="mobileTabs">
    <button type="button" class="pf-mobile-tab active" data-tab="personal"><i class="fa-solid fa-user-tie"></i> Profile</button>
    <button type="button" class="pf-mobile-tab" data-tab="education"><i class="fa-solid fa-graduation-cap"></i> Education</button>
    <button type="button" class="pf-mobile-tab" data-tab="experience"><i class="fa-solid fa-briefcase"></i> Experience</button>
    <button type="button" class="pf-mobile-tab" data-tab="skills"><i class="fa-solid fa-brain"></i> Skills</button>
  </div>

  <div class="pf-layout">

    {{-- ══ LEFT SIDEBAR ══ --}}
    <aside class="pf-sidebar">

      {{-- Profile Hero --}}
      <div class="pf-card pf-hero-card">
        <div class="pf-avatar-ring" onclick="document.getElementById('profilePicInput').click()" title="Change photo">
          <div class="pf-avatar-wrap" id="sidebarAvatarWrap">
            @if(!empty($user->profile_picture))
              <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile" id="sidebarAvatarImg">
            @else
              <span class="pf-avatar-initials">{{ strtoupper(substr($user->first_name ?? 'J',0,1).substr($user->last_name ?? 'D',0,1)) }}</span>
            @endif
          </div>
          <div class="pf-avatar-overlay"><i class="fa-solid fa-camera"></i></div>
        </div>
        <div class="pf-hero-name">{{ $user->name ?? 'Your Name' }}</div>
        <div class="pf-hero-role">{{ $user->job_title ?? 'Professional' }}</div>
        <div class="pf-hero-tags">
          @if($user->location)
            <span class="pf-hero-tag"><i class="fa-solid fa-location-dot"></i> {{ $user->location }}</span>
          @endif
          @if($user->email)
            <span class="pf-hero-tag" style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><i class="fa-solid fa-envelope"></i> {{ $user->email }}</span>
          @endif
        </div>
      </div>

      {{-- Profile Strength --}}
      <div class="pf-card">
        <div class="pf-strength-bar">
          <div class="pf-strength-label">
            <span>Profile Strength</span>
            <span class="pf-strength-val" id="strengthVal">{{ round($user->profile_completion ?? 0) }}%</span>
          </div>
          <div class="pf-strength-track">
            <div class="pf-strength-fill" id="strengthFill" style="width:{{ round($user->profile_completion ?? 0) }}%"></div>
          </div>
        </div>
        <div class="pf-stats">
          <div class="pf-stat">
            <div class="pf-stat-val" id="sidebarSkillsCount">{{ $user->skills?->count() ?? 0 }}</div>
            <div class="pf-stat-lbl">Skills</div>
          </div>
          <div class="pf-stat">
            <div class="pf-stat-val">{{ $user->educations?->count() ?? 0 }}</div>
            <div class="pf-stat-lbl">Degrees</div>
          </div>
          <div class="pf-stat">
            <div class="pf-stat-val">{{ $user->experiences?->count() ?? 0 }}</div>
            <div class="pf-stat-lbl">Roles</div>
          </div>
        </div>
        <div class="pf-info-section">
          <div class="pf-info-title"><i class="fa-solid fa-address-card"></i> Contact</div>
          <div class="pf-info-row">
            <div class="pf-info-icon"><i class="fa-solid fa-envelope"></i></div>
            <div><div class="pf-info-key">Email</div><div class="pf-info-val">{{ $user->email ?? '—' }}</div></div>
          </div>
          <div class="pf-info-row">
            <div class="pf-info-icon"><i class="fa-solid fa-phone"></i></div>
            <div><div class="pf-info-key">Phone</div><div class="pf-info-val">{{ $user->phone ?? 'Not set' }}</div></div>
          </div>
        </div>
      </div>

      {{-- Sidebar Nav --}}
      <div class="pf-card">
        <div class="pf-nav" id="sidebarNav">
          <button type="button" class="pf-nav-item active" data-tab="personal">
            <span class="pf-nav-icon"><i class="fa-solid fa-user-tie"></i></span>
            Profile Details
            <span class="pf-nav-badge" id="personalBadge">{{ round($progress['personal'] ?? 0) }}%</span>
          </button>
          <button type="button" class="pf-nav-item" data-tab="education">
            <span class="pf-nav-icon"><i class="fa-solid fa-graduation-cap"></i></span>
            Education
            <span class="pf-nav-badge" id="educationBadge">{{ round($progress['education'] ?? 0) }}%</span>
          </button>
          <button type="button" class="pf-nav-item" data-tab="experience">
            <span class="pf-nav-icon"><i class="fa-solid fa-briefcase"></i></span>
            Experience
            <span class="pf-nav-badge" id="experienceBadge">{{ round($progress['experience'] ?? 0) }}%</span>
          </button>
          <button type="button" class="pf-nav-item" data-tab="skills">
            <span class="pf-nav-icon"><i class="fa-solid fa-brain"></i></span>
            Skills & Expertise
            <span class="pf-nav-badge" id="skillsBadge">{{ round($progress['skills'] ?? 0) }}%</span>
          </button>
        </div>
      </div>

    </aside>

    {{-- ══ MAIN CONTENT ══ --}}
    <main class="pf-main">
      <form id="profileUpdateForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ─── PANEL: PERSONAL DETAILS ─── --}}
        <div class="pf-panel active" id="tab-personal">
          <div class="pf-card" style="border-radius: var(--radius-lg);">
            <div class="pf-section-hdr">
              <h2>
                <span class="pf-section-icon"><i class="fa-solid fa-user-tie"></i></span>
                Profile Details
              </h2>
              <span class="pf-section-sub">Keep your information up to date</span>
            </div>
            <div class="pf-form-body">

              {{-- Avatar --}}
              <div class="pf-field-group">
                <div class="pf-field-group-title"><i class="fa-solid fa-image"></i> Profile Photo</div>
                <div class="pf-avatar-upload" onclick="document.getElementById('profilePicInput').click()">
                  <div class="pf-avatar-upload-preview" id="avatarPreview">
                    @if(!empty($user->profile_picture))
                      <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile" id="previewImg">
                    @else
                      <span id="previewInitials">{{ strtoupper(substr($user->first_name ?? 'J',0,1).substr($user->last_name ?? 'D',0,1)) }}</span>
                    @endif
                  </div>
                  <div class="pf-avatar-upload-info">
                    <h4>Upload Profile Photo</h4>
                    <p>JPG, PNG or GIF · Max 2MB<br>Click anywhere to browse</p>
                    <div class="pf-avatar-actions" onclick="event.stopPropagation()">
                      <button type="button" class="pf-btn-sm pf-btn-sm-navy" onclick="document.getElementById('profilePicInput').click()">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i> Upload Photo
                      </button>
                      @if(!empty($user->profile_picture))
                        <button type="button" class="pf-btn-sm pf-btn-sm-ghost" onclick="removeProfilePicture()">Remove</button>
                      @endif
                    </div>
                  </div>
                  <input type="file" name="profile_picture" id="profilePicInput" accept="image/jpeg,image/png,image/gif" hidden>
                </div>
              </div>

              {{-- Basic Info --}}
              <div class="pf-field-group">
                <div class="pf-field-group-title"><i class="fa-solid fa-id-card"></i> Basic Information</div>
                <div class="pf-grid">
                  <div class="pf-field">
                    <label class="pf-label">First Name <span class="pf-label-req">*</span></label>
                    <input type="text" name="first_name" class="pf-input" placeholder="First Name" value="{{ old('first_name', $user->first_name ?? '') }}">
                    @error('first_name')<div class="pf-error">{{ $message }}</div>@enderror
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Last Name <span class="pf-label-req">*</span></label>
                    <input type="text" name="last_name" class="pf-input" placeholder="Last Name" value="{{ old('last_name', $user->last_name ?? '') }}">
                    @error('last_name')<div class="pf-error">{{ $message }}</div>@enderror
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Email Address <span class="pf-label-req">*</span></label>
                    <input type="email" name="email" class="pf-input" placeholder="you@email.com" value="{{ old('email', $user->email ?? '') }}">
                    @error('email')<div class="pf-error">{{ $message }}</div>@enderror
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Phone Number <span class="pf-label-req">*</span></label>
                    <input type="text" name="phone" class="pf-input" placeholder="+91 98765 43210" value="{{ old('phone', $user->phone ?? '') }}">
                    @error('phone')<div class="pf-error">{{ $message }}</div>@enderror
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Gender</label>
                    <div class="pf-select-wrap">
                      <select name="gender" class="pf-select">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender',$user->gender??'') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender',$user->gender??'') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender',$user->gender??'') == 'other' ? 'selected' : '' }}>Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Job Function</label>
                    <div class="pf-select-wrap">
                      <select name="job_function_id" class="pf-select">
                        <option value="">Select Job Function</option>
                        @foreach($jobFunctions as $jf)
                          <option value="{{ $jf->id }}" {{ old('job_function_id',$user->job_function_id??'') == $jf->id ? 'selected' : '' }}>{{ $jf->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Location --}}
              <div class="pf-field-group">
                <div class="pf-field-group-title"><i class="fa-solid fa-map-location-dot"></i> Location</div>
                <div class="pf-grid">
                  <div class="pf-field pf-full">
                    <label class="pf-label">Street Address</label>
                    <input type="text" name="address" class="pf-input" placeholder="Your address" value="{{ old('address', $user->address ?? '') }}">
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">City / Location</label>
                    <input type="text" name="location" class="pf-input" placeholder="Chennai, Tamil Nadu" value="{{ old('location', $user->location ?? '') }}">
                  </div>
                  <div class="pf-field">
                    <label class="pf-label">Pin Code</label>
                    <input type="text" name="pincode" class="pf-input" placeholder="600001" value="{{ old('pincode', $user->pincode ?? '') }}">
                  </div>
                </div>
              </div>

              {{-- Resume --}}
              <div class="pf-field-group" style="margin-bottom:0">
                <div class="pf-field-group-title"><i class="fa-solid fa-file-pdf"></i> CV / Resume</div>
                <div class="pf-resume-zone" onclick="document.getElementById('cvFile').click()">
                  <div class="pf-resume-icon"><i class="fa-solid fa-file-arrow-up"></i></div>
                  <div class="pf-resume-text">
                    <h5>Upload CV / Resume</h5>
                    <p>PDF, DOC, DOCX · Max 3MB</p>
                  </div>
                  <div class="pf-resume-badge">
                    @if(!empty($user->resume))
                      <span class="pf-file-pill"><i class="fa-solid fa-circle-check"></i> {{ Str::limit(basename($user->resume), 20) }}</span>
                      <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="pf-file-view" onclick="event.stopPropagation()" title="View Resume">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                      </a>
                    @else
                      <span style="font-size:12px;color:var(--text-muted);">No file uploaded</span>
                    @endif
                  </div>
                  <input type="file" name="resume" id="cvFile" accept=".pdf,.doc,.docx" hidden>
                </div>
              </div>

            </div>
            <div class="pf-save-wrap">
              <span class="pf-save-hint"><i class="fa-solid fa-shield-halved"></i> Your data is encrypted and secure</span>
              <button type="submit" class="pf-save-btn"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            </div>
          </div>
        </div>

        {{-- ─── PANEL: EDUCATION ─── --}}
        <div class="pf-panel" id="tab-education">
          <div class="pf-card" style="border-radius: var(--radius-lg);">
            <div class="pf-section-hdr">
              <h2>
                <span class="pf-section-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                Education History
              </h2>
              <button type="button" class="btn-add-entry" id="addEducation"><i class="fa-solid fa-plus"></i> Add Degree</button>
            </div>
            <div class="pf-form-body">
              <div id="educationList">
                @if($user->educations && $user->educations->count() > 0)
                  @foreach($user->educations as $index => $education)
                    <div class="pf-entry education-entry">
                      <div class="pf-entry-hdr">
                        <div class="pf-entry-title">
                          <span class="pf-entry-num">{{ $index + 1 }}</span>
                          Education Details
                        </div>
                        <button type="button" class="btn-del">Remove</button>
                      </div>
                      <div class="pf-entry-body">
                        <div class="pf-grid">
                          <div class="pf-field">
                            <label class="pf-label">Degree <span class="pf-label-req">*</span></label>
                            <div class="pf-select-wrap">
                              <select name="education[{{ $index }}][degree]" class="pf-select">
                                <option value="">Select Degree</option>
                                <option {{ $education->degree == "Bachelor's" ? 'selected' : '' }}>Bachelor's</option>
                                <option {{ $education->degree == "Master's" ? 'selected' : '' }}>Master's</option>
                                <option {{ $education->degree == 'PhD' ? 'selected' : '' }}>PhD</option>
                                <option {{ $education->degree == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option {{ $education->degree == '10th / SSC' ? 'selected' : '' }}>10th / SSC</option>
                                <option {{ $education->degree == '12th / HSC' ? 'selected' : '' }}>12th / HSC</option>
                              </select>
                            </div>
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Institution <span class="pf-label-req">*</span></label>
                            <input type="text" name="education[{{ $index }}][institution]" class="pf-input" placeholder="E.g., Chennai University" value="{{ $education->institution }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Subject / Major <span class="pf-label-req">*</span></label>
                            <input type="text" name="education[{{ $index }}][subject]" class="pf-input" placeholder="E.g., Computer Science" value="{{ $education->subject }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">GPA / Score</label>
                            <input type="text" name="education[{{ $index }}][gpa]" class="pf-input" placeholder="e.g., 9.2 GPA" value="{{ $education->gpa }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Location</label>
                            <input type="text" name="education[{{ $index }}][location]" class="pf-input" placeholder="City, State" value="{{ $education->location }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Year <span class="pf-label-req">*</span></label>
                            <input type="text" name="education[{{ $index }}][year]" class="pf-input" placeholder="e.g., 2024" value="{{ $education->year }}">
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="pf-entry education-entry">
                    <div class="pf-entry-hdr">
                      <div class="pf-entry-title"><span class="pf-entry-num">1</span> Education Details</div>
                      <button type="button" class="btn-del">Remove</button>
                    </div>
                    <div class="pf-entry-body">
                      <div class="pf-grid">
                        <div class="pf-field">
                          <label class="pf-label">Degree <span class="pf-label-req">*</span></label>
                          <div class="pf-select-wrap">
                            <select name="education[0][degree]" class="pf-select">
                              <option value="">Select Degree</option>
                              <option>Bachelor's</option><option>Master's</option><option>PhD</option>
                              <option>Diploma</option><option>10th / SSC</option><option>12th / HSC</option>
                            </select>
                          </div>
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Institution <span class="pf-label-req">*</span></label>
                          <input type="text" name="education[0][institution]" class="pf-input" placeholder="E.g., Chennai University">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Subject / Major <span class="pf-label-req">*</span></label>
                          <input type="text" name="education[0][subject]" class="pf-input" placeholder="E.g., Computer Science">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">GPA / Score</label>
                          <input type="text" name="education[0][gpa]" class="pf-input" placeholder="e.g., 9.2 GPA">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Location</label>
                          <input type="text" name="education[0][location]" class="pf-input" placeholder="City, State">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Year <span class="pf-label-req">*</span></label>
                          <input type="text" name="education[0][year]" class="pf-input" placeholder="e.g., 2024">
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="pf-save-wrap">
              <span class="pf-save-hint"><i class="fa-solid fa-shield-halved"></i> Your data is encrypted and secure</span>
              <button type="submit" class="pf-save-btn"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            </div>
          </div>
        </div>

        {{-- ─── PANEL: EXPERIENCE ─── --}}
        <div class="pf-panel" id="tab-experience">
          <div class="pf-card" style="border-radius: var(--radius-lg);">
            <div class="pf-section-hdr">
              <h2>
                <span class="pf-section-icon"><i class="fa-solid fa-briefcase"></i></span>
                Work Experience
              </h2>
              <button type="button" class="btn-add-entry" id="addExperience"><i class="fa-solid fa-plus"></i> Add Role</button>
            </div>
            <div class="pf-form-body">
              <div id="experienceList">
                @if($user->experiences && $user->experiences->count() > 0)
                  @foreach($user->experiences as $index => $experience)
                    <div class="pf-entry experience-entry">
                      <div class="pf-entry-hdr">
                        <div class="pf-entry-title"><span class="pf-entry-num">{{ $index + 1 }}</span> Work Experience</div>
                        <button type="button" class="btn-del">Remove</button>
                      </div>
                      <div class="pf-entry-body">
                        <div class="pf-grid">
                          <div class="pf-field">
                            <label class="pf-label">Job Title <span class="pf-label-req">*</span></label>
                            <input type="text" name="experience[{{ $index }}][job_title]" class="pf-input" placeholder="E.g., Senior Developer" value="{{ $experience->job_title }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Company <span class="pf-label-req">*</span></label>
                            <input type="text" name="experience[{{ $index }}][company]" class="pf-input" placeholder="Company Name" value="{{ $experience->company }}">
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Employment Type <span class="pf-label-req">*</span></label>
                            <div class="pf-select-wrap">
                              <select name="experience[{{ $index }}][employment_type]" class="pf-select">
                                <option value="">Select Type</option>
                                <option value="full_time" {{ $experience->employment_type=='full_time'?'selected':'' }}>Full-time</option>
                                <option value="part_time" {{ $experience->employment_type=='part_time'?'selected':'' }}>Part-time</option>
                                <option value="contract" {{ $experience->employment_type=='contract'?'selected':'' }}>Contract</option>
                                <option value="internship" {{ $experience->employment_type=='internship'?'selected':'' }}>Internship</option>
                                <option value="freelance" {{ $experience->employment_type=='freelance'?'selected':'' }}>Freelance</option>
                              </select>
                            </div>
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Location <span class="pf-label-req">*</span></label>
                            <input type="text" name="experience[{{ $index }}][location]" class="pf-input" placeholder="City, State" value="{{ $experience->location }}">
                          </div>
                          <div class="pf-field pf-full">
                            <div class="pf-check-row">
                              <input type="checkbox" name="experience[{{ $index }}][currently_working]" id="curRole{{ $index }}" {{ $experience->currently_working?'checked':'' }}>
                              <label for="curRole{{ $index }}">I currently work here</label>
                            </div>
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">Start Date <span class="pf-label-req">*</span></label>
                            <div class="pf-date-pair">
                              <div class="pf-select-wrap">
                                <select name="experience[{{ $index }}][start_month]" class="pf-select">
                                  <option value="">Month</option>
                                  @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                    <option value="{{ $m }}" {{ $experience->start_month==$m?'selected':'' }}>{{ ucfirst($m) }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="pf-select-wrap">
                                <select name="experience[{{ $index }}][start_year]" class="pf-select">
                                  <option value="">Year</option>
                                  @for($y=date('Y');$y>=1990;$y--)
                                    <option value="{{ $y }}" {{ $experience->start_year==$y?'selected':'' }}>{{ $y }}</option>
                                  @endfor
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="pf-field">
                            <label class="pf-label">End Date <span class="pf-label-req">*</span></label>
                            <div class="pf-date-pair">
                              <div class="pf-select-wrap">
                                <select name="experience[{{ $index }}][end_month]" class="pf-select">
                                  <option value="">Month</option>
                                  @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                    <option value="{{ $m }}" {{ $experience->end_month==$m?'selected':'' }}>{{ ucfirst($m) }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="pf-select-wrap">
                                <select name="experience[{{ $index }}][end_year]" class="pf-select">
                                  <option value="">Year</option>
                                  @for($y=date('Y');$y>=1990;$y--)
                                    <option value="{{ $y }}" {{ $experience->end_year==$y?'selected':'' }}>{{ $y }}</option>
                                  @endfor
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="pf-entry experience-entry">
                    <div class="pf-entry-hdr">
                      <div class="pf-entry-title"><span class="pf-entry-num">1</span> Work Experience</div>
                      <button type="button" class="btn-del">Remove</button>
                    </div>
                    <div class="pf-entry-body">
                      <div class="pf-grid">
                        <div class="pf-field">
                          <label class="pf-label">Job Title <span class="pf-label-req">*</span></label>
                          <input type="text" name="experience[0][job_title]" class="pf-input" placeholder="E.g., Senior Developer">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Company <span class="pf-label-req">*</span></label>
                          <input type="text" name="experience[0][company]" class="pf-input" placeholder="Company Name">
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Employment Type <span class="pf-label-req">*</span></label>
                          <div class="pf-select-wrap">
                            <select name="experience[0][employment_type]" class="pf-select">
                              <option value="">Select Type</option>
                              <option value="full_time">Full-time</option>
                              <option value="part_time">Part-time</option>
                              <option value="contract">Contract</option>
                              <option value="internship">Internship</option>
                              <option value="freelance">Freelance</option>
                            </select>
                          </div>
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Location <span class="pf-label-req">*</span></label>
                          <input type="text" name="experience[0][location]" class="pf-input" placeholder="City, State">
                        </div>
                        <div class="pf-field pf-full">
                          <div class="pf-check-row">
                            <input type="checkbox" name="experience[0][currently_working]" id="curRole0">
                            <label for="curRole0">I currently work here</label>
                          </div>
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">Start Date <span class="pf-label-req">*</span></label>
                          <div class="pf-date-pair">
                            <div class="pf-select-wrap">
                              <select name="experience[0][start_month]" class="pf-select">
                                <option value="">Month</option>
                                @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                  <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="pf-select-wrap">
                              <select name="experience[0][start_year]" class="pf-select">
                                <option value="">Year</option>
                                @for($y=date('Y');$y>=1990;$y--)
                                  <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="pf-field">
                          <label class="pf-label">End Date <span class="pf-label-req">*</span></label>
                          <div class="pf-date-pair">
                            <div class="pf-select-wrap">
                              <select name="experience[0][end_month]" class="pf-select">
                                <option value="">Month</option>
                                @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                  <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="pf-select-wrap">
                              <select name="experience[0][end_year]" class="pf-select">
                                <option value="">Year</option>
                                @for($y=date('Y');$y>=1990;$y--)
                                  <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="pf-save-wrap">
              <span class="pf-save-hint"><i class="fa-solid fa-shield-halved"></i> Your data is encrypted and secure</span>
              <button type="submit" class="pf-save-btn"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            </div>
          </div>
        </div>

        {{-- ─── PANEL: SKILLS ─── --}}
        <div class="pf-panel" id="tab-skills">
          <div class="pf-card" style="border-radius: var(--radius-lg);">
            <div class="pf-section-hdr">
              <h2>
                <span class="pf-section-icon"><i class="fa-solid fa-brain"></i></span>
                Skills & Expertise
              </h2>
            </div>
            <div class="pf-form-body">
              <div class="pf-skills-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="skillSearch" placeholder="Type a skill to search or add…">
                <button type="button" id="addCustomSkill" class="pf-add-skill-btn">
                  <i class="fa-solid fa-plus"></i> Add
                </button>
              </div>

              <div class="pf-skills-sublabel">Suggested Skills</div>
              <div class="pf-chips" id="suggestedSkills">
                @php $suggested = ['Product Strategy','User-Centered Thinking','Prioritization','Analytics','Data-Driven Decisions','Agile & Scrum','Market Research','Financial Acumen','Stakeholder Management','Project Management','Team Leadership','Communication','Problem Solving','Critical Thinking','Technical Writing']; @endphp
                @foreach($suggested as $skill)
                  <span class="pf-chip" data-skill="{{ $skill }}">{{ $skill }}</span>
                @endforeach
              </div>

              <div class="pf-skills-sublabel" style="margin-top:24px;">Your Skills</div>
              <div class="pf-chips" id="selectedSkills">
                @if($user->skills && $user->skills->count() > 0)
                  @foreach($user->skills as $skill)
                    <span class="pf-chip selected" data-skill="{{ $skill->skill_name }}">{{ $skill->skill_name }}<span class="rm">✕</span></span>
                  @endforeach
                @else
                  <span class="pf-no-skills" id="noSkillsMsg">No skills added yet. Pick from suggestions or type a custom skill above.</span>
                @endif
              </div>
              <input type="hidden" name="skills" id="skillsInput" value="{{ $user->skills ? $user->skills->pluck('skill_name')->implode(',') : '' }}">
            </div>
            <div class="pf-save-wrap">
              <span class="pf-save-hint"><i class="fa-solid fa-shield-halved"></i> Your data is encrypted and secure</span>
              <button type="submit" class="pf-save-btn"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            </div>
          </div>
        </div>

      </form>
    </main>
  </div>
</div>

<script>
// ── Tab Navigation ────────────────────────────────────────────
function switchTab(tabName) {
  document.querySelectorAll('.pf-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.pf-nav-item').forEach(n => n.classList.remove('active'));
  document.querySelectorAll('.pf-mobile-tab').forEach(t => t.classList.remove('active'));
  document.getElementById('tab-' + tabName).classList.add('active');
  document.querySelectorAll('[data-tab="' + tabName + '"]').forEach(el => el.classList.add('active'));
}
document.querySelectorAll('.pf-nav-item, .pf-mobile-tab').forEach(btn => {
  btn.addEventListener('click', function() { switchTab(this.dataset.tab); });
});

// ── Profile Picture Upload ────────────────────────────────────
document.getElementById('profilePicInput').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (!file) return;
  if (file.size > 2 * 1024 * 1024) { alert('Max 2MB'); this.value = ''; return; }
  const reader = new FileReader();
  reader.onload = function(ev) {
    const src = ev.target.result;
    // Update sidebar avatar
    const sidebarWrap = document.getElementById('sidebarAvatarWrap');
    let img = sidebarWrap.querySelector('img');
    if (!img) { img = document.createElement('img'); sidebarWrap.innerHTML = ''; sidebarWrap.appendChild(img); }
    img.src = src;
    // Update upload preview
    const preview = document.getElementById('avatarPreview');
    let pImg = preview.querySelector('img');
    const pInit = preview.querySelector('#previewInitials');
    if (!pImg) { pImg = document.createElement('img'); preview.appendChild(pImg); }
    pImg.src = src; pImg.id = 'previewImg';
    if (pInit) pInit.style.display = 'none';
  };
  reader.readAsDataURL(file);
});

function removeProfilePicture() {
  if (!confirm('Remove your profile picture?')) return;
  fetch('{{ route("profile.remove-picture") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
  }).then(r => r.json()).then(d => { if (d.success) location.reload(); });
}

// ── Skills ────────────────────────────────────────────────────
const selectedSkills = new Set();
@if($user->skills && $user->skills->count() > 0)
  @foreach($user->skills as $skill)
    selectedSkills.add('{{ $skill->skill_name }}');
  @endforeach
@endif

function createSelectedChip(skill) {
  const el = document.createElement('span');
  el.className = 'pf-chip selected';
  el.dataset.skill = skill;
  el.innerHTML = `${skill}<span class="rm" title="Remove">✕</span>`;
  el.querySelector('.rm').addEventListener('click', e => {
    e.stopPropagation();
    selectedSkills.delete(skill);
    el.remove();
    if (!selectedSkills.size) showNoSkills();
    syncSkills();
  });
  return el;
}
function showNoSkills() {
  const msg = document.createElement('span');
  msg.id = 'noSkillsMsg'; msg.className = 'pf-no-skills';
  msg.textContent = 'No skills added yet. Pick from suggestions or type above.';
  document.getElementById('selectedSkills').appendChild(msg);
}
function syncSkills() {
  document.getElementById('skillsInput').value = Array.from(selectedSkills).join(',');
  const el = document.getElementById('sidebarSkillsCount');
  if (el) el.textContent = selectedSkills.size;
}

// Existing remove buttons
document.querySelectorAll('#selectedSkills .pf-chip.selected .rm').forEach(btn => {
  btn.addEventListener('click', e => {
    e.stopPropagation();
    const chip = btn.closest('.pf-chip');
    selectedSkills.delete(chip.dataset.skill);
    chip.remove();
    if (!selectedSkills.size) showNoSkills();
    syncSkills();
  });
});

// Suggested chips
document.querySelectorAll('#suggestedSkills .pf-chip').forEach(tag => {
  tag.addEventListener('click', function() {
    const skill = this.dataset.skill;
    if (selectedSkills.has(skill)) return;
    selectedSkills.add(skill);
    document.getElementById('noSkillsMsg')?.remove();
    document.getElementById('selectedSkills').appendChild(createSelectedChip(skill));
    syncSkills();
  });
});

// Custom skill
document.getElementById('addCustomSkill').addEventListener('click', () => {
  const input = document.getElementById('skillSearch');
  const skill = input.value.trim();
  if (!skill) { input.focus(); return; }
  if (selectedSkills.has(skill)) { alert('Already added'); return; }
  selectedSkills.add(skill);
  document.getElementById('noSkillsMsg')?.remove();
  document.getElementById('selectedSkills').appendChild(createSelectedChip(skill));
  syncSkills();
  input.value = '';
  document.querySelectorAll('#suggestedSkills .pf-chip').forEach(t => t.style.display = '');
});
document.getElementById('skillSearch').addEventListener('keypress', e => {
  if (e.key === 'Enter') { e.preventDefault(); document.getElementById('addCustomSkill').click(); }
});
document.getElementById('skillSearch').addEventListener('input', function() {
  const q = this.value.toLowerCase();
  document.querySelectorAll('#suggestedSkills .pf-chip').forEach(t => {
    t.style.display = t.dataset.skill.toLowerCase().includes(q) ? '' : 'none';
  });
});

// ── Form submit sync ──────────────────────────────────────────
document.getElementById('profileUpdateForm').addEventListener('submit', () => syncSkills());

// ── Education add/remove ──────────────────────────────────────
let eduCount = {{ $user->educations && $user->educations->count() > 0 ? $user->educations->count() : 1 }};
document.getElementById('addEducation').addEventListener('click', e => {
  e.preventDefault(); eduCount++;
  const entry = document.querySelector('.education-entry').cloneNode(true);
  entry.querySelectorAll('input,select').forEach(el => {
    el.value = '';
    if (el.name) el.name = el.name.replace(/\[\d+\]/, '[' + (eduCount-1) + ']');
  });
  entry.querySelector('.pf-entry-num').textContent = eduCount;
  entry.querySelector('.btn-del').addEventListener('click', function(e) {
    e.preventDefault();
    if (document.querySelectorAll('.education-entry').length > 1) entry.remove();
  });
  document.getElementById('educationList').appendChild(entry);
});
document.querySelectorAll('#educationList .btn-del').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    if (document.querySelectorAll('.education-entry').length > 1) btn.closest('.education-entry').remove();
  });
});

// ── Experience add/remove ─────────────────────────────────────
let expCount = {{ $user->experiences && $user->experiences->count() > 0 ? $user->experiences->count() : 1 }};
document.getElementById('addExperience').addEventListener('click', e => {
  e.preventDefault(); expCount++;
  const entry = document.querySelector('.experience-entry').cloneNode(true);
  entry.querySelectorAll('input,select').forEach(el => {
    el.value = '';
    if (el.type === 'checkbox') el.checked = false;
    if (el.name) el.name = el.name.replace(/\[\d+\]/, '[' + (expCount-1) + ']');
  });
  entry.querySelector('.pf-entry-num').textContent = expCount;
  entry.querySelector('.btn-del').addEventListener('click', function(e) {
    e.preventDefault();
    if (document.querySelectorAll('.experience-entry').length > 1) entry.remove();
  });
  document.getElementById('experienceList').appendChild(entry);
});
document.querySelectorAll('#experienceList .btn-del').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    if (document.querySelectorAll('.experience-entry').length > 1) btn.closest('.experience-entry').remove();
  });
});
</script>

@endsection