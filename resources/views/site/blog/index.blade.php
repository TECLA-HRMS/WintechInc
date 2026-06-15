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
    <h1 class="blog-hero__title">Insights & Articles</h1>
    <p class="blog-hero__sub">Explore the latest trends, expert insights, and recruitment strategies from the Wintech Inc team.</p>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════
     BLOG LISTING GRID
════════════════════════════════════════════════════ --}}
<section class="blog-main">
  <div class="container">
    <div class="row g-4">
        @forelse($posts as $post)
        @php
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTime = max(1, ceil($wordCount / 200));
        @endphp
        <div class="col-lg-4 col-md-6 col-sm-12">
            <article class="blog-card">
                <div class="blog-card__image-wrap">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <img src="{{ $post->featured_image ? asset($post->featured_image) : asset('assets/images/blog/01.jpg') }}" alt="Blog Image" class="blog-card__img">
                    </a>
                    @if($post->category)
                    <span class="blog-card__tag">{{ $post->category }}</span>
                    @endif
                </div>
                
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="meta-item"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('d M, Y') }}</span>
                        <span class="meta-item"><i class="far fa-clock"></i> {{ $readingTime }} min read</span>
                    </div>
                    
                    <a href="{{ route('blog.show', $post->slug) }}" class="blog-card__title-link">
                        <h3 class="blog-card__title">{{ Str::limit($post->title, 55) }}</h3>
                    </a>
                    
                    <p class="blog-card__excerpt">
                        {{ Str::limit($post->excerpt, 95) }}
                    </p>
                    
                    <div class="blog-card__footer">
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card__more-btn">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="no-blogs-card">
                <div class="no-blogs-icon"><i class="far fa-newspaper"></i></div>
                <h3>No articles published yet</h3>
                <p>We are currently writing fresh updates. Please check back soon!</p>
                <a href="{{ url('/') }}" class="rts-btn btn-primary">Return Home</a>
            </div>
        </div>
        @endforelse
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════ PREMIUM STYLING --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

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
  background: linear-gradient(135deg, rgba(7, 16, 86, 0.9) 0%, rgba(9, 14, 36, 0.7) 100%);
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
.blog-breadcrumb a {
  color: rgba(255, 255, 255, 0.5);
  text-decoration: none;
  transition: color 0.3s;
}
.blog-breadcrumb a:hover {
  color: #fff;
}
.blog-breadcrumb .sep {
  color: rgba(255, 255, 255, 0.2);
}
.blog-breadcrumb .active {
  color: rgba(255, 255, 255, 0.85);
}
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

/* Listing section */
.blog-main {
  background: #f8fafc;
  padding: 80px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
}

/* Card Design */
.blog-card {
  background: #ffffff;
  border-radius: 24px;
  border: 1px solid rgba(241, 245, 249, 0.9);
  padding: 16px;
  overflow: hidden;
  box-shadow: 0 15px 35px rgba(15, 23, 42, 0.03);
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  position: relative;
}
.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 25px 50px rgba(177, 30, 36, 0.06);
  border-color: rgba(177, 30, 36, 0.15);
}
.blog-card__image-wrap {
  position: relative;
  overflow: hidden;
  aspect-ratio: 16/10;
  background: #f1f5f9;
  border-radius: 18px;
}
.blog-card__img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.blog-card:hover .blog-card__img {
  transform: scale(1.05);
}
.blog-card__tag {
  position: absolute;
  top: 14px;
  left: 14px;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  color: #b11e24;
  font-size: 10.5px;
  font-weight: 800;
  padding: 4px 12px;
  border-radius: 30px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  border: 1px solid rgba(177, 30, 36, 0.15);
  z-index: 2;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.blog-card__content {
  padding: 24px 10px 10px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.blog-card__meta {
  display: flex;
  gap: 12px;
  margin-bottom: 14px;
}
.meta-item {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11.5px;
  font-weight: 700;
  color: #64748b;
  background: #f8fafc;
  padding: 4px 12px;
  border-radius: 30px;
  border: 1px solid #f1f5f9;
}
.meta-item i {
  color: #b11e24;
}
.blog-card__title-link {
  text-decoration: none !important;
}
.blog-card__title {
  font-size: 20px;
  font-weight: 800;
  color: #071056;
  line-height: 1.4;
  margin: 0 0 12px;
  transition: color 0.25s ease;
  letter-spacing: -0.3px;
}
.blog-card__title-link:hover .blog-card__title {
  color: #b11e24;
}
.blog-card__excerpt {
  font-size: 14px;
  color: #64748b;
  line-height: 1.6;
  margin: 0 0 24px;
}
.blog-card__footer {
  margin-top: auto;
  padding-top: 15px;
  border-top: 1px solid #f1f5f9;
}
.blog-card__more-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  font-weight: 800;
  color: #b11e24;
  text-decoration: none !important;
  transition: all 0.25s ease;
}
.blog-card__more-btn i {
  transition: transform 0.3s ease;
}
.blog-card__more-btn:hover {
  color: #8c1418;
}
.blog-card__more-btn:hover i {
  transform: translateX(5px);
}

/* Empty State Card */
.no-blogs-card {
  background: #fff;
  border-radius: 20px;
  border: 1px solid rgba(226, 232, 240, 0.8);
  padding: 60px 40px;
  box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
  max-width: 500px;
  margin: 0 auto;
}
.no-blogs-icon {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background: #fff1f2;
  color: #b11e24;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  margin: 0 auto 24px;
}
.no-blogs-card h3 {
  font-size: 20px;
  font-weight: 800;
  color: #071056;
  margin-bottom: 8px;
}
.no-blogs-card p {
  color: #64748b;
  font-size: 14.5px;
  margin-bottom: 28px;
}
</style>

@endsection
