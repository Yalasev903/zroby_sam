<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Сохранение нового комментария.
     */
    public function store(Request $request)
    {
        // Валидация данных формы
        $data = $request->validate([
            'commentable_id'   => 'required|integer',
            'commentable_type' => 'required|string',
            'content'          => 'required|string|max:1000',
        ]);

        // Создание нового комментария
        $comment = new Comment();
        $comment->user_id = auth()->id(); // Автор комментария (предполагается, что пользователь аутентифицирован)
        $comment->content = $data['content'];
        $comment->commentable_id = $data['commentable_id'];
        $comment->commentable_type = $data['commentable_type'];
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }
}
