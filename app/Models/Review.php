<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
         'order_id',
         'customer_id',
         'executor_id',
         'review_by',
         'rating',
         'comment',
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    // Отзыв, оставленный заказчиком (о исполнителе) – customer_id является автором
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }

    // Отзыв, оставленный исполнителем (о заказчике) – executor_id является автором
    public function executor()
    {
        return $this->belongsTo(\App\Models\User::class, 'executor_id');
    }
}
