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
         'rating',
         'comment',
    ];

    // Связь с заказом
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Связь с заказчиком
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Связь с исполнителем
    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }
}
