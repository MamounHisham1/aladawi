<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')
            ->published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                    ->orWhere('title_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhere('author_ar', 'like', "%{$search}%")
                    ->orWhere('author_en', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Language filter
        if ($request->has('language') && $request->language) {
            $query->where('language', $request->language);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $books = $query->paginate(12);

        $categories = Category::where('type', 'book')
            ->orWhere('type', 'general')
            ->active()
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'language', 'sort', 'order']),
        ]);
    }

    public function show(Book $book)
    {
        $book->load('category');

        // Get related books
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->published()
            ->take(3)
            ->get();

        return Inertia::render('Books/Show', [
            'book' => $book,
            'relatedBooks' => $relatedBooks,
        ]);
    }

    public function download(Book $book, $mediaId)
    {
        $media = $book->getMedia('book_files')->find($mediaId);

        if (! $media) {
            abort(404);
        }

        // Increment download count
        $book->incrementDownloadCount();

        return response()->download($media->getPath(), $media->name);
    }
}
