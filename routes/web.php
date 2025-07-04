<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudioLectureController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FatwaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Sheikh Al-Adawi
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Sitemap routes
Route::prefix('sitemap')->name('sitemap.')->group(function () {
    Route::get('/', [SitemapController::class, 'index'])->name('index');
    Route::get('/pages', [SitemapController::class, 'pages'])->name('pages');
    Route::get('/fatwas', [SitemapController::class, 'fatwas'])->name('fatwas');
    Route::get('/audio', [SitemapController::class, 'audio'])->name('audio');
    Route::get('/books', [SitemapController::class, 'books'])->name('books');
    Route::get('/articles', [SitemapController::class, 'articles'])->name('articles');
});

// Main sitemap.xml route
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

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

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
