@extends('layouts.site')

@section('content')


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root {
  --primary: #b11e24;
  --primary-dark: #8c1418;
  --primary-light: #ff4f56;
  --secondary: #1a1a1a;
  --gray-50: #f9fafb;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-400: #9ca3af;
  --gray-500: #6b7280;
  --gray-600: #4b5563;
  --gray-700: #374151;
  --gray-800: #1f2937;
  --gray-900: #111827;
  --success: #10b981;
  --warning: #f59e0b;
  --danger: #ef4444;
  --info: #3b82f6;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'Inter', sans-serif; }

.settings-wrapper {
  min-height: 100vh;
  background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
  padding: 140px 0 80px;
  position: relative;
}

@media (max-width: 991px) {
  .settings-wrapper { padding: 100px 0 60px; }
}

@media (max-width: 767px) {
  .settings-wrapper { padding: 90px 0 50px; }
}

@media (max-width: 575px) {
  .settings-wrapper { padding: 80px 0 40px; }
}

.settings-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

@media (max-width: 575px) {
  .settings-container { padding: 0 14px; }
}

.settings-header {
  margin-bottom: 32px;
}

@media (max-width: 767px) {
  .settings-header { margin-bottom: 24px; }
}

@media (max-width: 575px) {
  .settings-header { margin-bottom: 20px; }
}

.settings-title {
  font-size: 32px;
  font-weight: 800;
  color: var(--gray-900);
  margin-bottom: 8px;
  letter-spacing: -0.5px;
}

.settings-subtitle {
  font-size: 15px;
  color: var(--gray-500);
  font-weight: 500;
}

@media (max-width: 767px) {
  .settings-title { font-size: 24px; }
  .settings-subtitle { font-size: 14px; }
}

@media (max-width: 575px) {
  .settings-title { font-size: 22px; margin-bottom: 6px; }
  .settings-subtitle { font-size: 13px; }
}

.settings-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 24px;
  align-items: start;
}

@media (max-width: 991px) {
  .settings-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
}

/* Sidebar */
.settings-sidebar {
  background: #fff;
  border-radius: 16px;
  padding: 8px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  border: 1px solid var(--gray-200);
  position: sticky;
  top: 100px;
}

/* Mobile sidebar: wrapping tabs */
@media (max-width: 991px) {
  .settings-sidebar {
    position: static;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 8px;
    padding: 10px;
    border-radius: 12px;
  }
  .settings-nav-item {
    flex-shrink: 0;
    flex-direction: row;
    gap: 8px;
    padding: 10px 16px;
    font-size: 13px;
    border-radius: 10px;
    text-align: left;
    min-width: auto;
    width: auto;
    white-space: nowrap;
  }
  .settings-nav-icon {
    width: 18px;
    height: 18px;
    font-size: 16px;
    margin: 0;
  }
  .settings-nav-item span { display: inline; }
}

@media (max-width: 575px) {
  .settings-nav-item {
    padding: 8px 12px;
    font-size: 12px;
    gap: 6px;
  }
  .settings-nav-icon {
    width: 15px;
    height: 15px;
    font-size: 13px;
  }
}

.settings-nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  color: var(--gray-600);
  text-decoration: none;
  transition: all 0.2s;
  cursor: pointer;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
}

.settings-nav-item:hover {
  background: var(--gray-50);
  color: var(--gray-900);
}

.settings-nav-item.active {
  background: linear-gradient(135deg, var(--primary), var(--primary-light));
  color: #fff;
  box-shadow: 0 4px 12px rgba(177, 30, 36, 0.3);
}

.settings-nav-icon {
  width: 20px;
  height: 20px;
  flex-shrink: 0;
}

/* Content */
.settings-content {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  border: 1px solid var(--gray-200);
  overflow: hidden;
}

.settings-section {
  display: none;
  padding: 32px;
}

.settings-section.active {
  display: block;
}

@media (max-width: 575px) {
  .settings-section { padding: 20px 16px; }
  .section-title { font-size: 18px; margin-bottom: 6px; }
  .section-description { font-size: 13px; margin-bottom: 20px; }
  .settings-divider { margin: 20px 0; }
}

.section-title {
  font-size: 20px;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 8px;
}

.section-description {
  font-size: 14px;
  color: var(--gray-500);
  margin-bottom: 28px;
}

.settings-divider {
  height: 1px;
  background: var(--gray-200);
  margin: 28px 0;
}

/* Form Elements */
.form-group {
  margin-bottom: 24px;
}

@media (max-width: 575px) {
  .form-group:last-child {
    margin-bottom: 20px;
  }
}

.form-label {
  display: block;
  font-size: 13px;
  font-weight: 600;
  color: var(--gray-700);
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

@media (max-width: 575px) {
  .form-label {
    font-size: 12px;
    margin-bottom: 7px;
  }
}

.form-input {
  width: 100%;
  padding: 12px 16px;
  border: 1.5px solid var(--gray-300);
  border-radius: 10px;
  font-size: 14px;
  color: var(--gray-900);
  transition: all 0.2s;
  font-family: 'Inter', sans-serif;
}

@media (max-width: 575px) {
  .form-input {
    padding: 11px 14px;
    font-size: 14px;
  }
  textarea.form-input {
    min-height: 100px;
  }
}

.form-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(177, 30, 36, 0.1);
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%234b5563' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 40px;
}

/* File Input */
input[type="file"].form-input {
  padding: 10px 14px;
  cursor: pointer;
  font-size: 13px;
}

input[type="file"].form-input::file-selector-button {
  padding: 8px 16px;
  margin-right: 12px;
  border: none;
  background: var(--gray-100);
  color: var(--gray-700);
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  font-size: 13px;
  transition: all 0.2s;
}

input[type="file"].form-input::file-selector-button:hover {
  background: var(--gray-200);
}

@media (max-width: 575px) {
  input[type="file"].form-input {
    padding: 9px 12px;
    font-size: 12px;
  }
  input[type="file"].form-input::file-selector-button {
    padding: 7px 14px;
    margin-right: 10px;
    font-size: 12px;
  }
}

/* Toggle Switch */
.toggle-group {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  background: var(--gray-50);
  border-radius: 12px;
  margin-bottom: 12px;
  border: 1px solid var(--gray-200);
  gap: 12px;
}

@media (max-width: 575px) {
  .toggle-group { padding: 14px; gap: 12px; }
  .toggle-info h4 { font-size: 13px; margin-bottom: 3px; }
  .toggle-info p { font-size: 12px; line-height: 1.4; }
  .toggle-switch { width: 44px; height: 24px; }
  .toggle-slider:before { height: 18px; width: 18px; }
  .toggle-switch input:checked + .toggle-slider:before { transform: translateX(20px); }
}

.toggle-info h4 {
  font-size: 14px;
  font-weight: 600;
  color: var(--gray-900);
  margin-bottom: 4px;
}

.toggle-info p {
  font-size: 13px;
  color: var(--gray-500);
}

.toggle-switch {
  position: relative;
  width: 48px;
  height: 26px;
  flex-shrink: 0;
}

.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle-slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: var(--gray-300);
  border-radius: 34px;
  transition: 0.3s;
}

.toggle-slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 3px;
  bottom: 3px;
  background: white;
  border-radius: 50%;
  transition: 0.3s;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.toggle-switch input:checked + .toggle-slider {
  background: var(--primary);
}

.toggle-switch input:checked + .toggle-slider:before {
  transform: translateX(22px);
}

/* Buttons */
.btn {
  padding: 12px 24px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
  border: none;
  font-family: 'Inter', sans-serif;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  position: relative;
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn.loading {
  pointer-events: none;
}

.btn.loading::after {
  content: '';
  position: absolute;
  width: 16px;
  height: 16px;
  top: 50%;
  right: 12px;
  margin-top: -8px;
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
  to { transform: rotate(360deg); }
}

@media (max-width: 575px) {
  .btn { 
    width: 100%; 
    justify-content: center; 
    padding: 12px 20px; 
    font-size: 14px;
    margin-top: 4px;
  }
  .btn + .btn { margin-top: 10px; margin-left: 0; }
  .action-card .btn { margin-top: 0; }
  .btn.loading::after {
    right: 50%;
    margin-right: -40px;
  }
}

.btn-primary {
  background: linear-gradient(135deg, var(--primary), var(--primary-light));
  color: #fff;
  box-shadow: 0 4px 12px rgba(177, 30, 36, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(177, 30, 36, 0.4);
}

.btn-secondary {
  background: var(--gray-100);
  color: var(--gray-700);
}

.btn-secondary:hover {
  background: var(--gray-200);
}

.btn-danger {
  background: var(--danger);
  color: #fff;
}

.btn-danger:hover {
  background: #dc2626;
}

/* Stats Cards */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-bottom: 28px;
}

@media (max-width: 575px) {
  .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
  .stat-card { padding: 16px 12px; }
  .stat-value { font-size: 20px; margin-bottom: 6px; }
  .stat-label { font-size: 11px; }
}

.stat-card {
  background: linear-gradient(135deg, var(--gray-50) 0%, #fff 100%);
  border: 1px solid var(--gray-200);
  border-radius: 12px;
  padding: 20px;
  text-align: center;
}

.stat-value {
  font-size: 28px;
  font-weight: 800;
  color: var(--primary);
  margin-bottom: 4px;
}

.stat-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--gray-500);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Alert */
.alert {
  padding: 14px 18px;
  border-radius: 10px;
  font-size: 14px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

@media (max-width: 575px) {
  .alert {
    padding: 12px 14px;
    font-size: 13px;
    margin-bottom: 16px;
    gap: 8px;
  }
}

.alert-success {
  background: #d1fae5;
  color: #065f46;
  border: 1px solid #6ee7b7;
}

.alert-danger {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fca5a5;
}

/* Action Cards */
.action-card {
  background: var(--gray-50);
  border: 1px solid var(--gray-200);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 16px;
}

.action-card h4 {
  font-size: 15px;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 6px;
}

.action-card p {
  font-size: 13px;
  color: var(--gray-500);
  margin-bottom: 14px;
}

.action-card-buttons {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

@media (max-width: 575px) {
  .action-card { padding: 16px; margin-bottom: 14px; }
  .action-card h4 { font-size: 14px; margin-bottom: 5px; }
  .action-card p { font-size: 12px; margin-bottom: 12px; line-height: 1.5; }
  .action-card-buttons {
    flex-direction: column;
    gap: 8px;
  }
  .action-card-buttons .btn {
    width: 100%;
    margin-top: 0;
  }
}

.row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

@media (max-width: 767px) {
  .row { 
    grid-template-columns: 1fr; 
    gap: 16px; 
  }
}

@media (max-width: 575px) {
  .row { gap: 0; }
  .form-group { margin-bottom: 18px; }
}
</style>

<div class="settings-wrapper">
  <div class="settings-container">
    
    <div class="settings-header">
      <h1 class="settings-title">Settings</h1>
      <p class="settings-subtitle">Manage your account settings and preferences</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <i class="fa-solid fa-circle-exclamation"></i>
        {{ $errors->first() }}
      </div>
    @endif

    <div class="settings-grid">
      
      <!-- Sidebar -->
      <div class="settings-sidebar">
        <button class="settings-nav-item active" data-section="account">
          <i class="fa-solid fa-user settings-nav-icon"></i>
          <span>Account</span>
        </button>
        <button class="settings-nav-item" data-section="profile">
          <i class="fa-solid fa-id-card settings-nav-icon"></i>
          <span>Profile</span>
        </button>
        
        <!--<button class="settings-nav-item" data-section="job-preferences">-->
        <!--  <i class="fa-solid fa-briefcase settings-nav-icon"></i>-->
        <!--  <span>Job Preferences</span>-->
        <!--</button>-->
        <button class="settings-nav-item" data-section="security">
          <i class="fa-solid fa-lock settings-nav-icon"></i>
          <span>Security</span>
        </button>
        <button class="settings-nav-item" data-section="resume">
          <i class="fa-solid fa-file-pdf settings-nav-icon"></i>
          <span>Resume</span>
        </button>
        <button class="settings-nav-item" data-section="data">
          <i class="fa-solid fa-database settings-nav-icon"></i>
          <span>Data & Storage</span>
        </button>
      </div>

      <!-- Content -->
      <div class="settings-content">
        
        <!-- Account Section -->
        <div class="settings-section active" id="account">
          <h2 class="section-title">Account Settings</h2>
          <p class="section-description">Manage your account information and password</p>

          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-value">{{ $user->profile_completion ?? 0 }}%</div>
              <div class="stat-label">Profile Complete</div>
            </div>
            <div class="stat-card">
              <div class="stat-value">{{ $user->created_at->diffForHumans() }}</div>
              <div class="stat-label">Member Since</div>
            </div>
          </div>

          <div class="settings-divider"></div>

          <form action="{{ route('settings.account') }}" method="POST">
            @csrf
            <div class="row">
              <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-input" value="{{ $user->email }}" disabled>
              </div>
              <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-input" value="{{ $user->phone ?? '' }}" placeholder="Enter phone number">
              </div>
            </div>

            <h3 style="font-size: 16px; font-weight: 700; color: var(--gray-900); margin: 28px 0 20px;">Change Password</h3>

            <div class="form-group">
              <label class="form-label">Current Password</label>
              <input type="password" name="current_password" class="form-input" placeholder="Enter current password">
            </div>

            <div class="row">
              <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-input" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-input" placeholder="Confirm new password">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk"></i>
              Update Account
            </button>
          </form>
        </div>

        <!-- Profile Section -->
        <div class="settings-section" id="profile">
          <h2 class="section-title">Profile Information</h2>
          <p class="section-description">Update your personal information and profile details</p>

          <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
              <div class="form-group">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-input" value="{{ $user->first_name ?? '' }}" placeholder="Enter first name">
              </div>
              <div class="form-group">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-input" value="{{ $user->last_name ?? '' }}" placeholder="Enter last name">
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-input" value="{{ $user->location ?? '' }}" placeholder="City, State">
              </div>
              <div class="form-group">
                <label class="form-label">Current Job Title</label>
                <input type="text" name="job_title" class="form-input" value="{{ $user->job_title ?? '' }}" placeholder="e.g., Software Engineer">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Bio / About Me</label>
              <textarea name="bio" class="form-input" rows="4" placeholder="Tell us about yourself...">{{ $user->bio ?? '' }}</textarea>
            </div>

            <div class="row">
              <div class="form-group">
                <label class="form-label">LinkedIn Profile</label>
                <input type="url" name="linkedin_url" class="form-input" value="{{ $user->linkedin_url ?? '' }}" placeholder="https://linkedin.com/in/yourprofile">
              </div>
              <div class="form-group">
                <label class="form-label">Portfolio Website</label>
                <input type="url" name="portfolio_url" class="form-input" value="{{ $user->portfolio_url ?? '' }}" placeholder="https://yourportfolio.com">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk"></i>
              Save Profile
            </button>
          </form>
        </div>

        <!-- Notifications Section -->
        <div class="settings-section" id="notifications">
          <h2 class="section-title">Notification Preferences</h2>
          <p class="section-description">Manage how you receive notifications and updates</p>

          <form action="{{ route('settings.notifications') }}" method="POST">
            @csrf
            
            <h3 style="font-size: 16px; font-weight: 700; color: var(--gray-900); margin-bottom: 16px;">Email Notifications</h3>
            
            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Job Alerts</h4>
                <p>Receive email notifications for new job postings matching your preferences</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="job_alerts" {{ ($settings['notifications']['job_alerts'] ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Application Updates</h4>
                <p>Get notified when your job applications are viewed or updated</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="application_updates" {{ ($settings['notifications']['application_updates'] ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Profile Views</h4>
                <p>Receive notifications when employers view your profile</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="profile_views" {{ ($settings['notifications']['profile_views'] ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Marketing Emails</h4>
                <p>Receive promotional emails, tips, and career advice</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="marketing_emails" {{ ($settings['notifications']['marketing_emails'] ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="settings-divider"></div>

            <h3 style="font-size: 16px; font-weight: 700; color: var(--gray-900); margin-bottom: 16px;">Push Notifications</h3>

            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Browser Notifications</h4>
                <p>Receive instant notifications in your browser</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="browser_notifications" {{ ($settings['notifications']['browser_notifications'] ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk"></i>
              Save Notification Settings
            </button>
          </form>
        </div>

        <!-- Job Preferences Section -->
        <div class="settings-section" id="job-preferences">
          <h2 class="section-title">Job Preferences</h2>
          <p class="section-description">Set your job search preferences to receive matching job alerts</p>

          <form action="{{ route('settings.job-preferences') }}" method="POST">
            @csrf

            <div class="form-group">
              <label class="form-label">Preferred Job Functions / Roles</label>
              <p style="font-size:13px;color:var(--gray-500);margin-bottom:12px;">Select the roles you are interested in — you will only receive job alerts for these functions.</p>
              <div style="display:flex;flex-wrap:wrap;gap:10px;">
                @foreach($jobFunctions as $fn)
                  @php $checked = in_array($fn, $notifPrefs->preferred_job_functions ?? []); @endphp
                  <label style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border:1.5px solid {{ $checked ? 'var(--primary)' : 'var(--gray-300)' }};border-radius:999px;cursor:pointer;font-size:13px;font-weight:600;color:{{ $checked ? 'var(--primary)' : 'var(--gray-600)' }};background:{{ $checked ? '#fff0ee' : 'var(--gray-50)' }};transition:all .2s;" class="fn-chip">
                    <input type="checkbox" name="preferred_job_functions[]" value="{{ $fn }}" {{ $checked ? 'checked' : '' }} style="display:none;">
                    {{ $fn }}
                  </label>
                @endforeach
              </div>
            </div>

            <div class="settings-divider"></div>
            
            <div class="row">
              <div class="form-group">
                <label class="form-label">Preferred Job Type</label>
                <select name="preferred_job_type" class="form-input form-select">
                  <option value="Full-Time" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                  <option value="Part-Time" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                  <option value="Contract" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                  <option value="Internship" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                  <option value="Freelance" {{ ($settings['job']['preferred_job_type'] ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label">Job Status</label>
                <select name="preferred_job_status" class="form-input form-select">
                  <option value="All Jobs" {{ ($settings['job']['preferred_job_status'] ?? '') == 'All Jobs' ? 'selected' : '' }}>All Jobs</option>
                  <option value="Active" {{ ($settings['job']['preferred_job_status'] ?? '') == 'Active' ? 'selected' : '' }}>Active Only</option>
                  <option value="Featured" {{ ($settings['job']['preferred_job_status'] ?? '') == 'Featured' ? 'selected' : '' }}>Featured Only</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group">
                <label class="form-label">Preferred Location</label>
                <input type="text" name="preferred_location" class="form-input" placeholder="e.g., Bangalore, Mumbai" value="{{ $settings['job']['preferred_location'] ?? '' }}">
              </div>

              <div class="form-group">
                <label class="form-label">Job Posted Timeframe</label>
                <select name="job_posted_timeframe" class="form-input form-select">
                  <option value="Last 24 Hours" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 24 Hours' ? 'selected' : '' }}>Last 24 Hours</option>
                  <option value="Last 7 Days" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 7 Days' ? 'selected' : '' }}>Last 7 Days</option>
                  <option value="Last 30 Days" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'Last 30 Days' ? 'selected' : '' }}>Last 30 Days</option>
                  <option value="All Time" {{ ($settings['job']['job_posted_timeframe'] ?? '') == 'All Time' ? 'selected' : '' }}>All Time</option>
                </select>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk"></i>
              Save Job Preferences
            </button>
          </form>
        </div>

        <!-- Security Section -->
        <div class="settings-section" id="security">
          <h2 class="section-title">Security Settings</h2>
          <p class="section-description">Manage your account security and login sessions</p>

          <div class="action-card">
            <h4>Two-Factor Authentication (2FA)</h4>
            <p>Add an extra layer of security to your account</p>
            <button type="button" class="btn btn-secondary" onclick="enable2FA()">
              <i class="fa-solid fa-shield-halved"></i>
              Enable 2FA
            </button>
          </div>

          <div class="action-card">
            <h4>Active Sessions</h4>
            <p>Manage devices and locations where you're currently logged in</p>
            <button type="button" class="btn btn-secondary" onclick="viewSessions()">
              <i class="fa-solid fa-desktop"></i>
              View Active Sessions
            </button>
          </div>

          <div class="action-card">
            <h4>Login History</h4>
            <p>View your recent login activity and locations</p>
            <button type="button" class="btn btn-secondary" onclick="viewLoginHistory()">
              <i class="fa-solid fa-clock-rotate-left"></i>
              View Login History
            </button>
          </div>

          <div class="settings-divider"></div>

          <h3 style="font-size: 16px; font-weight: 700; color: var(--gray-900); margin-bottom: 16px;">Security Preferences</h3>

          <form action="{{ route('settings.security') }}" method="POST">
            @csrf
            
            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Login Alerts</h4>
                <p>Get notified when someone logs into your account</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="login_alerts" {{ ($settings['security']['login_alerts'] ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-group">
              <div class="toggle-info">
                <h4>Suspicious Activity Alerts</h4>
                <p>Receive alerts for unusual account activity</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="suspicious_alerts" {{ ($settings['security']['suspicious_alerts'] ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk"></i>
              Save Security Settings
            </button>
          </form>
        </div>

        <!-- Resume Section -->
        <div class="settings-section" id="resume">
          <h2 class="section-title">Resume Management</h2>
          <p class="section-description">Upload and manage your resume</p>

          @if($user->resume)
            <div class="action-card" style="background: #d1fae5; border-color: #6ee7b7;">
              <h4 style="color: #065f46;">Current Resume</h4>
              <p style="color: #047857; margin-bottom: 12px;">{{ $user->resume }}</p>
              <div class="action-card-buttons">
                <a href="{{ asset('resume/' . $user->resume) }}" target="_blank" class="btn btn-secondary">
                  <i class="fa-solid fa-eye"></i>
                  View Resume
                </a>
                <a href="{{ asset('resume/' . $user->resume) }}" download class="btn btn-secondary">
                  <i class="fa-solid fa-download"></i>
                  Download
                </a>
                <button type="button" class="btn btn-danger" onclick="deleteResume()">
                  <i class="fa-solid fa-trash"></i>
                  Delete
                </button>
              </div>
            </div>
          @endif

          <div class="action-card">
            <h4>Upload New Resume</h4>
            <p>Upload your resume in PDF, DOC, or DOCX format (Max 5MB)</p>
            <form action="{{ route('settings.uploadResume') }}" method="POST" enctype="multipart/form-data" id="resumeForm">
              @csrf
              <div class="form-group">
                <input type="file" name="resume" class="form-input" accept=".pdf,.doc,.docx" required>
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i>
                Upload Resume
              </button>
            </form>
          </div>
        </div>

        <!-- Data & Storage Section -->
        <div class="settings-section" id="data">
          <h2 class="section-title">Data & Storage</h2>
          <p class="section-description">Manage your data and clear cache</p>

          <div class="action-card">
            <h4>Clear Cache</h4>
            <p>Clear cached data to improve performance and free up space</p>
            <button type="button" class="btn btn-secondary" onclick="clearCache()">
              <i class="fa-solid fa-broom"></i>
              Clear Cache
            </button>
          </div>

          <div class="action-card">
            <h4>Delete Browsing History</h4>
            <p>Remove your job search and browsing history</p>
            <button type="button" class="btn btn-secondary" onclick="deleteBrowsingHistory()">
              <i class="fa-solid fa-clock-rotate-left"></i>
              Delete History
            </button>
          </div>

          <div class="action-card">
            <h4>Download Your Data</h4>
            <p>Download a copy of your profile data, applications, and activity</p>
            <a href="{{ route('settings.downloadData') }}" class="btn btn-secondary">
              <i class="fa-solid fa-download"></i>
              Download Data
            </a>
          </div>

          <div class="settings-divider"></div>

          <div class="action-card" style="border: 1.5px solid var(--danger); background: #fef2f2;">
            <h4 style="color: var(--danger);">Delete Account</h4>
            <p style="color: #991b1b;">Permanently delete your account and all associated data. This action cannot be undone.</p>
            <button type="button" class="btn btn-danger" onclick="confirmDeleteAccount()">
              <i class="fa-solid fa-trash"></i>
              Delete Account
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
// Tab Navigation
document.querySelectorAll('.settings-nav-item').forEach(item => {
  item.addEventListener('click', function() {
    const section = this.dataset.section;
    
    // Update active nav
    document.querySelectorAll('.settings-nav-item').forEach(nav => nav.classList.remove('active'));
    this.classList.add('active');
    
    // Update active section
    document.querySelectorAll('.settings-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(section).classList.add('active');
    
    // Scroll to top of content on mobile
    if (window.innerWidth <= 991) {
      document.querySelector('.settings-content').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Scroll active tab into view in sidebar
    this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
  });
});

// Prevent form submission on enter key in text inputs (except textarea)
document.querySelectorAll('.form-input:not(textarea)').forEach(input => {
  input.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
    }
  });
});

// Auto-resize textareas
document.querySelectorAll('textarea.form-input').forEach(textarea => {
  textarea.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
  });
});

// Form submission loading state
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn && !submitBtn.classList.contains('loading')) {
      submitBtn.classList.add('loading');
      submitBtn.disabled = true;
    }
  });
});

// Resume form with file validation
const resumeForm = document.getElementById('resumeForm');
if (resumeForm) {
  resumeForm.addEventListener('submit', function(e) {
    const fileInput = this.querySelector('input[type="file"]');
    if (fileInput && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const maxSize = 5 * 1024 * 1024; // 5MB
      const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
      
      if (file.size > maxSize) {
        e.preventDefault();
        alert('File size must be less than 5MB');
        return false;
      }
      
      if (!allowedTypes.includes(file.type)) {
        e.preventDefault();
        alert('Only PDF, DOC, and DOCX files are allowed');
        return false;
      }
    }
  });
}

// Clear Cache
function clearCache() {
  if (confirm('Are you sure you want to clear the cache?')) {
    fetch('{{ route("settings.clearCache") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Cache cleared successfully!');
      }
    });
  }
}

// Delete Browsing History
function deleteBrowsingHistory() {
  if (confirm('Are you sure you want to delete your browsing history?')) {
    fetch('{{ route("settings.deleteBrowsingHistory") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Browsing history deleted successfully!');
      }
    });
  }
}

// Delete Account
function confirmDeleteAccount() {
  const password = prompt('⚠️ WARNING: This will permanently delete your account and all data.\n\nPlease enter your password to confirm:');
  
  if (password) {
    const confirmation = prompt('Type "DELETE" to confirm account deletion:');
    
    if (confirmation === 'DELETE') {
      fetch('{{ route("settings.deleteAccount") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          password: password,
          confirmation: confirmation
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Account deleted successfully. You will be redirected to the homepage.');
          window.location.href = data.redirect;
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        alert('An error occurred. Please try again.');
      });
    } else {
      alert('Account deletion cancelled. Confirmation text did not match.');
    }
  }
}

// Delete Resume
function deleteResume() {
  if (confirm('Are you sure you want to delete your resume?')) {
    fetch('{{ route("settings.deleteResume") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Resume deleted successfully!');
        location.reload();
      } else {
        alert('Error: ' + data.message);
      }
    });
  }
}

// Enable 2FA
function enable2FA() {
  alert('Two-Factor Authentication setup will be available soon. This feature adds an extra layer of security to your account.');
}

// View Sessions
function viewSessions() {
  alert('Active sessions feature coming soon. You will be able to see all devices where you are logged in.');
}

// View Login History
function viewLoginHistory() {
  alert('Login history feature coming soon. You will be able to see your recent login activity.');
}
// Job Function chip toggle
document.querySelectorAll('.fn-chip').forEach(label => {
  label.addEventListener('click', function() {
    const cb = this.querySelector('input[type="checkbox"]');
    cb.checked = !cb.checked;
    if (cb.checked) {
      this.style.borderColor = 'var(--primary)';
      this.style.color = 'var(--primary)';
      this.style.background = '#fff0ee';
    } else {
      this.style.borderColor = 'var(--gray-300)';
      this.style.color = 'var(--gray-600)';
      this.style.background = 'var(--gray-50)';
    }
  });
});
</script>

@endsection
