<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    // Явно указываем имя таблицы
    protected $table = 'services_category';

    protected $fillable = [
        'name',
    ];

    /**
     * Определение связи "один ко многим" с услугами.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'services_category_id');
    }
}
