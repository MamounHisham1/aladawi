<?php

namespace App\Http\Controllers;

use App\Models\Fatwa;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FatwaController extends Controller
{
    public function index(Request $request)
    {
        $query = Fatwa::with('category')
            ->published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('question_ar', 'like', "%{$search}%")
                  ->orWhere('question_en', 'like', "%{$search}%")
                  ->orWhere('answer_ar', 'like', "%{$search}%")
                  ->orWhere('answer_en', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Date filter
        if ($request->has('date_from') && $request->date_from) {
            $query->where('fatwa_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('fatwa_date', '<=', $request->date_to);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $fatwas = $query->paginate(12);

        $categories = Category::where('type', 'fatwa')
            ->orWhere('type', 'general')
            ->active()
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Fatwas/Index', [
            'fatwas' => $fatwas,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'date_from', 'date_to', 'sort', 'order']),
        ]);
    }

    public function show(Fatwa $fatwa)
    {
        $fatwa->load('category');

        // Get related fatwas
        $relatedFatwas = Fatwa::with('category')
            ->where('category_id', $fatwa->category_id)
            ->where('id', '!=', $fatwa->id)
            ->published()
            ->take(3)
            ->get();

        return Inertia::render('Fatwas/Show', [
            'fatwa' => $fatwa,
            'relatedFatwas' => $relatedFatwas,
        ]);
    }
}
