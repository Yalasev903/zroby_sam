<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Выбираем только те уведомления, которые предназначены именно этому пользователю (без общих уведомлений)
        $notifications = Notification::where('user_id', $user->id)
            ->orWhere(function ($query) use ($user) {
                $query->whereNull('user_id')
                      ->where('created_at', '>=', $user->created_at); // Только уведомления после регистрации
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }
}
