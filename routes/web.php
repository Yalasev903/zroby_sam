<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : view('dashboard');
    })->name('dashboard');

    // Only allow access for 'admin' users
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    Route::get('/executors', [ExecutorController::class, 'index'])->name('executors.index');
    Route::get('/my_profile/{user}', [ProfileController::class, 'showProfile'])->name('my_profile.show');
    Route::get('/my_profile/settings/{user}', [ProfileController::class, 'showProfileSettings'])->name('profile.settings');
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('ads.my');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

// News Routes
Route::resource('news', NewsController::class);
Route::get('/news/{slug}/details', [NewsController::class, 'show'])->name('news.details');
Route::get('/news/category/{id}', [NewsController::class, 'byCategory'])->name('news.byCategory');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/categories', [NewsCategoryController::class, 'index'])->name('news.categories');
