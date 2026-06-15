@extends('layouts.site')

@section('content')

{{-- Toast Notifications --}}
@if(session('success'))
<div class="jd-toast jd-toast--success" id="toastNotification">
  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
  <span>{{ session('success') }}</span>
  <button onclick="closeToast()">×</button>
</div>
@endif
@if(session('error'))
<div class="jd-toast jd-toast--error" id="toastNotification">
  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
  <span>{{ session('error') }}</span>
  <button onclick="closeToast()">×</button>
</div>
@endif

<div class="space-for-header"></div>

{{-- ═══════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ --}}
<section class="jd-hero">
  <div class="jd-hero__bg"></div>
  <div class="jd-hero__inner">
    <nav class="jd-breadcrumb">
      <a href="{{ url('/') }}">Home</a>
      <span class="jd-breadcrumb__sep">/</span>
      <a href="{{ url('jobs') }}">Jobs</a>
      <span class="jd-breadcrumb__sep">/</span>
      <span>{{ $job->job_title }}</span>
    </nav>

    <div class="jd-hero__row">
      <div class="jd-hero__left">
        @php
          $typeSlug = strtolower(str_replace(' ','-',$job->job_type ?? 'full-time'));
          $typeColors = [
            'full-time'=>'#10b981','part-time'=>'#f97316','internship'=>'#3b82f6','contract'=>'#a855f7','remote'=>'#14b8a6',
          ];
          $tc = $typeColors[$typeSlug] ?? '#10b981';
        @endphp
        <div class="jd-hero__badges">
          <span class="jd-hero__badge" style="color:{{ $tc }}; background: {{ $tc }}20; border: 1px solid {{ $tc }}40;">{{ $job->job_type ?? 'Full-Time' }}</span>
          @if($job->work_mode)
          <span class="jd-hero__badge jd-hero__badge--glass">{{ $job->work_mode }}</span>
          @endif
        </div>
        <h1 class="jd-hero__title">{{ $job->job_title }}</h1>
        <div class="jd-hero__meta">
          <span>{{ $job->company_name ?? 'Company' }}</span>
          <span class="jd-hero__sep">•</span>
          <span>{{ $job->job_location ?? 'Location' }}</span>
          @if($job->experience)
          <span class="jd-hero__sep">•</span>
          <span>{{ $job->experience }}</span>
          @endif
          <span class="jd-hero__sep">•</span>
          <span>{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
        </div>
      </div>
      <div class="jd-hero__right">
        <div class="jd-hero__salary">
          @if($job->salary_from && $job->salary_to)
            <span class="jd-hero__salary-amount">₹{{ number_format($job->salary_from/100000,1) }}L – ₹{{ number_format($job->salary_to/100000,1) }}L</span>
            <span class="jd-hero__salary-period">per year</span>
          @else
            <span class="jd-hero__salary-amount">Not Disclosed</span>
          @endif
        </div>
        <a href="#apply-form" class="jd-btn" onclick="@guest return showLoginPopup(event); @endguest">Apply Now</a>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════════════ --}}
<section class="jd-section">
  <div class="jd-wrap">
    <div class="jd-grid">

      {{-- ─── LEFT: Content ─── --}}
      <main class="jd-content">

        {{-- Company Header --}}
        <div class="jd-card jd-card--header">
          <div class="jd-company">
            <div class="jd-company__logo">
              @if($job->company_logo)
                <img src="{{ asset($job->company_logo) }}" alt="{{ $job->company_name }}">
              @else
                <span class="jd-company__letter">{{ strtoupper(substr($job->company_name ?? 'C',0,1)) }}</span>
              @endif
            </div>
            <div class="jd-company__info">
              <h3 class="jd-company__name">{{ $job->company_name ?? 'Company' }}</h3>
              <p class="jd-company__loc">{{ $job->job_location ?? 'Location' }}</p>
            </div>
          </div>
          @if($job->skills)
          <div class="jd-skills">
            @foreach(array_filter(array_map('trim', explode(',', $job->skills))) as $skill)
              <span class="jd-skill">{{ $skill }}</span>
            @endforeach
          </div>
          @endif
        </div>

        {{-- Job Description --}}
        @if($job->description)
        <div class="jd-card">
          <h3 class="jd-card__title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Job Overview
          </h3>
          <div class="jd-prose">{!! nl2br(e($job->description)) !!}</div>
        </div>
        @endif

        @if($job->responsibilities)
        <div class="jd-card">
          <h3 class="jd-card__title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            Key Responsibilities
          </h3>
          <div class="jd-prose">{!! nl2br(e($job->responsibilities)) !!}</div>
        </div>
        @endif

        @if($job->requirements)
        <div class="jd-card">
          <h3 class="jd-card__title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Requirements
          </h3>
          <div class="jd-prose">{!! nl2br(e($job->requirements)) !!}</div>
        </div>
        @endif

        {{-- ─── APPLICATION FORM ─── --}}
        <div class="jd-card jd-card--apply" id="apply-form" style="position:relative;">
          <div class="jd-apply-head">
            <div>
              <h3 class="jd-apply-head__title">Apply for this Position</h3>
              <p class="jd-apply-head__sub">We'll review and respond within 2 business days.</p>
            </div>
            @auth
            <span class="jd-autofill">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Auto-filled
            </span>
            @endauth
          </div>

          <form enctype="multipart/form-data" id="applyForm" action="{{ route('job.apply.store', $job->id) }}" method="POST">
            @csrf
            <div class="jd-form">

              {{-- Personal --}}
              <div class="jd-form__section-label">Personal Information</div>
              <div class="jd-form__grid">
                <div class="jd-field">
                  <label>Full Name <span class="jd-req">*</span></label>
                  <input type="text" name="full_name" placeholder="Your full name" value="{{ $user ? $user->name : '' }}" required>
                </div>
                <div class="jd-field">
                  <label>Email <span class="jd-req">*</span></label>
                  <input type="email" name="email" placeholder="your@email.com" value="{{ $user ? $user->email : '' }}" required>
                </div>
                <div class="jd-field">
                  <label>Phone <span class="jd-req">*</span></label>
                  <input type="tel" name="phone" placeholder="+91 98765 43210" value="{{ $user ? $user->phone : '' }}" required>
                </div>
                <div class="jd-field">
                  <label>Location</label>
                  <input type="text" name="location" placeholder="City, State" value="{{ $user ? $user->location : '' }}">
                </div>
              </div>

              {{-- Professional --}}
              <div class="jd-form__section-label">Professional Details</div>
              <div class="jd-form__grid">
                <div class="jd-field">
                  <label>Experience <span class="jd-req">*</span></label>
                  <input type="text" name="experience" placeholder="e.g. 3 years" value="{{ $user && $user->experiences->count() > 0 ? $user->experiences->sum(function($exp) { return (int)filter_var($exp->duration ?? '0', FILTER_SANITIZE_NUMBER_INT); }) . ' years' : '' }}" required>
                </div>
                <div class="jd-field">
                  <label>Work Mode Preference</label>
                  <select name="preferred_work_mode_ref">
                    <option value="">Select</option>
                    <option value="Office">Office</option>
                    <option value="Remote">Remote</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Flexible">Flexible</option>
                  </select>
                </div>
                <div class="jd-field">
                  <label>Notice Period</label>
                  <input type="text" name="notice_period" placeholder="e.g. 30 days">
                </div>
                <div class="jd-field">
                  <label>Current CTC</label>
                  <input type="text" name="current_ctc" placeholder="e.g. 4 LPA">
                </div>
                <div class="jd-field">
                  <label>Expected CTC <span class="jd-req">*</span></label>
                  <input type="text" name="expected_ctc" placeholder="e.g. 8 LPA" required>
                </div>
                <div class="jd-field">
                  <label>LinkedIn</label>
                  <input type="url" name="linkedin" placeholder="linkedin.com/in/yourname">
                </div>
              </div>

              {{-- Cover Letter --}}
              <div class="jd-form__section-label">Cover Letter <span style="font-weight:400;color:#999;font-size:11px;margin-left:6px;">optional</span></div>
              <div class="jd-field jd-field--full">
                <textarea name="cover_letter" rows="4" placeholder="Why are you a great fit for this role?"></textarea>
              </div>

              {{-- Resume --}}
              <div class="jd-form__section-label">Resume / CV</div>
              <div class="jd-upload" id="uploadZone" onclick="document.getElementById('resume_upload').click()">
                <div class="jd-upload__icon" id="uploadIconWrap">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                </div>
                <div class="jd-upload__text">
                  <span id="resume-label">{{ $user && $user->resume ? 'Click to upload a new Resume' : 'Upload your Resume' }}</span>
                  <small>PDF, DOC, DOCX · Max 5 MB</small>
                </div>
                <input type="file" id="resume_upload" name="resume" accept=".pdf,.doc,.docx"
                  {{ $user && $user->resume ? '' : 'required' }} style="display:none"
                  onchange="handleResumeUpload(this)">
              </div>

              {{-- Submit --}}
              <div class="jd-form__submit">
                <button class="jd-btn" type="submit">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                  Submit Application
                </button>
                <span class="jd-form__privacy">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                  Your data is secure
                </span>
              </div>
            </div>
          </form>

          {{-- Guest Lock --}}
          @guest
          <div class="jd-lock" onclick="showLoginPopup()">
            <div class="jd-lock__card">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              <h4>Sign in to Apply</h4>
              <p>Create a free account or sign in to submit your application.</p>
              <div class="jd-lock__btns">
                <a href="{{ route('login') }}" class="jd-btn">Sign In</a>
                <a href="{{ route('login') }}" onclick="sessionStorage.setItem('authTab','register')" class="jd-btn jd-btn--outline">Register</a>
              </div>
            </div>
          </div>
          @endguest
        </div>

      </main>

      {{-- ─── RIGHT: Sidebar ─── --}}
      <aside class="jd-sidebar">

        {{-- Quick Apply --}}
        <div class="jd-widget jd-widget--cta">
          <div class="jd-widget__company">
            <div class="jd-widget__logo">
              @if($job->company_logo)
                <img src="{{ asset($job->company_logo) }}" alt="{{ $job->company_name }}">
              @else
                <span class="jd-company__letter jd-company__letter--sm">{{ strtoupper(substr($job->company_name ?? 'C',0,1)) }}</span>
              @endif
            </div>
            <div>
              <p class="jd-widget__company-name">{{ $job->company_name ?? 'Company' }}</p>
              <p class="jd-widget__job-title">{{ $job->job_title }}</p>
            </div>
          </div>
          <div class="jd-widget__salary">
            @if($job->salary_from && $job->salary_to)
              ₹{{ number_format($job->salary_from/100000,1) }}L – ₹{{ number_format($job->salary_to/100000,1) }}L <small>/yr</small>
            @else
              Not Disclosed
            @endif
          </div>
          <a href="#apply-form" class="jd-btn jd-btn--full" onclick="@guest return showLoginPopup(event); @endguest">Apply Now</a>
          @if($job->end_date)
          <p class="jd-widget__deadline">Deadline: {{ \Carbon\Carbon::parse($job->end_date)->format('d M Y') }}</p>
          @endif
        </div>

        {{-- Job Summary --}}
        <div class="jd-widget">
          <h4 class="jd-widget__title">Job Summary</h4>
          <ul class="jd-summary">
            <li><span>Job Title</span><strong>{{ $job->job_title }}</strong></li>
            <li><span>Location</span><strong>{{ $job->job_location }}</strong></li>
            <li><span>Job Type</span><strong>{{ $job->job_type }}</strong></li>
            @if($job->experience)<li><span>Experience</span><strong>{{ $job->experience }}</strong></li>@endif
            @if($job->work_mode)<li><span>Work Mode</span><strong>{{ $job->work_mode }}</strong></li>@endif
            @if($job->vacancies)<li><span>Openings</span><strong>{{ $job->vacancies }}</strong></li>@endif
            <li><span>Posted</span><strong>{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</strong></li>
          </ul>
        </div>

        {{-- Similar Jobs --}}
        @if($similarJobs->count())
        <div class="jd-widget">
          <h4 class="jd-widget__title">Similar Jobs</h4>
          <div class="jd-similar">
            @foreach($similarJobs as $similar)
            <a href="{{ route('jobs.show', $similar->id) }}" class="jd-similar__item">
              <div class="jd-similar__logo">
                @if($similar->company_logo)
                  <img src="{{ asset($similar->company_logo) }}" alt="{{ $similar->company_name }}">
                @else
                  <span class="jd-company__letter jd-company__letter--xs">{{ strtoupper(substr($similar->company_name ?? 'C',0,1)) }}</span>
                @endif
              </div>
              <div class="jd-similar__info">
                <span class="jd-similar__title">{{ $similar->job_title }}</span>
                <span class="jd-similar__meta">{{ $similar->job_location }} · {{ $similar->job_type }}</span>
              </div>
            </a>
            @endforeach
          </div>
        </div>
        @endif

      </aside>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════ STYLES --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

:root {
  --jd-primary: #b11e24;
  --jd-primary-dark: #8c1418;
  --jd-primary-light: #fff1f2;
  --jd-dark: #1a1a2e;
  --jd-text: #2d2d3a;
  --jd-muted: #6e6e80;
  --jd-border: #ebebf0;
  --jd-bg: #f5f5f8;
  --jd-white: #ffffff;
  --jd-radius: 12px;
  --jd-font: 'DM Sans', sans-serif;
}

/* ── HERO ──────────────────────────────── */
.jd-hero {
  position: relative;
  padding: 60px 24px 50px;
  background: var(--jd-dark);
  overflow: hidden;
}
.jd-hero__bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 15% 50%, rgba(177,30,36,.2) 0%, transparent 50%),
    radial-gradient(ellipse at 85% 30%, rgba(177,30,36,.12) 0%, transparent 50%);
}
.jd-hero__inner {
  position: relative;
  max-width: 1280px;
  margin: 0 auto;
}
.jd-breadcrumb {
  font-family: var(--jd-font);
  font-size: 13px;
  margin-bottom: 24px;
}
.jd-breadcrumb a {
  color: rgba(255,255,255,.45);
  text-decoration: none;
  transition: color .2s;
}
.jd-breadcrumb a:hover { color: #fff; }
.jd-breadcrumb__sep { color: rgba(255,255,255,.25); margin: 0 8px; }
.jd-breadcrumb span { color: rgba(255,255,255,.7); }

.jd-hero__row {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 32px;
  flex-wrap: wrap;
}
.jd-hero__left { flex: 1; min-width: 0; }
.jd-hero__badges { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; }
.jd-hero__badge {
  font-family: var(--jd-font);
  font-size: 11px;
  font-weight: 700;
  padding: 5px 12px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}
.jd-hero__badge--glass {
  background: rgba(255,255,255,.1);
  color: rgba(255,255,255,.8);
  border: 1px solid rgba(255,255,255,.2);
}
.jd-hero__title {
  font-family: var(--jd-font);
  font-size: clamp(24px, 3.5vw, 38px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 12px;
  letter-spacing: -0.3px;
  line-height: 1.2;
}
.jd-hero__meta {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 6px;
  font-family: var(--jd-font);
  font-size: 14px;
  color: rgba(255,255,255,.55);
}
.jd-hero__sep { color: rgba(255,255,255,.25); }

.jd-hero__right {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 14px;
  flex-shrink: 0;
}
.jd-hero__salary { text-align: right; }
.jd-hero__salary-amount {
  display: block;
  font-family: var(--jd-font);
  font-size: 22px;
  font-weight: 700;
  color: #fff;
}
.jd-hero__salary-period {
  font-size: 12px;
  color: rgba(255,255,255,.45);
}

/* ── BUTTON ────────────────────────────── */
.jd-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 13px 28px;
  background: var(--jd-primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-family: var(--jd-font);
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: background .2s, transform .15s;
  white-space: nowrap;
}
.jd-btn:hover { background: var(--jd-primary-dark); transform: translateY(-1px); color: #fff; }
.jd-btn--full { width: 100%; }
.jd-btn--outline {
  background: transparent;
  border: 1.5px solid var(--jd-border);
  color: var(--jd-text);
}
.jd-btn--outline:hover { border-color: var(--jd-primary); color: var(--jd-primary); background: var(--jd-primary-light); }

/* ── SECTION LAYOUT ────────────────────── */
.jd-section {
  background: var(--jd-bg);
  padding: 40px 0 80px;
}
.jd-wrap {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}
.jd-grid {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 28px;
  align-items: start;
}

/* ── CARDS ─────────────────────────────── */
.jd-card {
  background: var(--jd-white);
  border: 1px solid var(--jd-border);
  border-radius: var(--jd-radius);
  padding: 28px;
  margin-bottom: 20px;
}
.jd-card__title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: var(--jd-font);
  font-size: 17px;
  font-weight: 700;
  color: var(--jd-dark);
  margin: 0 0 16px;
  padding-bottom: 14px;
  border-bottom: 1px solid var(--jd-border);
}
.jd-card__title svg { color: var(--jd-primary); flex-shrink: 0; }
.jd-prose {
  font-family: var(--jd-font);
  font-size: 14px;
  color: var(--jd-text);
  line-height: 1.8;
  white-space: pre-wrap;
  word-wrap: break-word;
}

/* Company header card */
.jd-card--header { padding: 24px; }
.jd-company {
  display: flex;
  align-items: center;
  gap: 14px;
}
.jd-company__logo {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  border: 1px solid var(--jd-border);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--jd-white);
  flex-shrink: 0;
}
.jd-company__logo img { width: 100%; height: 100%; object-fit: contain; }
.jd-company__letter {
  width: 100%; height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--jd-primary), var(--jd-primary-dark));
  color: #fff;
  font-family: var(--jd-font);
  font-size: 20px;
  font-weight: 700;
}
.jd-company__letter--sm { font-size: 16px; }
.jd-company__letter--xs { font-size: 12px; }
.jd-company__name {
  font-family: var(--jd-font);
  font-size: 16px;
  font-weight: 700;
  color: var(--jd-dark);
  margin: 0;
}
.jd-company__loc {
  font-family: var(--jd-font);
  font-size: 13px;
  color: var(--jd-muted);
  margin: 2px 0 0;
}
.jd-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px solid var(--jd-border);
}
.jd-skill {
  font-family: var(--jd-font);
  font-size: 12px;
  font-weight: 600;
  color: var(--jd-primary);
  background: var(--jd-primary-light);
  border: 1px solid rgba(232,73,36,.15);
  padding: 4px 10px;
  border-radius: 6px;
}

/* ── APPLY FORM ────────────────────────── */
.jd-card--apply { padding: 0; overflow: hidden; }
.jd-apply-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 24px 28px;
  background: var(--jd-primary-light);
  border-bottom: 1px solid rgba(232,73,36,.1);
}
.jd-apply-head__title {
  font-family: var(--jd-font);
  font-size: 18px;
  font-weight: 700;
  color: var(--jd-dark);
  margin: 0 0 4px;
}
.jd-apply-head__sub {
  font-family: var(--jd-font);
  font-size: 13px;
  color: var(--jd-muted);
  margin: 0;
}
.jd-autofill {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-family: var(--jd-font);
  font-size: 11px;
  font-weight: 600;
  color: #059669;
  background: #ecfdf5;
  border: 1px solid #a7f3d0;
  padding: 4px 10px;
  border-radius: 99px;
  white-space: nowrap;
  flex-shrink: 0;
}
.jd-form { padding: 24px 28px 28px; }
.jd-form__section-label {
  font-family: var(--jd-font);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--jd-muted);
  margin: 24px 0 14px;
  padding-bottom: 8px;
  border-bottom: 1px solid var(--jd-border);
}
.jd-form__section-label:first-child { margin-top: 0; }
.jd-form__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.jd-field { display: flex; flex-direction: column; gap: 6px; }
.jd-field--full { grid-column: 1/-1; }
.jd-field label {
  font-family: var(--jd-font);
  font-size: 12px;
  font-weight: 600;
  color: var(--jd-text);
}
.jd-req { color: var(--jd-primary); }
.jd-field input,
.jd-field select,
.jd-field textarea {
  width: 100%;
  padding: 11px 14px;
  border: 1.5px solid var(--jd-border);
  border-radius: 9px;
  font-family: var(--jd-font);
  font-size: 14px;
  color: var(--jd-text);
  background: var(--jd-bg);
  outline: none;
  transition: border-color .2s, box-shadow .2s, background .2s;
}
.jd-field input::placeholder,
.jd-field textarea::placeholder { color: #aaa; }
.jd-field input:focus,
.jd-field select:focus,
.jd-field textarea:focus {
  border-color: var(--jd-primary);
  background: var(--jd-white);
  box-shadow: 0 0 0 3px rgba(232,73,36,.08);
}
.jd-field textarea { resize: vertical; min-height: 100px; }

/* Upload */
.jd-upload {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 18px 20px;
  border: 2px dashed var(--jd-border);
  border-radius: 10px;
  background: var(--jd-bg);
  cursor: pointer;
  transition: border-color .2s, background .2s;
}
.jd-upload:hover { border-color: var(--jd-primary); background: var(--jd-primary-light); }
.jd-upload.has-file { border-color: #059669; background: #f0fdf4; border-style: solid; }
.jd-upload__icon {
  width: 44px; height: 44px;
  border-radius: 10px;
  background: var(--jd-white);
  border: 1px solid var(--jd-border);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--jd-muted);
  flex-shrink: 0;
  transition: all .2s;
}
.jd-upload:hover .jd-upload__icon { color: var(--jd-primary); border-color: var(--jd-primary); }
.jd-upload.has-file .jd-upload__icon { color: #059669; border-color: #059669; }
.jd-upload__text { display: flex; flex-direction: column; gap: 2px; }
.jd-upload__text span { font-family: var(--jd-font); font-size: 14px; font-weight: 600; color: var(--jd-text); }
.jd-upload__text small { font-family: var(--jd-font); font-size: 12px; color: var(--jd-muted); }
.jd-upload.has-file .jd-upload__text span { color: #059669; }

.jd-form__submit {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-top: 28px;
  flex-wrap: wrap;
}
.jd-form__privacy {
  display: flex;
  align-items: center;
  gap: 5px;
  font-family: var(--jd-font);
  font-size: 12px;
  color: var(--jd-muted);
}

/* Lock overlay */
.jd-lock {
  position: absolute;
  inset: 0;
  border-radius: var(--jd-radius);
  backdrop-filter: blur(6px);
  background: rgba(245,245,248,.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
  cursor: pointer;
}
.jd-lock__card {
  background: var(--jd-white);
  border: 1px solid var(--jd-border);
  border-radius: var(--jd-radius);
  padding: 36px 28px;
  text-align: center;
  box-shadow: 0 16px 48px rgba(0,0,0,.1);
  max-width: 340px;
  width: 90%;
}
.jd-lock__card svg { color: var(--jd-primary); margin-bottom: 16px; }
.jd-lock__card h4 {
  font-family: var(--jd-font);
  font-size: 20px;
  font-weight: 700;
  color: var(--jd-dark);
  margin: 0 0 8px;
}
.jd-lock__card p {
  font-family: var(--jd-font);
  font-size: 14px;
  color: var(--jd-muted);
  margin: 0 0 24px;
  line-height: 1.5;
}
.jd-lock__btns { display: flex; flex-direction: column; gap: 10px; }

/* ── SIDEBAR ───────────────────────────── */
.jd-sidebar {
  position: sticky;
  top: 90px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.jd-widget {
  background: var(--jd-white);
  border: 1px solid var(--jd-border);
  border-radius: var(--jd-radius);
  padding: 22px;
}
.jd-widget__title {
  font-family: var(--jd-font);
  font-size: 15px;
  font-weight: 700;
  color: var(--jd-dark);
  margin: 0 0 16px;
  padding-bottom: 12px;
  border-bottom: 1px solid var(--jd-border);
}

/* CTA widget */
.jd-widget--cta {
  background: linear-gradient(135deg, var(--jd-white), var(--jd-primary-light));
  border-color: rgba(232,73,36,.15);
}
.jd-widget__company { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.jd-widget__logo {
  width: 42px; height: 42px;
  border-radius: 10px;
  border: 1px solid var(--jd-border);
  overflow: hidden;
  display: flex; align-items: center; justify-content: center;
  background: var(--jd-white);
  flex-shrink: 0;
}
.jd-widget__logo img { width: 100%; height: 100%; object-fit: contain; }
.jd-widget__company-name { font-family: var(--jd-font); font-size: 12px; color: var(--jd-muted); margin: 0; }
.jd-widget__job-title { font-family: var(--jd-font); font-size: 14px; font-weight: 700; color: var(--jd-dark); margin: 2px 0 0; }
.jd-widget__salary {
  font-family: var(--jd-font);
  font-size: 20px;
  font-weight: 700;
  color: var(--jd-primary);
  margin-bottom: 16px;
}
.jd-widget__salary small { font-size: 12px; font-weight: 400; color: var(--jd-muted); }
.jd-widget__deadline {
  font-family: var(--jd-font);
  font-size: 12px;
  color: var(--jd-muted);
  margin: 12px 0 0;
  text-align: center;
}

/* Summary */
.jd-summary {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.jd-summary li {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 12px;
  padding-bottom: 12px;
  border-bottom: 1px solid var(--jd-border);
}
.jd-summary li:last-child { border-bottom: none; padding-bottom: 0; }
.jd-summary li span {
  font-family: var(--jd-font);
  font-size: 13px;
  color: var(--jd-muted);
  flex-shrink: 0;
}
.jd-summary li strong {
  font-family: var(--jd-font);
  font-size: 13px;
  font-weight: 600;
  color: var(--jd-dark);
  text-align: right;
  word-break: break-word;
}

/* Similar jobs */
.jd-similar { display: flex; flex-direction: column; gap: 4px; }
.jd-similar__item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border-radius: 9px;
  text-decoration: none;
  transition: background .2s;
}
.jd-similar__item:hover { background: var(--jd-bg); }
.jd-similar__logo {
  width: 36px; height: 36px;
  border-radius: 8px;
  border: 1px solid var(--jd-border);
  overflow: hidden;
  display: flex; align-items: center; justify-content: center;
  background: var(--jd-white);
  flex-shrink: 0;
}
.jd-similar__logo img { width: 100%; height: 100%; object-fit: contain; }
.jd-similar__info { flex: 1; min-width: 0; }
.jd-similar__title {
  display: block;
  font-family: var(--jd-font);
  font-size: 13px;
  font-weight: 600;
  color: var(--jd-dark);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.jd-similar__meta {
  font-family: var(--jd-font);
  font-size: 11px;
  color: var(--jd-muted);
}

/* ── TOAST ─────────────────────────────── */
.jd-toast {
  position: fixed;
  top: 90px; right: 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 18px;
  background: var(--jd-white);
  border: 1px solid var(--jd-border);
  border-radius: 10px;
  box-shadow: 0 8px 30px rgba(0,0,0,.1);
  z-index: 9999;
  animation: jdToastIn .35s ease;
  max-width: 400px;
}
.jd-toast--success { border-left: 4px solid #059669; }
.jd-toast--success svg { color: #059669; }
.jd-toast--error { border-left: 4px solid #dc2626; }
.jd-toast--error svg { color: #dc2626; }
.jd-toast span { font-family: var(--jd-font); font-size: 14px; color: var(--jd-text); flex: 1; }
.jd-toast button {
  background: none; border: none;
  font-size: 18px; color: var(--jd-muted);
  cursor: pointer; line-height: 1;
  padding: 0 2px;
}
@keyframes jdToastIn { from { transform: translateX(100px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
@keyframes jdToastOut { from { opacity: 1; } to { opacity: 0; transform: translateX(60px); } }

/* ── RESPONSIVE ────────────────────────── */
@media(max-width:1100px) {
  .jd-grid { grid-template-columns: 1fr 280px; }
}
@media(max-width:991px) {
  .jd-grid { grid-template-columns: 1fr; }
  .jd-sidebar { position: static; order: -1; }
}
@media(max-width:640px) {
  .jd-hero { padding: 40px 16px 36px; }
  .jd-hero__title { font-size: 22px; }
  .jd-hero__row { flex-direction: column; align-items: flex-start; gap: 20px; }
  .jd-hero__right { align-items: flex-start; }
  .jd-wrap { padding: 0 14px; }
  .jd-section { padding: 24px 0 60px; }
  .jd-card { padding: 20px; }
  .jd-apply-head { flex-direction: column; padding: 20px; }
  .jd-form { padding: 20px; }
  .jd-form__grid { grid-template-columns: 1fr; }
  .jd-upload { flex-direction: column; text-align: center; }
  .jd-form__submit { flex-direction: column; align-items: stretch; }
  .jd-form__submit .jd-btn { width: 100%; }
}

html { scroll-padding-top: 90px; }
#apply-form { scroll-margin-top: 90px; }
@media(prefers-reduced-motion:reduce) {
  *, *::before, *::after { transition: none !important; animation: none !important; }
}
</style>

{{-- ═══════════════════════════════════════════════════ SCRIPTS --}}
<script>
window.addEventListener('DOMContentLoaded', function () {
  const toast = document.getElementById('toastNotification');
  if (toast) setTimeout(closeToast, 5000);
});
function closeToast() {
  const t = document.getElementById('toastNotification');
  if (!t) return;
  t.style.animation = 'jdToastOut .3s ease forwards';
  setTimeout(() => t.remove(), 300);
}

function handleResumeUpload(input) {
  const zone = document.getElementById('uploadZone');
  const label = document.getElementById('resume-label');
  if (input.files[0]) {
    label.textContent = input.files[0].name;
    zone.classList.add('has-file');
  } else {
    label.textContent = 'Upload your Resume';
    zone.classList.remove('has-file');
  }
}

document.querySelectorAll('a[href="#apply-form"]').forEach(link => {
  link.addEventListener('click', function (e) {
    @auth
    e.preventDefault();
    const target = document.getElementById('apply-form');
    if (target) {
      window.scrollTo({ top: target.getBoundingClientRect().top + scrollY - 100, behavior: 'smooth' });
    }
    @endauth
  });
});
</script>

@endsection
