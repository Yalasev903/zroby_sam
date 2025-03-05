<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Страница со списком заказов (для отображения подтверждения заказчиком)
     */
    public function index()
    {
        $orders = Order::latest()->get();
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

        $existingOrder = Order::where('title', $ad->title)
                              ->where('executor_id', Auth::id())
                              ->where('status', 'waiting')
                              ->first();
        if ($existingOrder) {
            return redirect()->back()->with('error', 'Вы уже взяли этот заказ.');
        }

        $order = Order::create([
            'title'       => $ad->title,
            'description' => $ad->description,
            'category'    => $ad->category ?? 'Строительство',
            'user_id'     => $ad->user_id,
            'executor_id' => Auth::id(),
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
