<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $quizzes = Quiz::orderBy('created_at', 'desc')->get();
        $unlockedDifficulty = $user->highest_unlocked_difficulty ?? 1;

        return view('quizzes.index', compact('quizzes', 'unlockedDifficulty'));
    }

    public function show(Request $request, Quiz $quiz)
    {
        $user = $request->user();
        $availableDifficulties = $quiz->questions()
            ->with('level')
            ->get()
            ->pluck('level.difficulty')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
        $unlockedDifficulty = $user->highest_unlocked_difficulty ?? 1;

        return view('quizzes.show', compact('quiz', 'availableDifficulties', 'unlockedDifficulty'));
    }

    public function play(Request $request, Quiz $quiz, int $difficulty)
    {
        $user = $request->user();

        if ($difficulty > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $questions = $quiz->questions()
            ->with(['options', 'level'])
            ->whereHas('level', function ($query) use ($difficulty) {
                $query->where('difficulty', $difficulty);
            })
            ->get();

        if ($questions->isEmpty()) {
            abort(404);
        }

        $questionsJson = $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'text' => $option->option_text,
                        'is_correct' => $option->is_correct,
                    ];
                })->values()->toArray(),
            ];
        })->toArray();

        $totalTime = $quiz->duration_minutes * 60;
        $perQuestionTime = max(5, (int) floor($totalTime / $questions->count()));

        return view('quizzes.play', compact('quiz', 'questions', 'questionsJson', 'difficulty', 'totalTime', 'perQuestionTime'));
    }

    public function complete(Request $request, Quiz $quiz, int $difficulty)
    {
        $user = $request->user();

        if ($difficulty > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $answers = json_decode($request->input('answers', '[]'), true);
        if (! is_array($answers)) {
            $answers = [];
        }

        $questions = $quiz->questions()
            ->with(['options', 'level'])
            ->whereHas('level', function ($query) use ($difficulty) {
                $query->where('difficulty', $difficulty);
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

        $totalQuestions = $questions->count();
        $ratio = $totalQuestions > 0 ? $correctCount / $totalQuestions : 0;
        $passed = $totalQuestions > 0 && $ratio >= 0.7;
        $scorePercent = (int) round($ratio * 100);

        $xpGained = 0;
        if ($passed) {
            $xpGained += 100;
            if ($correctCount === $totalQuestions) {
                $xpGained += 50;
            }
        }

        $user->xp_total = (int) $user->xp_total + $xpGained;

        $unlockedMessage = null;

        if ($passed && ($user->highest_unlocked_difficulty ?? 1) === $difficulty) {
            $nextLevel = Level::where('difficulty', '>', $difficulty)
                ->orderBy('difficulty')
                ->first();

            if ($nextLevel) {
                $user->highest_unlocked_difficulty = $nextLevel->difficulty;
                $unlockedMessage = "Difficulté suivante débloquée : {$nextLevel->difficulty}.";
            }
        }

        $user->save();
        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'difficulty' => $difficulty,
            'score_percent' => $scorePercent,
            'correct_answers' => $correctCount,
            'total_questions' => $totalQuestions,
            'xp_gained' => $xpGained,
            'passed' => $passed,
        ]);
        $user->checkBadges();

        if ($passed) {
            $message = "Quiz réussi ($correctCount / $totalQuestions) — au moins 70 %. ";
            $message .= "XP gagnés : $xpGained";
            if ($correctCount === $totalQuestions) {
                $message .= ' (bonus score parfait inclus).';
            }
        } else {
            $message = "Quiz non validé ($correctCount / $totalQuestions) — il faut au moins 70 % de bonnes réponses. +0 XP pour cette tentative.";
        }
        if ($unlockedMessage) {
            $message .= ' '.$unlockedMessage;
        }

        return redirect()->route('dashboard')->with('success', $message);
    }
}
