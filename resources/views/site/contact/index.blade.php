@extends('layouts.site')
@section('content')

<div class="space-for-header"></div>

{{-- ═══════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ --}}
<section class="ct-hero">
  <div class="ct-hero__bg"></div>
  <div class="ct-hero__inner">
    <nav class="ct-breadcrumb">
      <a href="{{ url('/') }}">Home</a>
      <span class="ct-breadcrumb__sep">/</span>
      <span>Contact Us</span>
    </nav>
    <h1 class="ct-hero__title">Let's Connect</h1>
    <p class="ct-hero__subtitle">Have questions or need assistance? We're just a message away.</p>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CONTACT INFO STRIP
════════════════════════════════════════════════════ --}}
<section class="ct-strip">
  <div class="ct-wrap">
    <div class="ct-strip__grid">
      <a href="tel:{{ $settings['site_phone'] ?? '+919940436371' }}" class="ct-strip__item">
        <div class="ct-strip__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.69 13a19.79 19.79 0 01-3.07-8.67A2 2 0 013.62 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        </div>
        <div class="ct-strip__text">
          <span class="ct-strip__label">Call Us</span>
          <span class="ct-strip__value">{{ $settings['site_phone'] ?? '+91 9940436371' }}</span>
        </div>
      </a>

      <a href="mailto:{{ $settings['site_email'] ?? 'lochana@wintechinc.in' }}" class="ct-strip__item">
        <div class="ct-strip__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <div class="ct-strip__text">
          <span class="ct-strip__label">Email Us</span>
          <span class="ct-strip__value">{{ $settings['site_email'] ?? 'lochana@wintechinc.in' }}</span>
        </div>
      </a>

      <div class="ct-strip__item">
        <div class="ct-strip__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div class="ct-strip__text">
          <span class="ct-strip__label">Visit Us</span>
          <span class="ct-strip__value">{{ $settings['site_address'] ?? 'No 8/235, Pillaiyar Kovil St, Polichalur, Chennai 600074' }}</span>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     FORM + MAP LAYOUT
════════════════════════════════════════════════════ --}}
<section class="ct-main">
  <div class="ct-wrap">
    <div class="ct-layout">

      {{-- LEFT: Contact Form --}}
      <div class="ct-form-card">
        <div class="ct-form-card__head">
          <h2>Send Us a Message</h2>
          <p>Fill out the form and our team will get back to you within 24 hours.</p>
        </div>

        @if(session('success'))
        <div class="ct-alert">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
          @csrf
          <div class="ct-form-grid">
            <div class="ct-field">
              <label>Full Name <span>*</span></label>
              <input type="text" name="name" placeholder="Your full name" value="{{ old('name') }}" required>
              @error('name')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field">
              <label>Email Address <span>*</span></label>
              <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required>
              @error('email')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field">
              <label>Phone Number <span>*</span></label>
              <input type="text" name="phonenumber" placeholder="+91 98765 43210" value="{{ old('phonenumber') }}" required>
              @error('phonenumber')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field">
              <label>Service Interested In <span>*</span></label>
              <select name="service" required>
                <option value="">Select a Service</option>
                <optgroup label="IT Sectors">
                  <option value="Placement Service(Candidate)" {{ old('service') == 'Placement Service(Candidate)' ? 'selected' : '' }}>Placement Service(Candidate)</option>
                  <option value="Placement Service (For Employers)" {{ old('service') == 'Placement Service (For Employers)' ? 'selected' : '' }}>Placement Service (For Employers)</option>
                  <option value="Placement Service for IT Industry" {{ old('service') == 'Placement Service for IT Industry' ? 'selected' : '' }}>Placement Service for IT Industry</option>
                  <option value="Placement  Service for Manpower  (Employers)" {{ old('service') == 'Placement  Service for Manpower  (Employers)' ? 'selected' : '' }}>Placement  Service for Manpower  (Employers)</option>
                  <option value="Placement  Service for Manpower  (Candidate)" {{ old('service') == 'Placement  Service for Manpower  (Candidate)' ? 'selected' : '' }}>Placement  Service for Manpower  (Candidate)</option>
                </optgroup>
                <optgroup label="Non-IT Sectors">
                  <option value="Manpower Suppliers" {{ old('service') == 'Manpower Suppliers' ? 'selected' : '' }}>Manpower Suppliers</option>
                  <option value="Manpower Consultants" {{ old('service') == 'Manpower Consultants' ? 'selected' : '' }}>Manpower Consultants</option>
                  <option value="Placement Service for Accounts" {{ old('service') == 'Placement Service for Accounts' ? 'selected' : '' }}>Placement Service for Accounts</option>
                  <option value="Placement Service for Accounts (Employers)" {{ old('service') == 'Placement Service for Accounts (Employers)' ? 'selected' : '' }}>Placement Service for Accounts (Employers)</option>
                  <option value="Placement  Service for Hospital" {{ old('service') == 'Placement  Service for Hospital' ? 'selected' : '' }}>Placement  Service for Hospital</option>
                  <option value="Manpower Outsourcing Services" {{ old('service') == 'Manpower Outsourcing Services' ? 'selected' : '' }}>Manpower Outsourcing Services</option>
                  <option value="Placement Service for Banking Sector" {{ old('service') == 'Placement Service for Banking Sector' ? 'selected' : '' }}>Placement Service for Banking Sector</option>
                </optgroup>
                <optgroup label="Services">
                  <option value="Digital Marketing" {{ old('service') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                  <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                  <option value="E commerce Development" {{ old('service') == 'E commerce Development' ? 'selected' : '' }}>E commerce Development</option>
                  <option value="Mobile App Development" {{ old('service') == 'Mobile App Development' ? 'selected' : '' }}>Mobile App Development</option>
                </optgroup>
                <option value="Other" {{ old('service') == 'Other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('service')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field ct-field--full">
              <label>Subject <span>*</span></label>
              <input type="text" name="subject" placeholder="How can we help you?" value="{{ old('subject') }}" required>
              @error('subject')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field ct-field--full">
              <label>Message <span>*</span></label>
              <textarea name="message" rows="5" placeholder="Tell us more about your requirement..." required>{{ old('message') }}</textarea>
              @error('message')<small class="ct-error">{{ $message }}</small>@enderror
            </div>
            <div class="ct-field ct-field--full">
              <button type="submit" class="ct-btn">
                Send Message
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              </button>
            </div>
          </div>
        </form>
      </div>

      {{-- RIGHT: Sidebar --}}
      <div class="ct-sidebar">

        {{-- Map Card --}}
        <div class="ct-map-card">
          @if(!empty($settings['google_map_url']))
          <iframe src="{{ $settings['google_map_url'] }}" width="100%" height="220" style="border:0;border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          @else
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.7414934391663!2d80.13794481482218!3d12.988378990844867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5261a620ca75df%3A0xfa41e30f85eeec47!2sWintech%20HR%20Consultancy!5e0!3m2!1sen!2sin!4v1688157321832!5m2!1sen!2sin" width="100%" height="220" style="border:0;border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          @endif
        </div>

        {{-- Business Hours --}}
        <div class="ct-hours-card">
          <h4>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Business Hours
          </h4>
          <ul>
            <li><span>Monday – Friday</span><strong>9:00 AM – 6:00 PM</strong></li>
            <li><span>Saturday</span><strong>10:00 AM – 4:00 PM</strong></li>
            <li><span>Sunday</span><strong>Closed</strong></li>
          </ul>
        </div>

        {{-- Social Links --}}
        @php
          $socials = [
            'fb_link' => ['label' => 'Facebook', 'icon' => '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>'],
            'instagram_link' => ['label' => 'Instagram', 'icon' => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>'],
            'twitter_link' => ['label' => 'Twitter / X', 'icon' => '<path d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0012 7.5v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>'],
            'linkedin_link' => ['label' => 'LinkedIn', 'icon' => '<path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-4 0v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>'],
            'youtube_link' => ['label' => 'YouTube', 'icon' => '<path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>'],
          ];
          $hasSocials = false;
          foreach($socials as $key => $data) {
            if(!empty($settings[$key])) { $hasSocials = true; break; }
          }
        @endphp
        @if($hasSocials)
        <div class="ct-social-card">
          <h4>Follow Us</h4>
          <div class="ct-social-links">
            @foreach($socials as $key => $data)
              @if(!empty($settings[$key]))
              <a href="{{ $settings[$key] }}" target="_blank" rel="noopener" title="{{ $data['label'] }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $data['icon'] !!}</svg>
              </a>
              @endif
            @endforeach
          </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════ STYLES --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

:root {
  --ct-primary: #b11e24;
  --ct-primary-dark: #8c1418;
  --ct-primary-light: #fff1f2;
  --ct-dark: #1a1a2e;
  --ct-text: #2d2d3a;
  --ct-muted: #6e6e80;
  --ct-border: #ebebf0;
  --ct-bg: #f5f5f8;
  --ct-white: #ffffff;
  --ct-radius: 12px;
  --ct-font: 'DM Sans', sans-serif;
}

/* ── HERO ──────────────────────────────── */
.ct-hero {
  position: relative;
  padding: 70px 24px 60px;
  background: var(--ct-dark);
  overflow: hidden;
}
.ct-hero__bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 25% 50%, rgba(232,73,36,.22) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 40%, rgba(232,73,36,.1) 0%, transparent 50%);
}
.ct-hero__inner {
  position: relative;
  max-width: 1280px;
  margin: 0 auto;
}
.ct-breadcrumb {
  font-family: var(--ct-font);
  font-size: 13px;
  margin-bottom: 16px;
}
.ct-breadcrumb a {
  color: rgba(255,255,255,.45);
  text-decoration: none;
  transition: color .2s;
}
.ct-breadcrumb a:hover { color: #fff; }
.ct-breadcrumb__sep { color: rgba(255,255,255,.25); margin: 0 8px; }
.ct-breadcrumb span { color: rgba(255,255,255,.75); }
.ct-hero__title {
  font-family: var(--ct-font);
  font-size: clamp(28px, 4vw, 44px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 10px;
  letter-spacing: -0.5px;
}
.ct-hero__subtitle {
  font-family: var(--ct-font);
  font-size: 16px;
  color: rgba(255,255,255,.5);
  margin: 0;
}

/* ── WRAP ──────────────────────────────── */
.ct-wrap {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* ── INFO STRIP ────────────────────────── */
.ct-strip {
  background: var(--ct-white);
  border-bottom: 1px solid var(--ct-border);
  padding: 0;
}
.ct-strip__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}
.ct-strip__item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 28px 24px;
  text-decoration: none;
  color: inherit;
  transition: background .2s;
  border-right: 1px solid var(--ct-border);
}
.ct-strip__item:last-child { border-right: none; }
.ct-strip__item:hover { background: var(--ct-primary-light); }
.ct-strip__icon {
  width: 46px;
  height: 46px;
  border-radius: 12px;
  background: var(--ct-primary-light);
  color: var(--ct-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: all .2s;
}
.ct-strip__item:hover .ct-strip__icon { background: var(--ct-primary); color: #fff; }
.ct-strip__text { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
.ct-strip__label {
  font-family: var(--ct-font);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: var(--ct-muted);
}
.ct-strip__value {
  font-family: var(--ct-font);
  font-size: 14px;
  font-weight: 600;
  color: var(--ct-dark);
  word-break: break-word;
}

/* ── MAIN LAYOUT ───────────────────────── */
.ct-main {
  background: var(--ct-bg);
  padding: 48px 0 72px;
}
.ct-layout {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 28px;
  align-items: start;
}

/* ── FORM CARD ─────────────────────────── */
.ct-form-card {
  background: var(--ct-white);
  border: 1px solid var(--ct-border);
  border-radius: var(--ct-radius);
  padding: 36px;
}
.ct-form-card__head {
  margin-bottom: 28px;
}
.ct-form-card__head h2 {
  font-family: var(--ct-font);
  font-size: 24px;
  font-weight: 700;
  color: var(--ct-dark);
  margin: 0 0 6px;
}
.ct-form-card__head p {
  font-family: var(--ct-font);
  font-size: 14px;
  color: var(--ct-muted);
  margin: 0;
}

/* Alert */
.ct-alert {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 18px;
  border-radius: 9px;
  font-family: var(--ct-font);
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 24px;
  background: #f0fdf4;
  color: #059669;
  border: 1px solid #a7f3d0;
}

/* Form grid */
.ct-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px;
}
.ct-field { display: flex; flex-direction: column; gap: 6px; }
.ct-field--full { grid-column: 1 / -1; }
.ct-field label {
  font-family: var(--ct-font);
  font-size: 13px;
  font-weight: 600;
  color: var(--ct-text);
}
.ct-field label span { color: var(--ct-primary); }
.ct-field input,
.ct-field select,
.ct-field textarea {
  width: 100%;
  padding: 12px 16px;
  border: 1.5px solid var(--ct-border);
  border-radius: 9px;
  font-family: var(--ct-font);
  font-size: 14px;
  color: var(--ct-text);
  background: var(--ct-bg);
  outline: none;
  transition: border-color .2s, background .2s, box-shadow .2s;
  -webkit-appearance: none;
}
.ct-field input::placeholder,
.ct-field textarea::placeholder { color: #aaa; }
.ct-field input:focus,
.ct-field select:focus,
.ct-field textarea:focus {
  border-color: var(--ct-primary);
  background: var(--ct-white);
  box-shadow: 0 0 0 3px rgba(232,73,36,.08);
}
.ct-field textarea { resize: vertical; min-height: 130px; }
.ct-error {
  font-family: var(--ct-font);
  font-size: 12px;
  color: #dc2626;
}

/* Button */
.ct-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px 32px;
  background: var(--ct-primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-family: var(--ct-font);
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: background .2s, transform .15s, box-shadow .2s;
  box-shadow: 0 4px 16px rgba(232,73,36,.15);
}
.ct-btn:hover {
  background: var(--ct-primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(232,73,36,.2);
}

/* ── SIDEBAR ───────────────────────────── */
.ct-sidebar {
  display: flex;
  flex-direction: column;
  gap: 20px;
  position: sticky;
  top: 90px;
}

/* Map card */
.ct-map-card {
  background: var(--ct-white);
  border: 1px solid var(--ct-border);
  border-radius: var(--ct-radius);
  padding: 12px;
  overflow: hidden;
}
.ct-map-card iframe {
  border-radius: 8px;
  display: block;
}

/* Hours card */
.ct-hours-card {
  background: var(--ct-white);
  border: 1px solid var(--ct-border);
  border-radius: var(--ct-radius);
  padding: 22px;
}
.ct-hours-card h4 {
  font-family: var(--ct-font);
  font-size: 15px;
  font-weight: 700;
  color: var(--ct-dark);
  margin: 0 0 16px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding-bottom: 12px;
  border-bottom: 1px solid var(--ct-border);
}
.ct-hours-card h4 svg { color: var(--ct-primary); }
.ct-hours-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ct-hours-card li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: var(--ct-font);
  font-size: 13px;
}
.ct-hours-card li span { color: var(--ct-muted); }
.ct-hours-card li strong { color: var(--ct-dark); font-weight: 600; }

/* Social card */
.ct-social-card {
  background: var(--ct-dark);
  border-radius: var(--ct-radius);
  padding: 22px;
}
.ct-social-card h4 {
  font-family: var(--ct-font);
  font-size: 14px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 16px;
}
.ct-social-links {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}
.ct-social-links a {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.12);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,.65);
  text-decoration: none;
  transition: all .2s;
}
.ct-social-links a:hover {
  background: var(--ct-primary);
  border-color: var(--ct-primary);
  color: #fff;
  transform: translateY(-2px);
}

/* ── RESPONSIVE ────────────────────────── */
@media(max-width:1100px) {
  .ct-layout { grid-template-columns: 1fr 300px; }
}
@media(max-width:991px) {
  .ct-layout { grid-template-columns: 1fr; }
  .ct-sidebar { position: static; order: -1; }
  .ct-strip__grid { grid-template-columns: 1fr; }
  .ct-strip__item { border-right: none; border-bottom: 1px solid var(--ct-border); }
  .ct-strip__item:last-child { border-bottom: none; }
}
@media(max-width:640px) {
  .ct-hero { padding: 50px 16px 40px; }
  .ct-wrap { padding: 0 16px; }
  .ct-main { padding: 28px 0 48px; }
  .ct-form-card { padding: 24px 20px; }
  .ct-form-grid { grid-template-columns: 1fr; }
  .ct-btn { width: 100%; }
}
@media(prefers-reduced-motion:reduce) {
  *, *::before, *::after { transition: none !important; }
}
</style>

@endsection
