@extends('layouts.site')

@section('content')

<div class="space-for-header"></div>

{{-- ═══════════════════════════════════════════════════
     PAGE HERO
════════════════════════════════════════════════════ --}}
<section class="jb-hero">
  <div class="jb-hero__bg"></div>
  <div class="jb-hero__inner">
    <nav class="jb-breadcrumb" aria-label="Breadcrumb">
      <a href="{{ url('/') }}">Home</a>
      <span class="jb-breadcrumb__sep">/</span>
      <span>Careers</span>
    </nav>
    <h1 class="jb-hero__title">Explore Opportunities</h1>
    <p class="jb-hero__subtitle">Discover roles that match your skills and aspirations</p>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════════════ --}}
<section class="jb-main-section">
  <div class="jb-wrap">
    <div class="jb-grid">

      {{-- ─── SIDEBAR FILTERS ─── --}}
      <aside class="jb-filters" id="desktopSidebar">
        <div class="jb-filters__inner">
          <div class="jb-filters__top">
            <h3 class="jb-filters__heading">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
              Filters
            </h3>
            @php
              $hasActiveFilters = !empty($currentFilters['search']) || !empty($currentFilters['job_type']) || !empty($currentFilters['work_mode']) || !empty($currentFilters['job_function']) || !empty($currentFilters['location']) || !empty($currentFilters['experience']) || !empty($currentFilters['salary_min']) || !empty($currentFilters['salary_max']) || !empty($currentFilters['posted_date']);
            @endphp
            @if($hasActiveFilters)
            <a href="{{ route('jobs.index') }}" class="jb-filters__reset">Clear All</a>
            @endif
          </div>

          <form action="{{ route('jobs.index') }}" method="GET" id="desktopFilterForm">
            @if(!empty($currentFilters['search']))<input type="hidden" name="search" value="{{ $currentFilters['search'] }}">@endif
            @if(!empty($currentFilters['sort_by']))<input type="hidden" name="sort_by" value="{{ $currentFilters['sort_by'] }}">@endif

            {{-- Salary Range --}}
            <div class="jb-fblock open">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Salary Range</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                <div class="jb-salary-inputs">
                  <input type="number" name="salary_min" class="jb-input-sm" placeholder="Min ₹" value="{{ $currentFilters['salary_min'] ?? '' }}">
                  <span>to</span>
                  <input type="number" name="salary_max" class="jb-input-sm" placeholder="Max ₹" value="{{ $currentFilters['salary_max'] ?? '' }}">
                </div>
              </div>
            </div>

            {{-- Job Type --}}
            <div class="jb-fblock open">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Job Type</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @forelse($jobTypes->filter() as $type)
                <label class="jb-checkbox">
                  <input type="checkbox" name="job_type[]" value="{{ $type }}" {{ in_array($type,(array)($currentFilters['job_type']??[])) ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark"></span>
                  <span class="jb-checkbox__text">{{ $type }}</span>
                </label>
                @empty<p class="jb-no-opt">No options</p>@endforelse
              </div>
            </div>

            {{-- Work Mode --}}
            <div class="jb-fblock open">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Work Mode</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @forelse($workModes->filter() as $mode)
                <label class="jb-checkbox">
                  <input type="checkbox" name="work_mode[]" value="{{ $mode }}" {{ in_array($mode,(array)($currentFilters['work_mode']??[])) ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark"></span>
                  <span class="jb-checkbox__text">{{ $mode }}</span>
                </label>
                @empty<p class="jb-no-opt">No options</p>@endforelse
              </div>
            </div>

            {{-- Job Functions --}}
            <div class="jb-fblock">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Job Function</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @forelse($jobFunctions->filter() as $fn)
                <label class="jb-checkbox">
                  <input type="checkbox" name="job_function[]" value="{{ $fn }}" {{ in_array($fn,(array)($currentFilters['job_function']??[])) ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark"></span>
                  <span class="jb-checkbox__text">{{ $fn }}</span>
                </label>
                @empty<p class="jb-no-opt">No options</p>@endforelse
              </div>
            </div>

            {{-- Experience --}}
            <div class="jb-fblock">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Experience</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @forelse($experiences->filter() as $exp)
                <label class="jb-checkbox">
                  <input type="checkbox" name="experience[]" value="{{ $exp }}" {{ in_array($exp,(array)($currentFilters['experience']??[])) ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark"></span>
                  <span class="jb-checkbox__text">{{ $exp }}</span>
                </label>
                @empty<p class="jb-no-opt">No options</p>@endforelse
              </div>
            </div>

            {{-- Location --}}
            <div class="jb-fblock">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Location</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @forelse($locations->filter() as $loc)
                <label class="jb-checkbox">
                  <input type="checkbox" name="location[]" value="{{ $loc }}" {{ in_array($loc,(array)($currentFilters['location']??[])) ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark"></span>
                  <span class="jb-checkbox__text">{{ $loc }}</span>
                </label>
                @empty<p class="jb-no-opt">No options</p>@endforelse
              </div>
            </div>

            {{-- Date Posted --}}
            <div class="jb-fblock">
              <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
                <span>Date Posted</span>
                <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="jb-fblock__body">
                @foreach(['last_24_hours'=>'Last 24 Hours','last_7_days'=>'Last 7 Days','last_30_days'=>'Last 30 Days'] as $val=>$label)
                <label class="jb-checkbox">
                  <input type="radio" name="posted_date" value="{{ $val }}" {{ ($currentFilters['posted_date']??'')==$val ? 'checked' : '' }}>
                  <span class="jb-checkbox__mark jb-checkbox__mark--radio"></span>
                  <span class="jb-checkbox__text">{{ $label }}</span>
                </label>
                @endforeach
              </div>
            </div>

            <div class="jb-filters__submit">
              <button type="submit" class="jb-btn">Apply Filters</button>
            </div>
          </form>
        </div>
      </aside>

      {{-- ─── MAIN CONTENT AREA ─── --}}
      <div class="jb-content">

        {{-- Search Bar --}}
        <form action="{{ route('jobs.index') }}" method="GET" id="mainSearchForm">
          <div class="jb-search">
            <svg class="jb-search__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="search" class="jb-search__input" placeholder="Search by title, company, or keyword..." value="{{ $currentFilters['search'] ?? '' }}">
            @if(!empty($currentFilters['search']))
            <button type="button" class="jb-search__clear" onclick="removeFilter('search')">×</button>
            @endif
            <button type="submit" class="jb-search__btn">Search</button>

            {{-- Mobile filter toggle --}}
            <button type="button" class="jb-mobile-filter-btn" onclick="openMobileFilters()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
              @php $activeCount = count((array)($currentFilters['job_type']??[])) + count((array)($currentFilters['work_mode']??[])) + count((array)($currentFilters['job_function']??[])) + count((array)($currentFilters['location']??[])) + count((array)($currentFilters['experience']??[])) + (!empty($currentFilters['posted_date']) ? 1 : 0) + (!empty($currentFilters['salary_min']) || !empty($currentFilters['salary_max']) ? 1 : 0); @endphp
              @if($activeCount > 0)<span class="jb-mobile-filter-btn__badge">{{ $activeCount }}</span>@endif
            </button>
          </div>

          {{-- Hidden filter state --}}
          <input type="hidden" name="sort_by" value="{{ $currentFilters['sort_by'] ?? 'featured' }}">
          @foreach((array)($currentFilters['job_type'] ?? []) as $v)<input type="hidden" name="job_type[]" value="{{ $v }}">@endforeach
          @foreach((array)($currentFilters['work_mode'] ?? []) as $v)<input type="hidden" name="work_mode[]" value="{{ $v }}">@endforeach
          @foreach((array)($currentFilters['job_function'] ?? []) as $v)<input type="hidden" name="job_function[]" value="{{ $v }}">@endforeach
          @foreach((array)($currentFilters['location'] ?? []) as $v)<input type="hidden" name="location[]" value="{{ $v }}">@endforeach
          @foreach((array)($currentFilters['experience'] ?? []) as $v)<input type="hidden" name="experience[]" value="{{ $v }}">@endforeach
          @if(!empty($currentFilters['salary_min']))<input type="hidden" name="salary_min" value="{{ $currentFilters['salary_min'] }}">@endif
          @if(!empty($currentFilters['salary_max']))<input type="hidden" name="salary_max" value="{{ $currentFilters['salary_max'] }}">@endif
          @if(!empty($currentFilters['posted_date']))<input type="hidden" name="posted_date" value="{{ $currentFilters['posted_date'] }}">@endif
        </form>

        {{-- Active Filters --}}
        @if($hasActiveFilters)
        <div class="jb-active-tags">
          @if(!empty($currentFilters['search']))
            <span class="jb-tag">"{{ $currentFilters['search'] }}" <button onclick="removeFilter('search')">×</button></span>
          @endif
          @foreach((array)($currentFilters['job_type'] ?? []) as $type)
            <span class="jb-tag">{{ $type }} <button onclick="removeArrayFilter('job_type', '{{ $type }}')">×</button></span>
          @endforeach
          @foreach((array)($currentFilters['work_mode'] ?? []) as $mode)
            <span class="jb-tag">{{ $mode }} <button onclick="removeArrayFilter('work_mode', '{{ $mode }}')">×</button></span>
          @endforeach
          @foreach((array)($currentFilters['job_function'] ?? []) as $fn)
            <span class="jb-tag">{{ $fn }} <button onclick="removeArrayFilter('job_function', '{{ $fn }}')">×</button></span>
          @endforeach
          @foreach((array)($currentFilters['location'] ?? []) as $loc)
            <span class="jb-tag">{{ $loc }} <button onclick="removeArrayFilter('location', '{{ $loc }}')">×</button></span>
          @endforeach
          @foreach((array)($currentFilters['experience'] ?? []) as $exp)
            <span class="jb-tag">{{ $exp }} <button onclick="removeArrayFilter('experience', '{{ $exp }}')">×</button></span>
          @endforeach
          @if(!empty($currentFilters['salary_min']) || !empty($currentFilters['salary_max']))
            <span class="jb-tag">₹{{ number_format($currentFilters['salary_min'] ?? 0) }} – ₹{{ number_format($currentFilters['salary_max'] ?? 0) }} <button onclick="removeSalaryFilter()">×</button></span>
          @endif
          @if(!empty($currentFilters['posted_date']))
            <span class="jb-tag">{{ str_replace('_',' ',ucwords($currentFilters['posted_date'],'_')) }} <button onclick="removeFilter('posted_date')">×</button></span>
          @endif
          <a href="{{ route('jobs.index') }}" class="jb-tag jb-tag--clear">Clear All</a>
        </div>
        @endif

        {{-- Results Header --}}
        <div class="jb-toolbar">
          <span class="jb-toolbar__count"><strong>{{ $jobs->total() }}</strong> job{{ $jobs->total() != 1 ? 's' : '' }} found</span>
          <select class="jb-toolbar__sort" onchange="updateSort(this.value)">
            <option value="featured" {{ ($currentFilters['sort_by'] ?? 'featured') == 'featured' ? 'selected' : '' }}>Featured</option>
            <option value="newest" {{ ($currentFilters['sort_by'] ?? 'featured') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="oldest" {{ ($currentFilters['sort_by'] ?? 'featured') == 'oldest' ? 'selected' : '' }}>Oldest</option>
          </select>
        </div>

        {{-- Job Listings --}}
        <div class="jb-listings">
          @forelse($jobs as $job)
          @php
            $typeSlug = strtolower(str_replace(' ', '-', $job->job_type ?? 'full-time'));
            $typeColors = [
              'full-time'  => '#059669',
              'part-time'  => '#ea580c',
              'internship' => '#2563eb',
              'contract'   => '#9333ea',
              'remote'     => '#0d9488',
            ];
            $tc = $typeColors[$typeSlug] ?? '#059669';
          @endphp
          <a href="{{ route('jobs.show', $job->id) }}" class="jb-item">
            <div class="jb-item__left">
              <div class="jb-item__logo">
                @if($job->company_logo)
                  <img src="{{ asset($job->company_logo) }}" alt="{{ $job->company_name }}">
                @else
                  <span class="jb-item__logo-letter">{{ strtoupper(substr($job->company_name ?? 'C', 0, 1)) }}</span>
                @endif
              </div>
            </div>
            <div class="jb-item__center">
              <h3 class="jb-item__title">{{ $job->job_title }}</h3>
              <div class="jb-item__info">
                <span class="jb-item__company">{{ $job->company_name ?? 'Company' }}</span>
                <span class="jb-item__dot">•</span>
                <span class="jb-item__loc">{{ $job->job_location ?? 'Location not specified' }}</span>
                @if($job->work_mode)
                <span class="jb-item__dot">•</span>
                <span>{{ $job->work_mode }}</span>
                @endif
              </div>
              <div class="jb-item__tags">
                <span class="jb-item__type" style="color:{{ $tc }}; background: {{ $tc }}15; border-color: {{ $tc }}30;">{{ $job->job_type ?? 'Full-Time' }}</span>
                @if($job->experience)
                <span class="jb-item__exp">{{ $job->experience }}</span>
                @endif
                @if($job->vacancies)
                <span class="jb-item__exp">{{ $job->vacancies }} Opening{{ $job->vacancies > 1 ? 's' : '' }}</span>
                @endif
              </div>
            </div>
            <div class="jb-item__right">
              <div class="jb-item__salary">
                @if($job->salary_from && $job->salary_to)
                  ₹{{ number_format($job->salary_from/100000, 1) }}L – ₹{{ number_format($job->salary_to/100000, 1) }}L
                  <small>/year</small>
                @else
                  Not Disclosed
                @endif
              </div>
              <span class="jb-item__arrow">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
              </span>
            </div>
          </a>
          @empty
          <div class="jb-empty">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
            <h4>No jobs match your criteria</h4>
            <p>Try adjusting your filters or search terms.</p>
            <a href="{{ route('jobs.index') }}" class="jb-btn">Reset Filters</a>
          </div>
          @endforelse
        </div>

        {{-- Pagination --}}
        @if($jobs->hasPages())
        <div class="jb-pagination">
          {{ $jobs->appends($currentFilters)->links('pagination::bootstrap-4') }}
        </div>
        @endif

      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MOBILE FILTER DRAWER
════════════════════════════════════════════════════ --}}
<div class="jb-mob-overlay" id="mobOverlay" onclick="closeMobileFilters()"></div>
<div class="jb-mob-drawer" id="mobDrawer">
  <div class="jb-mob-drawer__head">
    <h4>Filters</h4>
    <button onclick="closeMobileFilters()">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <form action="{{ route('jobs.index') }}" method="GET" id="mobileFilterForm">
    @if(!empty($currentFilters['search']))<input type="hidden" name="search" value="{{ $currentFilters['search'] }}">@endif
    @if(!empty($currentFilters['sort_by']))<input type="hidden" name="sort_by" value="{{ $currentFilters['sort_by'] }}">@endif

    <div class="jb-mob-drawer__body">
      {{-- Salary --}}
      <div class="jb-fblock open">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Salary Range</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          <div class="jb-salary-inputs">
            <input type="number" name="salary_min" class="jb-input-sm" placeholder="Min ₹" value="{{ $currentFilters['salary_min'] ?? '' }}">
            <span>to</span>
            <input type="number" name="salary_max" class="jb-input-sm" placeholder="Max ₹" value="{{ $currentFilters['salary_max'] ?? '' }}">
          </div>
        </div>
      </div>

      {{-- Job Type --}}
      <div class="jb-fblock open">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Job Type</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @forelse($jobTypes->filter() as $type)
          <label class="jb-checkbox">
            <input type="checkbox" name="job_type[]" value="{{ $type }}" {{ in_array($type,(array)($currentFilters['job_type']??[])) ? 'checked' : '' }}>
            <span class="jb-checkbox__mark"></span>
            <span class="jb-checkbox__text">{{ $type }}</span>
          </label>
          @empty<p class="jb-no-opt">No options</p>@endforelse
        </div>
      </div>

      {{-- Work Mode --}}
      <div class="jb-fblock open">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Work Mode</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @forelse($workModes->filter() as $mode)
          <label class="jb-checkbox">
            <input type="checkbox" name="work_mode[]" value="{{ $mode }}" {{ in_array($mode,(array)($currentFilters['work_mode']??[])) ? 'checked' : '' }}>
            <span class="jb-checkbox__mark"></span>
            <span class="jb-checkbox__text">{{ $mode }}</span>
          </label>
          @empty<p class="jb-no-opt">No options</p>@endforelse
        </div>
      </div>

      {{-- Job Functions --}}
      <div class="jb-fblock">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Job Function</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @forelse($jobFunctions->filter() as $fn)
          <label class="jb-checkbox">
            <input type="checkbox" name="job_function[]" value="{{ $fn }}" {{ in_array($fn,(array)($currentFilters['job_function']??[])) ? 'checked' : '' }}>
            <span class="jb-checkbox__mark"></span>
            <span class="jb-checkbox__text">{{ $fn }}</span>
          </label>
          @empty<p class="jb-no-opt">No options</p>@endforelse
        </div>
      </div>

      {{-- Experience --}}
      <div class="jb-fblock">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Experience</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @forelse($experiences->filter() as $exp)
          <label class="jb-checkbox">
            <input type="checkbox" name="experience[]" value="{{ $exp }}" {{ in_array($exp,(array)($currentFilters['experience']??[])) ? 'checked' : '' }}>
            <span class="jb-checkbox__mark"></span>
            <span class="jb-checkbox__text">{{ $exp }}</span>
          </label>
          @empty<p class="jb-no-opt">No options</p>@endforelse
        </div>
      </div>

      {{-- Location --}}
      <div class="jb-fblock">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Location</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @forelse($locations->filter() as $loc)
          <label class="jb-checkbox">
            <input type="checkbox" name="location[]" value="{{ $loc }}" {{ in_array($loc,(array)($currentFilters['location']??[])) ? 'checked' : '' }}>
            <span class="jb-checkbox__mark"></span>
            <span class="jb-checkbox__text">{{ $loc }}</span>
          </label>
          @empty<p class="jb-no-opt">No options</p>@endforelse
        </div>
      </div>

      {{-- Date Posted --}}
      <div class="jb-fblock">
        <button type="button" class="jb-fblock__head" onclick="this.closest('.jb-fblock').classList.toggle('open')">
          <span>Date Posted</span>
          <svg class="jb-fblock__arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="jb-fblock__body">
          @foreach(['last_24_hours'=>'Last 24 Hours','last_7_days'=>'Last 7 Days','last_30_days'=>'Last 30 Days'] as $val=>$label)
          <label class="jb-checkbox">
            <input type="radio" name="posted_date" value="{{ $val }}" {{ ($currentFilters['posted_date']??'')==$val ? 'checked' : '' }}>
            <span class="jb-checkbox__mark jb-checkbox__mark--radio"></span>
            <span class="jb-checkbox__text">{{ $label }}</span>
          </label>
          @endforeach
        </div>
      </div>
    </div>

    <div class="jb-mob-drawer__foot">
      <a href="{{ route('jobs.index') }}" class="jb-btn jb-btn--outline">Reset</a>
      <button type="submit" class="jb-btn">Apply</button>
    </div>
  </form>
</div>

{{-- ═══════════════════════════════════════════════════ STYLES --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

:root {
  --jb-primary: #b11e24;
  --jb-primary-dark: #c93516;
  --jb-primary-light: #fff4f1;
  --jb-dark: #1a1a2e;
  --jb-text: #2d2d3a;
  --jb-muted: #6e6e80;
  --jb-border: #ebebf0;
  --jb-bg: #f5f5f8;
  --jb-white: #ffffff;
  --jb-radius: 12px;
  --jb-font: 'DM Sans', sans-serif;
}

/* ── HERO ──────────────────────────────── */
.jb-hero {
  position: relative;
  padding: 115px 24px 60px;
  background: var(--jb-dark);
  overflow: hidden;
}
.jb-hero__bg {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(7, 16, 86, 0.82), rgba(7, 16, 86, 0.82)), url('/job.jpg');
  background-size: cover;
  background-position: center;
}
.jb-hero__inner {
  position: relative;
  max-width: 1280px;
  margin: 0 auto;
}
.jb-breadcrumb {
  font-family: var(--jb-font);
  font-size: 13px;
  margin-bottom: 16px;
}
.jb-breadcrumb a {
  color: rgba(255,255,255,.5);
  text-decoration: none;
  transition: color .2s;
}
.jb-breadcrumb a:hover { color: #fff; }
.jb-breadcrumb__sep { color: rgba(255,255,255,.3); margin: 0 8px; }
.jb-breadcrumb span { color: rgba(255,255,255,.8); }
.jb-hero__title {
  font-family: var(--jb-font);
  font-size: clamp(28px, 4vw, 44px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 10px;
  letter-spacing: -0.5px;
}
.jb-hero__subtitle {
  font-family: var(--jb-font);
  font-size: 16px;
  color: rgba(255,255,255,.55);
  margin: 0;
  font-weight: 400;
}

/* ── MAIN SECTION ──────────────────────── */
.jb-main-section {
  background: var(--jb-bg);
  padding: 40px 0 80px;
}
.jb-wrap {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}
.jb-grid {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 28px;
  align-items: start;
}

/* ── SIDEBAR ───────────────────────────── */
.jb-filters {
  position: sticky;
  top: 90px;
}
.jb-filters__inner {
  background: var(--jb-white);
  border: 1px solid var(--jb-border);
  border-radius: var(--jb-radius);
  overflow: hidden;
}
.jb-filters__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 20px;
  border-bottom: 1px solid var(--jb-border);
}
.jb-filters__heading {
  font-family: var(--jb-font);
  font-size: 15px;
  font-weight: 700;
  color: var(--jb-dark);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.jb-filters__heading svg { color: var(--jb-primary); }
.jb-filters__reset {
  font-family: var(--jb-font);
  font-size: 12px;
  font-weight: 600;
  color: var(--jb-primary);
  text-decoration: none;
  transition: opacity .2s;
}
.jb-filters__reset:hover { opacity: .7; }

/* Filter blocks */
.jb-fblock { border-bottom: 1px solid var(--jb-border); }
.jb-fblock:last-of-type { border-bottom: none; }
.jb-fblock__head {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 20px;
  background: none;
  border: none;
  cursor: pointer;
  font-family: var(--jb-font);
  font-size: 13px;
  font-weight: 600;
  color: var(--jb-text);
  transition: color .2s;
}
.jb-fblock__head:hover { color: var(--jb-primary); }
.jb-fblock__arrow {
  color: var(--jb-muted);
  transition: transform .25s;
}
.jb-fblock.open .jb-fblock__arrow { transform: rotate(180deg); }
.jb-fblock__body {
  display: none;
  padding: 0 20px 16px;
}
.jb-fblock.open .jb-fblock__body { display: block; }

/* Checkbox / Radio */
.jb-checkbox {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 0;
  cursor: pointer;
  user-select: none;
}
.jb-checkbox input { display: none; }
.jb-checkbox__mark {
  width: 16px;
  height: 16px;
  border: 2px solid #d1d5db;
  border-radius: 4px;
  flex-shrink: 0;
  position: relative;
  transition: all .2s;
}
.jb-checkbox__mark--radio { border-radius: 50%; }
.jb-checkbox input:checked ~ .jb-checkbox__mark {
  background: var(--jb-primary);
  border-color: var(--jb-primary);
}
.jb-checkbox input:checked ~ .jb-checkbox__mark::after {
  content: '';
  position: absolute;
  top: 2px; left: 4px;
  width: 4px; height: 7px;
  border: solid #fff;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}
.jb-checkbox input:checked ~ .jb-checkbox__mark--radio::after {
  top: 50%; left: 50%;
  width: 6px; height: 6px;
  border: none;
  background: #fff;
  border-radius: 50%;
  transform: translate(-50%,-50%);
}
.jb-checkbox__text {
  font-family: var(--jb-font);
  font-size: 13px;
  color: var(--jb-muted);
  font-weight: 500;
  transition: color .2s;
}
.jb-checkbox input:checked ~ .jb-checkbox__text { color: var(--jb-primary); font-weight: 600; }

.jb-salary-inputs {
  display: flex;
  align-items: center;
  gap: 8px;
}
.jb-salary-inputs span {
  font-size: 12px;
  color: var(--jb-muted);
}
.jb-input-sm {
  flex: 1;
  padding: 9px 12px;
  border: 1.5px solid var(--jb-border);
  border-radius: 8px;
  font-family: var(--jb-font);
  font-size: 13px;
  color: var(--jb-text);
  outline: none;
  transition: border-color .2s;
  width: 100%;
  min-width: 0;
}
.jb-input-sm:focus { border-color: var(--jb-primary); }

.jb-no-opt { font-size: 12px; color: #aaa; margin: 4px 0 0; font-style: italic; }
.jb-filters__submit { padding: 16px 20px; }

/* ── BUTTON ────────────────────────────── */
.jb-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 24px;
  background: var(--jb-primary);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-family: var(--jb-font);
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: background .2s, transform .15s;
  width: 100%;
}
.jb-btn:hover { background: var(--jb-primary-dark); transform: translateY(-1px); color: #fff; }
.jb-btn--outline {
  background: transparent;
  border: 1.5px solid var(--jb-border);
  color: var(--jb-muted);
}
.jb-btn--outline:hover { border-color: var(--jb-primary); color: var(--jb-primary); background: transparent; }

/* ── SEARCH ────────────────────────────── */
.jb-search {
  display: flex;
  align-items: center;
  background: var(--jb-white);
  border: 1.5px solid var(--jb-border);
  border-radius: var(--jb-radius);
  padding: 4px 4px 4px 16px;
  gap: 10px;
  transition: border-color .2s, box-shadow .2s;
  margin-bottom: 20px;
}
.jb-search:focus-within {
  border-color: var(--jb-primary);
  box-shadow: 0 0 0 3px rgba(232,73,36,.08);
}
.jb-search__icon { color: var(--jb-muted); flex-shrink: 0; }
.jb-search__input {
  flex: 1;
  border: none;
  outline: none;
  font-family: var(--jb-font);
  font-size: 14px;
  color: var(--jb-text);
  background: transparent;
  min-width: 0;
  padding: 12px 8px 12px 0;
  width: 100%;
}
.jb-search__input::placeholder { color: #aaa; }
.jb-search__clear {
  background: none;
  border: none;
  font-size: 20px;
  color: var(--jb-muted);
  cursor: pointer;
  line-height: 1;
  padding: 0 4px;
}
.jb-search__clear:hover { color: #ef4444; }
.jb-search__btn {
  padding: 8px 16px;
  background: var(--jb-primary);
  color: #fff;
  border: none;
  border-radius: 8px;
  font-family: var(--jb-font);
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: background .2s;
  white-space: nowrap;
  flex: 0 0 auto;
  max-width: 80px;
}
.jb-search__btn:hover { background: var(--jb-primary-dark); }

.jb-mobile-filter-btn {
  display: none;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: 9px;
  border: 1.5px solid var(--jb-border);
  background: var(--jb-white);
  cursor: pointer;
  color: var(--jb-text);
  flex-shrink: 0;
  position: relative;
  transition: border-color .2s;
}
.jb-mobile-filter-btn:hover { border-color: var(--jb-primary); color: var(--jb-primary); }
.jb-mobile-filter-btn__badge {
  position: absolute;
  top: -5px; right: -5px;
  width: 18px; height: 18px;
  background: var(--jb-primary);
  color: #fff;
  font-size: 10px;
  font-weight: 700;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ── ACTIVE TAGS ───────────────────────── */
.jb-active-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 20px;
}
.jb-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  background: var(--jb-primary-light);
  color: var(--jb-primary);
  border-radius: 6px;
  font-family: var(--jb-font);
  font-size: 12px;
  font-weight: 600;
  white-space: nowrap;
}
.jb-tag button {
  background: none;
  border: none;
  color: inherit;
  font-size: 15px;
  cursor: pointer;
  padding: 0;
  line-height: 1;
  opacity: .7;
  transition: opacity .2s;
}
.jb-tag button:hover { opacity: 1; }
.jb-tag--clear {
  background: transparent;
  border: 1px dashed var(--jb-border);
  color: var(--jb-muted);
  text-decoration: none;
  transition: all .2s;
}
.jb-tag--clear:hover { border-color: #ef4444; color: #ef4444; }

/* ── TOOLBAR ───────────────────────────── */
.jb-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
}
.jb-toolbar__count {
  font-family: var(--jb-font);
  font-size: 13px;
  color: var(--jb-muted);
}
.jb-toolbar__count strong { color: var(--jb-dark); font-weight: 700; }
.jb-toolbar__sort {
  padding: 8px 12px;
  border: 1.5px solid var(--jb-border);
  border-radius: 8px;
  font-family: var(--jb-font);
  font-size: 13px;
  font-weight: 500;
  color: var(--jb-text);
  background: var(--jb-white);
  outline: none;
  cursor: pointer;
}
.jb-toolbar__sort:focus { border-color: var(--jb-primary); }

/* ── JOB LISTING ITEM ──────────────────── */
.jb-listings { display: flex; flex-direction: column; gap: 12px; }

.jb-item {
  display: flex;
  align-items: center;
  gap: 18px;
  padding: 22px 24px;
  background: var(--jb-white);
  border: 1px solid var(--jb-border);
  border-radius: var(--jb-radius);
  text-decoration: none;
  color: inherit;
  transition: border-color .2s, box-shadow .25s, transform .25s;
}
.jb-item:hover {
  border-color: rgba(232,73,36,.3);
  box-shadow: 0 8px 30px rgba(232,73,36,.08);
  transform: translateY(-2px);
}

.jb-item__logo {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  border: 1px solid var(--jb-border);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  background: var(--jb-white);
}
.jb-item__logo img { width: 100%; height: 100%; object-fit: contain; }
.jb-item__logo-letter {
  width: 100%; height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--jb-primary), var(--jb-primary-dark));
  color: #fff;
  font-family: var(--jb-font);
  font-size: 20px;
  font-weight: 700;
}

.jb-item__center { flex: 1; min-width: 0; }
.jb-item__title {
  font-family: var(--jb-font);
  font-size: 16px;
  font-weight: 700;
  color: var(--jb-dark);
  margin: 0 0 6px;
  transition: color .2s;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.jb-item:hover .jb-item__title { color: var(--jb-primary); }
.jb-item__info {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
  font-family: var(--jb-font);
  font-size: 13px;
  color: var(--jb-muted);
  margin-bottom: 8px;
}
.jb-item__dot { color: #d1d5db; }
.jb-item__company { font-weight: 500; }
.jb-item__tags { display: flex; flex-wrap: wrap; gap: 6px; }
.jb-item__type {
  font-family: var(--jb-font);
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 5px;
  border: 1px solid;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}
.jb-item__exp {
  font-family: var(--jb-font);
  font-size: 11px;
  font-weight: 500;
  padding: 4px 10px;
  border-radius: 5px;
  background: var(--jb-bg);
  color: var(--jb-muted);
  border: 1px solid var(--jb-border);
}

.jb-item__right {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 8px;
  flex-shrink: 0;
}
.jb-item__salary {
  font-family: var(--jb-font);
  font-size: 14px;
  font-weight: 700;
  color: var(--jb-dark);
  white-space: nowrap;
}
.jb-item__salary small { font-weight: 400; color: var(--jb-muted); font-size: 11px; }
.jb-item__arrow {
  width: 32px; height: 32px;
  border-radius: 8px;
  background: var(--jb-bg);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--jb-muted);
  transition: all .2s;
}
.jb-item:hover .jb-item__arrow { background: var(--jb-primary); color: #fff; }

/* ── EMPTY STATE ───────────────────────── */
.jb-empty {
  text-align: center;
  padding: 80px 24px;
  background: var(--jb-white);
  border: 1px solid var(--jb-border);
  border-radius: var(--jb-radius);
}
.jb-empty svg { color: var(--jb-primary); margin-bottom: 20px; }
.jb-empty h4 { font-family: var(--jb-font); font-size: 20px; font-weight: 700; color: var(--jb-dark); margin: 0 0 8px; }
.jb-empty p { font-family: var(--jb-font); font-size: 14px; color: var(--jb-muted); margin: 0 0 24px; }
.jb-empty .jb-btn { width: auto; display: inline-flex; }

/* ── PAGINATION ────────────────────────── */
.jb-pagination { margin-top: 32px; display: flex; justify-content: center; }
.jb-pagination .pagination .page-link {
  font-family: var(--jb-font);
  font-size: 13px;
  font-weight: 600;
  border-radius: 8px !important;
  margin: 0 2px;
  border-color: var(--jb-border);
  color: var(--jb-text);
}
.jb-pagination .pagination .page-item.active .page-link {
  background: var(--jb-primary);
  border-color: var(--jb-primary);
}

/* ── MOBILE DRAWER ─────────────────────── */
.jb-mob-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.5);
  z-index: 9998;
  opacity: 0; visibility: hidden;
  transition: all .3s;
}
.jb-mob-overlay.active { opacity: 1; visibility: visible; }

.jb-mob-drawer {
  position: fixed;
  top: 0; right: 0; bottom: 0;
  width: 320px;
  max-width: 85vw;
  background: var(--jb-white);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  transform: translateX(100%);
  transition: transform .35s cubic-bezier(.4,0,.2,1);
  box-shadow: -8px 0 30px rgba(0,0,0,.1);
}
.jb-mob-drawer.open { transform: translateX(0); }

.jb-mob-drawer__head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
  border-bottom: 1px solid var(--jb-border);
}
.jb-mob-drawer__head h4 {
  margin: 0;
  font-family: var(--jb-font);
  font-size: 17px;
  font-weight: 700;
  color: var(--jb-dark);
}
.jb-mob-drawer__head button {
  width: 36px; height: 36px;
  border-radius: 8px;
  border: none;
  background: var(--jb-bg);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--jb-muted);
  transition: all .2s;
}
.jb-mob-drawer__head button:hover { background: #fee2e2; color: #ef4444; }

.jb-mob-drawer__body {
  flex: 1;
  overflow-y: auto;
  padding: 8px 0;
}
.jb-mob-drawer__body .jb-fblock__head { padding: 14px 20px; }
.jb-mob-drawer__body .jb-fblock__body { padding: 0 20px 14px; }

.jb-mob-drawer__foot {
  display: flex;
  gap: 10px;
  padding: 16px 20px;
  border-top: 1px solid var(--jb-border);
}
.jb-mob-drawer__foot .jb-btn { flex: 1; }
.jb-mob-drawer__foot .jb-btn--outline { flex: 0 0 auto; width: auto; padding: 12px 20px; }

/* ── RESPONSIVE ────────────────────────── */
@media(max-width:991px) {
  .jb-grid { grid-template-columns: 1fr; }
  .jb-filters { display: none; }
  .jb-mobile-filter-btn { display: flex; }
}
@media(max-width:640px) {
  .jb-item { flex-direction: column; align-items: flex-start; gap: 12px; padding: 18px; }
  .jb-item__right { flex-direction: row; align-items: center; width: 100%; justify-content: space-between; }
  .jb-hero { padding: 50px 16px 40px; }
  .jb-main-section { padding: 24px 0 60px; }
  .jb-wrap { padding: 0 16px; }
  .jb-item__title { white-space: normal; }
  .jb-search__btn { padding: 8px 14px; font-size: 12px; max-width: 70px; }
}
@media(min-width:992px) {
  .jb-mob-overlay, .jb-mob-drawer { display: none !important; }
}

@media(prefers-reduced-motion:reduce) {
  *, *::before, *::after { transition: none !important; }
}
</style>

{{-- ═══════════════════════════════════════════════════ SCRIPTS --}}
<script>
function openMobileFilters() {
  document.getElementById('mobDrawer').classList.add('open');
  document.getElementById('mobOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
}
function closeMobileFilters() {
  document.getElementById('mobDrawer').classList.remove('open');
  document.getElementById('mobOverlay').classList.remove('active');
  document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMobileFilters(); });

function updateSort(val) {
  const u = new URL(window.location.href);
  u.searchParams.set('sort_by', val);
  window.location.href = u.toString();
}
function removeFilter(name) {
  const u = new URL(window.location.href);
  u.searchParams.delete(name);
  window.location.href = u.toString();
}
function removeArrayFilter(name, val) {
  const u = new URL(window.location.href);
  const rest = u.searchParams.getAll(name + '[]').filter(v => v !== val);
  u.searchParams.delete(name + '[]');
  rest.forEach(v => u.searchParams.append(name + '[]', v));
  window.location.href = u.toString();
}
function removeSalaryFilter() {
  const u = new URL(window.location.href);
  u.searchParams.delete('salary_min');
  u.searchParams.delete('salary_max');
  window.location.href = u.toString();
}
</script>

@endsection
