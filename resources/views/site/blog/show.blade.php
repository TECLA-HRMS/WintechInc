@extends('layouts.site')
@section('content')

@php
    $wordCount = str_word_count(strip_tags($post->content));
    $readingTime = max(1, ceil($wordCount / 200));
@endphp

{{-- ════════════════════════════════════════════════════
     CINEMATIC HERO BANNER
═════════════════════════════════════════════════════ --}}
<div class="bd-hero" style="background-image: url('{{ $post->featured_image ? asset($post->featured_image) : asset('blog.png') }}');">
    <div class="bd-hero__overlay"></div>
    <div class="bd-hero__particles">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
    <div class="container position-relative" style="z-index:3;">
        {{-- Breadcrumb --}}
        <nav class="bd-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            <a href="{{ route('blog.index') }}">Blog</a>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            <span>{{ Str::limit($post->title, 38) }}</span>
        </nav>

        {{-- Pills --}}
        <div class="bd-hero__pills">
            @if($post->category)
            <span class="bd-pill bd-pill--cat"><i class="fas fa-tag"></i> {{ $post->category }}</span>
            @endif
            <span class="bd-pill"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('d M, Y') }}</span>
            <span class="bd-pill"><i class="far fa-clock"></i> {{ $readingTime }} min read</span>
        </div>

        {{-- Title --}}
        <h1 class="bd-hero__title">{{ $post->title }}</h1>

        {{-- Reading progress line --}}
        <div class="bd-hero__divider">
            <span class="bd-hero__divider-bar"></span>
        </div>
    </div>
</div>

{{-- Reading progress indicator --}}
<div class="bd-progress-bar" id="bdProgressBar"></div>

{{-- ════════════════════════════════════════════════════
     MAIN BODY
═════════════════════════════════════════════════════ --}}
<section class="bd-body">
    <div class="container">
        <div class="row g-4 g-xl-5">

            {{-- ── Article Column ── --}}
            <div class="col-xl-8 col-lg-8 col-md-12">

                {{-- Featured Image --}}
                @if($post->featured_image)
                <div class="bd-featured-img">
                    <img loading="lazy" src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                    <div class="bd-featured-img__shine"></div>
                </div>
                @endif

                {{-- Article Card --}}
                <article class="bd-article">
                    <div class="bd-article__content">
                        {!! $post->content !!}
                    </div>

                    {{-- Gallery --}}
                    @if($post->additional_images && count(json_decode($post->additional_images)) > 0)
                    <div class="bd-gallery">
                        <h4 class="bd-gallery__heading"><i class="fas fa-images"></i> Media Gallery</h4>
                        <div class="row g-3">
                            @foreach(json_decode($post->additional_images) as $img)
                            <div class="col-md-6 col-sm-12">
                                <div class="bd-gallery__item">
                                    <img loading="lazy" src="{{ asset($img) }}" alt="Gallery image">
                                    <div class="bd-gallery__item-overlay"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Share Row --}}
                    <div class="bd-share-row">
                        <span class="bd-share-label">Share this article</span>
                        <div class="bd-share-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="bd-share-btn bd-share-btn--fb" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="bd-share-btn bd-share-btn--tw" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="bd-share-btn bd-share-btn--li" title="Share on LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <button class="bd-share-btn bd-share-btn--copy" onclick="copyLink()" title="Copy link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </article>

                {{-- Back to Blog --}}
                <div class="bd-back-row">
                    <a href="{{ route('blog.index') }}" class="bd-back-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Back to all articles
                    </a>
                </div>
            </div>

            {{-- ── Sidebar Column ── --}}
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="bd-sidebar">

                    {{-- Search --}}
                    <div class="bd-widget">
                        <h4 class="bd-widget__title">Search Articles</h4>
                        <form action="{{ route('blog.index') }}" method="GET" class="bd-search-form">
                            <input type="text" name="search" placeholder="Type keywords…" required>
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    {{-- Recent Posts --}}
                    @php
                        $recent_posts = \App\Models\BlogPost::where('id', '!=', $post->id)
                            ->orderBy('published_at', 'desc')
                            ->take(4)
                            ->get();
                    @endphp
                    @if($recent_posts->count() > 0)
                    <div class="bd-widget">
                        <h4 class="bd-widget__title">Recent Articles</h4>
                        <div class="bd-recent-list">
                            @foreach($recent_posts as $i => $recent)
                            <a href="{{ route('blog.show', $recent->id) }}" class="bd-recent-item">
                                <div class="bd-recent-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="bd-recent-thumb">
                                    @if($recent->featured_image)
                                    <img loading="lazy" src="{{ asset($recent->featured_image) }}" alt="{{ $recent->title }}">
                                    @else
                                    <div class="bd-recent-thumb-ph"><i class="fas fa-newspaper"></i></div>
                                    @endif
                                </div>
                                <div class="bd-recent-info">
                                    <h5>{{ Str::limit($recent->title, 52) }}</h5>
                                    <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($recent->published_at)->format('d M Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Categories --}}
                    @php
                        $categories = \App\Models\BlogPost::select('category')
                            ->whereNotNull('category')
                            ->where('category', '!=', '')
                            ->distinct()
                            ->pluck('category');
                    @endphp
                    @if($categories->count() > 0)
                    <div class="bd-widget">
                        <h4 class="bd-widget__title">Categories</h4>
                        <div class="bd-cat-list">
                            @foreach($categories as $cat)
                            @php $catCount = \App\Models\BlogPost::where('category', $cat)->count(); @endphp
                            <a href="{{ route('blog.index', ['category' => $cat]) }}" class="bd-cat-item">
                                <div class="bd-cat-item__left">
                                    <span class="bd-cat-dot"></span>
                                    <span>{{ $cat }}</span>
                                </div>
                                <span class="bd-cat-count">{{ $catCount }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Career CTA --}}
                    <div class="bd-cta-card">
                        <div class="bd-cta-card__glow"></div>
                        <div class="bd-cta-card__icon"><i class="fas fa-briefcase"></i></div>
                        <h4>Looking for your next career move?</h4>
                        <p>Explore exciting opportunities across top IT &amp; non-IT sectors with Wintech Inc.</p>
                        <a href="{{ route('jobs.index') }}" class="bd-cta-card__btn">
                            Browse Jobs
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
// Reading progress bar
window.addEventListener('scroll', function () {
    const scrollTop = window.scrollY;
    const docHeight = document.body.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    document.getElementById('bdProgressBar').style.width = progress + '%';
});

// Copy link
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        const btn = document.querySelector('.bd-share-btn--copy');
        btn.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => { btn.innerHTML = '<i class="fas fa-link"></i>'; }, 2000);
    });
}
</script>

{{-- ════════════════════════════════════════════════════
     PREMIUM CSS
═════════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

/* ── Global ── */
*, *::before, *::after { box-sizing: border-box; }

/* ── Reading Progress ── */
.bd-progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg, #b11e24, #ff6b70);
    width: 0%;
    z-index: 9999;
    transition: width 0.15s ease;
    box-shadow: 0 0 10px rgba(177,30,36,0.5);
}

/* ══════════════════════════
   HERO
══════════════════════════ */
.bd-hero {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: flex-end;
    padding-bottom: 70px;
    padding-top: 140px;
    background-size: cover;
    background-position: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow: hidden;
}
.bd-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(7,18,43,0.55) 0%,
        rgba(7,18,43,0.82) 60%,
        rgba(7,18,43,0.97) 100%
    );
    z-index: 1;
}

/* Floating particles */
.bd-hero__particles {
    position: absolute;
    inset: 0;
    z-index: 2;
    pointer-events: none;
    overflow: hidden;
}
.bd-hero__particles span {
    position: absolute;
    display: block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(177,30,36,0.5);
    animation: bdFloat 8s infinite ease-in-out;
}
.bd-hero__particles span:nth-child(1) { top:20%; left:10%; animation-delay:0s; }
.bd-hero__particles span:nth-child(2) { top:60%; left:80%; animation-delay:2s; width:10px; height:10px; }
.bd-hero__particles span:nth-child(3) { top:80%; left:30%; animation-delay:4s; width:4px; height:4px; }
.bd-hero__particles span:nth-child(4) { top:30%; left:60%; animation-delay:1s; }
.bd-hero__particles span:nth-child(5) { top:70%; left:50%; animation-delay:3s; width:8px; height:8px; }
@keyframes bdFloat {
    0%,100% { transform: translateY(0) scale(1); opacity: 0.6; }
    50%      { transform: translateY(-20px) scale(1.2); opacity: 1; }
}

/* Breadcrumb */
.bd-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.55);
    margin-bottom: 24px;
    position: relative;
    z-index: 3;
}
.bd-breadcrumb a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: color 0.25s;
}
.bd-breadcrumb a:hover { color: #ff8a90; }
.bd-breadcrumb svg { opacity: 0.35; flex-shrink: 0; }
.bd-breadcrumb span { color: rgba(255,255,255,0.4); }

/* Pills */
.bd-hero__pills {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
    position: relative;
    z-index: 3;
}
.bd-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 50px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.75);
    backdrop-filter: blur(8px);
    letter-spacing: 0.3px;
}
.bd-pill--cat {
    background: rgba(177,30,36,0.2);
    border-color: rgba(177,30,36,0.35);
    color: #ff8a90;
}
.bd-pill i { font-size: 11px; }

/* Hero Title */
.bd-hero__title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: clamp(28px, 4.5vw, 48px);
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    letter-spacing: -1px;
    margin: 0 0 30px;
    max-width: 860px;
    position: relative;
    z-index: 3;
    text-shadow: 0 2px 30px rgba(0,0,0,0.3);
}

/* Hero Divider */
.bd-hero__divider {
    position: relative;
    z-index: 3;
}
.bd-hero__divider-bar {
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #b11e24, #ff6b70);
    border-radius: 4px;
    animation: bdGrow 0.8s 0.3s ease both;
}
@keyframes bdGrow {
    from { width: 0; }
    to   { width: 60px; }
}

/* ══════════════════════════
   BODY WRAPPER
══════════════════════════ */
.bd-body {
    background: #f8fafc;
    padding: 60px 0 100px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    position: relative;
}
.bd-body::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 55% 40% at 5% 10%, rgba(177,30,36,0.04) 0%, transparent 55%),
        radial-gradient(ellipse 45% 40% at 95% 90%, rgba(7,16,86,0.04) 0%, transparent 55%);
    pointer-events: none;
}

/* ── Featured Image ── */
.bd-featured-img {
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 28px;
    position: relative;
    box-shadow: 0 15px 40px rgba(15,23,42,0.10);
}
.bd-featured-img img {
    width: 100%;
    max-height: 480px;
    object-fit: cover;
    display: block;
    transition: transform 0.7s ease;
}
.bd-featured-img:hover img { transform: scale(1.03); }
.bd-featured-img__shine {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.04) 0%, transparent 60%);
    pointer-events: none;
}

/* ── Article Card ── */
.bd-article {
    background: #ffffff;
    border: 1px solid rgba(226,232,240,0.9);
    border-radius: 28px;
    padding: 48px 48px 40px;
    box-shadow: 0 8px 30px rgba(15,23,42,0.06);
}
@media (max-width: 767px) {
    .bd-article { padding: 28px 22px 28px; }
}

/* ── Article Typography ── */
.bd-article__content {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    line-height: 1.85;
    color: #475569;
}
.bd-article__content p {
    margin-bottom: 24px;
    color: #475569;
}
.bd-article__content h2,
.bd-article__content h3,
.bd-article__content h4 {
    color: #071056;
    font-weight: 800;
    letter-spacing: -0.5px;
    line-height: 1.3;
    margin: 42px 0 18px;
}
.bd-article__content h2 { font-size: 28px; }
.bd-article__content h3 { font-size: 22px; }
.bd-article__content h4 { font-size: 18px; }

.bd-article__content blockquote {
    background: rgba(177,30,36,0.04);
    border-left: 4px solid #b11e24;
    padding: 22px 30px;
    border-radius: 0 18px 18px 0;
    font-style: italic;
    font-weight: 600;
    color: #1e293b;
    margin: 36px 0;
    position: relative;
}
.bd-article__content blockquote::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 24px;
    font-size: 60px;
    line-height: 1;
    color: rgba(177,30,36,0.2);
    font-style: normal;
}

.bd-article__content ul,
.bd-article__content ol {
    padding-left: 22px;
    margin-bottom: 28px;
    color: #475569;
}
.bd-article__content li { margin-bottom: 10px; }

.bd-article__content a {
    color: #b11e24;
    text-decoration: none;
    border-bottom: 1px solid rgba(177,30,36,0.25);
    transition: all 0.2s;
}
.bd-article__content a:hover {
    color: #8c1418;
    border-bottom-color: #8c1418;
}

.bd-article__content strong { color: #1e293b; }

.bd-article__content img {
    border-radius: 16px;
    max-width: 100%;
    height: auto;
    margin: 24px 0;
    box-shadow: 0 10px 30px rgba(15,23,42,0.08);
}

.bd-article__content hr {
    border: none;
    border-top: 1px solid #e2e8f0;
    margin: 40px 0;
}

/* ── Gallery ── */
.bd-gallery {
    margin-top: 48px;
    padding-top: 40px;
    border-top: 1px solid #e2e8f0;
}
.bd-gallery__heading {
    font-size: 18px;
    font-weight: 800;
    color: #071056;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.bd-gallery__heading i { color: #b11e24; }
.bd-gallery__item {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
}
.bd-gallery__item img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.bd-gallery__item:hover img { transform: scale(1.06); }
.bd-gallery__item-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 50%, rgba(7,18,43,0.6) 100%);
    pointer-events: none;
}

/* ── Share Row ── */
.bd-share-row {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-top: 44px;
    padding-top: 30px;
    border-top: 1px solid #e2e8f0;
}
.bd-share-label {
    font-size: 12.5px;
    font-weight: 700;
    color: #94a3b8;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.bd-share-links {
    display: flex;
    gap: 10px;
    margin-left: auto;
}
.bd-share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none !important;
    transition: all 0.3s ease;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #64748b;
}
.bd-share-btn:hover { transform: translateY(-3px); color: #fff; }
.bd-share-btn--fb:hover  { background: #1877f2; border-color: #1877f2; }
.bd-share-btn--tw:hover  { background: #1da1f2; border-color: #1da1f2; }
.bd-share-btn--li:hover  { background: #0a66c2; border-color: #0a66c2; }
.bd-share-btn--copy:hover{ background: #b11e24; border-color: #b11e24; }

/* ── Back Row ── */
.bd-back-row {
    margin-top: 28px;
}
.bd-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
    text-decoration: none !important;
    transition: all 0.3s ease;
    padding: 10px 18px;
    border-radius: 50px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
}
.bd-back-btn:hover {
    color: #b11e24;
    background: rgba(177,30,36,0.04);
    border-color: rgba(177,30,36,0.2);
    gap: 14px;
}

/* ══════════════════════════
   SIDEBAR
══════════════════════════ */
.bd-sidebar {
    position: sticky;
    top: 100px;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Widget shell */
.bd-widget {
    background: #ffffff;
    border: 1px solid rgba(226,232,240,0.9);
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 6px 24px rgba(15,23,42,0.05);
}
.bd-widget__title {
    font-size: 15px;
    font-weight: 800;
    color: #071056;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.bd-widget__title::before {
    content: '';
    display: inline-block;
    width: 4px;
    height: 18px;
    background: linear-gradient(180deg, #b11e24, #ff6b70);
    border-radius: 4px;
    flex-shrink: 0;
}

/* Search */
.bd-search-form {
    position: relative;
}
.bd-search-form input {
    width: 100%;
    padding: 13px 52px 13px 18px;
    border-radius: 14px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    color: #1e293b;
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 500;
    transition: all 0.3s;
}
.bd-search-form input::placeholder { color: #94a3b8; }
.bd-search-form input:focus {
    outline: none;
    border-color: rgba(177,30,36,0.4);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(177,30,36,0.08);
    color: #1e293b;
}
.bd-search-form button {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 11px;
    background: #b11e24;
    color: #fff;
    border: none;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.25s, box-shadow 0.25s;
}
.bd-search-form button:hover {
    background: #8c1418;
    box-shadow: 0 6px 20px rgba(177,30,36,0.4);
}

/* Recent Posts */
.bd-recent-list { display: flex; flex-direction: column; gap: 14px; }
.bd-recent-item {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none !important;
    padding: 12px;
    border-radius: 16px;
    background: #f8fafc;
    border: 1px solid rgba(226,232,240,0.8);
    transition: all 0.3s ease;
}
.bd-recent-item:hover {
    background: rgba(177,30,36,0.04);
    border-color: rgba(177,30,36,0.18);
    transform: translateX(4px);
}
.bd-recent-num {
    font-size: 10px;
    font-weight: 800;
    color: rgba(177,30,36,0.6);
    width: 22px;
    flex-shrink: 0;
    letter-spacing: 0.5px;
}
.bd-recent-thumb {
    width: 58px;
    height: 58px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
}
.bd-recent-thumb img { width:100%; height:100%; object-fit:cover; }
.bd-recent-thumb-ph {
    width: 58px;
    height: 58px;
    border-radius: 12px;
    background: rgba(177,30,36,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(177,30,36,0.5);
    font-size: 18px;
    flex-shrink: 0;
}
.bd-recent-info { flex: 1; min-width: 0; }
.bd-recent-info h5 {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 5px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s;
}
.bd-recent-item:hover .bd-recent-info h5 { color: #b11e24; }
.bd-recent-info span {
    font-size: 10.5px;
    font-weight: 600;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 5px;
}
.bd-recent-info span i { color: #b11e24; font-size: 10px; }

/* Categories */
.bd-cat-list { display: flex; flex-direction: column; gap: 8px; }
.bd-cat-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 16px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid rgba(226,232,240,0.8);
    text-decoration: none !important;
    transition: all 0.25s;
}
.bd-cat-item:hover {
    background: rgba(177,30,36,0.05);
    border-color: rgba(177,30,36,0.2);
}
.bd-cat-item__left {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #475569;
    transition: color 0.25s;
}
.bd-cat-item:hover .bd-cat-item__left { color: #b11e24; }
.bd-cat-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(177,30,36,0.4);
    flex-shrink: 0;
    transition: background 0.25s;
}
.bd-cat-item:hover .bd-cat-dot { background: #b11e24; }
.bd-cat-count {
    background: #fff;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 9px;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
}

/* Career CTA Card */
.bd-cta-card {
    border-radius: 24px;
    padding: 36px 28px;
    background: linear-gradient(135deg, rgba(7,16,86,0.9) 0%, rgba(100,15,20,0.9) 100%);
    border: 1px solid rgba(177,30,36,0.25);
    text-align: center;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(14px);
}
.bd-cta-card__glow {
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(177,30,36,0.3) 0%, transparent 70%);
    pointer-events: none;
}
.bd-cta-card__icon {
    width: 64px;
    height: 64px;
    background: rgba(177,30,36,0.2);
    border: 1px solid rgba(177,30,36,0.3);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: #ff8a90;
    margin: 0 auto 20px;
    position: relative;
    z-index: 1;
}
.bd-cta-card h4 {
    font-size: 18px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.35;
    position: relative;
    z-index: 1;
}
.bd-cta-card p {
    font-size: 13px;
    color: rgba(255,255,255,0.65);
    line-height: 1.6;
    margin-bottom: 26px;
    position: relative;
    z-index: 1;
}
.bd-cta-card__btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    color: #b11e24;
    font-size: 13.5px;
    font-weight: 800;
    padding: 12px 26px;
    border-radius: 50px;
    text-decoration: none !important;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}
.bd-cta-card__btn:hover {
    background: #b11e24;
    color: #fff;
    box-shadow: 0 12px 32px rgba(177,30,36,0.45);
    gap: 12px;
}
</style>

@endsection

