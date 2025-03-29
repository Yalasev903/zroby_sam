<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Находим все непрочитанные уведомления пользователя
        $unreadNotifications = \App\Models\Notification::where('user_id', $user->id)
            ->where('read', false)
            ->whereNull('cleared_at')
            ->get();

        // Помечаем их как прочитанные
        foreach ($unreadNotifications as $notification) {
            $notification->read = true;
            $notification->save();
        }

        // Дальше получаем все уведомления (или фильтруем, как вам нужно)
        // В данном примере берём все уведомления, неочищённые или очищённые не старше 60 дней
        // (Это условие вы уже использовали для админа/пользователя)
        if ($user->isAdmin()) {
            $notifications = \App\Models\Notification::orderBy('created_at', 'desc')
                ->where(function ($query) {
                    $query->whereNull('cleared_at')
                        ->orWhere('cleared_at', '>=', now()->subDays(60));
                })
                ->get();
        } else {
            $notifications = \App\Models\Notification::where(function ($query) use ($user) {
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

    public function notificationTable()
    {
        $notifications = \App\Models\Notification::orderBy('created_at', 'desc')->get();
        return view('admin.pages.notification_table', compact('notifications'));
    }

    public function destroy($id)
    {
        // Поиск уведомления по id
        $notification = \App\Models\Notification::findOrFail($id);

        // Удаляем уведомление
        $notification->delete();

        return redirect()->route('admin.notification.table')->with('success', 'Повідомлення успішно видалено.');
    }
}
