<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

// Auth Routes
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [AuthController::class, 'register']);
