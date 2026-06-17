@extends('layouts.site')
@section('content')

<div class="space-for-header"></div>

{{-- ═══════════════════════════════════════════════════
     HERO BANNER
════════════════════════════════════════════════════ --}}
<section class="blog-hero">
  <div class="blog-hero__bg"></div>
  <div class="blog-hero__inner">
    <nav class="blog-breadcrumb">
      <a href="{{ url('/') }}">Home</a>
      <span class="sep">/</span>
      <span class="active">Blogs</span>
    </nav>
    <h1 class="blog-hero__title">Insights &amp; Articles</h1>
    <p class="blog-hero__sub">Explore the latest trends, expert insights, and recruitment strategies from the Wintech Inc team.</p>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     BLOG LISTING GRID
════════════════════════════════════════════════════ --}}
<section class="blog-main">
  <div class="container">
    <div class="bx-grid">
        @forelse($posts as $index => $post)
        @php
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTime = max(1, ceil($wordCount / 200));
            $cardNum = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
        @endphp

        <article class="bx-card" data-index="{{ $index }}">
            {{-- Glowing orb accent --}}
            <div class="bx-orb"></div>

            {{-- Number badge --}}
            <span class="bx-num">{{ $cardNum }}</span>

            {{-- Image panel --}}
            <div class="bx-img-panel">
                <a href="{{ route('blog.show', $post->slug) }}" tabindex="-1">
                    <img loading="lazy" src="{{ $post->featured_image ? asset($post->featured_image) : asset('assets/images/blog/01.jpg') }}"
                         alt="{{ $post->title }}"
                         class="bx-img">
                </a>
                <div class="bx-img-overlay"></div>
                @if($post->category)
                <span class="bx-cat">{{ $post->category }}</span>
                @endif
            </div>

            {{-- Body --}}
            <div class="bx-body">
                <div class="bx-meta-row">
                    <span class="bx-meta"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</span>
                </div>

                <a href="{{ route('blog.show', $post->slug) }}" class="bx-title-link">
                    <h3 class="bx-title">{{ Str::limit($post->title, 58) }}</h3>
                </a>

                <p class="bx-excerpt">{{ Str::limit($post->excerpt, 100) }}</p>

                <div class="bx-cta">
                    <a href="{{ route('blog.show', $post->slug) }}" class="bx-btn">
                        <span>Read Article</span>
                        <svg class="bx-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        @empty
        <div class="bx-empty">
            <div class="bx-empty-icon"><i class="far fa-newspaper"></i></div>
            <h3>No articles published yet</h3>
            <p>We are currently writing fresh updates. Please check back soon!</p>
            <a href="{{ url('/') }}" class="bx-empty-btn">Return Home</a>
        </div>
        @endforelse
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════ PREMIUM STYLING --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

/* ─── Hero (kept intact) ─── */
.blog-hero {
  position: relative;
  padding: 110px 24px 70px;
  background: url('{{ asset('blog.png') }}') no-repeat center center;
  background-size: cover;
  overflow: hidden;
  z-index: 1;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.blog-hero__bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(7,16,86,0.9) 0%, rgba(9,14,36,0.7) 100%);
  z-index: -1;
}
.blog-breadcrumb {
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.blog-breadcrumb a { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.3s; }
.blog-breadcrumb a:hover { color: #fff; }
.blog-breadcrumb .sep { color: rgba(255,255,255,0.2); }
.blog-breadcrumb .active { color: rgba(255,255,255,0.85); }
.blog-hero__title {
  font-size: clamp(32px, 5vw, 46px);
  font-weight: 800;
  color: #fff;
  margin: 0 0 15px;
  letter-spacing: -1px;
}
.blog-hero__sub {
  font-size: 16px;
  color: #94a3b8;
  margin: 0;
  max-width: 600px;
  line-height: 1.6;
}

/* ─── Main Section ─── */
.blog-main {
  background: #f8fafc;
  padding: 90px 0 100px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  position: relative;
  overflow: hidden;
}
.blog-main::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 60% 50% at 10% 10%, rgba(177,30,36,0.05) 0%, transparent 55%),
    radial-gradient(ellipse 50% 40% at 90% 90%, rgba(7,16,86,0.05) 0%, transparent 55%);
  pointer-events: none;
}

/* ─── Grid ─── */
.bx-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
}
@media (max-width: 992px) { .bx-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 600px)  { .bx-grid { grid-template-columns: 1fr; } }

/* ─── Card Shell ─── */
.bx-card {
  position: relative;
  border-radius: 28px;
  background: #ffffff;
  border: 1px solid rgba(226,232,240,0.9);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 24px rgba(15,23,42,0.05);
  transition: transform 0.45s cubic-bezier(0.23,1,0.32,1),
              box-shadow 0.45s cubic-bezier(0.23,1,0.32,1),
              border-color 0.45s ease;
}
.bx-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 30px 60px rgba(177,30,36,0.12), 0 0 0 1px rgba(177,30,36,0.18);
  border-color: rgba(177,30,36,0.2);
}

/* ─── Glow Orb ─── */
.bx-orb {
  position: absolute;
  top: -60px;
  right: -60px;
  width: 180px;
  height: 180px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(177,30,36,0.18) 0%, transparent 70%);
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.4s ease;
}
.bx-card:hover .bx-orb { opacity: 1; }

/* ─── Number Badge ─── */
.bx-num {
  position: absolute;
  top: 18px;
  right: 18px;
  z-index: 5;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1px;
  color: rgba(7,16,86,0.45);
  background: rgba(255,255,255,0.9);
  border: 1px solid rgba(226,232,240,0.8);
  padding: 4px 10px;
  border-radius: 20px;
  backdrop-filter: blur(8px);
}

/* ─── Image Panel ─── */
.bx-img-panel {
  position: relative;
  overflow: hidden;
  aspect-ratio: 16 / 10;
  flex-shrink: 0;
}
.bx-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.8s cubic-bezier(0.23,1,0.32,1);
}
.bx-card:hover .bx-img { transform: scale(1.07); }

.bx-img-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, transparent 30%, rgba(7,18,43,0.85) 100%);
  pointer-events: none;
}

/* ─── Category Tag ─── */
.bx-cat {
  position: absolute;
  bottom: 16px;
  left: 16px;
  background: #b11e24;
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  padding: 5px 14px;
  border-radius: 30px;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  z-index: 3;
  box-shadow: 0 4px 16px rgba(177,30,36,0.45);
}

/* ─── Card Body ─── */
.bx-body {
  padding: 24px 26px 26px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  background: #ffffff;
}

/* ─── Meta Row ─── */
.bx-meta-row {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}
.bx-meta {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  letter-spacing: 0.3px;
}
.bx-meta i { color: #b11e24; }
.bx-meta-read {
  margin-left: auto;
  background: rgba(177,30,36,0.08);
  color: #b11e24;
  padding: 3px 10px;
  border-radius: 20px;
  border: 1px solid rgba(177,30,36,0.18);
}
.bx-meta-read i { color: #b11e24; }

/* ─── Title ─── */
.bx-title-link { text-decoration: none !important; }
.bx-title {
  font-size: 18.5px;
  font-weight: 800;
  color: #071056;
  line-height: 1.45;
  margin: 0 0 14px;
  letter-spacing: -0.3px;
  transition: color 0.25s ease;
}
.bx-title-link:hover .bx-title { color: #b11e24; }

/* ─── Excerpt ─── */
.bx-excerpt {
  font-size: 13.5px;
  color: #64748b;
  line-height: 1.65;
  margin: 0 0 28px;
  flex-grow: 1;
}

/* ─── CTA Button ─── */
.bx-cta { margin-top: auto; }
.bx-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(177,30,36,0.06);
  border: 1px solid rgba(177,30,36,0.2);
  color: #b11e24;
  font-size: 12.5px;
  font-weight: 800;
  padding: 10px 20px;
  border-radius: 50px;
  text-decoration: none !important;
  letter-spacing: 0.3px;
  transition: all 0.3s cubic-bezier(0.23,1,0.32,1);
  width: fit-content;
}
.bx-btn:hover {
  background: #b11e24;
  border-color: #b11e24;
  color: #fff;
  box-shadow: 0 8px 28px rgba(177,30,36,0.35);
  gap: 14px;
}
.bx-arrow {
  width: 15px;
  height: 15px;
  flex-shrink: 0;
  transition: transform 0.3s ease;
}
.bx-btn:hover .bx-arrow { transform: translateX(3px); }

/* ─── Stagger Fade-Up ─── */
@keyframes bxFadeUp {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}
.bx-card { animation: bxFadeUp 0.55s cubic-bezier(0.23,1,0.32,1) both; }
.bx-card[data-index="0"] { animation-delay: 0.05s; }
.bx-card[data-index="1"] { animation-delay: 0.12s; }
.bx-card[data-index="2"] { animation-delay: 0.19s; }
.bx-card[data-index="3"] { animation-delay: 0.26s; }
.bx-card[data-index="4"] { animation-delay: 0.33s; }
.bx-card[data-index="5"] { animation-delay: 0.40s; }
.bx-card[data-index="6"] { animation-delay: 0.47s; }
.bx-card[data-index="7"] { animation-delay: 0.54s; }
.bx-card[data-index="8"] { animation-delay: 0.61s; }

/* ─── Empty State ─── */
.bx-empty {
  grid-column: 1 / -1;
  text-align: center;
  background: #ffffff;
  border: 1px solid rgba(226,232,240,0.9);
  border-radius: 28px;
  padding: 72px 40px;
  box-shadow: 0 10px 30px rgba(15,23,42,0.05);
}
.bx-empty-icon {
  width: 72px;
  height: 72px;
  background: rgba(177,30,36,0.08);
  border: 1px solid rgba(177,30,36,0.18);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 30px;
  color: #b11e24;
  margin: 0 auto 26px;
}
.bx-empty h3 {
  font-size: 22px;
  font-weight: 800;
  color: #071056;
  margin-bottom: 10px;
}
.bx-empty p {
  color: #64748b;
  font-size: 14.5px;
  margin-bottom: 30px;
}
.bx-empty-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #b11e24;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  padding: 12px 28px;
  border-radius: 50px;
  text-decoration: none !important;
  transition: all 0.3s ease;
  box-shadow: 0 8px 24px rgba(177,30,36,0.3);
}
.bx-empty-btn:hover {
  background: #8c1418;
  color: #fff;
  box-shadow: 0 12px 32px rgba(177,30,36,0.45);
}
</style>

@endsection

