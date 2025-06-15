<?php

namespace App\Http\Controllers;

use App\Models\AudioLecture;
use App\Models\AudioSeries;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AudioLectureController extends Controller
{
    public function index(Request $request)
    {
        $query = AudioLecture::with(['category', 'audioSeries'])
            ->published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                    ->orWhere('title_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Series filter
        if ($request->has('series') && $request->series) {
            $query->where('audio_series_id', $request->series);
        }

        // Quality filter
        if ($request->has('quality') && $request->quality) {
            $query->where('quality', $request->quality);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $audioLectures = $query->paginate(12);

        $categories = Category::where('type', 'audio')
            ->orWhere('type', 'general')
            ->active()
            ->orderBy('sort_order')
            ->get();

        $audioSeries = AudioSeries::active()
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Audio/Index', [
            'audioLectures' => $audioLectures,
            'categories' => $categories,
            'audioSeries' => $audioSeries,
            'filters' => $request->only(['search', 'category', 'series', 'quality', 'sort', 'order']),
        ]);
    }

    public function show(AudioLecture $audioLecture)
    {
        $audioLecture->load(['category', 'audioSeries']);

        // Get related audio lectures
        $relatedLectures = AudioLecture::where('category_id', $audioLecture->category_id)
            ->where('id', '!=', $audioLecture->id)
            ->published()
            ->take(3)
            ->get();

        return Inertia::render('Audio/Show', [
            'audioLecture' => $audioLecture,
            'relatedLectures' => $relatedLectures,
        ]);
    }

    public function series(Request $request)
    {
        $series = AudioSeries::with(['audioLectures' => function ($query) {
            $query->published()->orderBy('sort_order');
        }])
            ->active()
            ->orderBy('sort_order')
            ->paginate(12);

        return Inertia::render('Audio/Series', [
            'series' => $series,
        ]);
    }
}
