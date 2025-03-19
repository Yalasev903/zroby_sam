<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Отображает панель администратора с таблицами пользователей, заказов и объявлений.
     */
    public function dashboard()
    {
        $users = \App\Models\User::all();
        $orders = \App\Models\Order::with(['customer', 'executor'])->get();
        $ads = \App\Models\Ad::with(['user', 'servicesCategory'])->get();
        $chatMessages = \App\Models\ChMessage::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('users', 'orders', 'ads', 'chatMessages'));
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
        $categories = \App\Models\ServiceCategory::all();
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
            'services_category_id' => 'required|exists:services_category,id',
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
        $chatMessages = \App\Models\ChMessage::orderBy('created_at', 'desc')->get();
        return view('admin.components_admin_dashboard.chat_message_table_widget', compact('chatMessages'));
    }

}
