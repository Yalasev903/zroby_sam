<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Для администратора: показываем все уведомления, включая скрытые, если они не старше 60 дней
            $notifications = Notification::orderBy('created_at', 'desc')
                ->where(function ($query) {
                    $query->whereNull('cleared_at')
                          ->orWhere('cleared_at', '>=', now()->subDays(60));
                })
                ->get();
        } else {
            // Для обычного пользователя: показываем уведомления, где cleared_at равен NULL
            $notifications = Notification::where(function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->orWhere(function ($query) use ($user) {
                              $query->whereNull('user_id')
                                    ->where('created_at', '>=', $user->created_at);
                          });
                })
                ->whereNull('cleared_at')
                ->orderBy('created_at', 'desc')
                ->get();
    }
                return view('notifications.index', compact('notifications'));
            }

    public function clearUserNotifications(Request $request)
{
    $user = auth()->user();

    // Обновляем только уведомления, предназначенные данному пользователю и не очищённые ранее
    Notification::where('user_id', $user->id)
        ->whereNull('cleared_at')
        ->update(['cleared_at' => now()]);

    return redirect()->route('notifications.index')->with('status', 'Уведомления успешно очищены');
}

}
