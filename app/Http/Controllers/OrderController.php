<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Страница со списком заказов (фильтрация по пользователю)
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $orders = Order::where('user_id', $user->id)->latest()->get();
        } elseif ($user->role === 'executor') {
            $orders = Order::where('executor_id', $user->id)->latest()->get();
        } else {
            $orders = collect();
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Метод для исполнителя, создающий заказ на основе объявления.
     */
    public function takeOrder(Ad $ad)
    {
        if (Auth::user()->role !== 'executor') {
            abort(403, 'Доступ запрещен.');
        }

        // Проверка: если заказ для данного объявления уже существует и его статус не равен 'completed'
        if ($ad->order && $ad->order->status !== 'completed') {
            return redirect()->back()->with('error', 'Этот заказ уже взят.');
        }

        $order = Order::create([
            'ad_id'                => $ad->id,
            'title'                => $ad->title,
            'description'          => $ad->description,
            // Сохраняем идентификатор категории из объявления (если связь установлена)
            'services_category_id' => $ad->servicesCategory ? $ad->servicesCategory->id : null,
            'user_id'              => $ad->user_id,    // заказчик (автор объявления)
            'executor_id'          => Auth::id(),      // исполнитель, взявший заказ
            'status'               => 'waiting',
        ]);

        return redirect()->route('orders.index')->with('success', 'Замовлення успішно створено та прийнято.');
    }

    public function approveOrder(Order $order)
    {
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ запрещен.');
        }

        if ($order->status !== 'waiting') {
            return redirect()->back()->with('error', 'Замовлення не готово до запуску.');
        }

        $order->update([
            'status'     => 'in_progress',
            'start_time' => now(),
        ]);

        return redirect()->back()->with('success', 'Замовлення виконується, відлік часу розпочато.');
    }

    public function completeOrder(Order $order)
    {
        if (Auth::user()->role !== 'executor' || Auth::id() !== $order->executor_id) {
            abort(403, 'Доступ заборонен.');
        }

        if ($order->status !== 'in_progress') {
            return redirect()->back()->with('error', 'Замовлення не можна завершити на данному етапі.');
        }

        $order->update([
            'status'   => 'pending_confirmation',
            'end_time' => now(),
        ]);

        return redirect()->back()->with('success', 'Замовлення виконано, очікує підтвердження замовником.');
    }

    public function confirmOrder(Order $order)
    {
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ заборонен.');
        }

        if ($order->status !== 'pending_confirmation') {
            return redirect()->back()->with('error', 'Замовлення не можна підтвердити на данному етапі.');
        }

        // Обновляем статус заказа на "completed"
        $order->update([
            'status' => 'completed',
        ]);

        // Обновление рейтинга исполнителя: добавляем 1 балл за выполненное задание
        if ($order->executor) {
            $order->executor->updateRating(1); // Метод updateRating реализован в модели User
        }

        // Обновление рейтинга заказчика: также добавляем 1 балл за успешное завершение заказа
        if ($order->customer) {
            $order->customer->updateRating(1);
        }

        return redirect()->back()->with('success', 'Замовлення підтверджено та завершено.');
    }
}
