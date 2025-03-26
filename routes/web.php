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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReviewController;

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

    // Маршруты для админа (опущены для краткости) ...

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

    // Маршрут для уведомлений
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Маршруты для скарг (для заказчиков)
    Route::get('/orders/{order}/ticket/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/orders/{order}/ticket', [TicketController::class, 'store'])->name('tickets.store');

    // Отзывы от заказчика об исполнителе
    Route::get('/orders/{order}/review/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // Отзывы от исполнителя о заказчике
    Route::get('/orders/{order}/review-customer/create', [ReviewController::class, 'createCustomerReview'])->name('reviews.create_customer');
    Route::post('/orders/{order}/review-customer', [ReviewController::class, 'storeCustomerReview'])->name('reviews.store_customer');
});

// News Routes (опущены для краткости)
