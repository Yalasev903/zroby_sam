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
        'payment_type',
        'guarantee_amount',
        'guarantee_card_number',
        'guarantee_payment_status',
        'guarantee_paid_at',
        'guarantee_transferred_at',
        'cancellation_reason',
        'cancelled_by',
        'cancelled_at',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
        'guarantee_paid_at' => 'datetime',
        'guarantee_transferred_at' => 'datetime',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

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

    public function ticket()
    {
        return $this->hasOne(\App\Models\Ticket::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    public function isGuarantee()
    {
        return $this->payment_type === 'guarantee';
    }

    public function isPaid()
    {
        return $this->guarantee_payment_status === 'paid';
    }

    public function isTransferred()
    {
        return $this->guarantee_payment_status === 'transferred';
    }

    public function maskedCard()
    {
        if (!$this->guarantee_card_number) return null;
        return str_repeat('*', 12) . substr($this->guarantee_card_number, -4);
    }
}
