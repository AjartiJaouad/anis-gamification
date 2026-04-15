<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|string|max:255|unique:users,pseudo', // استعملنا pseudo
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6|confirmed' // زدنا confirmed للتحقق من Password Confirmation
        ]);

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_anonymous' => is_null($request->email),
            'xp_total' => 0,
            'streak_days' => 0
        ]);

        auth()->login($user);

        return redirect('/')->with('success', 'Bienvenue dans ANIS!');
    }
}
