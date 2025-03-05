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

    // Связь с заказом (если заказ создан для данного объявления)
    public function order()
    {
        return $this->hasOne(Order::class, 'ad_id');
    }

    // Другие отношения, например, с комментариями
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
