<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ad;
use App\Models\ChMessage;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\AdminSetting;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Главная панель администратора.
     */
    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::all(),
            'orders' => Order::with(['customer', 'executor'])->latest()->get(),
            'ads' => Ad::with(['user', 'servicesCategory'])->latest()->get(),
            'chatMessages' => ChMessage::latest()->get(),
            'tickets' => Ticket::with(['user', 'order'])->latest()->get(),
            'notifications' => Notification::latest()->get(),
            // 🛠 Сериализация новостей для JavaScript
            'news' => News::with('category')->latest()->get()->map(function ($item) {
                $imagePath = public_path($item->image_url);
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image_url' => file_exists($imagePath) ? asset($item->image_url) : asset('images/no-image.png'),
                    'created_at' => $item->created_at->toDateTimeString(),
                    'category' => [
                        'name' => optional($item->category)->name
                    ]
                ];
            })->toArray(),
        ]);
    }

    public function destroyNews(News $news)
    {
        $news->delete();
        return back()->with('success', 'Новину видалено.');
    }


    // ---------- ПОЛЬЗОВАТЕЛИ ----------

    public function usersTable()
    {
        return view('admin.pages.users_table', ['users' => User::all()]);
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:customer,executor,admin',
        ]);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Роль оновлено.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Користувача видалено.');
    }

    // ---------- ЗАКАЗЫ ----------

    public function orders()
    {
        $orders = Order::with(['customer', 'executor'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function ordersTable()
    {
        $orders = Order::with(['customer', 'executor'])->latest()->get();
        return view('admin.pages.orders_table', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,waiting,in_progress,pending_confirmation,completed,cancelled',
        ]);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Статус замовлення оновлено.');
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Замовлення видалено.');
    }

    // ---------- ОГОЛОШЕННЯ ----------

    public function ads()
    {
        $ads = Ad::with(['user', 'servicesCategory'])->latest()->get();
        return view('admin.ads', compact('ads'));
    }

    public function adsTable()
    {
        $ads = Ad::with(['user', 'servicesCategory'])->latest()->get();
        return view('admin.pages.ads_table', compact('ads'));
    }

    public function editAd(Ad $ad)
    {
        return view('admin.components_admin_dashboard.edit_ad', [
            'ad' => $ad,
            'categories' => ServiceCategory::all(),
        ]);
    }

    public function updateAd(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:100',
            'services_category_id' => 'required|exists:services_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($ad->photo_path) {
                Storage::delete('public/' . $ad->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('ads', 'public');
        }

        $ad->update($data);

        return redirect()->route('admin.ads')->with('success', 'Оголошення оновлено.');
    }

    public function destroyAd(Ad $ad)
    {
        if ($ad->photo_path) {
            Storage::delete('public/' . $ad->photo_path);
        }
        $ad->delete();
        return back()->with('success', 'Оголошення видалено.');
    }

    // ---------- СКАРГИ ----------

    public function ticketsTable()
    {
        $tickets = Ticket::with(['user', 'order'])->latest()->get();
        return view('admin.pages.tickets_table', compact('tickets'));
    }

    public function resolveTicket(Request $request, Ticket $ticket)
    {
        $request->validate(['resolution' => 'required|string']);

        Notification::create([
            'user_id' => $ticket->user_id,
            'title' => 'Вирішення скарги',
            'message' => $request->resolution,
            'read' => false,
        ]);

        return back()->with('success', 'Скаргу оброблено.');
    }

    // ---------- ЧАТ ----------

    public function chatMessages()
    {
        $chatMessages = ChMessage::latest()->get();
        return view('admin.components_admin_dashboard.chat_message_table_widget', compact('chatMessages'));
    }

    public function chatTable()
    {
        $chatMessages = ChMessage::latest()->get();
        return view('admin.pages.chat_table', compact('chatMessages'));
    }

    public function destroyChatMessage($id)
    {
        $msg = ChMessage::findOrFail($id);
        $msg->delete();
        return back()->with('success', 'Повідомлення видалено.');
    }

    // ---------- УВЕДОМЛЕНИЯ ----------

    public function notificationTable()
    {
        $notifications = Notification::latest()->get();
        return view('admin.pages.notifications_table', compact('notifications'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return back()->with('success', 'Уведомлення видалено.');
    }

    // ---------- ПРИВІТАННЯ ----------

    public function greetings()
    {
        $greetings = Notification::where('title', 'Привітання')->latest()->get();
        return view('admin.pages.greetings', compact('greetings'));
    }

    public function resendGreeting(Request $request)
    {
        $adminSetting = AdminSetting::first();

        if (!$adminSetting || !$adminSetting->auto_greeting_enabled) {
            return back()->with('error', 'Автопривітання вимкнено.');
        }

        $message = $request->input('message') ?: ($adminSetting->auto_greeting_text ?? 'Вітаємо!');
        $userId = $request->input('user_id');

        if ($userId) {
            $user = User::find($userId);
            if (!$user) return back()->with('error', 'Користувача не знайдено.');

            Notification::create([
                'user_id' => $user->id,
                'title' => 'Привітання',
                'message' => 'Привіт ' . $user->name . '! ' . $message,
                'read' => false,
            ]);
        } else {
            foreach (User::all() as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Привітання',
                    'message' => $message,
                    'read' => false,
                ]);
            }
        }

        return back()->with('success', 'Привітання надіслано.');
    }

    // ---------- НАЛАШТУВАННЯ ----------

    public function showSettingsForm()
    {
        $adminSetting = AdminSetting::first() ?? AdminSetting::create([
            'auto_greeting_enabled' => false,
            'auto_greeting_text' => '',
        ]);

        return view('admin.pages.settings', compact('adminSetting'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'auto_greeting_enabled' => 'sometimes|boolean',
            'auto_greeting_text' => 'nullable|string',
        ]);

        $setting = AdminSetting::first();
        if ($setting) {
            $setting->update([
                'auto_greeting_enabled' => $request->has('auto_greeting_enabled'),
                'auto_greeting_text' => $request->auto_greeting_text,
            ]);
        }

        return back()->with('success', 'Налаштування збережено.');
    }

    public function editNews(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.components_admin_dashboard.edit_news', compact('news', 'categories'));
    }

    public function updateNews(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'news_category_id' => 'required|integer',
            'image_url' => 'nullable|string',
        ]);

        $news->update($data);

        return back()->with('success', 'Новину оновлено.');
    }

    public function createNews()
    {
        $categories = NewsCategory::all();
        return view('admin.components_admin_dashboard.create_news', compact('categories'));
    }

    public function storeNews(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . time();

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('news', 'public');
            $data['image_url'] = 'storage/' . $data['image_url'];
        }

        News::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Новину створено успішно.');
    }

    public function newsTable()
    {
        $news = News::with('category')->latest()->get();

        return view('admin.pages.news_table', [
            'news' => $news->map(function ($item) {
                $imagePath = public_path($item->image_url);
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image_url' => file_exists($imagePath) ? asset($item->image_url) : asset('images/no-image.png'),
                    'created_at' => $item->created_at->toDateTimeString(),
                    'category' => [
                        'name' => optional($item->category)->name
                    ]
                ];
            })->toArray()
        ]);
    }
}
