<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'complaint', 'created_by'];

    // Связь с заказом
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Связь с пользователем (кто оставил скаргу)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
