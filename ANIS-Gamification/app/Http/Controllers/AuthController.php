<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name ?? 'Anonymous',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_anonymous' => true
        ]);

        return redirect('/login')->with('success', 'Account created');
    }
}
