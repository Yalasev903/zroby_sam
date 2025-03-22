<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $fillable = [
        'auto_greeting_enabled',
        'auto_greeting_text',
    ];
}
