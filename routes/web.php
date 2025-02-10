<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CommentController;

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
        return view('dashboard');
    })->name('dashboard');

    Route::get('/executors', [ExecutorController::class, 'index'])->name('executors.index');

    // Страница профиля (Route Model Binding)
    Route::get('/my_profile/{user}', [ProfileController::class, 'showProfile'])->name('my_profile.show');

    // Страница настроек профиля (только для владельца)
    Route::get('/my_profile/settings/{user}', [ProfileController::class, 'showProfileSettings'])->name('profile.settings');

    // Форма создания объявления
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');

    // Сохранение объявления
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');

    // Страница с объявлениями
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');

    // Страница объявлений (GET)
    Route::get('/ads_card_page', [AdController::class, 'index'])->name('ads.ads_card_page');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});
