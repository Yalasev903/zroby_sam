<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'photo_path',
        'city',
        'posted_at',
    ];

    /**
     * Получить владельца объявления.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить комментарии объявления.
     */
    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

}
