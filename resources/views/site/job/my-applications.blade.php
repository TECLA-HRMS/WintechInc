@extends('layouts.site')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
  --brand: #071056;
  --brand-light: #1a3ed4;
  --brand-glow: rgba(7,16,86,0.12);
  --bg: #f0f2f7;
  --card: #ffffff;
  --text: #0d1117;
  --text-sec: #57606a;
  --text-muted: #8b949e;
  --border: #e5e7eb;
  --radius: 18px;
}

.ma-root {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  background: var(--bg);
  min-height: 100vh;
  -webkit-font-smoothing: antialiased;
}

/* Hero */
.ma-hero {
  background: var(--brand);
  background-image:
    radial-gradient(ellipse 80% 50% at 20% -10%, rgba(26,62,212,0.4) 0%, transparent 60%),
    radial-gradient(ellipse 60% 40% at 80% 110%, rgba(7,16,86,0.5) 0%, transparent 60%);
  padding: 52px 0 90px;
  position: relative;
  overflow: hidden;
}
.ma-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size: 50px 50px;
}
.ma-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 28px;
  position: relative;
  z-index: 1;
}
.ma-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(26,62,212,0.2);
  border: 1px solid rgba(26,62,212,0.4);
  color: #7ea6ff;
  font-size: 11px;
  font-weight: 700;
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: 16px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}
.ma-hero-badge::before {
  content: '';
  width: 6px; height: 6px;
  background: #7ea6ff;
  border-radius: 50%;
  animation: maPulse 2s ease infinite;
}
@keyframes maPulse { 0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.6)} }

.ma-hero h1 {
  font-size: clamp(26px, 4vw, 38px);
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.03em;
  margin-bottom: 8px;
}
.ma-hero h1 span {
  background: linear-gradient(135deg, #7ea6ff, #a5c8ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.ma-hero p { color: #8b949e; font-size: 15px; }

/* Stats Bar */
.ma-stats {
  max-width: 1200px;
  margin: -40px auto 0;
  padding: 0 28px;
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px;
}
.ma-stat-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 20px 22px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}
.ma-stat-icon {
  width: 42px; height: 42px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}
.ma-stat-icon.blue { background: #dbeafe; color: #2563eb; }
.ma-stat-icon.green { background: #dcfce7; color: #16a34a; }
.ma-stat-icon.amber { background: #fef3c7; color: #d97706; }
.ma-stat-icon.purple { background: #ede9fe; color: #7c3aed; }
.ma-stat-num { font-size: 22px; font-weight: 800; color: var(--text); letter-spacing: -0.03em; }
.ma-stat-label { font-size: 12px; color: var(--text-muted); font-weight: 500; }

/* Main Content */
.ma-content {
  max-width: 1200px;
  margin: 32px auto 80px;
  padding: 0 28px;
}

/* Application Card */
.ma-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 28px 30px;
  margin-bottom: 16px;
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: center;
  gap: 24px;
  transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
  position: relative;
  overflow: hidden;
}
.ma-card::after {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 4px;
  background: linear-gradient(180deg, var(--brand), var(--brand-light));
  opacity: 0;
  transition: opacity 0.3s;
}
.ma-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 36px rgba(7,16,86,0.07);
  border-color: #cbd5e1;
}
.ma-card:hover::after { opacity: 1; }

/* Logo */
.ma-logo {
  width: 64px; height: 64px;
  border-radius: 14px;
  overflow: hidden;
  background: #f8fafc;
  border: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.ma-logo img {
  width: 100%; height: 100%;
  object-fit: contain;
  padding: 10px;
}
.ma-logo-letter {
  width: 100%; height: 100%;
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  font-weight: 800;
  letter-spacing: -0.02em;
}

/* Job Details */
.ma-details { min-width: 0; }
.ma-job-title {
  font-size: 17px;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 4px;
  text-decoration: none;
  display: block;
  letter-spacing: -0.02em;
  transition: color 0.2s;
}
.ma-job-title:hover { color: var(--brand-light); }
.ma-company {
  font-size: 14px;
  color: var(--text-sec);
  font-weight: 500;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.ma-company i { color: #94a3b8; font-size: 12px; }
.ma-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.ma-tag {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 12px;
  font-weight: 500;
  color: var(--text-muted);
  background: #f6f8fa;
  border: 1px solid #f1f5f9;
  padding: 5px 10px;
  border-radius: 7px;
}
.ma-tag i { font-size: 11px; color: var(--brand-light); opacity: 0.7; }

/* Tracking Section */
.ma-tracking {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 10px;
  min-width: 170px;
}
.ma-date {
  font-size: 12px;
  color: var(--text-muted);
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 5px;
}

/* Status Tracker */
.ma-tracker {
  display: flex;
  align-items: center;
  gap: 0;
}
.ma-tracker-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
}
.ma-tracker-dot {
  width: 20px; height: 20px;
  border-radius: 50%;
  border: 2px solid #e5e7eb;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 9px;
  color: transparent;
  transition: all 0.3s;
  position: relative;
  z-index: 1;
}
.ma-tracker-dot.active {
  border-color: var(--brand);
  background: var(--brand);
  color: #fff;
  box-shadow: 0 0 0 3px rgba(7,16,86,0.15);
}
.ma-tracker-dot.completed {
  border-color: #16a34a;
  background: #16a34a;
  color: #fff;
}
.ma-tracker-dot.rejected-dot {
  border-color: #dc2626;
  background: #dc2626;
  color: #fff;
}
.ma-tracker-line {
  width: 22px; height: 2px;
  background: #e5e7eb;
}
.ma-tracker-line.filled { background: #16a34a; }
.ma-tracker-line.rejected-line { background: #dc2626; }

.ma-tracker-label {
  font-size: 9px;
  font-weight: 600;
  color: var(--text-muted);
  margin-top: 4px;
  white-space: nowrap;
}
.ma-tracker-label.active-label { color: var(--brand); }
.ma-tracker-label.completed-label { color: #16a34a; }
.ma-tracker-label.rejected-label { color: #dc2626; }

/* Status Badge */
.ma-badge {
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.ma-badge.pending { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
.ma-badge.reviewed { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
.ma-badge.shortlisted { background: #fdf4ff; color: #9333ea; border: 1px solid #f3e8ff; }
.ma-badge.hired { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
.ma-badge.rejected { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
.ma-badge.default { background: #f8fafc; color: #475569; border: 1px solid #f1f5f9; }

/* Empty State */
.ma-empty {
  text-align: center;
  padding: 80px 20px;
  background: var(--card);
  border-radius: var(--radius);
  border: 1px solid var(--border);
}
.ma-empty-icon {
  width: 100px; height: 100px;
  border-radius: 50%;
  background: #f6f8fa;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 40px;
  color: #cbd5e1;
  margin-bottom: 24px;
}
.ma-empty h3 { font-size: 22px; font-weight: 700; color: var(--text); margin-bottom: 10px; }
.ma-empty p { font-size: 15px; color: var(--text-sec); max-width: 380px; margin: 0 auto 30px; line-height: 1.6; }
.ma-empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, var(--brand), var(--brand-light));
  color: #fff;
  padding: 13px 28px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 6px 16px rgba(7,16,86,0.2);
  transition: all 0.3s;
}
.ma-empty-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(7,16,86,0.3); color: #fff; }

/* Pagination */
.ma-pagination { margin-top: 32px; }
.ma-pagination .pagination { justify-content: center; gap: 5px; }
.ma-pagination .page-link {
  border-radius: 10px;
  border: 1px solid var(--border);
  color: var(--text-sec);
  font-weight: 600;
  font-size: 14px;
  padding: 8px 15px;
  background: #fff;
}
.ma-pagination .page-link:hover { background: #f8fafc; border-color: #cbd5e1; }
.ma-pagination .page-item.active .page-link {
  background: var(--brand);
  border-color: var(--brand);
  color: #fff;
  box-shadow: 0 4px 10px rgba(7,16,86,0.2);
}

/* Alert */
.ma-alert {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 20px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 20px;
  background: #eff6ff;
  color: #1e40af;
  border: 1px solid #dbeafe;
}

/* Responsive */
@media (max-width: 768px) {
  .ma-card {
    grid-template-columns: 1fr;
    gap: 16px;
    padding: 22px;
  }
  .ma-logo { width: 52px; height: 52px; border-radius: 12px; }
  .ma-tracking {
    align-items: flex-start;
    border-top: 1px solid var(--border);
    padding-top: 16px;
    width: 100%;
  }
  .ma-stats { grid-template-columns: 1fr 1fr; }
  .ma-hero { padding: 40px 0 70px; }
}
@media (max-width: 480px) {
  .ma-stats { grid-template-columns: 1fr; }
  .ma-tracker { transform: scale(0.9); transform-origin: left; }
}
</style>

<div class="ma-root">

  {{-- Hero --}}
  <div class="ma-hero">
    <div class="ma-hero-inner">
      <div class="ma-hero-badge">Application Tracker</div>
      <h1>My <span>Applications</span></h1>
      <p>Track your job applications and stay updated on your progress</p>
    </div>
  </div>

  {{-- Stats --}}
  @if($applications->count() > 0)
  @php
    $total = $applications->total();
    $pending = $applications->where('status', 'pending')->count();
    $shortlisted = $applications->filter(fn($a) => in_array(strtolower($a->status), ['shortlisted','interview']))->count();
    $hired = $applications->filter(fn($a) => in_array(strtolower($a->status), ['hired','accepted','selected']))->count();
  @endphp
  <div class="ma-stats">
    <div class="ma-stat-card">
      <div class="ma-stat-icon blue"><i class="fa-solid fa-paper-plane"></i></div>
      <div>
        <div class="ma-stat-num">{{ $total }}</div>
        <div class="ma-stat-label">Total Applied</div>
      </div>
    </div>
    <div class="ma-stat-card">
      <div class="ma-stat-icon amber"><i class="fa-solid fa-clock"></i></div>
      <div>
        <div class="ma-stat-num">{{ $pending }}</div>
        <div class="ma-stat-label">Pending</div>
      </div>
    </div>
    <div class="ma-stat-card">
      <div class="ma-stat-icon purple"><i class="fa-solid fa-star"></i></div>
      <div>
        <div class="ma-stat-num">{{ $shortlisted }}</div>
        <div class="ma-stat-label">Shortlisted</div>
      </div>
    </div>
    <div class="ma-stat-card">
      <div class="ma-stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
      <div>
        <div class="ma-stat-num">{{ $hired }}</div>
        <div class="ma-stat-label">Hired</div>
      </div>
    </div>
  </div>
  @endif

  {{-- Content --}}
  <div class="ma-content">

    @if(session('message'))
      <div class="ma-alert">
        <i class="fa-solid fa-circle-info"></i> {{ session('message') }}
      </div>
    @endif

    @if($applications->count() > 0)

      @foreach($applications as $app)
        @php
          $status = strtolower($app->status ?? 'pending');
          $badgeClass = 'default';
          $badgeLabel = ucfirst($app->status ?? 'Applied');

          if (in_array($status, ['pending','applied'])) $badgeClass = 'pending';
          elseif (in_array($status, ['reviewed','viewed'])) $badgeClass = 'reviewed';
          elseif (in_array($status, ['shortlisted','interview'])) $badgeClass = 'shortlisted';
          elseif (in_array($status, ['hired','accepted','selected'])) $badgeClass = 'hired';
          elseif (in_array($status, ['rejected','declined'])) $badgeClass = 'rejected';

          // Tracker steps: applied -> reviewed -> shortlisted -> hired
          $steps = ['applied','reviewed','shortlisted','hired'];
          $stepIndex = 0;
          if (in_array($status, ['pending','applied'])) $stepIndex = 0;
          elseif (in_array($status, ['reviewed','viewed'])) $stepIndex = 1;
          elseif (in_array($status, ['shortlisted','interview'])) $stepIndex = 2;
          elseif (in_array($status, ['hired','accepted','selected'])) $stepIndex = 3;
          $isRejected = in_array($status, ['rejected','declined']);
        @endphp

        <div class="ma-card">
          {{-- Logo --}}
          <div class="ma-logo">
            @if(!empty($app->company_logo))
              <img loading="lazy" src="{{ asset('uploads/company/logos/' . $app->company_logo) }}" alt="{{ $app->company_name }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="ma-logo-letter" style="display:none;">{{ strtoupper(substr($app->company_name ?? 'C', 0, 1)) }}</div>
            @else
              <div class="ma-logo-letter">{{ strtoupper(substr($app->company_name ?? 'C', 0, 1)) }}</div>
            @endif
          </div>

          {{-- Details --}}
          <div class="ma-details">
            <a href="{{ route('jobs.show', $app->job_id) }}" class="ma-job-title">{{ $app->job_title }}</a>
            <div class="ma-company"><i class="fa-solid fa-building"></i> {{ $app->company_name }}</div>
            <div class="ma-meta">
              @if($app->job_location)
                <span class="ma-tag"><i class="fa-solid fa-location-dot"></i> {{ $app->job_location }}</span>
              @endif
              @if($app->job_type)
                <span class="ma-tag"><i class="fa-solid fa-briefcase"></i> {{ ucwords(str_replace('_', ' ', $app->job_type)) }}</span>
              @endif
            </div>
          </div>

          {{-- Tracking --}}
          <div class="ma-tracking">
            {{-- Visual Tracker --}}
            <div class="ma-tracker">
              @foreach($steps as $i => $step)
                @if($i > 0)
                  <div class="ma-tracker-line {{ $isRejected ? ($i <= $stepIndex ? 'rejected-line' : '') : ($i <= $stepIndex ? 'filled' : '') }}"></div>
                @endif
                <div class="ma-tracker-step">
                  @if($isRejected && $i == $stepIndex)
                    <div class="ma-tracker-dot rejected-dot"><i class="fa-solid fa-xmark"></i></div>
                    <span class="ma-tracker-label rejected-label">Rejected</span>
                  @elseif($i < $stepIndex)
                    <div class="ma-tracker-dot completed"><i class="fa-solid fa-check"></i></div>
                    <span class="ma-tracker-label completed-label">{{ ucfirst($step) }}</span>
                  @elseif($i == $stepIndex && !$isRejected)
                    <div class="ma-tracker-dot active"><i class="fa-solid fa-circle" style="font-size:6px;"></i></div>
                    <span class="ma-tracker-label active-label">{{ ucfirst($step) }}</span>
                  @else
                    <div class="ma-tracker-dot"></div>
                    <span class="ma-tracker-label">{{ ucfirst($step) }}</span>
                  @endif
                </div>
              @endforeach
            </div>

            {{-- Badge + Date --}}
            <div class="ma-badge {{ $badgeClass }}">
              @if($badgeClass == 'pending') <i class="fa-solid fa-clock"></i>
              @elseif($badgeClass == 'reviewed') <i class="fa-solid fa-eye"></i>
              @elseif($badgeClass == 'shortlisted') <i class="fa-solid fa-star"></i>
              @elseif($badgeClass == 'hired') <i class="fa-solid fa-check-double"></i>
              @elseif($badgeClass == 'rejected') <i class="fa-solid fa-xmark"></i>
              @else <i class="fa-solid fa-circle-info"></i>
              @endif
              {{ $badgeLabel }}
            </div>

            <div class="ma-date">
              <i class="fa-regular fa-calendar"></i>
              {{ \Carbon\Carbon::parse($app->created_at)->format('M d, Y') }}
            </div>
          </div>
        </div>
      @endforeach

      <div class="ma-pagination">
        {{ $applications->links() }}
      </div>

    @else
      {{-- Empty State --}}
      <div class="ma-empty">
        <div class="ma-empty-icon"><i class="fa-solid fa-folder-open"></i></div>
        <h3>No Applications Yet</h3>
        <p>Start exploring jobs and apply to positions that match your skills and experience.</p>
        <a href="{{ route('jobs.index') }}" class="ma-empty-btn">
          <i class="fa-solid fa-magnifying-glass"></i> Browse Jobs
        </a>
      </div>
    @endif

  </div>
</div>

@endsection

