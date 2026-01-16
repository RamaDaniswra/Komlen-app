<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ChapterReaderController;
use App\Http\Controllers\Admin\AdminComicController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminUserController;



Route::get('/', [ComicController::class, 'index'])->name('home');

// Halaman detail komik (slug)
Route::get('/comics/{comic:slug}', [ComicController::class, 'show'])->name('comics.show');

// Baca chapter (slug + ID)
Route::get('/comics/{comic:slug}/chapters/{chapter:number}', 
    [ChapterReaderController::class, 'read']
)->name('chapters.read');

Route::get('/comics', [ComicController::class, 'list'])->name('comics.list');

// Store komentar
Route::post('/chapters/{chapter}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

// Simpan Rating (Hanya untuk user login)
Route::post('/comics/{comic:id}/rate', [RatingController::class, 'store'])
    ->name('comics.rate')
    ->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD komik (admin pakai ID)
        Route::resource('comics', AdminComicController::class)
            ->parameters([
                'comics' => 'comic:id'
            ]);

        // CRUD chapter (parent comic juga ID)
        Route::resource('comics.chapters', AdminChapterController::class)
            ->parameters([
                'comics'   => 'comic:id',
                'chapters' => 'chapter:id'
            ]);

        // CRUD user
        Route::resource('users', AdminUserController::class)
            ->parameters([
                'users' => 'user:id'
            ]);
    

});

require __DIR__.'/auth.php';
