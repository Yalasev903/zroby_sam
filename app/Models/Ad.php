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
        'services_category_id',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
    ];

    // Связь с заказом (если заказ создан для данного объявления)
    public function order()
    {
        // Возвращаем только активные заказы, исключая отменённые
        return $this->hasOne(Order::class, 'ad_id')->where('status', '!=', 'cancelled');
    }

    // Связь с комментариями
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function servicesCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'services_category_id');
    }
}
