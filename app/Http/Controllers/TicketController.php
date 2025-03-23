<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Отображает форму для создания скарги по заказу.
     * Доступно только если заказ имеет статус "cancelled" и скарга еще не создана.
     */
    public function create(Order $order)
    {
        if ($order->status !== 'cancelled') {
            abort(403, 'Скаргу можна залишити лише для скасованого замовлення.');
        }

        if ($order->ticket) {
            return redirect()->route('orders.index')->with('error', 'Скарга для цього замовлення вже залишена.');
        }

        return view('tickets.create', compact('order'));
    }

    /**
     * Сохраняет скаргу в базе данных.
     */
    public function store(Request $request, Order $order)
    {
        if ($order->status !== 'cancelled') {
            abort(403, 'Скаргу можна залишити лише для скасованого замовлення.');
        }

        $data = $request->validate([
            'complaint' => 'required|string',
        ]);

        Ticket::create([
            'order_id'  => $order->id,
            'user_id'   => Auth::id(),
            'complaint' => $data['complaint'],
        ]);

        return redirect()->route('orders.index')->with('success', 'Скарга успішно залишена.');
    }
}
