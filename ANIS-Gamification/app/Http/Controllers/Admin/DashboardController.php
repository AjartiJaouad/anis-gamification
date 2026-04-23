<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
        $anonymousCount = User::where('is_anonymous', true)->count();
        $totalAttempts = QuizAttempt::count();
        $passedAttempts = QuizAttempt::where('passed', true)->count();
        $quizPassRate = $totalAttempts > 0 ? (int) round(($passedAttempts / $totalAttempts) * 100) : 0;
        $averageQuizScore = $totalAttempts > 0 ? (int) round(QuizAttempt::avg('score_percent')) : 0;
        $topLearner = User::orderByDesc('xp_total')->first();
        $topQuiz = Quiz::withCount('attempts')->orderByDesc('attempts_count')->first();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'anonymousCount' => $anonymousCount,
            'totalXp' => User::sum('xp_total'),
            'bestStreak' => User::max('streak_days') ?? 0,
            'modulesCount' => Module::count(),
            'quizzesCount' => Quiz::count(),
            'badgesCount' => Badge::count(),
            'totalAttempts' => $totalAttempts,
            'quizPassRate' => $quizPassRate,
            'averageQuizScore' => $averageQuizScore,
            'topLearner' => $topLearner,
            'topQuiz' => $topQuiz,
            'recentUsers' => User::latest()->take(10)->get(),
            'adminPct' => $totalUsers > 0 ? round(($adminCount / $totalUsers) * 100) : 0,
            'userPct' => $totalUsers > 0 ? round(($userCount / $totalUsers) * 100) : 0,
            'anonymousPct' => $totalUsers > 0 ? round(($anonymousCount / $totalUsers) * 100) : 0,
        ]);
    }
}
