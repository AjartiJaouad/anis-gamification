<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        if ($request->boolean('stay_anonymous')) {
            $request->merge(['email' => null]);
        }

        $request->validate([
            'pseudo' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[A-Za-z0-9_]+$/', 'unique:users,pseudo'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'stay_anonymous' => ['sometimes', 'boolean'],
            'cgu' => ['accepted'],
        ], [
            'pseudo.regex' => 'Le pseudonyme ne peut contenir que des lettres, chiffres et underscore (_).',
            'pseudo.unique' => 'Ce pseudonyme est déjà utilisé.',
            'email.unique' => 'Cet e-mail est déjà utilisé.',
            'cgu.accepted' => 'Vous devez accepter les conditions d’utilisation.',
        ]);

        $email = $request->boolean('stay_anonymous') ? null : $request->input('email');

        $role = User::count() === 0 ? 'admin' : 'user';

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $email,
            'password' => $request->password,
            'role' => $role,
            'is_anonymous' => $request->boolean('stay_anonymous') || ! filled($email),
            'xp_total' => 0,
            'streak_days' => 0,
        ]);

        Auth::login($user);
        $user->recordLoginActivity();

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
            'login' => ['required', 'string'],
            'password' => ['required'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $user = User::where('pseudo', $credentials['login'])
            ->orWhere('email', $credentials['login'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'Les identifiants ne correspondent pas.',
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $user->recordLoginActivity();

        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
