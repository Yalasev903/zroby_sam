<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Отображает панель администратора с таблицей пользователей.
     */
    public function dashboard()
    {
        $users = \App\Models\User::all();
        // Загружаем все заказы вместе с информацией о заказчике и исполнителе
        $orders = \App\Models\Order::with(['customer', 'executor'])->get();
        return view('admin.dashboard', compact('users', 'orders'));
    }

    /**
     * Обновляет роль пользователя.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
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
     *
     * @param  \App\Models\User  $user
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Користувача успішно видалено.');
    }

      /**
     * Отображает панель администратора для управления заказами.
     */
    public function orders()
    {
        // Загружаем заказы вместе с данными о заказчике и исполнителе
        $orders = Order::with(['customer', 'executor'])->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Обновляет статус заказа.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
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
     *
     * @param  \App\Models\Order  $order
     */
    public function destroyOrder(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Замовлення успішно видалено.');
    }
}
