<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Укажите поля, доступные для массового заполнения
    protected $fillable = [
        'title',
        'description',
        'category',
        'user_id',
        'executor_id',
        'status',
        'start_time',
        'end_time',
    ];
}
