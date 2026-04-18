<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\User\QuizController as UserQuizController;

Route::get('/', fn() => view('home'));

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// User dashboard - auth فقط
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/quizzes', [UserQuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [UserQuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{quiz}/difficulty/{difficulty}', [UserQuizController::class, 'play'])->name('quizzes.play');
    Route::post('/quizzes/{quiz}/difficulty/{difficulty}/complete', [UserQuizController::class, 'complete'])->name('quizzes.complete');
});

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))
        ->name('dashboard');

    Route::resource('levels', LevelController::class)->except(['show']);
    Route::resource('quizzes', QuizController::class)->except(['show']);
    Route::resource('questions', QuestionController::class)->except(['show']);
    Route::resource('quizzes.questions', QuizQuestionController::class)->except(['show']);
});
