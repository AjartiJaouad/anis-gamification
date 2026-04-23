<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#89379f",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff1f2",
                        "surface-container": "#e6e8ea",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-surface font-body text-on-surface">
    <header class="bg-surface-container-lowest px-6 py-4 shadow-sm">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Admin • Gestion des utilisateurs</p>
                <h1 class="mt-2 font-headline text-3xl font-extrabold">Utilisateurs</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                    Retour au dashboard
                </a>
                <a href="{{ route('admin.modules.index') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white transition hover:bg-primary-dim">
                    Voir les modules
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-primary/20 bg-primary/10 p-4 text-sm font-semibold text-primary">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('delete'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                {{ $errors->first('delete') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-[2rem] border border-surface-container bg-white shadow-sm">
            <div class="border-b border-surface-container bg-surface-container-lowest px-6 py-5">
                <h2 class="text-lg font-semibold">Liste des comptes</h2>
                <p class="mt-1 text-sm text-on-surface-variant">Consulte, modifie le role ou supprime un compte si necessaire.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-surface-container">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Pseudo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">XP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Streak</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low bg-white">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-sm font-semibold">{{ $user->pseudo }}</td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $user->email ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm">{{ strtoupper($user->role) }}</td>
                                <td class="px-6 py-4 text-sm">{{ $user->xp_total }}</td>
                                <td class="px-6 py-4 text-sm">{{ $user->streak_days }}j</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full border border-primary/10 bg-primary/5 px-3 py-2 font-semibold text-primary transition hover:bg-primary/10">
                                            Modifier
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full bg-red-50 px-3 py-2 font-semibold text-red-700 transition hover:bg-red-100">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-on-surface-variant">Aucun utilisateur trouve.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </main>
</body>
</html>
