<?php

namespace Tests\Feature;

use App\Models\Level;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class QuizProgressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_quiz_attempt_is_logged_and_unlocks_next_level(): void
    {
        $user = User::factory()->create([
            'highest_unlocked_difficulty' => 1,
            'xp_total' => 0,
        ]);

        $levelOneId = DB::table('levels')->insertGetId([
            'difficulty' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('levels')->insert([
            'difficulty' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $quiz = Quiz::create([
            'module_id' => Module::create([
                'title' => 'Module quiz addictions',
                'content' => 'Contenu module',
                'order' => 1,
            ])->id,
            'title' => 'Quiz addictions',
            'description' => 'Quiz de validation',
            'difficulty' => 1,
            'questions_count' => 1,
            'duration_minutes' => 10,
        ]);

        $question = QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'level_id' => $levelOneId,
            'question' => 'Question test',
            'question_type' => 'qcm',
        ]);

        $correctOption = QuizOption::create([
            'quiz_question_id' => $question->id,
            'option_text' => 'Bonne reponse',
            'is_correct' => true,
        ]);

        QuizOption::create([
            'quiz_question_id' => $question->id,
            'option_text' => 'Mauvaise reponse',
            'is_correct' => false,
        ]);

        $response = $this->actingAs($user)->post(route('quizzes.complete', [$quiz, 1]), [
            'answers' => json_encode([
                $question->id => $correctOption->id,
            ]),
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('quiz_attempts', [
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'difficulty' => 1,
            'passed' => true,
            'xp_gained' => 150,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'highest_unlocked_difficulty' => 2,
            'xp_total' => 150,
        ]);
        $this->assertDatabaseHas('module_user_progress', [
            'user_id' => $user->id,
            'module_id' => $quiz->module_id,
        ]);
    }
}
