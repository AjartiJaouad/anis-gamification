<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user()->load([
            'badges' => fn ($query) => $query->latest()->limit(3),
            'completedModules:id',
        ]);

        $modulesCount = Module::count();
        $completedModulesCount = $user->completedModules->count();
        $moduleProgress = $modulesCount > 0
            ? (int) round(($completedModulesCount / $modulesCount) * 100)
            : 0;
        $quizAttempts = $user->quizAttempts()->latest()->get();
        $quizAttemptsCount = $quizAttempts->count();
        $passedAttemptsCount = $quizAttempts->where('passed', true)->count();
        $quizPassRate = $quizAttemptsCount > 0
            ? (int) round(($passedAttemptsCount / $quizAttemptsCount) * 100)
            : 0;
        $averageQuizScore = $quizAttemptsCount > 0
            ? (int) round($quizAttempts->avg('score_percent'))
            : 0;

        return view('dashboard', [
            'user' => $user,
            'recentBadges' => $user->badges,
            'modulesCount' => $modulesCount,
            'completedModulesCount' => $completedModulesCount,
            'moduleProgress' => $moduleProgress,
            'currentLevel' => $user->highest_unlocked_difficulty ?? 1,
            'quizAttemptsCount' => $quizAttemptsCount,
            'quizPassRate' => $quizPassRate,
            'averageQuizScore' => $averageQuizScore,
        ]);
    }
}
