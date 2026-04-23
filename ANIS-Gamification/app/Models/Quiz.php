<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Cast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'questions_count', 'duration_minutes', 'difficulty'])]
class Quiz extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'questions_count' => 'integer',
            'duration_minutes' => 'integer',
            'difficulty' => 'integer',
        ];
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
