<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

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

    // Маршруты для админа
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/users/{user}/update', [AdminController::class, 'updateUserRole'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

        // Новые маршруты для управления заказами
        Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::post('/admin/orders/{order}/update', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');
        Route::delete('/admin/orders/{order}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');

         // Маршруты для управления оголошеннями
        Route::get('/admin/ads', [AdminController::class, 'ads'])->name('admin.ads');
        Route::get('/admin/ads/{ad}/edit', [AdminController::class, 'editAd'])->name('admin.ads.edit');
        Route::post('/admin/ads/{ad}/update', [AdminController::class, 'updateAd'])->name('admin.ads.update');
        Route::delete('/admin/ads/{ad}', [AdminController::class, 'destroyAd'])->name('admin.ads.destroy');

        Route::get('/admin/chat-messages', [AdminController::class, 'chatMessages'])->name('admin.chat.messages');
        Route::delete('/admin/chat-messages/{id}', [AdminController::class, 'destroyChatMessage'])->name('admin.chat.messages.destroy');

            // Новые маршруты для страниц
        Route::get('/admin/ads-table', [AdminController::class, 'adsTable'])->name('admin.ads.table');
        Route::get('/admin/chat-table', [AdminController::class, 'chatTable'])->name('admin.chat.table');
        Route::get('/admin/orders-table', [AdminController::class, 'ordersTable'])->name('admin.orders.table');
        Route::get('/admin/users-table', [AdminController::class, 'usersTable'])->name('admin.users.table');
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

    // Маршруты для заказов
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{ad}/take', [OrderController::class, 'takeOrder'])->name('orders.take');
    Route::post('/orders/{order}/approve', [OrderController::class, 'approveOrder'])->name('orders.approve');
    Route::post('/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
});

// News Routes
Route::resource('news', NewsController::class);
Route::get('/news/{slug}/details', [NewsController::class, 'show'])->name('news.details');
Route::get('/news/category/{id}', [NewsController::class, 'byCategory'])->name('news.byCategory');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/categories', [NewsCategoryController::class, 'index'])->name('news.categories');
