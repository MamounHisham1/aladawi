<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category')
            ->published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('content_ar', 'like', "%{$search}%")
                  ->orWhere('content_en', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Sort
        $sortBy = $request->get('sort', 'published_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $articles = $query->paginate(12);

        $categories = Category::where('type', 'article')
            ->orWhere('type', 'general')
            ->active()
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Articles/Index', [
            'articles' => $articles,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'sort', 'order']),
        ]);
    }

    public function show(Article $article)
    {
        $article->load('category');

        // Get related articles
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->published()
            ->take(3)
            ->get();

        return Inertia::render('Articles/Show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
