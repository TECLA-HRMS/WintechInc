@extends('layouts.site')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
  --brand-navy: #071056;
  --brand-navy-light: #121f87;
  --brand-navy-glow: rgba(7, 16, 86, 0.08);
  --brand-burgundy: #b11e24;
  --brand-burgundy-light: #d32f2f;
  --brand-burgundy-glow: rgba(177, 30, 36, 0.1);
  --slate-50: #f8fafc;
  --slate-100: #f1f5f9;
  --slate-200: #e2e8f0;
  --slate-300: #cbd5e1;
  --slate-700: #334155;
  --slate-800: #1e293b;
  --slate-900: #0f172a;
  --glass-bg: rgba(255, 255, 255, 0.85);
  --glass-border: rgba(255, 255, 255, 0.5);
  --radius-sm: 12px;
  --radius-md: 16px;
  --radius-lg: 24px;
  --shadow-sm: 0 2px 8px rgba(7, 16, 86, 0.04);
  --shadow-md: 0 12px 24px -10px rgba(7, 16, 86, 0.06);
  --shadow-lg: 0 25px 50px -12px rgba(7, 16, 86, 0.1);
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
  background-color: #f3f6f9;
}

.profile-container-wrap {
  padding: 120px 0 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--slate-800);
}

/* Glassmorphism Panel card */
.premium-card {
  background: var(--glass-bg);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  overflow: hidden;
  transition: var(--transition);
}

/* Banner section */
.elite-banner {
  background: linear-gradient(135deg, var(--brand-navy) 0%, #030833 100%);
  padding: 40px;
  position: relative;
  overflow: hidden;
  color: #fff;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.elite-banner::before {
  content: '';
  position: absolute;
  top: -10%;
  right: -5%;
  width: 350px;
  height: 350px;
  background: radial-gradient(circle, rgba(177, 30, 36, 0.25) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

.elite-banner::after {
  content: '';
  position: absolute;
  bottom: -20%;
  left: 10%;
  width: 250px;
  height: 250px;
  background: radial-gradient(circle, rgba(18, 31, 135, 0.4) 0%, transparent 75%);
  border-radius: 50%;
  pointer-events: none;
}

.banner-content {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 24px;
}

.avatar-uploader-container {
  display: flex;
  align-items: center;
  gap: 24px;
}

.elite-avatar-wrapper {
  position: relative;
  width: 110px;
  height: 110px;
  border-radius: 50%;
  padding: 4px;
  background: linear-gradient(135deg, var(--brand-burgundy) 0%, var(--brand-navy-light) 100%);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  transition: var(--transition);
}

.elite-avatar-wrapper:hover {
  transform: scale(1.05);
}

.elite-avatar-inner {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #fff;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 38px;
  font-weight: 800;
  color: var(--brand-navy);
  position: relative;
}

.elite-avatar-inner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.camera-overlay {
  position: absolute;
  inset: 0;
  background: rgba(7, 16, 86, 0.75);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: var(--transition);
  color: #fff;
  font-size: 20px;
}

.elite-avatar-wrapper:hover .camera-overlay {
  opacity: 1;
}

.banner-user-details h2 {
  font-size: 28px;
  font-weight: 800;
  letter-spacing: -0.5px;
  margin: 0 0 6px;
  background: linear-gradient(to right, #ffffff, #e2e8f0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.banner-user-details p {
  font-size: 14px;
  color: #94a3b8;
  margin: 0 0 4px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.banner-user-details p strong {
  color: #fff;
}

/* Completion indicator */
.completion-container {
  margin-top: 30px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 20px;
  border-radius: var(--radius-md);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.completion-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
  font-weight: 600;
  color: #cbd5e1;
  margin-bottom: 10px;
}

.completion-header span:last-child {
  color: #fff;
  font-weight: 800;
  font-size: 16px;
}

.completion-bar-bg {
  height: 8px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 99px;
  overflow: hidden;
}

.completion-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--brand-burgundy) 0%, var(--brand-burgundy-light) 100%);
  box-shadow: 0 0 15px var(--brand-burgundy);
  border-radius: 99px;
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Tabs section */
.elite-tabs {
  display: flex;
  background: #fff;
  border-bottom: 1.5px solid var(--slate-100);
  padding: 0 32px;
  gap: 32px;
  overflow-x: auto;
  scrollbar-width: none;
}

.elite-tab-btn {
  background: none;
  border: none;
  padding: 24px 8px;
  font-size: 14px;
  font-weight: 700;
  color: var(--slate-700);
  cursor: pointer;
  position: relative;
  transition: var(--transition);
  display: flex;
  align-items: center;
  gap: 10px;
  white-space: nowrap;
}

.elite-tab-btn i {
  font-size: 16px;
}

.elite-tab-btn:hover {
  color: var(--brand-burgundy);
}

.elite-tab-btn.active {
  color: var(--brand-burgundy);
}

.elite-tab-btn.active::after {
  content: '';
  position: absolute;
  bottom: -1.5px;
  left: 0;
  right: 0;
  height: 3px;
  background: var(--brand-burgundy);
  border-radius: 99px;
}

.tab-completion-badge {
  background: var(--slate-100);
  color: var(--slate-700);
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 99px;
  font-weight: 700;
  transition: var(--transition);
}

.elite-tab-btn.active .tab-completion-badge {
  background: var(--brand-burgundy-glow);
  color: var(--brand-burgundy);
}

/* Sidebar panel */
.sidebar-panel {
  background: #fff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--slate-200);
  overflow: hidden;
  box-shadow: var(--shadow-md);
}

.sidebar-hero {
  background: linear-gradient(135deg, var(--brand-navy) 0%, #0d1a70 100%);
  padding: 36px 24px;
  text-align: center;
  color: #fff;
}

.sidebar-avatar-outer {
  width: 96px;
  height: 96px;
  border-radius: 50%;
  padding: 3px;
  background: linear-gradient(135deg, var(--brand-burgundy) 0%, rgba(255, 255, 255, 0.4) 100%);
  margin: 0 auto 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.sidebar-avatar-inner {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #fff;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  font-weight: 800;
  color: var(--brand-navy);
}

.sidebar-avatar-inner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.sidebar-hero h3 {
  font-size: 20px;
  font-weight: 800;
  margin: 0 0 6px;
  letter-spacing: -0.3px;
}

.sidebar-hero p {
  font-size: 13px;
  color: #cbd5e1;
  margin: 0 0 12px;
}

.sidebar-location-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 700;
  background: rgba(255, 255, 255, 0.1);
  padding: 6px 14px;
  border-radius: 99px;
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.sidebar-metrics {
  display: flex;
  border-bottom: 1.5px solid var(--slate-100);
}

.metric-box {
  flex: 1;
  text-align: center;
  padding: 20px 12px;
}

.metric-box:first-child {
  border-right: 1.5px solid var(--slate-100);
}

.metric-value {
  font-size: 24px;
  font-weight: 800;
  color: var(--brand-burgundy);
}

.metric-label {
  font-size: 10px;
  font-weight: 700;
  color: var(--slate-700);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.sidebar-list-section {
  padding: 24px;
  border-bottom: 1.5px solid var(--slate-100);
}

.sidebar-list-section:last-child {
  border-bottom: none;
}

.sidebar-section-hdr {
  font-size: 11px;
  font-weight: 800;
  color: var(--brand-navy);
  text-transform: uppercase;
  letter-spacing: 1.2px;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.sidebar-detail-item {
  margin-bottom: 14px;
}

.sidebar-detail-item:last-child {
  margin-bottom: 0;
}

.detail-lbl {
  font-size: 10px;
  font-weight: 700;
  color: var(--slate-700);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
}

.detail-val {
  font-size: 13.5px;
  font-weight: 600;
  color: var(--slate-900);
  word-break: break-all;
}

.elite-stat-row {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 14px;
  background: var(--slate-50);
  border-radius: var(--radius-sm);
  border: 1px solid var(--slate-100);
  font-size: 13px;
  font-weight: 600;
  color: var(--slate-700);
  margin-bottom: 10px;
  transition: var(--transition);
}

.elite-stat-row:hover {
  background: var(--brand-navy-glow);
  color: var(--brand-navy);
  transform: translateX(4px);
}

/* Form Styling */
.elite-tab-panel {
  display: none;
  padding: 40px;
}

.elite-tab-panel.active {
  display: block;
}

.panel-heading {
  font-size: 18px;
  font-weight: 800;
  color: var(--brand-navy);
  margin-bottom: 24px;
  display: flex;
  align-items: center;
  gap: 12px;
}

.panel-heading::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--slate-200);
}

.elite-form-label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: var(--slate-700);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 8px;
}

.elite-form-control, .elite-form-select {
  width: 100%;
  background: var(--slate-50);
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-sm);
  padding: 12px 16px;
  font-size: 14.5px;
  color: var(--slate-900);
  transition: var(--transition);
  font-family: inherit;
  outline: none;
  height: 50px;
}

.elite-form-control:focus, .elite-form-select:focus {
  border-color: var(--brand-burgundy);
  background: #fff;
  box-shadow: 0 0 0 4px var(--brand-burgundy-glow);
}

.elite-select-wrap {
  position: relative;
}

.elite-select-wrap::after {
  content: '\f078';
  font-family: 'Font Awesome 6 Free';
  font-weight: 900;
  position: absolute;
  right: 16px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 12px;
  color: var(--slate-700);
  pointer-events: none;
}

.elite-form-select {
  appearance: none;
  -webkit-appearance: none;
  padding-right: 40px;
}

/* Upload zone */
.elite-upload-box {
  border: 2px dashed var(--slate-200);
  border-radius: var(--radius-md);
  padding: 32px 20px;
  text-align: center;
  background: var(--slate-50);
  cursor: pointer;
  transition: var(--transition);
  position: relative;
}

.elite-upload-box:hover {
  border-color: var(--brand-burgundy);
  background: var(--brand-burgundy-glow);
}

.upload-icon {
  font-size: 36px;
  color: var(--brand-burgundy);
  margin-bottom: 12px;
}

.upload-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--slate-900);
  margin-bottom: 4px;
}

.upload-subtitle {
  font-size: 11px;
  color: var(--slate-700);
}

.upload-browse {
  color: var(--brand-burgundy);
  font-weight: 700;
}

.elite-preview-circle {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin: 0 auto 16px;
  overflow: hidden;
  border: 3px solid #fff;
  box-shadow: var(--shadow-md);
}

.elite-preview-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.trash-overlay-btn {
  position: absolute;
  top: 16px;
  right: 16px;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #f87171;
  color: #fff;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(248, 113, 113, 0.3);
  transition: var(--transition);
}

.trash-overlay-btn:hover {
  background: #ef4444;
  transform: scale(1.08);
}

/* File badge item */
.elite-file-badge {
  background: #fff;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-sm);
  padding: 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  box-shadow: var(--shadow-sm);
  height: 100%;
}

.file-icon {
  font-size: 26px;
  color: var(--brand-burgundy);
}

.file-info {
  min-width: 0;
  flex: 1;
}

.file-name {
  font-size: 13px;
  font-weight: 700;
  color: var(--slate-900);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.file-status {
  font-size: 11px;
  color: var(--slate-700);
}

.file-view-btn {
  color: var(--brand-navy-light);
  font-size: 18px;
  transition: var(--transition);
}

.file-view-btn:hover {
  color: var(--brand-burgundy);
  transform: scale(1.1);
}

.elite-empty-badge {
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-sm);
  background: var(--slate-50);
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--slate-700);
  font-size: 13.5px;
  font-weight: 600;
  height: 100%;
}

/* Entry Cards */
.entry-card {
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  padding: 24px;
  margin-bottom: 24px;
  transition: var(--transition);
}

.entry-card:hover {
  background: #fff;
  border-color: var(--brand-burgundy-light);
  box-shadow: var(--shadow-md);
}

.entry-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  border-bottom: 1.5px solid var(--slate-100);
  padding-bottom: 14px;
}

.entry-title {
  font-size: 15px;
  font-weight: 800;
  color: var(--brand-navy);
  display: flex;
  align-items: center;
  gap: 10px;
}

.entry-num {
  background: var(--brand-burgundy);
  color: #fff;
  width: 24px;
  height: 24px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 700;
}

.btn-del {
  border: 1.5px solid var(--slate-200);
  background: #fff;
  color: #ef4444;
  padding: 6px 16px;
  font-size: 12px;
  font-weight: 700;
  border-radius: 30px;
  cursor: pointer;
  transition: var(--transition);
}

.btn-del:hover {
  border-color: #f87171;
  background: #fef2f2;
}

.btn-add-section {
  background: var(--brand-navy-glow);
  color: var(--brand-navy);
  border: 1.5px solid rgba(7, 16, 86, 0.1);
  border-radius: 30px;
  padding: 10px 24px;
  font-size: 13.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: var(--transition);
}

.btn-add-section:hover {
  background: var(--brand-navy);
  color: #fff;
  transform: translateY(-2px);
}

.check-container {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 16px;
  background: var(--slate-100);
  border-radius: var(--radius-sm);
}

.elite-checkbox {
  width: 18px;
  height: 18px;
  accent-color: var(--brand-burgundy);
  cursor: pointer;
}

.check-lbl {
  font-size: 13px;
  font-weight: 600;
  color: var(--slate-800);
  cursor: pointer;
}

.date-row {
  display: flex;
  gap: 12px;
}

.date-row .elite-select-wrap {
  flex: 1;
}

/* Skills Chip design */
.skills-box {
  background: var(--slate-50);
  border-radius: var(--radius-lg);
  padding: 32px;
  border: 1px solid var(--slate-200);
}

.skills-input-group {
  display: flex;
  align-items: center;
  gap: 12px;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-sm);
  padding: 8px 16px;
  background: #fff;
  margin-bottom: 24px;
}

.skills-input-group i {
  color: var(--slate-700);
}

.skills-input-field {
  border: none;
  outline: none;
  width: 100%;
  font-size: 14.5px;
  color: var(--slate-900);
  font-family: inherit;
}

.add-custom-skill-btn {
  background: var(--brand-burgundy);
  color: #fff;
  border: none;
  border-radius: 99px;
  padding: 8px 18px;
  font-size: 12.5px;
  font-weight: 700;
  cursor: pointer;
  white-space: nowrap;
  transition: var(--transition);
}

.add-custom-skill-btn:hover {
  background: var(--brand-burgundy-light);
  transform: translateY(-1px);
}

.skills-lbl-row {
  font-size: 11px;
  font-weight: 800;
  color: var(--brand-navy);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.skills-lbl-row::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--slate-200);
}

.skills-flex-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 24px;
}

.chip-tag {
  background: #fff;
  border: 1.5px solid var(--slate-200);
  padding: 8px 16px;
  border-radius: 99px;
  font-size: 13px;
  font-weight: 600;
  color: var(--slate-800);
  cursor: pointer;
  transition: var(--transition);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.chip-tag.suggested:hover {
  border-color: var(--brand-burgundy);
  color: var(--brand-burgundy);
  background: var(--brand-burgundy-glow);
}

.chip-tag.selected {
  background: var(--brand-navy);
  border-color: var(--brand-navy);
  color: #fff;
}

.chip-tag.selected .rm {
  font-size: 10px;
  margin-left: 6px;
  opacity: 0.8;
}

.chip-tag.selected .rm:hover {
  opacity: 1;
}

.no-skills-lbl {
  font-size: 13px;
  color: var(--slate-700);
  font-weight: 500;
}

/* Save profile button styling */
.elite-save-btn {
  background: var(--brand-burgundy);
  color: #fff;
  border: none;
  border-radius: 99px;
  padding: 16px 48px;
  font-size: 15px;
  font-weight: 800;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: var(--transition);
  box-shadow: 0 10px 25px var(--brand-burgundy-glow);
}

.elite-save-btn:hover {
  background: var(--brand-burgundy-light);
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(177, 30, 36, 0.35);
}

/* Media responsiveness */
@media (max-width: 991px) {
  .sidebar-panel {
    margin-bottom: 32px;
  }
}

@media (max-width: 767px) {
  .elite-tab-panel {
    padding: 24px 16px;
  }
  .elite-tabs {
    padding: 0 16px;
    gap: 16px;
  }
  .date-row {
    flex-direction: column;
    gap: 8px;
  }
}

@media (max-width: 480px) {
  .profile-container-wrap {
    padding: 90px 0 40px;
  }
  .elite-banner {
    padding: 24px 16px;
  }
  .avatar-uploader-container {
    flex-direction: column;
    text-align: center;
    gap: 16px;
  }
  .elite-avatar-wrapper {
    width: 90px;
    height: 90px;
  }
  .banner-user-details h2 {
    font-size: 22px;
  }
  .elite-tab-btn {
    padding: 16px 4px;
    font-size: 12px;
  }
  .elite-form-control, .elite-form-select {
    height: 52px;
    font-size: 16px; /* prevent mobile safari zoom */
  }
  .elite-save-btn {
    width: 100%;
    justify-content: center;
  }
}
</style>

<section class="profile-container-wrap">
  <div class="container">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: var(--radius-sm); border: none; background: #e6f4ea; color: #137333; font-weight: 600;">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: var(--radius-sm); border: none; background: #fce8e6; color: #c5221f; font-weight: 600;">
        <i class="fa-solid fa-triangle-exclamation me-2"></i> Please correct the highlighted errors.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row">
      {{-- LEFT SIDEBAR --}}
      <div class="col-12 col-xl-3 col-lg-4 mb-4">
        <div class="sidebar-panel">
          <div class="sidebar-hero">
            <div class="sidebar-avatar-outer">
              <div class="sidebar-avatar-inner" id="sidebarAvatar">
                @if(!empty($user->profile_picture))
                  <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile">
                @else
                  {{ strtoupper(substr($user->first_name ?? 'J', 0, 1) . substr($user->last_name ?? 'D', 0, 1)) }}
                @endif
              </div>
            </div>
            <h3 class="sidebar-name">{{ $user->name ?? ' ' }}</h3>
            <p class="sidebar-role">{{ $user->job_title ?? ' ' }}</p>
            <div class="sidebar-location-tag">
              <i class="fa-solid fa-location-dot"></i> {{ $user->location ?? 'Not Specified' }}
            </div>
          </div>

          <div class="sidebar-metrics">
            <div class="metric-box">
              <div class="metric-value" id="sidebarProfilePercent">{{ round($user->profile_completion ?? 0) }}%</div>
              <div class="metric-label">Completed</div>
            </div>
            <div class="metric-box">
              <div class="sidebar-avatar-inner" style="display:none;"></div>
              <div class="metric-value" id="sidebarSkillsCount">{{ $user->skills?->count() ?? 0 }}</div>
              <div class="metric-label">Skills</div>
            </div>
          </div>

          <div class="sidebar-list-section">
            <div class="sidebar-section-hdr">
              <i class="fa-solid fa-address-card"></i> Contact info
            </div>
            <div class="sidebar-detail-item">
              <div class="detail-lbl">Email</div>
              <div class="detail-val">{{ $user->email ?? 'john@example.com' }}</div>
            </div>
            <div class="sidebar-detail-item">
              <div class="detail-lbl">Phone</div>
              <div class="detail-val">{{ $user->phone ?? 'Not Specified' }}</div>
            </div>
          </div>

          <div class="sidebar-list-section">
            <div class="sidebar-section-hdr">
              <i class="fa-solid fa-sliders"></i> Progress Overview
            </div>
            <div class="elite-stat-row">
              <i class="fa-solid fa-graduation-cap" style="color: var(--brand-burgundy);"></i>
              <span>Education: <strong id="eduCount">{{ $user->educations?->count() ?? 0 }}</strong>/1</span>
            </div>
            <div class="elite-stat-row">
              <i class="fa-solid fa-briefcase" style="color: var(--brand-navy-light);"></i>
              <span>Experience: <strong id="expCount">{{ $user->experiences?->count() ?? 0 }}</strong>/1</span>
            </div>
            <div class="elite-stat-row">
              <i class="fa-solid fa-fire" style="color: #ea580c;"></i>
              <span>Skills: <strong id="skillCount">{{ $user->skills?->count() ?? 0 }}</strong>/5</span>
            </div>
          </div>
        </div>
      </div>

      {{-- MAIN CONTENT PANEL --}}
      <div class="col-12 col-xl-9 col-lg-8">
        <form id="profileUpdateForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="premium-card">

            {{-- PROFILE BANNER --}}
            <div class="elite-banner">
              <div class="banner-content">
                <div class="avatar-uploader-container">
                  <div class="elite-avatar-wrapper" id="bannerAvatar" onclick="document.getElementById('profilePicInput').click()">
                    <div class="elite-avatar-inner">
                      @if(!empty($user->profile_picture))
                        <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile">
                      @else
                        {{ strtoupper(substr($user->first_name ?? 'J', 0, 1) . substr($user->last_name ?? 'D', 0, 1)) }}
                      @endif
                      <div class="camera-overlay">
                        <i class="fa-solid fa-camera"></i>
                      </div>
                    </div>
                  </div>
                  <div class="banner-user-details">
                    <h2>{{ $user->name ?? 'John Doe' }}</h2>
                    <p><i class="fa-solid fa-briefcase"></i> {{ $user->job_title ?? 'Developer / Professional' }}</p>
                    <p><i class="fa-solid fa-clock"></i> Updated: <strong>{{ $user->profile_updated_at ? $user->profile_updated_at->diffForHumans() : 'Never' }}</strong></p>
                  </div>
                </div>
              </div>

              <div class="completion-container">
                <div class="completion-header">
                  <span>Profile Strength Indicator</span>
                  <span id="bannerProfilePercent">{{ round($user->profile_completion ?? 0) }}%</span>
                </div>
                <div class="completion-bar-bg">
                  <div class="completion-bar-fill" id="progressBar" style="width:{{ round($user->profile_completion ?? 0) }}%"></div>
                </div>
              </div>
            </div>

            {{-- TABS --}}
            <div class="elite-tabs">
              <button type="button" class="elite-tab-btn active" data-tab="personal">
                <i class="fa-solid fa-user-tie"></i> Profile Details
                <span class="tab-completion-badge" id="personalBadge">{{ round($progress['personal'] ?? 0) }}%</span>
              </button>
              <button type="button" class="elite-tab-btn" data-tab="education">
                <i class="fa-solid fa-graduation-cap"></i> Education
                <span class="tab-completion-badge" id="educationBadge">{{ round($progress['education'] ?? 0) }}%</span>
              </button>
              <button type="button" class="elite-tab-btn" data-tab="experience">
                <i class="fa-solid fa-briefcase"></i> Experience
                <span class="tab-completion-badge" id="experienceBadge">{{ round($progress['experience'] ?? 0) }}%</span>
              </button>
              <button type="button" class="elite-tab-btn" data-tab="skills">
                <i class="fa-solid fa-brain"></i> Skills & Expertise
                <span class="tab-completion-badge" id="skillsBadge">{{ round($progress['skills'] ?? 0) }}%</span>
              </button>
            </div>

            {{-- TAB: PERSONAL DETAILS --}}
            <div class="elite-tab-panel active" id="tab-personal">
              <div class="panel-heading">Profile Photo</div>
              <div class="row mb-4">
                <div class="col-12">
                  <div class="elite-upload-box" onclick="document.getElementById('profilePicInput').click()">
                    @if(!empty($user->profile_picture))
                      <button type="button" class="trash-overlay-btn" onclick="event.stopPropagation(); removeProfilePicture()" title="Remove photo">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                    @endif
                    <div class="elite-preview-circle" id="profilePicPreview">
                      @if(!empty($user->profile_picture))
                        <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" alt="Profile" id="previewImg">
                      @else
                        <span id="previewInitials" style="font-size: 34px; font-weight:800; color:var(--brand-navy)">{{ strtoupper(substr($user->first_name ?? 'J', 0, 1) . substr($user->last_name ?? 'D', 0, 1)) }}</span>
                      @endif
                    </div>
                    <div class="upload-title">
                      <span class="upload-browse">Upload a new profile picture</span> or select a file
                    </div>
                    <div class="upload-subtitle">Supported formats: JPG, PNG, GIF up to 2MB</div>
                    <input type="file" name="profile_picture" id="profilePicInput" accept="image/jpeg,image/png,image/gif" hidden>
                  </div>
                </div>
              </div>

              <div class="panel-heading">Basic Information</div>
              <div class="row g-4">
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">First Name <span style="color:var(--brand-burgundy)">*</span></label>
                  <input type="text" name="first_name" class="elite-form-control" placeholder="First Name" value="{{ old('first_name', $user->first_name ?? '') }}">
                  @error('first_name')<div style="font-size: 12px; color: var(--brand-burgundy); margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Last Name <span style="color:var(--brand-burgundy)">*</span></label>
                  <input type="text" name="last_name" class="elite-form-control" placeholder="Last Name" value="{{ old('last_name', $user->last_name ?? '') }}">
                  @error('last_name')<div style="font-size: 12px; color: var(--brand-burgundy); margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Email Address <span style="color:var(--brand-burgundy)">*</span></label>
                  <input type="email" name="email" class="elite-form-control" placeholder="Email Address" value="{{ old('email', $user->email ?? '') }}">
                  @error('email')<div style="font-size: 12px; color: var(--brand-burgundy); margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Phone Number <span style="color:var(--brand-burgundy)">*</span></label>
                  <input type="text" name="phone" class="elite-form-control" placeholder="Phone Number" value="{{ old('phone', $user->phone ?? '') }}">
                  @error('phone')<div style="font-size: 12px; color: var(--brand-burgundy); margin-top: 4px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Gender</label>
                  <div class="elite-select-wrap">
                    <select name="gender" class="elite-form-select">
                      <option value="">Select Gender</option>
                      <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                      <option value="other" {{ old('gender', $user->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Address</label>
                  <input type="text" name="address" class="elite-form-control" placeholder="Address" value="{{ old('address', $user->address ?? '') }}">
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Location / City</label>
                  <input type="text" name="location" class="elite-form-control" placeholder="City, Country" value="{{ old('location', $user->location ?? '') }}">
                </div>
                <div class="col-12 col-md-6">
                  <label class="elite-form-label">Pin Code</label>
                  <input type="text" name="pincode" class="elite-form-control" placeholder="Pin Code" value="{{ old('pincode', $user->pincode ?? '') }}">
                </div>
              </div>

              <div class="panel-heading mt-5">CV / Resume File</div>
              <div class="row g-4">
                <div class="col-12 col-md-6">
                  <div class="elite-upload-box" onclick="document.getElementById('cvFile').click()">
                    <div class="upload-icon">
                      <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div class="upload-title">
                      <span class="upload-browse">Upload dynamic CV</span> or drag here
                    </div>
                    <div class="upload-subtitle">PDF, DOC, DOCX up to 3MB maximum</div>
                    <input type="file" name="resume" id="cvFile" accept=".pdf,.doc,.docx" hidden>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  @if(!empty($user->resume))
                    <div class="elite-file-badge">
                      <div class="d-flex align-items-center gap-3 min-w-0">
                        <i class="fa-solid fa-file-pdf file-icon"></i>
                        <div class="min-w-0">
                          <div class="file-name">{{ basename($user->resume) }}</div>
                          <div class="file-status">CV Document Verified</div>
                        </div>
                      </div>
                      <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="file-view-btn" title="View Document">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                      </a>
                    </div>
                  @else
                    <div class="elite-empty-badge">
                      <span><i class="fa-regular fa-file me-2" style="font-size:18px"></i>No CV document uploaded yet</span>
                    </div>
                  @endif
                </div>
              </div>
            </div>

            {{-- TAB: EDUCATION DETAILS --}}
            <div class="elite-tab-panel" id="tab-education">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div class="panel-heading" style="margin-bottom:0; flex:1;">Education History</div>
                <button type="button" class="btn-add-section" id="addEducation">
                  <i class="fa-solid fa-plus"></i> Add Degree
                </button>
              </div>

              <div id="educationList">
                @if($user->educations && $user->educations->count() > 0)
                  @foreach($user->educations as $index => $education)
                    <div class="entry-card education-entry">
                      <div class="entry-card-header">
                        <div class="entry-title">
                          <span class="entry-num">{{ $index + 1 }}</span>
                          Education Details
                        </div>
                        <div>
                          <button type="button" class="btn-del">Delete</button>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Degree <span style="color:var(--brand-burgundy)">*</span></label>
                          <div class="elite-select-wrap">
                            <select name="education[{{ $index }}][degree]" class="elite-form-select">
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
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Institution Name <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="education[{{ $index }}][institution]" class="elite-form-control" placeholder="E.g., Chennai University" value="{{ $education->institution }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Subject / Major <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="education[{{ $index }}][subject]" class="elite-form-control" placeholder="E.g., Commerce / Computer Applications" value="{{ $education->subject }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Score / GPA</label>
                          <input type="text" name="education[{{ $index }}][gpa]" class="elite-form-control" placeholder="e.g., 9.2 GPA" value="{{ $education->gpa }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Location</label>
                          <input type="text" name="education[{{ $index }}][location]" class="elite-form-control" placeholder="City, State" value="{{ $education->location }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Year of Completion <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="education[{{ $index }}][year]" class="elite-form-control" placeholder="e.g., 2024" value="{{ $education->year }}">
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  {{-- Default empty structure for clone template fallback --}}
                  <div class="entry-card education-entry">
                    <div class="entry-card-header">
                      <div class="entry-title">
                        <span class="entry-num">1</span>
                        Education Details
                      </div>
                      <div>
                        <button type="button" class="btn-del">Delete</button>
                      </div>
                    </div>
                    <div class="row g-3">
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Degree <span style="color:var(--brand-burgundy)">*</span></label>
                        <div class="elite-select-wrap">
                          <select name="education[0][degree]" class="elite-form-select">
                            <option value="">Select Degree</option>
                            <option>Bachelor's</option>
                            <option>Master's</option>
                            <option>PhD</option>
                            <option>Diploma</option>
                            <option>10th / SSC</option>
                            <option>12th / HSC</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Institution Name <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="education[0][institution]" class="elite-form-control" placeholder="E.g., Chennai University">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Subject / Major <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="education[0][subject]" class="elite-form-control" placeholder="E.g., Commerce / Computer Applications">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Score / GPA</label>
                        <input type="text" name="education[0][gpa]" class="elite-form-control" placeholder="e.g., 9.2 GPA">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Location</label>
                        <input type="text" name="education[0][location]" class="elite-form-control" placeholder="City, State">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Year of Completion <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="education[0][year]" class="elite-form-control" placeholder="e.g., 2024">
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            {{-- TAB: WORK EXPERIENCE --}}
            <div class="elite-tab-panel" id="tab-experience">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div class="panel-heading" style="margin-bottom:0; flex:1;">Professional Experience</div>
                <button type="button" class="btn-add-section" id="addExperience">
                  <i class="fa-solid fa-plus"></i> Add Role
                </button>
              </div>

              <div id="experienceList">
                @if($user->experiences && $user->experiences->count() > 0)
                  @foreach($user->experiences as $index => $experience)
                    <div class="entry-card experience-entry">
                      <div class="entry-card-header">
                        <div class="entry-title">
                          <span class="entry-num">{{ $index + 1 }}</span>
                          Professional Experience
                        </div>
                        <div>
                          <button type="button" class="btn-del">Delete</button>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Job Title <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="experience[{{ $index }}][job_title]" class="elite-form-control" placeholder="E.g., Senior Systems Analyst" value="{{ $experience->job_title }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Company Name <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="experience[{{ $index }}][company]" class="elite-form-control" placeholder="Company Name" value="{{ $experience->company }}">
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Employment Type <span style="color:var(--brand-burgundy)">*</span></label>
                          <div class="elite-select-wrap">
                            <select name="experience[{{ $index }}][employment_type]" class="elite-form-select">
                              <option value="">Select Type</option>
                              <option value="full_time" {{ $experience->employment_type == 'full_time' ? 'selected' : '' }}>Full-time</option>
                              <option value="part_time" {{ $experience->employment_type == 'part_time' ? 'selected' : '' }}>Part-time</option>
                              <option value="contract" {{ $experience->employment_type == 'contract' ? 'selected' : '' }}>Contract</option>
                              <option value="internship" {{ $experience->employment_type == 'internship' ? 'selected' : '' }}>Internship</option>
                              <option value="freelance" {{ $experience->employment_type == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Location <span style="color:var(--brand-burgundy)">*</span></label>
                          <input type="text" name="experience[{{ $index }}][location]" class="elite-form-control" placeholder="City, State" value="{{ $experience->location }}">
                        </div>
                        <div class="col-12">
                          <div class="check-container">
                            <input type="checkbox" name="experience[{{ $index }}][currently_working]" id="currentRole{{ $index }}" class="elite-checkbox" {{ $experience->currently_working ? 'checked' : '' }}>
                            <label for="currentRole{{ $index }}" class="check-lbl">I am currently working in this role</label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">Start Date <span style="color:var(--brand-burgundy)">*</span></label>
                          <div class="date-row">
                            <div class="elite-select-wrap">
                              <select name="experience[{{ $index }}][start_month]" class="elite-form-select">
                                <option value="">Month</option>
                                @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                  <option value="{{ $m }}" {{ $experience->start_month == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="elite-select-wrap">
                              <select name="experience[{{ $index }}][start_year]" class="elite-form-select">
                                <option value="">Year</option>
                                @for($y = date('Y'); $y >= 1990; $y--)
                                  <option value="{{ $y }}" {{ $experience->start_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="elite-form-label">End Date <span style="color:var(--brand-burgundy)">*</span></label>
                          <div class="date-row">
                            <div class="elite-select-wrap">
                              <select name="experience[{{ $index }}][end_month]" class="elite-form-select">
                                <option value="">Month</option>
                                @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                  <option value="{{ $m }}" {{ $experience->end_month == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="elite-select-wrap">
                              <select name="experience[{{ $index }}][end_year]" class="elite-form-select">
                                <option value="">Year</option>
                                @for($y = date('Y'); $y >= 1990; $y--)
                                  <option value="{{ $y }}" {{ $experience->end_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  {{-- Default empty structure for clone template fallback --}}
                  <div class="entry-card experience-entry">
                    <div class="entry-card-header">
                      <div class="entry-title">
                        <span class="entry-num">1</span>
                        Professional Experience
                      </div>
                      <div>
                        <button type="button" class="btn-del">Delete</button>
                      </div>
                    </div>
                    <div class="row g-3">
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Job Title <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="experience[0][job_title]" class="elite-form-control" placeholder="E.g., Senior Systems Analyst">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Company Name <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="experience[0][company]" class="elite-form-control" placeholder="Company Name">
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Employment Type <span style="color:var(--brand-burgundy)">*</span></label>
                        <div class="elite-select-wrap">
                          <select name="experience[0][employment_type]" class="elite-form-select">
                            <option value="">Select Type</option>
                            <option value="full_time">Full-time</option>
                            <option value="part_time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                            <option value="freelance">Freelance</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Location <span style="color:var(--brand-burgundy)">*</span></label>
                        <input type="text" name="experience[0][location]" class="elite-form-control" placeholder="City, State">
                      </div>
                      <div class="col-12">
                        <div class="check-container">
                          <input type="checkbox" name="experience[0][currently_working]" id="currentRole" class="elite-checkbox">
                          <label for="currentRole" class="check-lbl">I am currently working in this role</label>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">Start Date <span style="color:var(--brand-burgundy)">*</span></label>
                        <div class="date-row">
                          <div class="elite-select-wrap">
                            <select name="experience[0][start_month]" class="elite-form-select">
                              <option value="">Month</option>
                              @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="elite-select-wrap">
                            <select name="experience[0][start_year]" class="elite-form-select">
                              <option value="">Year</option>
                              @for($y = date('Y'); $y >= 1990; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                              @endfor
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="elite-form-label">End Date <span style="color:var(--brand-burgundy)">*</span></label>
                        <div class="date-row">
                          <div class="elite-select-wrap">
                            <select name="experience[0][end_month]" class="elite-form-select">
                              <option value="">Month</option>
                              @foreach(['january','february','march','april','may','june','july','august','september','october','november','december'] as $m)
                                <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="elite-select-wrap">
                            <select name="experience[0][end_year]" class="elite-form-select">
                              <option value="">Year</option>
                              @for($y = date('Y'); $y >= 1990; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                              @endfor
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            {{-- TAB: SKILLS --}}
            <div class="elite-tab-panel" id="tab-skills">
              <div class="skills-box">
                <div class="panel-heading">Skills & Keywords</div>
                <div class="skills-input-group">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input type="text" id="skillSearch" class="skills-input-field" placeholder="Search and add suggested skills below…">
                  <button type="button" id="addCustomSkill" class="add-custom-skill-btn">
                    <i class="fa-solid fa-plus"></i> Add
                  </button>
                </div>

                <div class="skills-lbl-row">Suggested Skills</div>
                <div class="skills-flex-tags" id="suggestedSkills">
                  @php
                    $suggested = ['Product Strategy','User-Centered Thinking','Prioritization','Analytics','Data-Driven Decisions','Agile & Scrum','Market Research','Financial Acumen','Stakeholder Management','Project Management','Team Leadership','Communication','Problem Solving','Critical Thinking','Technical Writing'];
                  @endphp
                  @foreach($suggested as $skill)
                    <span class="chip-tag suggested" data-skill="{{ $skill }}">
                      <i class="fa-solid fa-sparkles" style="font-size:10px; color:var(--brand-burgundy)"></i>
                      {{ $skill }}
                    </span>
                  @endforeach
                </div>

                <div class="skills-lbl-row mt-4">Selected Skills</div>
                <div class="skills-flex-tags" id="selectedSkills">
                  @if($user->skills && $user->skills->count() > 0)
                    @foreach($user->skills as $skill)
                      <span class="chip-tag selected" data-skill="{{ $skill->skill_name }}">
                        {{ $skill->skill_name }}<span class="rm" title="Remove">✕</span>
                      </span>
                    @endforeach
                  @else
                    <span class="no-skills-lbl" id="noSkillsMsg">Click suggested skills above or type a custom one.</span>
                  @endif
                </div>
                <input type="hidden" name="skills" id="skillsInput" value="{{ $user->skills ? $user->skills->pluck('skill_name')->implode(',') : '' }}">
              </div>
            </div>

          </div>

          <div class="text-center mt-5">
            <button type="submit" class="elite-save-btn">
              <i class="fa-solid fa-circle-check"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
// ── Profile Picture Upload ────────────────────────────────────
document.getElementById('profilePicInput').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 2 * 1024 * 1024) {
      alert('File size must not exceed 2MB');
      this.value = '';
      return;
    }
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('profilePicPreview');
      const initials = document.getElementById('previewInitials');
      let img = document.getElementById('previewImg');
      if (!img) {
        img = document.createElement('img');
        img.id = 'previewImg';
        preview.appendChild(img);
      }
      img.src = e.target.result;
      if (initials) initials.style.display = 'none';

      const bannerAvatar = document.getElementById('bannerAvatar');
      let bannerImg = bannerAvatar.querySelector('img');
      if (!bannerImg) {
        bannerImg = document.createElement('img');
        bannerAvatar.querySelector('.elite-avatar-inner').insertBefore(bannerImg, bannerAvatar.querySelector('.elite-avatar-inner').firstChild);
      }
      bannerImg.src = e.target.result;
      const bannerText = bannerAvatar.querySelector('.elite-avatar-inner').childNodes[0];
      if (bannerText && bannerText.nodeType === 3) bannerText.textContent = '';

      const sidebarAvatar = document.getElementById('sidebarAvatar');
      let sidebarImg = sidebarAvatar.querySelector('img');
      if (!sidebarImg) {
        sidebarImg = document.createElement('img');
        sidebarAvatar.insertBefore(sidebarImg, sidebarAvatar.firstChild);
      }
      sidebarImg.src = e.target.result;
      const sidebarText = sidebarAvatar.childNodes[0];
      if (sidebarText && sidebarText.nodeType === 3) sidebarText.textContent = '';
    };
    reader.readAsDataURL(file);
  }
});

function removeProfilePicture() {
  if (confirm('Are you sure you want to remove your profile picture?')) {
    fetch('{{ route("profile.remove-picture") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => { if (data.success) location.reload(); });
  }
}

// ── Form Submission ───────────────────────────────────────────
const profileForm = document.getElementById('profileUpdateForm');
if (profileForm) {
  profileForm.addEventListener('submit', function(e) {
    const skillsArray = Array.from(selectedSkills);
    document.getElementById('skillsInput').value = skillsArray.join(',');
  });
}

function syncSkillsInput() {
  document.getElementById('skillsInput').value = Array.from(selectedSkills).join(',');
}

// ── Tabs ──────────────────────────────────────────────────────
document.querySelectorAll('.elite-tab-btn').forEach(tab => {
  tab.addEventListener('click', function () {
    document.querySelectorAll('.elite-tab-btn').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.elite-tab-panel').forEach(p => p.classList.remove('active'));
    this.classList.add('active');
    document.getElementById('tab-' + this.dataset.tab).classList.add('active');
  });
});

// ── Skills ────────────────────────────────────────────────────
const selectedSkills = new Set();

@if($user->skills && $user->skills->count() > 0)
  @foreach($user->skills as $skill)
    selectedSkills.add('{{ $skill->skill_name }}');
  @endforeach
@endif

document.querySelectorAll('#selectedSkills .chip-tag.selected .rm').forEach(rmBtn => {
  rmBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    const chip = this.closest('.chip-tag');
    const skill = chip.dataset.skill;
    selectedSkills.delete(skill);
    chip.remove();
    if (!selectedSkills.size) {
      const msg = document.createElement('span');
      msg.id = 'noSkillsMsg'; msg.className = 'no-skills-lbl';
      msg.textContent = 'Click suggested skills above or type a custom one.';
      document.getElementById('selectedSkills').appendChild(msg);
    }
    updateSkillCount();
  });
});

function attachSuggestedClick(tag) {
  tag.addEventListener('click', function () {
    const skill = this.dataset.skill;
    if (selectedSkills.has(skill)) return;
    selectedSkills.add(skill);
    document.getElementById('noSkillsMsg')?.remove();
    const el = document.createElement('span');
    el.className = 'chip-tag selected';
    el.dataset.skill = skill;
    el.innerHTML = `${skill}<span class="rm" title="Remove">✕</span>`;
    el.querySelector('.rm').addEventListener('click', e => {
      e.stopPropagation();
      selectedSkills.delete(skill);
      el.remove();
      if (!selectedSkills.size) {
        const msg = document.createElement('span');
        msg.id = 'noSkillsMsg'; msg.className = 'no-skills-lbl';
        msg.textContent = 'Click suggested skills above or type a custom one.';
        document.getElementById('selectedSkills').appendChild(msg);
      }
      updateSkillCount();
    });
    document.getElementById('selectedSkills').appendChild(el);
    updateSkillCount();
  });
}
document.querySelectorAll('.chip-tag.suggested').forEach(attachSuggestedClick);

document.getElementById('skillSearch').addEventListener('input', function () {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.chip-tag.suggested').forEach(tag => {
    tag.style.display = tag.dataset.skill.toLowerCase().includes(q) ? '' : 'none';
  });
});

document.getElementById('addCustomSkill').addEventListener('click', function() {
  const input = document.getElementById('skillSearch');
  const skillName = input.value.trim();
  if (!skillName) { alert('Please enter a skill name'); return; }
  if (selectedSkills.has(skillName)) { alert('This skill is already added'); return; }
  selectedSkills.add(skillName);
  document.getElementById('noSkillsMsg')?.remove();
  const el = document.createElement('span');
  el.className = 'chip-tag selected';
  el.dataset.skill = skillName;
  el.innerHTML = `${skillName}<span class="rm" title="Remove">✕</span>`;
  el.querySelector('.rm').addEventListener('click', e => {
    e.stopPropagation();
    selectedSkills.delete(skillName);
    el.remove();
    if (!selectedSkills.size) {
      const msg = document.createElement('span');
      msg.id = 'noSkillsMsg'; msg.className = 'no-skills-lbl';
      msg.textContent = 'Click suggested skills above or type a custom one.';
      document.getElementById('selectedSkills').appendChild(msg);
    }
    updateSkillCount();
  });
  document.getElementById('selectedSkills').appendChild(el);
  updateSkillCount();
  input.value = '';
  document.querySelectorAll('.chip-tag.suggested').forEach(tag => { tag.style.display = ''; });
});

document.getElementById('skillSearch').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') { e.preventDefault(); document.getElementById('addCustomSkill').click(); }
});

function updateSkillCount() {
  const count = selectedSkills.size;
  document.getElementById('skillCount').textContent = count;
  document.getElementById('sidebarSkillsCount').textContent = count;
  syncSkillsInput();
}

// ── Education: add/delete ─────────────────────────────────────
let eduCount = {{ $user->educations && $user->educations->count() > 0 ? $user->educations->count() : 1 }};
document.getElementById('addEducation').addEventListener('click', function (e) {
  e.preventDefault();
  eduCount++;
  const entry = document.querySelector('.education-entry').cloneNode(true);
  entry.querySelectorAll('input, select').forEach(el => {
    el.value = '';
    if (el.name) el.name = el.name.replace(/\[\d+\]/, '[' + (eduCount - 1) + ']');
  });
  entry.querySelector('.entry-num').textContent = eduCount;
  entry.querySelector('.btn-del').addEventListener('click', function(e) {
    e.preventDefault();
    if (document.querySelectorAll('.education-entry').length > 1) entry.remove();
  });
  document.getElementById('educationList').appendChild(entry);
});
document.querySelectorAll('#educationList .btn-del').forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    if (document.querySelectorAll('.education-entry').length > 1) this.closest('.education-entry').remove();
  });
});

// ── Experience: add/delete ────────────────────────────────────
let expCount = {{ $user->experiences && $user->experiences->count() > 0 ? $user->experiences->count() : 1 }};
document.getElementById('addExperience').addEventListener('click', function (e) {
  e.preventDefault();
  expCount++;
  const entry = document.querySelector('.experience-entry').cloneNode(true);
  entry.querySelectorAll('input, select').forEach(el => {
    el.value = '';
    if (el.type === 'checkbox') el.checked = false;
    if (el.name) el.name = el.name.replace(/\[\d+\]/, '[' + (expCount - 1) + ']');
  });
  entry.querySelector('.entry-num').textContent = expCount;
  entry.querySelector('.btn-del').addEventListener('click', function(e) {
    e.preventDefault();
    if (document.querySelectorAll('.experience-entry').length > 1) entry.remove();
  });
  document.getElementById('experienceList').appendChild(entry);
});
document.querySelectorAll('#experienceList .btn-del').forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    if (document.querySelectorAll('.experience-entry').length > 1) this.closest('.experience-entry').remove();
  });
});
</script>

@endsection