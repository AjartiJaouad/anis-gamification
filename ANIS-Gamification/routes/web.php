<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');

Route::post('/register', [AuthController::class, 'register'])->name('register');
