<?php

namespace App\Http\Controllers;

use App\Models\Fatwa;
use App\Models\AudioLecture;
use App\Models\Book;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $latestFatwas = Fatwa::with('category')
            ->published()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $featuredAudioLectures = AudioLecture::with(['category', 'audioSeries'])
            ->published()
            ->featured()
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $featuredBooks = Book::with('category')
            ->published()
            ->featured()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $latestArticles = Article::with('category')
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        return Inertia::render('Home', [
            'latestFatwas' => $latestFatwas,
            'featuredAudioLectures' => $featuredAudioLectures,
            'featuredBooks' => $featuredBooks,
            'latestArticles' => $latestArticles,
        ]);
    }

    public function about()
    {
        return Inertia::render('About');
    }
}
