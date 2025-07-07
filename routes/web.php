<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GenreController;

// ==================== HOME ==================== //
Route::get('/', [MangaController::class, 'index'])->name('home');

// ==================== DASHBOARD ==================== //
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==================== MANGA ROUTES ==================== //
Route::prefix('manga')->group(function () {

    // Public Routes
    Route::get('/', [MangaController::class, 'index'])->name('manga.index');

    // Manga Show (harus di paling bawah setelah create/edit)
    Route::get('/{manga}', [MangaController::class, 'show'])->name('manga.show');

    // Chapter & Page (public reader)
    Route::get('/{manga}/chapters', [ChapterController::class, 'index'])->name('chapter.index');
    Route::get('/{manga}/chapter/{chapter}', [ChapterController::class, 'show'])->name('chapter.show');
    Route::get('/{manga}/chapter/{chapter}/page/{page}', [PageController::class, 'read'])->name('page.read');

    // ==================== AUTHENTICATED ONLY ==================== //
    Route::middleware('auth')->group(function () {

        // Manga CRUD
        Route::get('/create', [MangaController::class, 'create'])->name('manga.create');
        Route::post('/', [MangaController::class, 'store'])->name('manga.store');
        Route::get('/{manga}/edit', [MangaController::class, 'edit'])->name('manga.edit');
        Route::put('/{manga}', [MangaController::class, 'update'])->name('manga.update');
        Route::delete('/{manga}', [MangaController::class, 'destroy'])->name('manga.destroy');

        // Chapter CRUD
        Route::get('/{manga}/chapter/create', [ChapterController::class, 'create'])->name('chapter.create');
        Route::post('/{manga}/chapter', [ChapterController::class, 'store'])->name('chapter.store');
        Route::get('/{manga}/chapter/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapter.edit');
        Route::put('/{manga}/chapter/{chapter}', [ChapterController::class, 'update'])->name('chapter.update');
        Route::delete('/{manga}/chapter/{chapter}', [ChapterController::class, 'destroy'])->name('chapter.destroy');

        // Page CRUD
        Route::get('/{manga}/chapter/{chapter}/pages/create', [PageController::class, 'create'])->name('page.create');
        Route::post('/{manga}/chapter/{chapter}/pages', [PageController::class, 'store'])->name('page.store');
        Route::get('/{manga}/chapter/{chapter}/page/{page}/edit', [PageController::class, 'edit'])->name('page.edit');
        Route::put('/{manga}/chapter/{chapter}/page/{page}', [PageController::class, 'update'])->name('page.update');
        Route::delete('/{manga}/chapter/{chapter}/page/{page}', [PageController::class, 'destroy'])->name('page.destroy');
    });
});

// ==================== GENRE ROUTES ==================== //
Route::middleware('auth')->group(function () {
    Route::resource('genre', GenreController::class);
});

// ==================== PROFILE ROUTES ==================== //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== AUTH ROUTES ==================== //
require __DIR__ . '/auth.php';
