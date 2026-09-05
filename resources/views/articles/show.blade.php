@extends('layouts.app')

@section('title', $article->title . ' | FZAN NEWS')

@section('content')
<div class="container" style="max-width: 900px;">
    <div style="padding-top: 32px; padding-bottom: 16px;">
        <a href="{{ route('home') }}" class="btn-outline" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; margin-bottom: 24px;">
            <i class="fas fa-arrow-left"></i> <span>Kembali ke Beranda</span>
        </a>
    </div>

    <article class="article-header">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;">
            <span class="tag-new" style="font-size: 12px;">{{ strtoupper($article->category) }}</span>
            @if($article->secondary_tag)
                <span class="read-time-pill" style="font-weight: 600;">#{{ $article->secondary_tag }}</span>
            @endif
            <span style="color: var(--c-text-muted);">&bull;</span>
            <span class="article-time-ago" data-created="{{ $article->created_at?->toIso8601String() }}" title="{{ $article->formatted_date }}" style="color: var(--c-text-muted); font-size: 14px; cursor: default;">{{ $article->time_ago }}</span>
            <span style="color: var(--c-text-muted);">&bull;</span>
            <span style="color: var(--c-text-muted); font-size: 14px;"><i class="far fa-clock"></i> {{ $article->read_time }}</span>
        </div>

        <h1 class="hero-title" style="font-size: 42px; text-align: left; margin-bottom: 24px; line-height: 1.2;">{{ $article->title }}</h1>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; border-top: 1px solid var(--c-border); border-bottom: 1px solid var(--c-border); padding: 16px 0;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <img src="{{ $article->author_avatar ?: 'https://i.pravatar.cc/100?img=5' }}" alt="{{ $article->author_name }}" class="author-avatar" style="width: 48px; height: 48px;">
                <div>
                    <div style="font-weight: 700; color: var(--c-text-main); font-size: 15px;">{{ $article->author_name }}</div>
                    <div style="font-size: 13px; color: var(--c-text-muted);">{{ $article->author_role ?: 'Penulis' }}</div>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button class="btn-outline" aria-label="Bagikan artikel" onclick="navigator.clipboard.writeText(window.location.href); alert('Link berhasil disalin!');" style="padding: 8px 16px;">
                    <i class="fas fa-share-alt"></i> Bagikan
                </button>
            </div>
        </div>

        <div style="margin-bottom: 36px; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md);">
            <img src="{{ $article->image }}" alt="{{ $article->title }}" style="width: 100%; max-height: 480px; object-fit: cover;">
        </div>

        <div style="font-size: 17px; line-height: 1.8; color: var(--c-text-main);">
            <p style="font-size: 20px; font-weight: 500; color: var(--c-teal); border-left: 4px solid var(--c-teal); padding-left: 20px; margin-bottom: 32px; line-height: 1.6;">
                {{ $article->excerpt }}
            </p>

            <div style="white-space: pre-line;">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </article>

    <!-- Related Articles Section -->
    @if(count($relatedArticles) > 0)
        <section style="margin-top: 60px; margin-bottom: 64px; border-top: 1px solid var(--c-border); padding-top: 48px;">
            <div style="margin-bottom: 28px;">
                <h3 style="font-family: var(--font-serif); font-size: 28px; color: var(--c-text-main);">Artikel Terkait</h3>
            </div>

            <div class="latest-grid" style="grid-template-columns: repeat(3, 1fr);">
                @foreach($relatedArticles as $related)
                    <article class="article-card">
                        <div class="card-img-wrap" style="height: 180px;">
                            <img src="{{ $related->image }}" alt="{{ $related->title }}" loading="lazy">
                            <span class="card-tag">{{ strtoupper($related->category) }}</span>
                        </div>
                        <div class="card-body">
                            <div class="card-meta">
                                <span class="read-duration"><i class="far fa-clock"></i> {{ $related->read_time }}</span>
                            </div>
                            <h3 class="card-title" style="font-size: 16px;">
                                <a href="{{ route('article.show', $related->slug) }}">{{ $related->title }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
