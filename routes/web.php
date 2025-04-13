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
use App\Http\Controllers\PortfolioProjectController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

// Вебхуки и редирект после оплаты
Route::post('/orders/{order}/payment/callback', [OrderController::class, 'paymentCallback'])->name('orders.paymentCallback');

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

        // Управление заказами
        Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::post('/admin/orders/{order}/update', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');
        Route::delete('/admin/orders/{order}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');

        // Управление объявлениями
        Route::get('/admin/ads', [AdminController::class, 'ads'])->name('admin.ads');
        Route::get('/admin/ads/{ad}/edit', [AdminController::class, 'editAd'])->name('admin.ads.edit');
        Route::post('/admin/ads/{ad}/update', [AdminController::class, 'updateAd'])->name('admin.ads.update');
        Route::delete('/admin/ads/{ad}', [AdminController::class, 'destroyAd'])->name('admin.ads.destroy');

        Route::get('/admin/chat-messages', [AdminController::class, 'chatMessages'])->name('admin.chat.messages');
        Route::delete('/admin/chat-messages/{id}', [AdminController::class, 'destroyChatMessage'])->name('admin.chat.messages.destroy');

        // Таблицы
        Route::get('/admin/ads-table', [AdminController::class, 'adsTable'])->name('admin.ads.table');
        Route::get('/admin/chat-table', [AdminController::class, 'chatTable'])->name('admin.chat.table');
        Route::get('/admin/orders-table', [AdminController::class, 'ordersTable'])->name('admin.orders.table');
        Route::get('/admin/users-table', [AdminController::class, 'usersTable'])->name('admin.users.table');
        Route::get('/admin/tickets-table', [AdminController::class, 'ticketsTable'])->name('admin.tickets.table');

        // Настройки админки
        Route::get('/admin/settings', [AdminController::class, 'showSettingsForm'])->name('admin.settings');
        Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

        // Приветствия
        Route::get('/admin/greetings', [AdminController::class, 'greetings'])->name('admin.greetings');
        Route::post('/admin/greetings/resend', [AdminController::class, 'resendGreeting'])->name('admin.greetings.resend');

        // Разрешение тикетов
        Route::post('/admin/tickets/{ticket}/resolve', [AdminController::class, 'resolveTicket'])->name('admin.tickets.resolve');

        // Маршрут для отображения таблицы уведомлений (админ)
        Route::get('/admin/notifications-table', [\App\Http\Controllers\NotificationController::class, 'notificationTable'])
        ->name('admin.notification.table');

        // Удаление уведомления (для администратора)
        Route::delete('/admin/notifications/{notification}/destroy', [\App\Http\Controllers\NotificationController::class, 'destroy'])
        ->name('admin.notifications.destroy');
    });

    Route::get('/executors', [ExecutorController::class, 'index'])->name('executors.index');
    Route::get('/my_profile/{user}', [ProfileController::class, 'showProfile'])->name('my_profile.show');
    Route::get('/my_profile/settings/{user}', [ProfileController::class, 'showProfileSettings'])->name('profile.settings');

    // Объявления
    Route::resource('ads', AdController::class);
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('ads.my');

    // Комментарии
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    // Заказы
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{ad}/take', [OrderController::class, 'takeOrder'])->name('orders.take');
    Route::post('/orders/{order}/approve', [OrderController::class, 'approveOrder'])->name('orders.approve');
    Route::post('/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::post('/orders/{order}/guarantee/transfer', [OrderController::class, 'confirmGuaranteeTransfer'])->name('orders.confirmGuarantee');
    Route::get('/orders/{order}/guarantee/approve', [OrderController::class, 'approveGuarantee'])->name('orders.approveGuarantee');
    Route::post('/orders/{order}/guarantee/set', [OrderController::class, 'setGuarantee'])->name('orders.setGuarantee');

    Route::get('/orders/{order}/payment/confirm', [OrderController::class, 'confirmPayment'])->name('orders.confirmPayment');
    Route::get('/reviews/{order}/create_customer', [ReviewController::class, 'createCustomerReview'])->name('reviews.create_customer');
    Route::post('/reviews/{order}/store_customer', [ReviewController::class, 'storeCustomerReview'])->name('reviews.store_customer');
    Route::get('/reviews/{order}/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name('reviews.store');

    // Уведомления
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/clear', [NotificationController::class, 'clearUserNotifications'])->name('notifications.clear');

    // Скарги (тикеты)
    Route::resource('tickets', TicketController::class);

    // Отзывы
    // Route::resource('reviews', ReviewController::class);

    //Портфолио
    Route::middleware('auth')->group(function () {
        Route::get('/portfolio/create', [PortfolioProjectController::class, 'create'])->name('portfolio.create');
        Route::post('/portfolio', [PortfolioProjectController::class, 'store'])->name('portfolio.store');
    });
});

// Новости
Route::resource('news', NewsController::class);
Route::get('/news/{slug}/details', [NewsController::class, 'show'])->name('news.details');
Route::get('/news/category/{id}', [NewsController::class, 'byCategory'])->name('news.byCategory');
Route::get('/news/categories', [NewsCategoryController::class, 'index'])->name('news.categories');
