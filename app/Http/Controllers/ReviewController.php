<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    /**
     * Форма для создания отзыва заказчиком об исполнителе.
     */
    public function create(Order $order)
    {
        // Проверяем, что пользователь – заказчик данного заказа
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ запрещен.');
        }
        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Замовлення не завершено.');
        }
        // Проверяем, что заказчик ещё не оставлял отзыв
        if ($order->reviews()->where('review_by', 'customer')->exists()) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
        }
        return view('reviews.create', compact('order'));
    }

    /**
     * Сохранение отзыва заказчика об исполнителе.
     */
    public function store(Request $request, Order $order)
    {
        if (Auth::user()->role !== 'customer' || Auth::id() !== $order->user_id) {
            abort(403, 'Доступ заборонено.');
        }
        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Замовлення не завершено.');
        }
        if ($order->reviews()->where('review_by', 'customer')->exists()) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
        }

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $data['order_id'] = $order->id;
        $data['customer_id'] = Auth::id();
        $data['executor_id'] = $order->executor_id;
        $data['review_by'] = 'customer';

        Review::create($data);

        // Если оценка отзыва больше 3, начисляем дополнительный балл исполнителю
        if ($data['rating'] > 3 && $order->executor) {
            $order->executor->fresh()->updateRating(1);
        }

        return redirect()->route('orders.index')->with('success', 'Відгук успішно залишено.');
    }

    /**
     * Форма для создания отзыва исполнителем о заказчике.
     */
    public function createCustomerReview(Order $order)
    {
        if (Auth::user()->role !== 'executor' || Auth::id() !== $order->executor_id) {
            abort(403, 'Доступ заборонено.');
        }

        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Замовлення не завершено.');
        }

        if ($order->reviews()->where('review_by', 'executor')->exists()) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
        }

        return view('reviews.customer_create', compact('order'));
    }

    /**
     * Сохранение отзыва исполнителем о заказчике.
     */
    public function storeCustomerReview(Request $request, Order $order)
    {
        if (Auth::user()->role !== 'executor' || Auth::id() !== $order->executor_id) {
            abort(403, 'Доступ заборонено.');
        }

        if ($order->status !== 'completed') {
            return redirect()->back()->with('error', 'Замовлення не завершено.');
        }

        if ($order->reviews()->where('review_by', 'executor')->exists()) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук за це замовлення.');
        }

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $data['order_id'] = $order->id;
        $data['customer_id'] = $order->user_id;
        $data['executor_id'] = Auth::id();
        $data['review_by'] = 'executor';

        Review::create($data);

        if ($data['rating'] > 3 && $order->customer) {
            $order->customer->fresh()->updateRating(1);
        }

        return redirect()->route('orders.index')->with('success', 'Відгук успішно залишено.');
    }
}
