<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Явно указываем имя таблицы
    protected $table = 'services';

    protected $fillable = [
        'services_category_id',
        'name',
    ];

    /**
     * Определение связи "принадлежит" с категорией услуг.
     */
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'services_category_id');
    }
}
