<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\AudioLecture;
use App\Models\Book;
use App\Models\Fatwa;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemaps = [
            ['loc' => route('sitemap.pages'), 'lastmod' => now()->toISOString()],
            ['loc' => route('sitemap.fatwas'), 'lastmod' => $this->getLastModified(Fatwa::class)],
            ['loc' => route('sitemap.audio'), 'lastmod' => $this->getLastModified(AudioLecture::class)],
            ['loc' => route('sitemap.books'), 'lastmod' => $this->getLastModified(Book::class)],
            ['loc' => route('sitemap.articles'), 'lastmod' => $this->getLastModified(Article::class)],
        ];

        return response()->view('sitemap.index', compact('sitemaps'))
            ->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        $pages = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('fatwas.index'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('audio.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('books.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('articles.index'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('contact.index'), 'changefreq' => 'monthly', 'priority' => '0.5'],
        ];

        return response()->view('sitemap.pages', compact('pages'))
            ->header('Content-Type', 'text/xml');
    }

    public function fatwas()
    {
        $fatwas = Fatwa::where('is_published', true)
            ->select('slug', 'updated_at', 'fatwa_date')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($fatwa) {
                return [
                    'loc' => route('fatwas.show', $fatwa->slug),
                    'lastmod' => $fatwa->updated_at->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ];
            });

        return response()->view('sitemap.urls', ['urls' => $fatwas])
            ->header('Content-Type', 'text/xml');
    }

    public function audio()
    {
        $lectures = AudioLecture::where('is_published', true)
            ->select('slug', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($lecture) {
                return [
                    'loc' => route('audio.show', $lecture->slug),
                    'lastmod' => $lecture->updated_at->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            });

        return response()->view('sitemap.urls', ['urls' => $lectures])
            ->header('Content-Type', 'text/xml');
    }

    public function books()
    {
        $books = Book::where('is_published', true)
            ->select('slug', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($book) {
                return [
                    'loc' => route('books.show', $book->slug),
                    'lastmod' => $book->updated_at->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            });

        return response()->view('sitemap.urls', ['urls' => $books])
            ->header('Content-Type', 'text/xml');
    }

    public function articles()
    {
        $articles = Article::where('is_published', true)
            ->select('slug', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'loc' => route('articles.show', $article->slug),
                    'lastmod' => $article->updated_at->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            });

        return response()->view('sitemap.urls', ['urls' => $articles])
            ->header('Content-Type', 'text/xml');
    }

    private function getLastModified($model)
    {
        $latest = $model::latest('updated_at')->first();

        return $latest ? $latest->updated_at->toISOString() : now()->toISOString();
    }
}
