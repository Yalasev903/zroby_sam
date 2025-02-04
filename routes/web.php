<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ExecutorController;

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::get('/create-post', [PostController::class, 'create'])->name('create.post');


