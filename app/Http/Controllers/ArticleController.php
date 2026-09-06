<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

/**
 * ARTICLE CONTROLLER (ADMIN)
 * Mengelola pengelolaan data artikel (CRUD) di area Dashboard Admin.
 */
class ArticleController extends Controller
{
    /**
     * MENAMPILKAN DAFTAR ARTIKEL & PENCARIAN DI DASHBOARD (READ)
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi Query Artikel
        $query = Article::query();

        // 2. Filter berdasarkan Kategori (jika dipilih)
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // 3. Filter Pencarian (Judul, Kategori, atau Penulis)
        if ($request->filled('search')) {
            $s = "%{$request->search}%";
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', $s)
                  ->orWhere('category', 'like', $s)
                  ->orWhere('author_name', 'like', $s);
            });
        }

        // 4. Ambil data artikel terbaru (10 artikel per halaman)
        $articles = $query->latest()->paginate(10)->withQueryString();

        // 5. Hitung Ringkasan Statistik Dashboard
        $stats = [
            'total_articles'   => Article::count(),
            'total_categories' => Article::distinct('category')->count('category')
        ];

        // 6. Ambil daftar kategori unik untuk tombol filter
        $categories = Article::distinct()->pluck('category');

        $activeCategory = $request->get('category', 'all');
        $activeSearch   = $request->get('search', '');

        // 7. Kirim data ke View Dashboard Admin
        return view('dashboard.daftar-artikel', compact(
            'articles', 
            'stats', 
            'categories', 
            'activeCategory', 
            'activeSearch'
        ));
    }

    /**
     * MENAMPILKAN FORM TAMBAH ARTIKEL
     */
    public function create()
    {
        return view('dashboard.form-artikel', [
            'article' => new Article(),
            'isEdit'   => false
        ]);
    }

    /**
     * MENYIMPAN ARTIKEL BARU KE DATABASE (CREATE)
     */
    public function store(Request $request)
    {
        // LANGKAH 1: Validasi input form
        $validated = $this->validateArticle($request);

        // LANGKAH 2: Upload file gambar ke server
        $validated['image'] = $this->handleImageUpload($request);

        // LANGKAH 3: Otomatis buat ringkasan 10 kata (Excerpt)
        $validated['excerpt'] = $this->generateExcerpt($validated['content']);

        // LANGKAH 4: Buat Slug URL & tanggal otomatis
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['date'] = now()->format('M d, Y');

        // LANGKAH 5: Simpan ke Database
        Article::create($validated);

        // LANGKAH 6: Redirect ke Dashboard dengan notifikasi sukses
        return redirect()->route('dashboard.daftar-artikel')->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * MENAMPILKAN FORM EDIT ARTIKEL
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('dashboard.form-artikel', [
            'article' => $article,
            'isEdit'   => true
        ]);
    }

    /**
     * MEMPERBARUI ARTIKEL (UPDATE)
     */
    public function update(Request $request, $id)
    {
        // LANGKAH 1: Cari artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // LANGKAH 2: Validasi input form
        $validated = $this->validateArticle($request);

        // LANGKAH 3: Upload gambar baru (jika ada) atau tetap gunakan gambar lama
        $validated['image'] = $this->handleImageUpload($request, $article->image);

        // LANGKAH 4: Generate ulang Excerpt 10 kata
        $validated['excerpt'] = $this->generateExcerpt($validated['content']);

        // LANGKAH 5: Update Slug jika judul diubah
        if ($article->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        // LANGKAH 6: Simpan perubahan ke Database
        $article->update($validated);

        // LANGKAH 7: Redirect ke Dashboard
        return redirect()->route('dashboard.daftar-artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * MENGHAPUS ARTIKEL (DELETE)
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('dashboard.daftar-artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    // ==========================================
    // HELPER FUNCTIONS (FUNGSI BANTUAN INTERNAL)
    // ==========================================

    /**
     * Validasi Form Artikel
     */
    private function validateArticle(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'content'     => 'required|string',
            'image_file'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
        ]);
    }

    /**
     * Penanganan Upload File Gambar
     */
    private function handleImageUpload(Request $request, ?string $defaultImage = null): string
    {
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/articles');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            return '/uploads/articles/' . $filename;
        }

        return $defaultImage ?: 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800';
    }

    /**
     * Otomatis Membuat Excerpt (10 Kata Pertama dari Konten Berita)
     */
    private function generateExcerpt(string $content): string
    {
        $cleanContent = strip_tags($content);
        $words = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($cleanContent))));

        return implode(' ', array_slice($words, 0, 10)) . (count($words) > 10 ? '...' : '');
    }
}
