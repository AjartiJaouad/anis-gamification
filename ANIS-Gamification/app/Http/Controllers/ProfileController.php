<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if ($request->boolean('stay_anonymous')) {
            $request->merge(['email' => null]);
        }

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'pseudo' => [
                'required',
                'string',
                'min:3',
                'max:20',
                'regex:/^[A-Za-z0-9_]+$/',
                Rule::unique('users', 'pseudo')->ignore($user->id),
            ],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'stay_anonymous' => ['sometimes', 'boolean'],
        ], [
            'pseudo.regex' => 'Le pseudonyme ne peut contenir que des lettres, chiffres et underscore (_).',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
        ]);

        $email = $request->boolean('stay_anonymous') ? null : ($validated['email'] ?? null);

        $user->pseudo = $validated['pseudo'];
        $user->email = $email;
        $user->is_anonymous = $request->boolean('stay_anonymous') || ! filled($email);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
        ]);

        $request->user()->update([
            'password' => $request->password,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Mot de passe modifié.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ], [
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
        ]);

        $user = $request->user();

        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('profile.edit')
                ->withErrors(['delete' => 'Impossible de supprimer le seul compte administrateur.']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect()->route('home')->with('success', 'Votre compte a été supprimé définitivement.');
    }
}
