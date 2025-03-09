<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'title',
        'description',
        'services_category_id',
        'user_id',
        'executor_id',
        'status',
        'start_time',
        'end_time',
    ];

    // Приведение полей времени к типу datetime
    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    // Остальные связи и методы модели...

    // Связь с объявлением
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    // Связь с категорией послуг
    public function servicesCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'services_category_id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function executor()
    {
        return $this->belongsTo(\App\Models\User::class, 'executor_id');
    }
}
