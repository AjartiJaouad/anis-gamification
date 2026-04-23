<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'condition_type',
        'condition_value'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
