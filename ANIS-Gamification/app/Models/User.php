<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['pseudo', 'email', 'password', 'role', 'is_anonymous', 'xp_total', 'streak_days', 'streak_last_counted_on', 'last_daily_bonus_date', 'highest_unlocked_difficulty'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'highest_unlocked_difficulty' => 'integer',
            'streak_last_counted_on' => 'date',
            'last_daily_bonus_date' => 'date',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Daily connection bonus (10 XP) and streak (consecutive days) on first visit of the day.
     */
    public function recordLoginActivity(): void
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($this->last_daily_bonus_date === null || ! $this->last_daily_bonus_date->equalTo($today)) {
            $this->xp_total = (int) $this->xp_total + 10;
            $this->last_daily_bonus_date = $today;
        }

        if (! $this->streak_last_counted_on?->equalTo($today)) {
            if ($this->streak_last_counted_on === null) {
                $this->streak_days = 1;
                $this->streak_last_counted_on = $today;
            } elseif ($this->streak_last_counted_on->equalTo($yesterday)) {
                $this->streak_days = (int) $this->streak_days + 1;
                $this->streak_last_counted_on = $today;
            } else {
                $this->streak_days = 1;
                $this->streak_last_counted_on = $today;
            }
        }

        $this->save();
    }
}
