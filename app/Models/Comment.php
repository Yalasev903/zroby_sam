<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * Получить модель, к которой привязан комментарий.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Автор комментария.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
