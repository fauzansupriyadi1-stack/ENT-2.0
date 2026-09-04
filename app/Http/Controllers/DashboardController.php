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

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%");
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(10);

        $stats = [
            'total_articles' => Article::count(),
            'total_categories' => Article::distinct('category')->count('category'),
            'total_likes' => (int) Article::sum('likes')
        ];

        return view('dashboard.index', compact('articles', 'stats'));
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
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|url'
        ]);

        if (empty($validated['read_time'])) {
            $validated['read_time'] = '5 min read';
        }

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
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|url'
        ]);

        if (empty($validated['read_time'])) {
            $validated['read_time'] = '5 min read';
        }

        if (empty($validated['image'])) {
            $validated['image'] = 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800';
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
