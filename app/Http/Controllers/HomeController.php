<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $allArticles = Article::latest()->get();

        // If DB is empty for some reason, fallback gracefully
        if ($allArticles->isEmpty()) {
            $heroArticles = collect();
            $latestArticles = collect();
        } else {
            $heroArticles = $allArticles->take(3);
            $latestArticles = $allArticles;
        }

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
            'latestArticles',
            'categories',
            'allArticles'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            // fallback by ID if slug not found
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
