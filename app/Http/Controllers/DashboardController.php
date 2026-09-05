<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Filter by category
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->whereRaw('LOWER(category) = ?', [strtolower($request->category)]);
        }

        // Filter by search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%");
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total_articles' => Article::count(),
            'total_categories' => Article::distinct('category')->count('category'),
            'total_likes' => (int) Article::sum('likes')
        ];

        // Daftar kategori unik dari database untuk filter pills
        $categories = Article::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $activeCategory = $request->get('category', 'all');
        $activeSearch   = $request->get('search', '');

        return view('dashboard.index', compact('articles', 'stats', 'categories', 'activeCategory', 'activeSearch'));
    }

    public function statsApi()
    {
        return response()->json([
            'total_articles' => Article::count(),
            'total_categories' => Article::distinct('category')->count('category'),
            'total_likes' => (int) Article::sum('likes')
        ]);
    }

    public function likeArticle($id)
    {
        $article = Article::find($id);

        if (!$article) {
            $article = Article::first();
        }

        if ($article) {
            $article->increment('likes');
        }

        return response()->json([
            'success' => true,
            'likes' => $article ? $article->likes : 0,
            'total_likes' => (int) Article::sum('likes')
        ]);
    }

    public function create()
    {
        return view('dashboard.form', [
            'article' => new Article(),
            'isEdit' => false
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'secondary_tag' => 'nullable|string|max:100',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'read_time' => 'nullable|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/articles');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['image'] = '/uploads/articles/' . $filename;
        }

        unset($validated['image_file']);

        // Auto-generate excerpt dari 10 kata pertama konten
        $cleanContent = strip_tags($validated['content']);
        $words = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($cleanContent))));
        $validated['excerpt'] = implode(' ', array_slice($words, 0, 10)) . (count($words) > 10 ? '...' : '');

        // Auto-hitung read_time dari jumlah kata (200 kata/menit)
        $wordCount = count($words);
        $minutes = max(1, (int) ceil($wordCount / 200));
        $validated['read_time'] = $minutes . ' min read';

        if (empty($validated['image'])) {
            $validated['image'] = 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800';
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['date'] = now()->format('M d, Y');

        Article::create($validated);

        return redirect()->route('dashboard.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('dashboard.form', [
            'article' => $article,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'secondary_tag' => 'nullable|string|max:100',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'read_time' => 'nullable|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/articles');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $validated['image'] = '/uploads/articles/' . $filename;
        }

        unset($validated['image_file']);

        // Auto-generate excerpt dari 10 kata pertama konten
        $cleanContent = strip_tags($validated['content']);
        $words = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($cleanContent))));
        $validated['excerpt'] = implode(' ', array_slice($words, 0, 10)) . (count($words) > 10 ? '...' : '');

        // Auto-hitung read_time dari jumlah kata (200 kata/menit)
        $wordCount = count($words);
        $minutes = max(1, (int) ceil($wordCount / 200));
        $validated['read_time'] = $minutes . ' min read';

        if (empty($validated['image'])) {
            $validated['image'] = $article->image ?: 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800';
        }

        if ($article->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        $article->update($validated);

        return redirect()->route('dashboard.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('dashboard.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
