<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleJourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_modules_and_mark_one_complete(): void
    {
        $user = User::factory()->create([
            'highest_unlocked_difficulty' => 2,
        ]);

        $moduleOne = Module::create([
            'title' => 'Comprendre les dependances',
            'content' => 'Contenu du premier module',
            'order' => 1,
        ]);

        $quiz = Quiz::create([
            'module_id' => $moduleOne->id,
            'title' => 'Quiz module 1',
            'description' => 'Validation module 1',
            'difficulty' => 1,
            'questions_count' => 1,
            'duration_minutes' => 10,
        ]);

        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'difficulty' => 1,
            'score_percent' => 80,
            'correct_answers' => 4,
            'total_questions' => 5,
            'xp_gained' => 100,
            'passed' => true,
        ]);

        Module::create([
            'title' => 'Prevenir les rechutes',
            'content' => 'Contenu du second module',
            'order' => 2,
        ]);

        $response = $this->actingAs($user)->get(route('modules.index'));

        $response->assertOk()
            ->assertSee('Comprendre les dependances')
            ->assertSee('Prevenir les rechutes');

        $completeResponse = $this->actingAs($user)->post(route('modules.complete', $moduleOne));

        $completeResponse->assertRedirect(route('modules.show', $moduleOne));
        $this->assertDatabaseHas('module_user_progress', [
            'user_id' => $user->id,
            'module_id' => $moduleOne->id,
        ]);
    }

    public function test_user_cannot_open_locked_module(): void
    {
        $user = User::factory()->create([
            'highest_unlocked_difficulty' => 1,
        ]);

        $lockedModule = Module::create([
            'title' => 'Module verrouille',
            'content' => 'Contenu bloque',
            'order' => 3,
        ]);

        $response = $this->actingAs($user)->get(route('modules.show', $lockedModule));

        $response->assertForbidden();
    }

    public function test_user_cannot_complete_module_without_passing_linked_quiz(): void
    {
        $user = User::factory()->create([
            'highest_unlocked_difficulty' => 1,
        ]);

        $module = Module::create([
            'title' => 'Module avec validation quiz',
            'content' => 'Contenu',
            'order' => 1,
        ]);

        Quiz::create([
            'module_id' => $module->id,
            'title' => 'Quiz de validation',
            'description' => 'Validation',
            'difficulty' => 1,
            'questions_count' => 1,
            'duration_minutes' => 10,
        ]);

        $response = $this->actingAs($user)->post(route('modules.complete', $module));

        $response->assertRedirect(route('modules.show', $module));
        $response->assertSessionHasErrors('module');
        $this->assertDatabaseMissing('module_user_progress', [
            'user_id' => $user->id,
            'module_id' => $module->id,
        ]);
    }
}
