<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'difficulty',
        'score_percent',
        'correct_answers',
        'total_questions',
        'xp_gained',
        'passed',
    ];

    protected $casts = [
        'difficulty' => 'integer',
        'score_percent' => 'float',
        'correct_answers' => 'integer',
        'total_questions' => 'integer',
        'xp_gained' => 'integer',
        'passed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
