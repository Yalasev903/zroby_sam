<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ad;
use App\Models\ChMessage;
use App\Models\AdminSetting;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use App\Models\Ticket;

class AdminController extends Controller
{
    /**
     * Отображает панель администратора с таблицами пользователей, заказов, объявлений и жалоб.
     */
    public function dashboard()
    {
        $users        = User::all();
        $orders       = Order::with(['customer', 'executor'])->get();
        $ads          = Ad::with(['user', 'servicesCategory'])->get();
        $chatMessages = ChMessage::orderBy('created_at', 'desc')->get();
        $tickets      = Ticket::with(['user', 'order'])->orderBy('created_at', 'desc')->get();

        // Добавляем выборку уведомлений (все уведомления для админа)
        $notifications = \App\Models\Notification::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('users', 'orders', 'ads', 'chatMessages', 'tickets', 'notifications'));
    }

    /**
     * Обновляет роль пользователя.
     */
    public function updateUserRole(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:customer,executor,admin',
        ]);
        $user->update(['role' => $validatedData['role']]);
        return redirect()->back()->with('success', 'Роль користувача успішно оновлена.');
    }

    /**
     * Удаляет пользователя.
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Користувача успішно видалено.');
    }

    /**
     * Отображает список заказов для управления.
     */
    public function orders()
    {
        $orders = Order::with(['customer', 'executor'])->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Обновляет статус заказа.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:new,waiting,in_progress,pending_confirmation,completed',
        ]);
        $order->update(['status' => $validatedData['status']]);
        return redirect()->back()->with('success', 'Статус замовлення успішно оновлено.');
    }

    /**
     * Удаляет заказ.
     */
    public function destroyOrder(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Замовлення успішно видалено.');
    }

    /**
     * Отображает список объявлений для управления.
     */
    public function ads()
    {
        $ads = Ad::with(['user', 'servicesCategory'])->get();
        return view('admin.ads', compact('ads'));
    }

    /**
     * Отображает форму редактирования объявления (администратор).
     */
    public function editAd(Request $request, Ad $ad)
    {
        $categories = ServiceCategory::all();
        return view('admin.components_admin_dashboard.edit_ad', compact('ad', 'categories'));
    }

    /**
     * Обновляет объявление (администратор).
     */
    public function updateAd(Request $request, Ad $ad)
    {
        $validatedData = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'required|string',
            'city'                 => 'required|string|max:100',
            'services_category_id' => 'required|exists:services_categories,id',
            'photo'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        $data = $request->only(['title', 'description', 'city', 'services_category_id']);
        if ($request->hasFile('photo')) {
            if ($ad->photo_path) {
                Storage::delete('public/' . $ad->photo_path);
            }
            $photoPath = $request->file('photo')->store('ads', 'public');
            $data['photo_path'] = $photoPath;
        }
        $ad->update($data);
        return redirect()->route('admin.ads')->with('success', 'Оголошення успішно оновлено.');
    }

    /**
     * Удаляет объявление.
     */
    public function destroyAd(Ad $ad)
    {
        if ($ad->photo_path) {
            Storage::delete('public/' . $ad->photo_path);
        }
        $ad->delete();
        return redirect()->back()->with('success', 'Оголошення успішно видалено.');
    }

    /**
     * Отображает список сообщений для управления.
     */
    public function chatMessages()
    {
        $chatMessages = ChMessage::orderBy('created_at', 'desc')->get();
        return view('admin.components_admin_dashboard.chat_message_table_widget', compact('chatMessages'));
    }

    /**
     * Отображает таблицу пользователей.
     */
    public function usersTable(Request $request)
    {
        $users = User::all();
        return view('admin.pages.users_table', compact('users'));
    }

    /**
     * Отображает страницу с таблицей объявлений.
     */
    public function adsTable()
    {
        $ads = Ad::with(['user', 'servicesCategory'])->get();
        return view('admin.pages.ads_table', compact('ads'));
    }

    /**
     * Отображает страницу с таблицей сообщений чата.
     */
    public function chatTable()
    {
        $chatMessages = ChMessage::orderBy('created_at', 'desc')->get();
        return view('admin.pages.chat_table', compact('chatMessages'));
    }

    /**
     * Отображает страницу с таблицей заказов.
     */
    public function ordersTable()
    {
        $orders = Order::with(['customer', 'executor'])->get();
        return view('admin.pages.orders_table', compact('orders'));
    }

    /**
     * Отображает страницу с таблицей жалоб (скарг).
     */
    public function ticketsTable()
    {
        $tickets = Ticket::with(['user', 'order'])->orderBy('created_at', 'desc')->get();
        return view('admin.pages.tickets_table', compact('tickets'));
    }

    /**
     * Отображает форму настроек администратора.
     */
    public function showSettingsForm()
    {
        $adminSetting = AdminSetting::first();
        if (!$adminSetting) {
            $adminSetting = AdminSetting::create([
                'auto_greeting_enabled' => false,
                'auto_greeting_text'    => '',
            ]);
        }
        return view('admin.pages.settings', compact('adminSetting'));
    }

    /**
     * Обновляет настройки администратора.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'auto_greeting_enabled' => 'sometimes|boolean',
            'auto_greeting_text'    => 'nullable|string',
        ]);
        $adminSetting = AdminSetting::first();
        if ($adminSetting) {
            $adminSetting->update([
                'auto_greeting_enabled' => $request->has('auto_greeting_enabled'),
                'auto_greeting_text'    => $validated['auto_greeting_text'] ?? null,
            ]);
        }
        return redirect()->back()->with('success', 'Налаштування збережено.');
    }

    /**
     * Отображает страницу для работы с привітаннями.
     */
    public function greetings()
    {
        $greetings = Notification::where('title', 'Привітання')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pages.greetings', compact('greetings'));
    }

    /**
     * Повторная отправка привітання.
     */
    public function resendGreeting(Request $request)
    {
        $adminSetting = AdminSetting::first();
        if (!$adminSetting || !$adminSetting->auto_greeting_enabled) {
            return redirect()->back()->with('error', 'Автопривітання не ввімкнено.');
        }
        $greetingText = $request->input('message')
            ? $request->input('message')
            : ($adminSetting->auto_greeting_text ?? 'Вітаємо у нашому сервісі!');
        $userId = $request->input('user_id');
        if ($userId) {
            $user = User::find($userId);
            if (!$user) {
                return redirect()->back()->with('error', 'Користувача не знайдено.');
            }
            Notification::create([
                'user_id' => $user->id,
                'title'   => 'Повідомлення від адміністратора',
                'message' => 'Привіт ' . $user->name . '! ' . $greetingText,
                'read'    => false,
            ]);
        } else {
            $users = User::all();
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title'   => 'Повідомлення від адміністратора',
                    'message' => $greetingText,
                    'read'    => false,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Повідомлення надіслано.');
    }

    /**
     * Обрабатывает решение по скарзі и отправляет уведомление пользователю.
     */
    public function resolveTicket(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'resolution' => 'required|string',
        ]);
        Notification::create([
            'user_id' => $ticket->user_id,
            'title'   => 'Вирішення скарги',
            'message' => $data['resolution'],
            'read'    => false,
        ]);
        return redirect()->back()->with('success', 'Рішення скарги надіслано.');
    }
}
