<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'company_name',
        'city',
        'profile_photo_path',
        'skills',
        'services_category',
        'services',
        'rating',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill');
    }

    public function hasRole($role)
    {
       return $this->role === $role;
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : asset('images/default-avatar.webp'); // Путь к изображению по умолчанию
    }

    public function updateRating(int $points): void
    {
        $this->increment('rating', $points);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function receivedComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviewsReceived()
    {
        return $this->hasMany(\App\Models\Review::class, 'executor_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
