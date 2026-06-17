@extends('layouts.site')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
  --cr-3d-primary: #b11e24;
  --cr-3d-primary-dark: #8c1418;
  --cr-3d-navy: #071056;
  --cr-3d-navy-light: #131d6d;
  --cr-3d-text: #1e293b;
  --cr-3d-muted: #64748b;
  --cr-3d-border: rgba(226, 232, 240, 0.8);
  --cr-3d-bg: #f8fafc;
  --cr-3d-white: #ffffff;
  --cr-3d-radius: 24px;
  --cr-3d-font: 'Plus Jakarta Sans', sans-serif;
  --cr-3d-shadow-main: 0 30px 60px rgba(15, 23, 42, 0.08), 0 15px 30px rgba(15, 23, 42, 0.04);
  --cr-3d-shadow-hover: 0 45px 80px rgba(15, 23, 42, 0.12), 0 20px 40px rgba(15, 23, 42, 0.06);
}

/* ── 3D HERO ──────────────────────────────── */
.cr-hero-3d {
  position: relative;
  padding: 110px 24px 70px;
  background: url('{{ asset('company.webp') }}') no-repeat center center;
  background-size: cover;
  overflow: hidden;
  z-index: 1;
}
.cr-hero-3d__bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(7, 16, 86, 0.9) 0%, rgba(9, 14, 36, 0.7) 100%);
  z-index: -2;
}
.cr-hero-3d__shapes .shape {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  z-index: -1;
  pointer-events: none;
}
.cr-hero-3d__shapes .shape-1 {
  top: -10%;
  right: 15%;
  width: 300px;
  height: 300px;
  background: rgba(177, 30, 36, 0.12);
}
.cr-hero-3d__shapes .shape-2 {
  bottom: -15%;
  left: 20%;
  width: 400px;
  height: 400px;
  background: rgba(7, 16, 86, 0.4);
}
.cr-hero-3d__inner {
  position: relative;
  max-width: 1280px;
  margin: 0 auto;
}
.cr-breadcrumb-3d {
  font-family: var(--cr-3d-font);
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.cr-breadcrumb-3d a {
  color: rgba(255, 255, 255, 0.5);
  text-decoration: none;
  transition: color 0.3s;
}
.cr-breadcrumb-3d a:hover {
  color: #fff;
}
.cr-breadcrumb-3d .sep {
  color: rgba(255, 255, 255, 0.2);
}
.cr-breadcrumb-3d .active {
  color: rgba(255, 255, 255, 0.8);
}
.cr-hero-3d__title {
  font-family: var(--cr-3d-font);
  font-size: clamp(32px, 5vw, 48px);
  font-weight: 800;
  color: #fff;
  margin: 0 0 15px;
  letter-spacing: -1px;
}
.cr-hero-3d__sub {
  font-family: var(--cr-3d-font);
  font-size: 16px;
  color: #94a3b8;
  margin: 0;
  max-width: 650px;
  line-height: 1.6;
}

/* ── MAIN LAYOUT ───────────────────────── */
.cr-main-3d {
  background: var(--cr-3d-bg);
  padding: 60px 0 90px;
}
.cr-wrap-3d {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}
.cr-layout-3d {
  display: grid;
  grid-template-columns: 340px 1fr;
  gap: 40px;
  align-items: start;
}

/* ── 3D ASIDE CARD ─────────────────────── */
.cr-aside-3d {
  position: sticky;
  top: 100px;
}
.cr-aside-card-3d {
  background: linear-gradient(135deg, #090e24 0%, #071056 100%);
  border-radius: var(--cr-3d-radius);
  padding: 36px 28px;
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.05);
  box-shadow: var(--cr-3d-shadow-main);
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.cr-aside-card-3d:hover {
  transform: translateY(-5px);
  box-shadow: var(--cr-3d-shadow-hover);
}
.cr-aside-logo-3d {
  background: #fff;
  border-radius: 12px;
  padding: 10px 16px;
  display: inline-block;
  margin-bottom: 24px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.cr-aside-logo-3d img {
  height: 28px;
  display: block;
}
.cr-aside-card-3d h3 {
  font-family: var(--cr-3d-font);
  font-size: 20px;
  font-weight: 800;
  margin: 0 0 24px;
}

/* 3D Timeline Steps */
.cr-steps-3d {
  display: flex;
  flex-direction: column;
  gap: 24px;
  margin-bottom: 30px;
}
.cr-step-3d {
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.cr-step-3d__num-wrap {
  perspective: 400px;
}
.cr-step-3d__num {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #b11e24;
  color: #fff;
  font-family: var(--cr-3d-font);
  font-size: 14px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  transform: rotateY(20deg);
  box-shadow: 5px 5px 15px rgba(177, 30, 36, 0.3);
  flex-shrink: 0;
}
.cr-step-3d strong {
  display: block;
  font-family: var(--cr-3d-font);
  font-size: 15px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 4px;
}
.cr-step-3d p {
  font-family: var(--cr-3d-font);
  font-size: 13px;
  color: #94a3b8;
  margin: 0;
  line-height: 1.5;
}

/* 3D Badges */
.cr-badges-3d {
  display: flex;
  gap: 10px;
  margin-bottom: 24px;
  padding-top: 24px;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.badge-item-3d {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: var(--cr-3d-font);
  font-size: 12px;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.85);
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 8px 16px;
  border-radius: 10px;
  transition: all 0.3s;
}
.badge-item-3d i {
  color: var(--cr-3d-primary);
}
.badge-item-3d:hover {
  background: var(--cr-3d-primary);
  border-color: var(--cr-3d-primary);
  transform: translateY(-2px);
}

/* Contact Links */
.cr-contact-3d {
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding-top: 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.cr-contact-3d a {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: var(--cr-3d-font);
  font-size: 13.5px;
  color: #94a3b8;
  text-decoration: none !important;
  transition: color 0.3s;
}
.cr-contact-3d a:hover {
  color: #fff;
}
.cr-contact-3d a i {
  color: var(--cr-3d-primary);
}

/* ── 3D FORM CARD ──────────────────────── */
.cr-form-card-3d {
  background: var(--cr-3d-white);
  border: 1px solid var(--cr-3d-border);
  border-radius: var(--cr-3d-radius);
  padding: 44px;
  box-shadow: var(--cr-3d-shadow-main);
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.cr-form-card-3d:hover {
  box-shadow: var(--cr-3d-shadow-hover);
}
.cr-form-header-3d {
  margin-bottom: 32px;
}
.cr-form-header-3d h2 {
  font-family: var(--cr-3d-font);
  font-size: 26px;
  font-weight: 800;
  color: var(--cr-3d-navy);
  margin: 0 0 8px;
  letter-spacing: -0.5px;
}
.cr-form-header-3d p {
  font-family: var(--cr-3d-font);
  font-size: 14.5px;
  color: var(--cr-3d-muted);
  margin: 0;
}

/* 3D Alert */
.cr-alert-3d {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px 20px;
  border-radius: 14px;
  font-family: var(--cr-3d-font);
  font-size: 14.5px;
  font-weight: 600;
  margin-bottom: 30px;
  background: #ecfdf5;
  color: #047857;
  border: 1.5px solid #a7f3d0;
  box-shadow: 0 4px 12px rgba(4, 120, 87, 0.05);
}
.alert-icon-3d {
  font-size: 18px;
}

/* Section Labels */
.cr-section-label-3d {
  font-family: var(--cr-3d-font);
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  color: var(--cr-3d-navy);
  margin: 36px 0 18px;
  padding-bottom: 8px;
  border-bottom: 2px solid var(--cr-3d-border);
  position: relative;
}
.cr-section-label-3d::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 40px;
  height: 2px;
  background: var(--cr-3d-primary);
}
.cr-section-label-3d:first-of-type {
  margin-top: 0;
}
.cr-section-label-3d small {
  font-weight: 500;
  color: #94a3b8;
  letter-spacing: 0;
  text-transform: none;
  margin-left: 8px;
}

/* Grid System */
.cr-grid-3d {
  display: grid;
  gap: 18px;
}
.cr-grid-3d--2 {
  grid-template-columns: 1fr 1fr;
}
.cr-grid-3d--3 {
  grid-template-columns: 1fr 1fr 1fr;
}

/* Fields */
.cr-field-3d {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.cr-field-3d--full {
  margin-top: 18px;
}
.cr-field-3d label {
  font-family: var(--cr-3d-font);
  font-size: 13px;
  font-weight: 700;
  color: var(--cr-3d-text);
}
.cr-field-3d label span {
  color: var(--cr-3d-primary);
}
.cr-field-3d input,
.cr-field-3d textarea {
  width: 100%;
  padding: 13px 16px;
  border: 1.5px solid var(--cr-3d-border);
  border-radius: 12px;
  font-family: var(--cr-3d-font);
  font-size: 14.5px;
  color: var(--cr-3d-text);
  background: #f8fafc;
  outline: none;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
}
.cr-field-3d input::placeholder,
.cr-field-3d textarea::placeholder {
  color: #94a3b8;
}
.cr-field-3d input:focus,
.cr-field-3d textarea:focus {
  border-color: var(--cr-3d-primary);
  background: #fff;
  box-shadow: 0 10px 20px rgba(232, 73, 36, 0.06), 0 0 0 3px rgba(232, 73, 36, 0.08);
  transform: translateY(-2px);
}
.cr-field-3d textarea {
  resize: vertical;
  min-height: 110px;
}

/* 3D Upload Card Widgets */
.cr-upload-3d {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 22px 24px;
  border: 2px dashed rgba(226, 232, 240, 1);
  border-radius: 16px;
  background: #f8fafc;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: 0 4px 6px rgba(0,0,0,0.01);
}
.cr-upload-3d:hover {
  border-color: var(--cr-3d-primary);
  background: #fff8f6;
  transform: translateY(-4px);
  box-shadow: 0 15px 30px rgba(232, 73, 36, 0.08);
}
.cr-upload-3d:active {
  transform: translateY(-1px);
}
.cr-upload-3d.has-file {
  border-color: #10b981;
  background: #ecfdf5;
  border-style: solid;
  box-shadow: 0 10px 20px rgba(16, 185, 129, 0.05);
}
.cr-upload-3d__icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: #fff;
  border: 1.5px solid var(--cr-3d-border);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--cr-3d-muted);
  font-size: 18px;
  flex-shrink: 0;
  transition: all 0.3s;
}
.cr-upload-3d:hover .cr-upload-3d__icon {
  color: var(--cr-3d-primary);
  border-color: var(--cr-3d-primary);
}
.cr-upload-3d.has-file .cr-upload-3d__icon {
  color: #10b981;
  border-color: #10b981;
}
.cr-upload-3d__text {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.cr-upload-3d__text span {
  font-family: var(--cr-3d-font);
  font-size: 13.5px;
  font-weight: 700;
  color: var(--cr-3d-text);
}
.cr-upload-3d__text small {
  font-family: var(--cr-3d-font);
  font-size: 11px;
  color: var(--cr-3d-muted);
}
.cr-upload-3d.has-file .cr-upload-3d__text span {
  color: #065f46;
}

/* 3D Submit Button & Note */
.cr-submit-3d {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-top: 36px;
  padding-top: 28px;
  border-top: 1px solid var(--cr-3d-border);
  flex-wrap: wrap;
}
.cr-btn-3d {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 15px 36px;
  background: #b11e24;
  color: #fff;
  border: none;
  border-radius: 12px;
  font-family: var(--cr-3d-font);
  font-size: 15px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: 0 10px 20px rgba(177, 30, 36, 0.2);
}
.cr-btn-3d:hover {
  background: linear-gradient(135deg, #a31820 0%, #d63d1a 100%);
  transform: translateY(-3px);
  box-shadow: 0 15px 30px rgba(232, 73, 36, 0.3);
}
.cr-btn-3d:active {
  transform: translateY(-1px);
}
.cr-submit-3d__note {
  display: flex;
  align-items: center;
  gap: 6px;
  font-family: var(--cr-3d-font);
  font-size: 12.5px;
  color: var(--cr-3d-muted);
  font-weight: 500;
}

/* ── RESPONSIVE DESIGN ─────────────────── */
@media(max-width:1100px) {
  .cr-grid-3d--3 {
    grid-template-columns: 1fr 1fr;
  }
}
@media(max-width:991px) {
  .cr-layout-3d {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  .cr-aside-3d {
    position: static;
    order: -1;
  }
}
@media(max-width:640px) {
  .cr-hero-3d {
    padding: 60px 16px 50px;
  }
  .cr-wrap-3d {
    padding: 0 16px;
  }
  .cr-form-card-3d {
    padding: 28px 20px;
  }
  .cr-grid-3d--2, .cr-grid-3d--3 {
    grid-template-columns: 1fr;
  }
  .cr-submit-3d {
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
  }
  .cr-btn-3d {
    width: 100%;
    justify-content: center;
  }
  .cr-upload-3d {
    flex-direction: column;
    text-align: center;
  }
}
@media(prefers-reduced-motion:reduce) {
  *, *::before, *::after {
    transition: none !important;
    transform: none !important;
  }
}
</style>

<div class="space-for-header"></div>

{{-- ═══════════════════════════════════════════════════
     3D HERO SECTION
════════════════════════════════════════════════════ --}}
<section class="cr-hero-3d">
  <div class="cr-hero-3d__bg"></div>
  <div class="cr-hero-3d__shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
  </div>
  <div class="cr-hero-3d__inner">
    <nav class="cr-breadcrumb-3d">
      <a href="{{ url('/') }}">Home</a>
      <span class="sep">/</span>
      <span class="active">Register Company</span>
    </nav>
    <h1 class="cr-hero-3d__title">Register Your Company</h1>
    <p class="cr-hero-3d__sub">Partner with Wintech Inc to acquire exceptional talent. Our streamlined, modern candidate matching process will connect you with the right professionals.</p>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MAIN CONTENT & 3D LAYOUT
════════════════════════════════════════════════════ --}}
<section class="cr-main-3d">
  <div class="cr-wrap-3d">
    <div class="cr-layout-3d">

      {{-- LEFT: 3D Info Panel --}}
      <aside class="cr-aside-3d">
        <div class="cr-aside-card-3d">
          <div class="cr-aside-logo-3d">
            <img loading="lazy" src="{{ asset('logo.png') }}" alt="Wintech Logo">
          </div>
          <h3>How It Works</h3>

          <div class="cr-steps-3d">
            <div class="cr-step-3d">
              <div class="cr-step-3d__num-wrap">
                <div class="cr-step-3d__num">1</div>
              </div>
              <div class="cr-step-3d__content">
                <strong>Fill the Form</strong>
                <p>Provide your company and job requirement details</p>
              </div>
            </div>
            <div class="cr-step-3d">
              <div class="cr-step-3d__num-wrap">
                <div class="cr-step-3d__num">2</div>
              </div>
              <div class="cr-step-3d__content">
                <strong>We Review</strong>
                <p>Our team reviews your requirements within 24 hours</p>
              </div>
            </div>
            <div class="cr-step-3d">
              <div class="cr-step-3d__num-wrap">
                <div class="cr-step-3d__num">3</div>
              </div>
              <div class="cr-step-3d__content">
                <strong>Get Matched</strong>
                <p>We connect you with the best-fit candidates</p>
              </div>
            </div>
          </div>

          <div class="cr-badges-3d">
            <span class="badge-item-3d">
              <i class="fas fa-shield-alt"></i> 100% Secure
            </span>
            <span class="badge-item-3d">
              <i class="fas fa-bolt"></i> 24hr Response
            </span>
          </div>

          <div class="cr-contact-3d">
            <a href="tel:+919940436371"><i class="fas fa-phone-alt"></i> +91 99404 36371</a>
            <a href="mailto:lochana@wintechinc.in"><i class="fas fa-envelope"></i> lochana@wintechinc.in</a>
          </div>
        </div>
      </aside>

      {{-- RIGHT: 3D Form Card --}}
      <div class="cr-form-card-3d">
        <div class="cr-form-header-3d">
          <h2>Submit Your Details</h2>
          <p>Fill in the form below and our recruitment experts will contact you shortly.</p>
        </div>

        @if(session('success'))
        <div class="cr-alert-3d">
          <div class="alert-icon-3d"><i class="fas fa-check-circle"></i></div>
          <div class="alert-text-3d">{{ session('success') }}</div>
        </div>
        @endif

        <form action="{{ route('company.register.submit') }}" method="POST" enctype="multipart/form-data">
          @csrf

          {{-- Personal Info --}}
          <div class="cr-section-label-3d">Personal Information</div>
          <div class="cr-grid-3d cr-grid-3d--3">
            <div class="cr-field-3d">
              <label>Full Name <span>*</span></label>
              <input type="text" name="name" placeholder="Your full name" value="{{ old('name') }}" required>
            </div>
            <div class="cr-field-3d">
              <label>Email <span>*</span></label>
              <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required>
            </div>
            <div class="cr-field-3d">
              <label>Mobile <span>*</span></label>
              <input type="tel" name="mobile" placeholder="+91 98765 43210" value="{{ old('mobile') }}" required>
            </div>
          </div>

          {{-- Company Info --}}
          <div class="cr-section-label-3d">Company Information</div>
          <div class="cr-grid-3d cr-grid-3d--2">
            <div class="cr-field-3d">
              <label>Company Name</label>
              <input type="text" name="company_name" placeholder="Your company" value="{{ old('company_name') }}">
            </div>
            <div class="cr-field-3d">
              <label>Website</label>
              <input type="url" name="company_website" placeholder="https://yourcompany.com" value="{{ old('company_website') }}">
            </div>
            <div class="cr-field-3d">
              <label>Location</label>
              <input type="text" name="location" placeholder="City, State" value="{{ old('location') }}">
            </div>
            <div class="cr-field-3d">
              <label>Address</label>
              <input type="text" name="address" placeholder="Full address" value="{{ old('address') }}">
            </div>
          </div>

          {{-- Job Requirements --}}
          <div class="cr-section-label-3d">Job Requirements</div>
          <div class="cr-grid-3d cr-grid-3d--3">
            <div class="cr-field-3d">
              <label>Position / Role</label>
              <input type="text" name="position" placeholder="e.g. Software Engineer" value="{{ old('position') }}">
            </div>
            <div class="cr-field-3d">
              <label>Salary Range</label>
              <input type="text" name="salary" placeholder="e.g. 5-8 LPA" value="{{ old('salary') }}">
            </div>
            <div class="cr-field-3d">
              <label>Experience Required</label>
              <input type="text" name="experience" placeholder="e.g. 2-4 years" value="{{ old('experience') }}">
            </div>
          </div>
          <div class="cr-field-3d cr-field-3d--full">
            <label>Job Description</label>
            <textarea name="job_desc" rows="4" placeholder="Describe the role, responsibilities, and skills required...">{{ old('job_desc') }}</textarea>
          </div>

          {{-- Attachments --}}
          <div class="cr-section-label-3d">Attachments <small>optional</small></div>
          <div class="cr-grid-3d cr-grid-3d--2">
            <div class="cr-upload-3d" id="jdUpload" onclick="document.getElementById('job_brief').click()">
              <div class="cr-upload-3d__icon">
                <i class="fas fa-file-pdf"></i>
              </div>
              <div class="cr-upload-3d__text">
                <span id="jd-name">Job Description Brief</span>
                <small>PDF, DOC, DOCX — max 2MB</small>
              </div>
              <input type="file" name="job_brief" id="job_brief" accept=".pdf,.doc,.docx" style="display:none" onchange="handleUpload(this,'jdUpload','jd-name','Job Description Brief')">
            </div>
            <div class="cr-upload-3d" id="logoUpload" onclick="document.getElementById('company_logo').click()">
              <div class="cr-upload-3d__icon">
                <i class="fas fa-image"></i>
              </div>
              <div class="cr-upload-3d__text">
                <span id="logo-name">Company Logo</span>
                <small>JPG, PNG, GIF — max 2MB</small>
              </div>
              <input type="file" name="company_logo" id="company_logo" accept="image/*" style="display:none" onchange="handleUpload(this,'logoUpload','logo-name','Company Logo')">
            </div>
          </div>

          {{-- Submit --}}
          <div class="cr-submit-3d">
            <button type="submit" class="cr-btn-3d">
              Submit Registration <i class="fas fa-arrow-right"></i>
            </button>
            <span class="cr-submit-3d__note">
              <i class="fas fa-lock"></i> Your information is secure
            </span>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════ PREMIUM 3D CSS STYLES --}}


<script>
function handleUpload(input, boxId, labelId, defaultText) {
  const box = document.getElementById(boxId);
  const label = document.getElementById(labelId);
  if (input.files[0]) {
    label.textContent = input.files[0].name;
    box.classList.add('has-file');
  } else {
    label.textContent = defaultText;
    box.classList.remove('has-file');
  }
}
</script>

@endsection


