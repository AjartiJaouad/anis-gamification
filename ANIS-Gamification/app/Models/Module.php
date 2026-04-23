<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'title',
        'content',
        'order',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'module_user_progress')
            ->withPivot(['completed_at'])
            ->withTimestamps();
    }
}
