@extends('dashboard.layout')

@section('title', 'Dashboard Kelola Artikel | FZAN NEWS')

@section('content')
<div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 28px;">
    <div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #0f172a; margin-bottom: 4px; display: flex; align-items: center; gap: 12px;">
            Kelola Artikel Berita
            <span style="font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 700; background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 99px; display: inline-flex; align-items: center; gap: 6px;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #0284c7; display: inline-block; animation: pulseGlow 1.5s infinite;"></span> REAL-TIME SYNC
            </span>
        </h1>
        <p style="color: #64748b; font-size: 14px;">Kelola, edit, filter, dan terbitkan cerita terbaru di portal FZAN NEWS.</p>
    </div>
    <a href="{{ route('dashboard.create') }}" class="btn-dash-primary" style="padding: 12px 24px; border-radius: 99px; background: var(--c-teal); color: #fff; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(7, 102, 83, 0.3); transition: all 0.2s;">
        <i class="fas fa-plus"></i> Tambah Artikel Baru
    </a>
</div>

<style>
@keyframes pulseGlow {
    0% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.2); }
    100% { opacity: 1; transform: scale(1); }
}
</style>

<!-- Real-Time Auto-Updating Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 32px;">
    <div class="stat-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Artikel</span>
            <div style="width: 42px; height: 42px; border-radius: 10px; background: rgba(7, 102, 83, 0.1); color: var(--c-teal); display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <div id="statTotalArticles" style="font-size: 28px; font-weight: 700; color: #0f172a; transition: all 0.3s;">{{ $stats['total_articles'] }}</div>
        <div style="font-size: 12px; color: #10b981; margin-top: 4px; font-weight: 500;">
            <i class="fas fa-arrow-up"></i> Terhubung langsung ke Database
        </div>
    </div>

    <div class="stat-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Kategori Berita</span>
            <div style="width: 42px; height: 42px; border-radius: 10px; background: #FFF3E0; color: #E65100; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fas fa-tags"></i>
            </div>
        </div>
        <div id="statTotalCategories" style="font-size: 28px; font-weight: 700; color: #0f172a; transition: all 0.3s;">{{ $stats['total_categories'] }}</div>
        <div style="font-size: 12px; color: #f59e0b; margin-top: 4px; font-weight: 500;">
            <i class="fas fa-layer-group"></i> Beragam topik terdaftar
        </div>
    </div>
</div>

<!-- Category Filter Pills & Instant Search -->
<div style="background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; margin-bottom: 24px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 20px;">
        <!-- Category Pills -->
        <div style="display: flex; flex-wrap: wrap; gap: 8px;" id="categoryFilterPills">
            <button class="filter-pill active" data-cat="all" style="padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 600; border: 1.5px solid var(--c-teal); background: var(--c-teal); color: #fff; cursor: pointer; transition: all 0.2s;">
                Semua Artikel
            </button>
            <button class="filter-pill" data-cat="lifestyle" style="padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer; transition: all 0.2s;">
                Lifestyle
            </button>
            <button class="filter-pill" data-cat="travel" style="padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer; transition: all 0.2s;">
                Travel
            </button>
            <button class="filter-pill" data-cat="productivity" style="padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer; transition: all 0.2s;">
                Productivity
            </button>
            <button class="filter-pill" data-cat="technology" style="padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1; background: #fff; color: #475569; cursor: pointer; transition: all 0.2s;">
                Technology
            </button>
        </div>

        <!-- Instant Search Bar -->
        <div style="position: relative; min-width: 280px;">
            <i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
            <input type="text" id="tableSearchInput" placeholder="Cari judul artikel/penulis..." style="width: 100%; padding: 10px 14px 10px 38px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; outline: none; transition: all 0.2s;">
        </div>
    </div>

    <!-- Responsive Table Container -->
    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;" id="articlesDataTable">
            <thead>
                <tr style="background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 14px 16px; border-radius: 8px 0 0 8px;">Artikel & Detail</th>
                    <th style="padding: 14px 16px;">Kategori</th>
                    <th style="padding: 14px 16px;">Penulis</th>
                    <th style="padding: 14px 16px;">Tanggal Publikasi</th>
                    <th style="padding: 14px 16px; text-align: right; border-radius: 0 8px 8px 0;">Aksi Cepat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $art)
                    <tr class="article-row" data-category="{{ strtolower($art->category) }}" style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                        <td style="padding: 16px;">
                            <div style="display: flex; align-items: center; gap: 14px;">
                                <img src="{{ $art->image }}" alt="{{ $art->title }}" style="width: 64px; height: 48px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                                <div>
                                    <a href="{{ route('article.show', $art->slug) }}" target="_blank" style="font-weight: 600; color: #0f172a; font-size: 14.5px; text-decoration: none; line-height: 1.3; display: block; margin-bottom: 2px;">
                                        {{ $art->title }}
                                    </a>
                                    <span style="font-size: 12px; color: #64748b; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="far fa-clock"></i> {{ $art->read_time }} &bull; <i class="far fa-heart" style="color: #e11d48;"></i> <span class="art-likes-count-{{ $art->id }}">{{ $art->likes }}</span> likes
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px;">
                            <span style="background: rgba(7, 102, 83, 0.1); color: var(--c-teal); font-size: 12px; font-weight: 700; padding: 5px 12px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $art->category }}
                            </span>
                        </td>
                        <td style="padding: 16px; font-weight: 500; color: #334155;">
                            {{ $art->author_name }}
                        </td>
                        <td style="padding: 16px; color: #64748b; font-size: 13px;">
                            {{ $art->date }}
                        </td>
                        <td style="padding: 16px; text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <button type="button" class="btn-preview-modal" data-title="{{ e($art->title) }}" data-category="{{ e($art->category) }}" data-image="{{ e($art->image) }}" data-excerpt="{{ e($art->excerpt) }}" data-content="{{ e($art->content) }}" data-author="{{ e($art->author_name) }}" data-date="{{ e($art->date) }}" style="background: #f1f5f9; color: #475569; padding: 7px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s;">
                                    <i class="fas fa-eye"></i> Intip
                                </button>

                                <a href="{{ route('dashboard.edit', $art->id) }}" style="background: #e0f2fe; color: #0284c7; padding: 7px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('dashboard.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #fee2e2; color: #dc2626; padding: 7px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #64748b;">
                            <i class="fas fa-inbox" style="font-size: 40px; margin-bottom: 12px; opacity: 0.5; display: block;"></i>
                            Belum ada artikel ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding-top: 20px;">
        {{ $articles->links() }}
    </div>
</div>

<!-- Interactive Live Article Preview Modal -->
<div id="previewModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(6px); z-index: 999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; width: 100%; max-width: 680px; border-radius: 20px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); position: relative; padding: 32px;">
        <button id="closePreviewModal" style="position: absolute; right: 20px; top: 20px; width: 36px; height: 36px; border-radius: 50%; background: #f1f5f9; border: none; cursor: pointer; font-size: 16px; color: #64748b;"><i class="fas fa-times"></i></button>

        <span id="modalCategory" style="background: rgba(7, 102, 83, 0.1); color: var(--c-teal); font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 99px; text-transform: uppercase;">CATEGORY</span>
        <h2 id="modalTitle" style="font-family: 'Playfair Display', serif; font-size: 26px; margin: 12px 0; color: #0f172a;">Article Title</h2>

        <div style="font-size: 13px; color: #64748b; margin-bottom: 20px; display: flex; gap: 12px;">
            <span><i class="far fa-user"></i> <span id="modalAuthor">Author</span></span>
            <span>&bull;</span>
            <span><i class="far fa-calendar"></i> <span id="modalDate">Date</span></span>
        </div>

        <img id="modalImage" src="" alt="Cover" style="width: 100%; height: 260px; object-fit: cover; border-radius: 12px; margin-bottom: 20px;">

        <p id="modalExcerpt" style="font-size: 16px; font-weight: 500; color: var(--c-teal); border-left: 3px solid var(--c-teal); padding-left: 16px; margin-bottom: 20px;"></p>

        <div id="modalContent" style="font-size: 14.5px; line-height: 1.7; color: #334155; white-space: pre-line;"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // 1. Real-Time Auto-Polling Stats API
    function fetchRealtimeStats() {
        fetch("{{ route('api.stats') }}")
            .then(res => res.json())
            .then(data => {
                const elArticles = document.getElementById('statTotalArticles');
                const elCats = document.getElementById('statTotalCategories');
                const elLikes = document.getElementById('statTotalLikes');

                if (elArticles && data.total_articles !== undefined) elArticles.innerText = data.total_articles;
                if (elCats && data.total_categories !== undefined) elCats.innerText = data.total_categories;
                if (elLikes && data.total_likes !== undefined) elLikes.innerText = data.total_likes;
            })
            .catch(err => console.log('Stats sync error:', err));
    }

    // Auto poll every 3 seconds for live real-time sync
    setInterval(fetchRealtimeStats, 3000);

    // 2. Instant Client-side Search Filter
    const searchInput = document.getElementById('tableSearchInput');
    const tableRows = document.querySelectorAll('.article-row');

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            tableRows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(val) ? '' : 'none';
            });
        });
    }

    // 3. Category Filter Pills
    const filterPills = document.querySelectorAll('.filter-pill');
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            filterPills.forEach(p => {
                p.style.background = '#fff';
                p.style.color = '#475569';
                p.style.borderColor = '#cbd5e1';
                p.classList.remove('active');
            });
            pill.style.background = 'var(--c-teal)';
            pill.style.color = '#fff';
            pill.style.borderColor = 'var(--c-teal)';
            pill.classList.add('active');

            const selectedCategory = pill.getAttribute('data-cat');
            tableRows.forEach(row => {
                const rowCat = row.getAttribute('data-category');
                if (selectedCategory === 'all' || rowCat === selectedCategory) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // 4. Modal Live Article Preview
    const previewModal = document.getElementById('previewModal');
    const closePreviewBtn = document.getElementById('closePreviewModal');
    const previewBtns = document.querySelectorAll('.btn-preview-modal');

    previewBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalTitle').innerText = btn.getAttribute('data-title');
            document.getElementById('modalCategory').innerText = btn.getAttribute('data-category');
            document.getElementById('modalImage').src = btn.getAttribute('data-image');
            document.getElementById('modalExcerpt').innerText = btn.getAttribute('data-excerpt');
            document.getElementById('modalContent').innerText = btn.getAttribute('data-content');
            document.getElementById('modalAuthor').innerText = btn.getAttribute('data-author');
            document.getElementById('modalDate').innerText = btn.getAttribute('data-date');

            previewModal.style.display = 'flex';
        });
    });

    if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', () => {
            previewModal.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === previewModal) {
            previewModal.style.display = 'none';
        }
    });
</script>
@endsection
