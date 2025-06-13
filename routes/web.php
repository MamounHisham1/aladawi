<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FatwaController;
use App\Http\Controllers\AudioLectureController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Sheikh Al-Adawi
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Fatwas routes
Route::prefix('fatwas')->name('fatwas.')->group(function () {
    Route::get('/', [FatwaController::class, 'index'])->name('index');
    Route::get('/{fatwa}', [FatwaController::class, 'show'])->name('show');
});

// Audio Lectures routes
Route::prefix('audio')->name('audio.')->group(function () {
    Route::get('/', [AudioLectureController::class, 'index'])->name('index');
    Route::get('/series', [AudioLectureController::class, 'series'])->name('series');
    Route::get('/{audioLecture}', [AudioLectureController::class, 'show'])->name('show');
});

// Books routes
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
    Route::get('/{book}/download/{media}', [BookController::class, 'download'])->name('download');
});

// Articles routes
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('show');
});

// Contact routes
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
