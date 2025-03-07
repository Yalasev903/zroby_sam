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
            'ad_id'       => $ad->id,
            'title'       => $ad->title,
            'description' => $ad->description,
            'category'    => $ad->category ?? 'Строительство',
            'user_id'     => $ad->user_id,   // заказчик (автор объявления)
            'executor_id' => Auth::id(),     // исполнитель, взявший заказ
            'status'      => 'waiting',
        ]);

        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан и принят.');
    }

    public function approveOrder(Order $order)
    {
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ запрещен.');
        }

        if ($order->status !== 'waiting') {
            return redirect()->back()->with('error', 'Заказ не готов к запуску.');
        }

        $order->update([
            'status'     => 'in_progress',
            'start_time' => now()
        ]);

        return redirect()->back()->with('success', 'Заказ запущен, отчёт времени начат.');
    }

    public function completeOrder(Order $order)
    {
        if (Auth::user()->role !== 'executor' || Auth::id() !== $order->executor_id) {
            abort(403, 'Доступ запрещен.');
        }

        if ($order->status !== 'in_progress') {
            return redirect()->back()->with('error', 'Заказ нельзя завершить на данном этапе.');
        }

        $order->update([
            'status'   => 'pending_confirmation',
            'end_time' => now()
        ]);

        return redirect()->back()->with('success', 'Заказ выполнен, ожидает подтверждения заказчиком.');
    }

    public function confirmOrder(Order $order)
    {
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ запрещен.');
        }

        if ($order->status !== 'pending_confirmation') {
            return redirect()->back()->with('error', 'Заказ нельзя подтвердить на данном этапе.');
        }

        $order->update([
            'status' => 'completed'
        ]);

        return redirect()->back()->with('success', 'Заказ подтверждён и завершён.');
    }
}
