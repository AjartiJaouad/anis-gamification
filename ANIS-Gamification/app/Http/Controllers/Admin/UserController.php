<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('created_at')->paginate(12);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'pseudo' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[A-Za-z0-9_]+$/', Rule::unique('users', 'pseudo')->ignore($user->id)],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', 'in:admin,user'],
            'is_anonymous' => ['sometimes', 'boolean'],
        ]);

        $email = $request->boolean('is_anonymous') ? null : ($data['email'] ?? null);

        $user->update([
            'pseudo' => $data['pseudo'],
            'email' => $email,
            'role' => $data['role'],
            'is_anonymous' => $request->boolean('is_anonymous') || ! filled($email),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis a jour avec succes.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin.users.index')
                ->withErrors(['delete' => 'Impossible de supprimer le seul compte administrateur.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprime avec succes.');
    }
}
