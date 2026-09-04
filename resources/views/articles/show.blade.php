@extends('layouts.app')

@section('title', $article['title'] . ' | MAGZIN.')

@section('content')
<div class="container">
    <div style="padding-top: 32px; padding-bottom: 16px;">
        <a href="{{ route('home') }}" class="btn-search" style="display: inline-flex; width: auto; padding: 6px 16px; margin-bottom: 24px; border: 1px solid var(--border-subtle);">
            <i class="fas fa-arrow-left"></i> <span>Back to Magazine</span>
        </a>
    </div>

    <article class="article-header">
        <div class="card-top-meta" style="justify-content: flex-start; gap: 12px; margin-bottom: 20px;">
            <span class="tag-pill" style="font-size: 13px; padding: 4px 14px;">{{ $article['category'] }}</span>
            @if(isset($article['secondary_tag']))
                <span class="tag-pill" style="font-size: 13px; padding: 4px 14px;">{{ $article['secondary_tag'] }}</span>
            @endif
            <span style="color: var(--text-muted);">&bull;</span>
            <span style="color: var(--text-muted); font-weight: 500;">{{ $article['date'] }}</span>
            <span style="color: var(--text-muted);">&bull;</span>
            <span style="color: var(--text-muted); font-weight: 500;">{{ $article['read_time'] }}</span>
        </div>

        <h1 class="hero-title" style="text-align: left; margin-bottom: 24px;">{{ $article['title'] }}</h1>

        <div class="author-row" style="margin-bottom: 32px; justify-content: flex-start; gap: 20px;">
            <div class="author-info">
                <img src="{{ $article['author']['avatar'] }}" alt="{{ $article['author']['name'] }}" class="author-avatar" style="width: 44px; height: 44px;">
                <div>
                    <div style="font-weight: 700; color: var(--text-main);">{{ $article['author']['name'] }}</div>
                    <div style="font-size: 12px; color: var(--text-muted);">{{ $article['author']['role'] ?? 'Author' }}</div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-left: auto;">
                <button class="btn-icon btn-bookmark" aria-label="Bookmark"><i class="far fa-bookmark"></i></button>
                <button class="btn-icon" aria-label="Share article" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');"><i class="fas fa-share-alt"></i></button>
            </div>
        </div>

        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="article-hero-image">

        <div class="article-content-body">
            <p style="font-size: 20px; font-weight: 500; color: var(--text-main); border-left: 3px solid var(--c-teal); padding-left: 20px; margin-bottom: 32px;">
                {{ $article['excerpt'] }}
            </p>

            <p>{{ $article['content'] }}</p>

            <p>
                As creative disciplines continue to converge, the intersection of digital craft, tactile heritage, and environmental consciousness is defining the next era of lifestyle culture. Leading institutions and independent ateliers alike are exploring new paradigms that honor both ancestral intelligence and machine learning.
            </p>

            <div style="background: var(--bg-surface); border: 1px solid var(--border-subtle); border-radius: var(--radius-md); padding: 28px; margin: 40px 0;">
                <h4 style="font-family: var(--font-heading); margin-bottom: 12px; color: var(--text-main);">Key Insights from this Edition:</h4>
                <ul style="padding-left: 20px; color: var(--text-muted); line-height: 1.8;">
                    <li>Harmonious balance between biological textiles and computational tailoring.</li>
                    <li>Global resurgence in craft apprenticeships and community-led studios.</li>
                    <li>The role of vibrant colors in shaping psychological well-being and visual storytelling.</li>
                </ul>
            </div>
        </div>
    </article>

    <!-- Related Articles Section -->
    @if(count($relatedArticles) > 0)
        <section style="margin-top: 40px; margin-bottom: 64px; border-top: 1px solid var(--border-subtle); padding-top: 48px;">
            <div class="section-header-bar">
                <div class="section-title-group">
                    <i class="fas fa-sparkles section-badge-icon"></i>
                    <h3 class="section-title">Related Stories</h3>
                </div>
            </div>

            <div class="featured-grid">
                @foreach($relatedArticles as $related)
                    <article class="featured-card" style="height: 440px;">
                        <img src="{{ $related['image'] }}" alt="{{ $related['title'] }}" class="featured-card-bg" loading="lazy">
                        
                        <div class="featured-card-overlay">
                            <div class="card-top-meta">
                                <span class="tag-pill">{{ $related['category'] }}</span>
                                <span style="font-size: 12px; color: var(--text-muted);">{{ $related['read_time'] }}</span>
                            </div>

                            <h3 class="card-headline">
                                <a href="{{ route('article.show', $related['slug']) }}">{{ $related['title'] }}</a>
                            </h3>

                            <div class="card-footer-meta">
                                <span style="font-size: 12px; color: var(--text-muted);">{{ $related['date'] }}</span>
                                <a href="{{ route('article.show', $related['slug']) }}" class="btn-circle-arrow" aria-label="Read full story">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
