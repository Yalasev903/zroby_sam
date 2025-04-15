<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FondyService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
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

    public function takeOrder(Ad $ad)
    {
        if (Auth::user()->role !== 'executor') {
            abort(403);
        }

        if ($ad->order) {
            if (in_array($ad->order->status, ['waiting', 'in_progress', 'pending_confirmation'])) {
                return back()->with('error', 'Этот заказ уже взят.');
            }
            if ($ad->order->status === 'cancelled' && $ad->order->executor_id === Auth::id()) {
                return back()->with('error', 'Вы не можете снова взять этот заказ.');
            }
        }

        $order = Order::create([
            'ad_id' => $ad->id,
            'title' => $ad->title,
            'description' => $ad->description,
            'services_category_id' => $ad->servicesCategory->id ?? null,
            'user_id' => $ad->user_id,
            'executor_id' => Auth::id(),
            'status' => 'waiting',
        ]);

        return redirect()->route('orders.index')->with('success', 'Замовлення успішно створено та прийнято.');
    }

    public function approveOrder(Order $order)
    {
        if (Auth::id() !== $order->user_id || Auth::user()->role !== 'customer') {
            abort(403);
        }

        if ($order->status !== 'waiting') {
            return back()->with('error', 'Замовлення не готово до запуску.');
        }

        $order->update([
            'status' => 'in_progress',
            'start_time' => now(),
        ]);

        return back()->with('success', 'Замовлення виконується.');
    }

    public function completeOrder(Order $order)
    {
        if (Auth::id() !== $order->executor_id || Auth::user()->role !== 'executor') {
            abort(403);
        }

        if ($order->status !== 'in_progress') {
            return back()->with('error', 'Замовлення не можна завершити.');
        }

        $order->update([
            'status' => 'pending_confirmation',
            'end_time' => now(),
        ]);

        return back()->with('success', 'Очікує підтвердження замовником.');
    }

    public function confirmOrder(Order $order, FondyService $fondy)
    {
        if (Auth::id() !== $order->user_id || Auth::user()->role !== 'customer') {
            abort(403);
        }

        if ($order->status !== 'pending_confirmation') {
            return back()->with('error', 'Не можна підтвердити на цьому етапі.');
        }

        $order->update(['status' => 'completed']);

        if ($order->executor) $order->executor->updateRating(1);
        if ($order->customer) $order->customer->updateRating(1);

        if ($order->isGuarantee() && $order->guarantee_payment_status === 'paid') {
            $order->update(['guarantee_payment_status' => 'transferring']);

            dispatch(function () use ($order, $fondy) {
                sleep(2); // имитация запроса

                $fondy->sendPayout($order);

                $order->update([
                    'guarantee_payment_status' => 'transferred',
                    'guarantee_transferred_at' => now(),
                ]);
            })->afterResponse();
        }

        return back()->with('success', 'Замовлення підтверджено. Гроші перераховуються виконавцю.');
    }

    public function setNoGuarantee(Order $order)
    {
        if (Auth::id() !== $order->executor_id || $order->payment_type !== 'none') {
            abort(403);
        }

        $order->update([
            'payment_type' => 'no_guarantee',
        ]);

        return back()->with('success', 'Робота без гаранта підтверджена.');
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $user = Auth::user();

        if (!($user->id === $order->user_id || $user->id === $order->executor_id)) {
            abort(403);
        }

        $data = $request->validate([
            'cancellation_reason' => 'required|string',
            'custom_reason' => 'nullable|string',
        ]);

        $reason = $data['cancellation_reason'] === 'other' ? $data['custom_reason'] : $data['cancellation_reason'];

        if (in_array($order->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Неможливо скасувати.');
        }

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_by' => $user->role,
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Замовлення скасовано.');
    }

    public function setGuarantee(Request $request, Order $order)
    {
        if (Auth::id() !== $order->executor_id || $order->payment_type !== 'none') {
            abort(403);
        }

        $data = $request->validate([
            'guarantee_amount' => 'required|numeric|min:1',
            'guarantee_card_number' => 'required|string|min:16|max:19',
        ]);

        $order->update([
            'payment_type' => 'guarantee',
            'guarantee_amount' => $data['guarantee_amount'],
            'guarantee_card_number' => $data['guarantee_card_number'],
            'guarantee_payment_status' => 'pending',
        ]);

        return back()->with('success', 'Оплата через гаранта запропонована.');
    }

    public function approveGuarantee(Order $order, FondyService $fondy)
    {
        if (Auth::id() !== $order->user_id || !$order->isGuarantee()) {
            abort(403);
        }

        if ($order->guarantee_payment_status !== 'pending') {
            return back()->with('error', 'Оплата вже зроблена або обробляється.');
        }

        $checkoutUrl = $fondy->createPayment($order);
        return redirect($checkoutUrl);
    }

    public function confirmGuaranteeTransfer(Order $order)
    {
        if (!Auth::user()->is_admin) abort(403);

        if ($order->guarantee_payment_status !== 'paid') {
            return back()->with('error', 'Спочатку потрібно оплатити.');
        }

        $payout = round($order->guarantee_amount * 0.9, 2);

        $order->update([
            'guarantee_payment_status' => 'transferred',
            'guarantee_transferred_at' => now(),
        ]);

        return back()->with('success', "Виплата {$payout} грн відправлена виконавцю.");
    }

    public function paymentCallback(Request $request, Order $order)
    {
        \Log::info('💳 Payment callback received', [
            'order_id' => $order->id,
            'payment_type' => $order->payment_type,
            'order_status' => $request->input('order_status'),
            'guarantee_status' => $order->guarantee_payment_status,
        ]);

        if ($request->input('order_status') === 'approved') {
            $order->update([
                'guarantee_payment_status' => 'paid',
                'guarantee_paid_at' => now(),
                'status' => 'in_progress',
                'start_time' => now(),
            ]);

            \Log::info('✅ Order marked as paid & started', ['order_id' => $order->id]);
        }

        return response()->json(['status' => 'ok']);
    }

    public function confirmPayment(Order $order)
    {
        return redirect()->route('orders.index')->with('success', 'Оплата гаранту пройшла успішно.');
    }
}
