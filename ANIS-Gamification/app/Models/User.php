<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Badge;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'role',
        'is_anonymous',
        'xp_total',
        'streak_days',
        'streak_last_counted_on',
        'last_daily_bonus_date',
        'highest_unlocked_difficulty'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'highest_unlocked_difficulty' => 'integer',
        'streak_last_counted_on' => 'date',
        'last_daily_bonus_date' => 'date',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    //  RELATION AVEC BADGES
    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withTimestamps();
    }

    //  STREAK SYSTEM 
    public function recordLoginActivity(): void
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($this->last_daily_bonus_date === null || ! $this->last_daily_bonus_date->equalTo($today)) {
            $this->xp_total += 10;
            $this->last_daily_bonus_date = $today;
        }

        if (! $this->streak_last_counted_on?->equalTo($today)) {
            if ($this->streak_last_counted_on === null) {
                $this->streak_days = 1;
            } elseif ($this->streak_last_counted_on->equalTo($yesterday)) {
                $this->streak_days += 1;
            } else {
                $this->streak_days = 1;
            }

            $this->streak_last_counted_on = $today;
        }

        $this->save();
    }
}
