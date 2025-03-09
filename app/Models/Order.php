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
}
