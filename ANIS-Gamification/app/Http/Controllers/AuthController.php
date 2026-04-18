<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'pseudo'   => 'required|string|max:255|unique:users,pseudo',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // إلا ما كاين حتى user → admin، غير هاكا → user
        $role = User::count() === 0 ? 'admin' : 'user';

        $user = User::create([
            'pseudo'       => $request->pseudo,
            'email'        => $request->email,
            'password'     => $request->password,
            'role'         => $role,
            'is_anonymous' => is_null($request->email),
            'xp_total'     => 0,
            'streak_days'  => 0,
        ]);

        Auth::login($user);

        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')->with('success', 'Bienvenue Admin!')
            : redirect()->route('dashboard')->with('success', 'Bienvenue dans ANIS!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'pseudo'   => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return auth()->user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }

        return back()->withErrors([
            'pseudo' => 'Les identifiants ne correspondent pas.',
        ])->withInput($request->only('pseudo'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
