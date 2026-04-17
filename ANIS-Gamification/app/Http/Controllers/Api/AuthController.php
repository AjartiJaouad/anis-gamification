<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'pseudo'   => 'required|string|max:255|unique:users,pseudo',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'pseudo'       => $request->pseudo,
            'email'        => $request->email,
            'password'     => $request->password,
            'is_anonymous' => is_null($request->email),
            'xp_total'     => 0,
            'streak_days'  => 0,
        ]);

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user'  => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'pseudo'   => 'required|string',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('pseudo', 'password'))) {
            return response()->json(['message' => 'Identifiants invalides.'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user'  => $user,
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
