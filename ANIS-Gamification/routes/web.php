<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\LevelController;

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

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))
        ->name('dashboard');

    Route::resource('levels', LevelController::class)->except(['show']);
});
