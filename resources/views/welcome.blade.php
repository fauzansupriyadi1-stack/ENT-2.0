@extends('layouts.app')

@section('content')
<div class="container">
    
    @php
        $featured = $allArticles->first();
        $gridArticles = $allArticles->count() > 1 ? $allArticles->slice(1) : $allArticles;
    @endphp

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="tag-badge-row">
                <span class="tag-new"><i class="fas fa-sparkles" style="margin-right: 4px;"></i> FEATURED STORY</span>
                <span class="read-time-pill"><i class="far fa-clock"></i> {{ $featured ? $featured->read_time : '5 min read' }}</span>
            </div>
            <h1 class="hero-title">Selamat Datang di FZAN NEWS</h1>
            <p class="hero-desc">Temukan ide, perspektif, dan kisah kurasi yang menginspirasi hari-hari Anda dengan fokus baru dan kejelasan kreatif.</p>
        </div>

        <div class="hero-image-wrap">
            <img src="{{ $featured ? $featured->image : 'https://images.unsplash.com/photo-1517021897933-0e0319cfbc28?auto=format&fit=crop&q=80&w=1200' }}" alt="{{ $featured ? $featured->title : 'Featured Story' }}" class="hero-cover-img" loading="eager">
            <div class="hero-overlay-gradient"></div>
            
            @if($featured)
                <div class="hero-floating-card">
                    <div class="floating-header">
                        <span class="tag">{{ strtoupper($featured->category) }}</span>
                    </div>
                    <h3><a href="{{ route('article.show', $featured->slug) }}" style="color: inherit;">{{ $featured->title }}</a></h3>
                    <p>{{ Str::limit($featured->excerpt, 100) }}</p>
                    <div class="hero-author">
                        <div class="author-info">
                            <img src="{{ $featured->author_avatar ?: 'https://i.pravatar.cc/100?img=5' }}" alt="{{ $featured->author_name }}" class="author-avatar">
                            <div>
                                <span class="author-name">{{ $featured->author_name }}</span>
                                <span class="author-role">{{ $featured->author_role ?: 'Editor' }}</span>
                            </div>
                        </div>
                        <span class="author-date"><i class="far fa-calendar-alt"></i> {{ $featured->date }}</span>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Articles Grid -->
    <section class="latest-articles" id="latest">
        <div class="section-header">
            <div>
                <h2>Artikel Terbaru</h2>
                <p class="section-subtitle">Kumpulan cerita terbaik yang dikurasi khusus untuk Anda.</p>
            </div>
            <div class="section-filter-status">
                @if(!empty($selectedCategory) && strtolower($selectedCategory) !== 'all')
                    <span id="active-filter-label">Kategori: <strong>{{ ucfirst($selectedCategory) }}</strong> ({{ $gridArticles->count() }})</span>
                    <a href="{{ url('/') }}#latest" class="reset-filter-btn" style="margin-left: 12px; font-size: 12px; background: var(--c-teal-light); color: var(--c-teal); padding: 5px 14px; border-radius: 99px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-times"></i> Reset Filter
                    </a>
                @else
                    <span id="active-filter-label">Menampilkan <strong>Semua Artikel</strong> ({{ $allArticles->count() }})</span>
                @endif
            </div>
        </div>

        <div class="latest-grid" id="articles-grid">
            @forelse($gridArticles as $article)
                <article class="article-card" data-category="{{ Str::slug($article->category) }}" data-id="{{ $article->id }}">
                    <div class="card-img-wrap">
                        <img src="{{ $article->image }}" alt="{{ $article->title }}" loading="lazy">
                        <span class="card-tag">{{ strtoupper($article->category) }}</span>
                    </div>
                    <div class="card-body">
                        <div class="card-meta">
                            <span class="read-duration"><i class="far fa-clock"></i> {{ $article->read_time }}</span>
                            <span class="post-date">{{ $article->date }}</span>
                        </div>
                        <h3 class="card-title">
                            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="card-excerpt">{{ Str::limit($article->excerpt, 110) }}</p>
                        <div class="card-footer">
                            <div class="author-row">
                                <img src="{{ $article->author_avatar ?: 'https://i.pravatar.cc/100?img=1' }}" alt="{{ $article->author_name }}" class="author-avatar-sm">
                                <span class="author-by">Oleh <strong>{{ $article->author_name }}</strong></span>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: var(--c-text-muted);">
                    <i class="fas fa-newspaper" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                    <p>Belum ada artikel. Silakan tambahkan artikel dari Dashboard.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>

<!-- Article Detail Modal for interactive reading preview -->
<div class="article-modal" id="article-modal">
    <div class="article-modal-backdrop" id="article-modal-backdrop"></div>
    <div class="article-modal-container">
        <button class="article-modal-close" id="article-modal-close" aria-label="Close article"><i class="fas fa-times"></i></button>
        <div class="article-modal-body" id="article-modal-content">
            <!-- Populated dynamically by JS -->
        </div>
    </div>
</div>
@endsection
