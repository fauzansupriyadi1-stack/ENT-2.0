<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function category(Request $request, $slug)
    {
        return $this->index($request, $slug);
    }

    public function index(Request $request, $categorySlug = null)
    {
        $selectedCategory = $categorySlug ?: $request->query('category');

        $allArticles = Article::latest()->get();

        if (!empty($selectedCategory) && strtolower($selectedCategory) !== 'all') {
            // Konversi slug ke spasi (misal: "morning-habits" -> "morning habits")
            $searchTerm = strtolower(str_replace('-', ' ', $selectedCategory));
            $gridArticles = Article::whereRaw('LOWER(category) = ?', [$searchTerm])
                ->orWhereRaw("LOWER(REPLACE(category, ' ', '-')) = ?", [strtolower($selectedCategory)])
                ->latest()->get();
        } else {
            $gridArticles = $allArticles->count() > 1 ? $allArticles->slice(1) : $allArticles;
        }

        $heroArticles = $allArticles->take(3);

        $categoriesList = Article::select('category')->distinct()->pluck('category');
        $categories = $categoriesList->map(function ($catName) {
            return [
                'name' => $catName,
                'count' => Article::where('category', $catName)->count(),
                'slug' => Str::slug($catName)
            ];
        })->toArray();

        return view('welcome', compact(
            'heroArticles',
            'gridArticles',
            'categories',
            'allArticles',
            'selectedCategory'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            $article = Article::find($slug);
        }

        if (!$article) {
            abort(404, 'Article not found');
        }

        $relatedArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan FZAN NEWS!');
    }
}
