@extends('layouts.site')
@section('content')

{{-- Premium Blog Details Hero Section --}}
<div class="blog-hero-banner" style="background: url('{{ asset('blog.png') }}') no-repeat center center; background-size: cover;">
    <div class="blog-hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-9 col-md-12">
                <div class="blog-meta-badges">
                    @if($post->category)
                    <span class="blog-cat-badge"><i class="fas fa-tags"></i> {{ $post->category }}</span>
                    @endif
                    <span class="blog-date-badge"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}</span>
                </div>
                <h1 class="blog-hero-title">{{ $post->title }}</h1>
                <div class="blog-bread-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route('blog.index') }}">Blog</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="active">{{ Str::limit($post->title, 40) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-details-body-wrapper">
    <div class="container">
        <div class="row g-5">
            {{-- Main Post Content --}}
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                <div class="blog-main-card">
                    @if($post->featured_image)
                    <div class="blog-main-thumbnail">
                        <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid">
                    </div>
                    @endif

                    <div class="blog-article-content">
                        {!! $post->content !!}
                    </div>

                    @if($post->additional_images && count(json_decode($post->additional_images)) > 0)
                    <div class="blog-gallery-section">
                        <h4 class="gallery-title"><i class="fas fa-images"></i> Media Gallery</h4>
                        <div class="row g-4">
                            @foreach(json_decode($post->additional_images) as $img)
                            <div class="col-md-6 col-sm-12">
                                <div class="gallery-image-wrapper">
                                    <img src="{{ asset($img) }}" alt="Additional Gallery Image" class="gallery-img">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Widgets --}}
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="blog-sidebar-sticky">
                    
                    {{-- Search --}}
                    <div class="sidebar-widget search-widget">
                        <h4 class="widget-title">Search Articles</h4>
                        <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                            <input type="text" name="search" placeholder="Type keywords..." required>
                            <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
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
                    <div class="sidebar-widget recent-widget">
                        <h4 class="widget-title">Recent Updates</h4>
                        <div class="recent-posts-list">
                            @foreach($recent_posts as $recent)
                            <a href="{{ route('blog.show', $recent->id) }}" class="recent-post-item">
                                @if($recent->featured_image)
                                <div class="recent-thumb">
                                    <img src="{{ asset($recent->featured_image) }}" alt="{{ $recent->title }}">
                                </div>
                                @else
                                <div class="recent-thumb-placeholder">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                @endif
                                <div class="recent-info">
                                    <h5 class="recent-title">{{ $recent->title }}</h5>
                                    <span class="recent-date"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($recent->published_at)->format('M d, Y') }}</span>
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
                    <div class="sidebar-widget category-widget">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="category-list">
                            @foreach($categories as $cat)
                                @php
                                    $cat_count = \App\Models\BlogPost::where('category', $cat)->count();
                                @endphp
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $cat]) }}">
                                        <span><i class="fas fa-chevron-right"></i> {{ $cat }}</span>
                                        <span class="cat-count">{{ $cat_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Career CTA Card --}}
                    <div class="sidebar-widget career-cta-card" style="background: linear-gradient(135deg, #071056 0%, #b11e24 100%);">
                        <div class="cta-globe-icon"><i class="fas fa-briefcase"></i></div>
                        <h4>Looking for your next career move?</h4>
                        <p>Explore exciting opportunities across top IT & non-IT sectors with Wintech Inc.</p>
                        <a href="{{ route('jobs.index') }}" class="cta-action-btn">Browse Jobs <i class="fas fa-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Premium CSS Styles --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

/* Banner Section */
.blog-hero-banner {
    position: relative;
    padding: 140px 0 90px;
    overflow: hidden;
}
.blog-hero-overlay {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(7, 16, 86, 0.9) 0%, rgba(9, 14, 36, 0.7) 100%);
    pointer-events: none;
}
.blog-meta-badges {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.blog-cat-badge, .blog-date-badge {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.blog-cat-badge {
    background: rgba(177, 30, 36, 0.2);
    color: #ff8a90;
    border: 1px solid rgba(177, 30, 36, 0.3);
}
.blog-date-badge {
    background: rgba(255, 255, 255, 0.08);
    color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.blog-hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 42px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.25;
    letter-spacing: -1px;
    margin-bottom: 24px;
}
@media (max-width: 767px) {
    .blog-hero-title {
        font-size: 28px;
    }
}
.blog-bread-nav {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 600;
}
.blog-bread-nav a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.2s;
}
.blog-bread-nav a:hover {
    color: #ff8a90;
}
.blog-bread-nav i {
    font-size: 10px;
    color: rgba(255, 255, 255, 0.4);
}
.blog-bread-nav .active {
    color: rgba(255, 255, 255, 0.5);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px;
}

/* Layout Content Wrapper */
.blog-details-body-wrapper {
    background: #f8fafc;
    padding: 60px 0 100px;
}
.blog-main-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(7, 16, 86, 0.03);
    border: 1px solid rgba(226, 232, 240, 0.8);
    padding: 40px;
    overflow: hidden;
}
@media (max-width: 767px) {
    .blog-main-card {
        padding: 24px 16px;
    }
}
.blog-main-thumbnail {
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 36px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
}
.blog-main-thumbnail img {
    width: 100%;
    object-fit: cover;
    max-height: 480px;
    transition: transform 0.5s ease;
}
.blog-main-thumbnail:hover img {
    transform: scale(1.02);
}

/* Article Typography Styling */
.blog-article-content {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    line-height: 1.8;
    color: #475569;
}
.blog-article-content p {
    margin-bottom: 24px;
}
.blog-article-content h2, .blog-article-content h3, .blog-article-content h4 {
    color: #071056;
    font-weight: 800;
    margin-top: 40px;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}
.blog-article-content h2 { font-size: 26px; }
.blog-article-content h3 { font-size: 22px; }
.blog-article-content h4 { font-size: 18px; }

.blog-article-content blockquote {
    background: rgba(177, 30, 36, 0.04);
    border-left: 4px solid #b11e24;
    padding: 20px 30px;
    border-radius: 0 16px 16px 0;
    font-style: italic;
    font-weight: 500;
    color: #1e293b;
    margin: 30px 0;
}
.blog-article-content ul, .blog-article-content ol {
    margin-bottom: 30px;
    padding-left: 20px;
}
.blog-article-content li {
    margin-bottom: 10px;
}
.blog-article-content img {
    border-radius: 12px;
    margin: 20px 0;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
    max-width: 100%;
    height: auto;
}

/* Gallery Styling */
.blog-gallery-section {
    margin-top: 50px;
    padding-top: 40px;
    border-top: 1px solid #e2e8f0;
}
.gallery-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #071056;
    margin-bottom: 24px;
}
.gallery-image-wrapper {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.04);
}
.gallery-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s;
}
.gallery-image-wrapper:hover .gallery-img {
    transform: scale(1.05);
}

/* Sidebar Styling */
.blog-sidebar-sticky {
    position: sticky;
    top: 100px;
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.sidebar-widget {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid rgba(226, 232, 240, 0.8);
    padding: 28px;
    box-shadow: 0 10px 24px rgba(7, 16, 86, 0.02);
}
.widget-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 17px;
    font-weight: 800;
    color: #071056;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}
.widget-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 30px;
    height: 3px;
    background: #b11e24;
    border-radius: 2px;
}

/* Search widget */
.search-form {
    position: relative;
}
.search-form input {
    width: 100%;
    padding: 12px 50px 12px 16px;
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 500;
    transition: all 0.3s;
}
.search-form input:focus {
    border-color: #b11e24;
    outline: none;
    box-shadow: 0 0 0 3px rgba(177, 30, 36, 0.1);
}
.search-form button {
    position: absolute;
    right: 4px;
    top: 50%;
    transform: translateY(-50%);
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: #b11e24;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
}
.search-form button:hover {
    background: #8c1418;
}

/* Recent Posts Widget */
.recent-posts-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.recent-post-item {
    display: flex;
    gap: 14px;
    text-decoration: none !important;
    align-items: center;
}
.recent-thumb, .recent-thumb-placeholder {
    width: 65px;
    height: 65px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}
.recent-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.recent-thumb-placeholder {
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 20px;
}
.recent-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.recent-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s;
}
.recent-post-item:hover .recent-title {
    color: #b11e24;
}
.recent-date {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
}

/* Category widget */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.category-list li a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 14px;
    background: #f8fafc;
    border-radius: 10px;
    color: #475569;
    font-size: 13.5px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    text-decoration: none !important;
    transition: all 0.25s;
}
.category-list li a i {
    font-size: 10px;
    margin-right: 6px;
    color: #94a3b8;
    transition: transform 0.25s, color 0.25s;
}
.category-list li a:hover {
    background: rgba(177, 30, 36, 0.05);
    color: #b11e24;
}
.category-list li a:hover i {
    transform: translateX(3px);
    color: #b11e24;
}
.cat-count {
    background: #fff;
    color: #64748b;
    padding: 2px 8px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    border: 1px solid #e2e8f0;
}

/* Sidebar Career CTA */
.career-cta-card {
    border: none;
    padding: 36px 28px;
    text-align: center;
    color: #ffffff;
    position: relative;
    overflow: hidden;
}
.cta-globe-icon {
    font-size: 48px;
    color: rgba(255, 255, 255, 0.15);
    margin-bottom: 16px;
}
.career-cta-card h4 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 12px;
}
.career-cta-card p {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.5;
    margin-bottom: 24px;
}
.cta-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    color: #b11e24;
    padding: 12px 28px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
}
.cta-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
    background: #071056;
    color: #ffffff;
}
</style>

@endsection
