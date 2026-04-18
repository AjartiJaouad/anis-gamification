<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $levels = Level::orderBy('difficulty')->get();
        $unlockedDifficulty = $user->highest_unlocked_difficulty ?? 1;

        return view('quizzes.index', compact('levels', 'unlockedDifficulty'));
    }

    public function showLevel(Request $request, Level $level)
    {
        $user = $request->user();

        if ($level->difficulty > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $quizzes = Quiz::whereHas('questions.level', function ($query) use ($level) {
            $query->where('difficulty', $level->difficulty);
        })
        ->withCount(['questions as questions_for_level_count' => function ($query) use ($level) {
            $query->whereHas('level', function ($query) use ($level) {
                $query->where('difficulty', $level->difficulty);
            });
        }])
        ->orderBy('title')
        ->get();

        return view('quizzes.level', compact('level', 'quizzes'));
    }

    public function play(Request $request, Level $level, Quiz $quiz)
    {
        $user = $request->user();

        if ($level->difficulty > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        if (! $quiz->questions()->whereHas('level', function ($query) use ($level) {
            $query->where('difficulty', $level->difficulty);
        })->exists()) {
            abort(404);
        }

        $questions = $quiz->questions()
            ->with(['options'])
            ->whereHas('level', function ($query) use ($level) {
                $query->where('difficulty', $level->difficulty);
            })
            ->get();

        if ($questions->isEmpty()) {
            abort(404);
        }

        $totalTime = $quiz->duration_minutes * 60;
        $perQuestionTime = max(5, (int) floor($totalTime / $questions->count()));

        return view('quizzes.play', compact('quiz', 'level', 'questions', 'totalTime', 'perQuestionTime'));
    }

    public function complete(Request $request, Level $level, Quiz $quiz)
    {
        $user = $request->user();

        if ($level->difficulty > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $answers = json_decode($request->input('answers', '[]'), true);
        if (! is_array($answers)) {
            $answers = [];
        }

        $questions = $quiz->questions()
            ->with(['options'])
            ->whereHas('level', function ($query) use ($level) {
                $query->where('difficulty', $level->difficulty);
            })
            ->get();

        $correctCount = 0;
        foreach ($questions as $question) {
            $selectedOptionId = isset($answers[$question->id]) ? (int) $answers[$question->id] : null;
            $option = $question->options->firstWhere('id', $selectedOptionId);

            if ($option && $option->is_correct) {
                $correctCount++;
            }
        }

        $xpGained = $correctCount * 10;
        $user->xp_total += $xpGained;

        $passed = $questions->count() > 0 && ($correctCount / $questions->count()) >= 0.5;
        $unlockedMessage = null;

        if ($passed && ($user->highest_unlocked_difficulty ?? 1) === $level->difficulty) {
            $nextLevel = Level::where('difficulty', '>', $level->difficulty)
                ->orderBy('difficulty')
                ->first();

            if ($nextLevel) {
                $user->highest_unlocked_difficulty = $nextLevel->difficulty;
                $unlockedMessage = "Niveau suivant débloqué : difficulté {$nextLevel->difficulty}.";
            }
        }

        $user->save();

        $message = "Quiz terminé : $correctCount / {$questions->count()} réponses correctes. Vous gagnez $xpGained XP.";
        if ($unlockedMessage) {
            $message .= ' ' . $unlockedMessage;
        }

        return redirect()->route('dashboard')->with('success', $message);
    }
}
