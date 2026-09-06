@extends('dashboard.layout')

@section('title', 'Dashboard Kelola Artikel | FZAN NEWS')

{{-- Load CSS khusus halaman ini --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-index.css') }}">
@endsection

@section('content')

{{-- ===== HEADER: Judul + Tombol Tambah ===== --}}
<div class="dash-header">
    <div>
        <h1>
            Kelola Artikel Berita
            <span class="badge-realtime">
                <span class="dot"></span> REAL-TIME SYNC
            </span>
        </h1>
        <p>Kelola, edit, filter, dan terbitkan cerita terbaru di portal FZAN NEWS.</p>
    </div>
    <a href="{{ route('dashboard.tambah-artikel') }}" class="btn-tambah-artikel">
        <i class="fas fa-plus"></i> Tambah Artikel Baru
    </a>
</div>

{{-- ===== KARTU STATISTIK ===== --}}
<div class="stats-grid">

    {{-- Kartu: Total Artikel --}}
    <div class="stat-box">
        <div class="stat-header">
            <span class="stat-label">Total Artikel</span>
            <div class="stat-icon artikel">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <div id="statTotalArticles" class="stat-number">{{ $stats['total_articles'] }}</div>
        <div class="stat-note hijau">
            <i class="fas fa-arrow-up"></i> Terhubung langsung ke Database
        </div>
    </div>

    {{-- Kartu: Total Kategori --}}
    <div class="stat-box">
        <div class="stat-header">
            <span class="stat-label">Kategori Berita</span>
            <div class="stat-icon kategori">
                <i class="fas fa-tags"></i>
            </div>
        </div>
        <div id="statTotalCategories" class="stat-number">{{ $stats['total_categories'] }}</div>
        <div class="stat-note kuning">
            <i class="fas fa-layer-group"></i> Beragam topik terdaftar
        </div>
    </div>

</div>

{{-- ===== FILTER KATEGORI & PENCARIAN ===== --}}
<form method="GET" action="{{ route('dashboard.daftar-artikel') }}" id="filterForm">
<div class="filter-box">
    <div class="filter-row">

        {{-- Tombol Pill Filter Kategori (dari database) --}}
        <div class="filter-pills" id="categoryFilterPills">
            <a href="{{ route('dashboard.daftar-artikel') }}"
               class="filter-pill {{ $activeCategory === 'all' || $activeCategory === '' ? 'active' : '' }}">
                Semua Artikel
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('dashboard.daftar-artikel', ['category' => $cat]) }}"
                   class="filter-pill {{ strtolower($activeCategory) === strtolower($cat) ? 'active' : '' }}">
                    {{ ucfirst($cat) }}
                </a>
            @endforeach
        </div>

        {{-- Search Bar --}}
        <div class="search-wrapper">
            <div class="search-input-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text"
                       name="search"
                       id="tableSearchInput"
                       value="{{ $activeSearch }}"
                       placeholder="Cari judul artikel/penulis..."
                       class="search-input">

                @if(!empty($activeCategory) && $activeCategory !== 'all')
                    <input type="hidden" name="category" value="{{ $activeCategory }}">
                @endif
            </div>

            <button type="submit" class="btn-cari">
                <i class="fas fa-search"></i> Cari
            </button>

            @if(!empty($activeSearch) || (!empty($activeCategory) && $activeCategory !== 'all'))
                <a href="{{ route('dashboard.daftar-artikel') }}" class="btn-reset">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </div>

    </div>

    {{-- ===== TABEL DAFTAR ARTIKEL ===== --}}
    <div class="table-wrapper">
        <table class="articles-table" id="articlesDataTable">
            <thead>
                <tr>
                    <th>Artikel &amp; Detail</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tanggal Publikasi</th>
                    <th>Aksi Cepat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $art)
                    <tr class="article-row" data-category="{{ strtolower($art->category) }}">

                        {{-- Kolom: Thumbnail + Judul --}}
                        <td>
                            <div class="article-cell">
                                <img src="{{ $art->image }}" alt="{{ $art->title }}" class="article-thumb">
                                <div>
                                    <a href="{{ route('article.show', $art->slug) }}" target="_blank" class="article-title-link">
                                        {{ $art->title }}
                                    </a>
                                    <span class="article-time">
                                        <i class="far fa-clock"></i> {{ $art->time_ago }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        {{-- Kolom: Kategori --}}
                        <td>
                            <span class="badge-category">{{ $art->category }}</span>
                        </td>

                        {{-- Kolom: Penulis --}}
                        <td class="author-name">{{ $art->author_name }}</td>

                        {{-- Kolom: Tanggal --}}
                        <td class="date-cell">
                            <span title="{{ $art->formatted_date }}"
                                  class="article-time-ago"
                                  data-created="{{ $art->created_at?->toIso8601String() }}">
                                {{ $art->time_ago }}
                            </span>
                        </td>

                        {{-- Kolom: Tombol Aksi --}}
                        <td>
                            <div class="action-group">
                                {{-- Tombol Intip (Preview Modal) --}}
                                <button type="button"
                                        class="btn-intip btn-preview-modal"
                                        data-title="{{ e($art->title) }}"
                                        data-category="{{ e($art->category) }}"
                                        data-image="{{ e($art->image) }}"
                                        data-excerpt="{{ e($art->excerpt) }}"
                                        data-content="{{ e($art->content) }}"
                                        data-author="{{ e($art->author_name) }}"
                                        data-date="{{ e($art->formatted_date) }}">
                                    <i class="fas fa-eye"></i> Intip
                                </button>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('dashboard.edit-artikel', $art->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('dashboard.hapus-artikel', $art->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="5">
                            <i class="fas fa-inbox empty-icon"></i>
                            Belum ada artikel ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $articles->links() }}
    </div>

</div>
</form>

{{-- ===== MODAL PREVIEW ARTIKEL ===== --}}
<div id="previewModal" class="modal-overlay">
    <div class="modal-box">
        <button id="closePreviewModal" class="modal-close-btn">
            <i class="fas fa-times"></i>
        </button>

        <span id="modalCategory" class="modal-badge-category">CATEGORY</span>
        <h2 id="modalTitle" class="modal-title">Article Title</h2>

        <div class="modal-meta">
            <span><i class="far fa-user"></i> <span id="modalAuthor">Author</span></span>
            <span>&bull;</span>
            <span><i class="far fa-calendar"></i> <span id="modalDate">Date</span></span>
        </div>

        <img id="modalImage" src="" alt="Cover" class="modal-cover">
        <p id="modalExcerpt" class="modal-excerpt"></p>
        <div id="modalContent" class="modal-content"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Search input — submit form saat tekan Enter
    const searchInput = document.getElementById('tableSearchInput');
    if (searchInput) {
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('filterForm').submit();
            }
        });
    }

    // Fungsi hitung "berapa lama lalu" dari tanggal ISO
    function timeAgo(isoString) {
        const now  = new Date();
        const past = new Date(isoString);
        const diffSec   = Math.floor((now - past) / 1000);
        const diffMin   = Math.floor(diffSec / 60);
        const diffHour  = Math.floor(diffMin / 60);
        const diffDay   = Math.floor(diffHour / 24);
        const diffWeek  = Math.floor(diffDay / 7);
        const diffMonth = Math.floor(diffDay / 30);
        const diffYear  = Math.floor(diffDay / 365);

        if (diffSec  < 60)  return 'baru saja';
        if (diffMin  < 60)  return diffMin  + ' menit lalu';
        if (diffHour < 24)  return diffHour + ' jam lalu';
        if (diffDay  < 7)   return diffDay  + ' hari lalu';
        if (diffWeek < 4)   return diffWeek + ' minggu lalu';
        if (diffMonth < 12) return diffMonth + ' bulan lalu';
        return diffYear + ' tahun lalu';
    }

    // Update semua label waktu setiap 60 detik
    function updateTimeAgo() {
        document.querySelectorAll('.article-time-ago[data-created]').forEach(el => {
            const iso = el.getAttribute('data-created');
            if (iso) el.innerText = timeAgo(iso);
        });
    }

    updateTimeAgo();
    setInterval(updateTimeAgo, 60000);

    // Modal Preview Artikel
    const previewModal   = document.getElementById('previewModal');
    const closePreviewBtn = document.getElementById('closePreviewModal');

    document.querySelectorAll('.btn-preview-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalTitle').innerText    = btn.getAttribute('data-title');
            document.getElementById('modalCategory').innerText = btn.getAttribute('data-category');
            document.getElementById('modalImage').src          = btn.getAttribute('data-image');
            document.getElementById('modalExcerpt').innerText  = btn.getAttribute('data-excerpt');
            document.getElementById('modalContent').innerText  = btn.getAttribute('data-content');
            document.getElementById('modalAuthor').innerText   = btn.getAttribute('data-author');
            document.getElementById('modalDate').innerText     = btn.getAttribute('data-date');

            previewModal.style.display = 'flex';
        });
    });

    if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', () => {
            previewModal.style.display = 'none';
        });
    }

    // Klik di luar modal = tutup modal
    window.addEventListener('click', (e) => {
        if (e.target === previewModal) {
            previewModal.style.display = 'none';
        }
    });
</script>
@endsection
