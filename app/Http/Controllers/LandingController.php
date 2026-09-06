<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

/**
 * LANDING CONTROLLER
 * Mengelola seluruh tampilan publik (Landing Page, Filter Kategori, dan Detail Berita).
 */
class LandingController extends Controller
{
    /**
     * HALAMAN UTAMA (LANDING PAGE BERITA)
     */
    public function index(Request $request, $categorySlug = null)
    {
        // 1. Tentukan Kategori yang dipilih
        $selectedCategory = $categorySlug ?: $request->query('category');

        // 2. Ambil semua artikel terbaru dari database
        $allArticles = Article::latest()->get();

        // 3. Filter Artikel untuk Grid jika kategori dipilih
        if (!empty($selectedCategory) && strtolower($selectedCategory) !== 'all') {
            $categoryName = str_replace('-', ' ', $selectedCategory);
            $gridArticles = Article::where('category', 'like', "%{$categoryName}%")->latest()->get();
        } else {
            // Tampilkan artikel mulai dari artikel ke-2 (artikel ke-1 untuk Hero)
            $gridArticles = $allArticles->count() > 1 ? $allArticles->slice(1) : $allArticles;
        }

        // 4. Ambil 3 artikel teratas untuk Featured / Hero Banner
        $heroArticles = $allArticles->take(3);

        // 5. Ambil daftar kategori unik beserta jumlah artikelnya
        $categories = Article::select('category')
            ->distinct()
            ->pluck('category')
            ->map(function ($catName) {
                return [
                    'name'  => $catName,
                    'count' => Article::where('category', $catName)->count(),
                    'slug'  => Str::slug($catName)
                ];
            })
            ->toArray();

        // 6. Kirim data ke View Landing Page
        return view('halaman-utama', compact(
            'heroArticles',
            'gridArticles',
            'categories',
            'allArticles',
            'selectedCategory'
        ));
    }

    /**
     * ALIAS FILTER KATEGORI VIA URL SLUG (/category/teknologi)
     */
    public function category(Request $request, $slug)
    {
        return $this->index($request, $slug);
    }

    /**
     * HALAMAN DETAIL BERITA
     */
    public function show($slug)
    {
        // 1. Cari artikel berdasarkan Slug URL atau ID
        $article = Article::where('slug', $slug)->first() ?: Article::find($slug);

        // 2. Jika tidak ditemukan, tampilkan error 404
        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        // 3. Ambil 3 artikel terbaru lainnya sebagai Artikel Terkait
        $relatedArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();

        // 4. Tampilkan View Detail Berita
        return view('articles.detail-artikel', compact('article', 'relatedArticles'));
    }

    /**
     * LANGGANAN NEWSLETTER
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan FZAN NEWS!');
    }
}
