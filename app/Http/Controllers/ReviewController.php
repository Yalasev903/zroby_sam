<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Форма для создания отзыва
    public function create(Order $order)
    {
        // Проверяем, что пользователь – заказчик данного заказа
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ запрещен.');
        }

        // Отзыв можно оставить только для завершённых заказов
        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Замовлення не завершено.');
        }

        // Если отзыв уже существует, повторное добавление запрещено
        if ($order->review) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
        }

        return view('reviews.create', compact('order'));
    }
    // Сохранение отзыва
    public function store(Request $request, Order $order)
    {
    if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
        abort(403, 'Доступ заборонено.');
    }

    if ($order->status !== 'completed') {
        return redirect()->back()->with('error', 'Замовлення не завершено.');
    }

    if ($order->review) {
        return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
    }

    $data = $request->validate([
        'rating'  => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

    $data['order_id'] = $order->id;
    $data['customer_id'] = Auth::id();
    $data['executor_id'] = $order->executor_id;

    // Создание отзыва
    Review::create($data);

    // Если оценка отзыва больше 3, обновляем модель исполнителя и начисляем дополнительный балл
    if ($data['rating'] > 3 && $order->executor) {
        $executor = $order->executor->fresh();
        $executor->updateRating(1);
    }

    return redirect()->route('orders.index')->with('success', 'Відгук успішно залишено.');
    }
}
