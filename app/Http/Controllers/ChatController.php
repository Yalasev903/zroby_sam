<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Отображение страницы чата
    public function index()
    {
        return view('chat.index'); // Убедитесь, что файл chat/index.blade.php создан
    }

    // Обработка отправки сообщения
    public function send(Request $request)
    {
        // Валидация данных
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Пример записи сообщения в базу данных
        \DB::table('messages')->insert([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Сообщение отправлено!');
    }
}
