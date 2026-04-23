<?php

namespace App\Models;

use App\Models\Level;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['quiz_id', 'level_id', 'question'])]
class QuizQuestion extends Model
{
    use HasFactory;

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function options()
    {
        return $this->hasMany(QuizOption::class);
    }
}
