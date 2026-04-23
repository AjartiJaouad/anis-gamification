<?php

namespace App\Models;

use App\Models\Badge;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'highest_unlocked_difficulty',
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

    // 🔐 Vérifier admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // 🏅 Relation avec badges
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withTimestamps();
    }

    public function completedModules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_user_progress')
            ->withPivot(['completed_at'])
            ->withTimestamps();
    }

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // 🔥 Streak + bonus XP login
    public function recordLoginActivity(): void
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Bonus XP une fois par jour
        if ($this->last_daily_bonus_date === null || ! $this->last_daily_bonus_date->equalTo($today)) {
            $this->xp_total += 10;
            $this->last_daily_bonus_date = $today;
        }

        // Gestion du streak
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

    // 🎮 Attribution automatique des badges
    public function checkBadges(): void
    {
        $badges = Badge::all();

        foreach ($badges as $badge) {

            // Badge XP
            if ($badge->condition_type === 'xp' && $this->xp_total >= $badge->condition_value) {
                $this->badges()->syncWithoutDetaching([$badge->id]);
            }

            // Badge Streak
            if ($badge->condition_type === 'streak' && $this->streak_days >= $badge->condition_value) {
                $this->badges()->syncWithoutDetaching([$badge->id]);
            }
        }
    }

    public function hasCompletedModule(Module $module): bool
    {
        return $this->completedModules->contains($module->id);
    }
}
