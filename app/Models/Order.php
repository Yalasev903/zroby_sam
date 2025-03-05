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
        'category',
        'user_id',
        'executor_id',
        'status',
        'start_time',
        'end_time',
    ];

    // При необходимости можно добавить обратное отношение к объявлению
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
