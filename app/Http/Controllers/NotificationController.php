<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Здесь вы можете подготовить данные для отображения уведомлений
        // Например, получить их из базы или другого сервиса
        $notifications = []; // Замените на реальный запрос

        return view('notifications.index', compact('notifications'));
    }
}
