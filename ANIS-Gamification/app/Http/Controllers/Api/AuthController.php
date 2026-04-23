<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        if ($request->boolean('stay_anonymous')) {
            $request->merge(['email' => null]);
        }

        $request->validate([
            'pseudo' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[A-Za-z0-9_]+$/', 'unique:users,pseudo'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'stay_anonymous' => ['sometimes', 'boolean'],
        ]);

        $email = $request->boolean('stay_anonymous') ? null : $request->input('email');
        $role = User::count() === 0 ? 'admin' : 'user';

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'is_anonymous' => $request->boolean('stay_anonymous') || !filled($email),
            'xp_total' => 0,
            'streak_days' => 0,
        ]);

        // 🔥 Gamification start
        $user->recordLoginActivity();
        $user->checkBadges();

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user->fresh(),
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $user = User::where('pseudo', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides.'], 401);
        }

        //Gamification
        $user->recordLoginActivity();
        $user->checkBadges();

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user->fresh(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnecté.']);
    }

    public function user(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
