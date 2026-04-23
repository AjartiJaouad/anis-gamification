<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Modifier un utilisateur</title>
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
        <div class="mx-auto flex max-w-3xl flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-slate-500">Admin • Edition utilisateur</p>
                <h1 class="mt-2 font-headline text-3xl font-extrabold">{{ $user->pseudo }}</h1>
            </div>
            <a href="{{ route('admin.users.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                Retour a la liste
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6">
        <div class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="pseudo" class="block text-sm font-semibold">Pseudo</label>
                    <input id="pseudo" type="text" name="pseudo" value="{{ old('pseudo', $user->pseudo) }}" required class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    @error('pseudo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold">Role</label>
                    <select id="role" name="role" class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                        <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-start gap-3 rounded-2xl bg-surface px-4 py-4">
                    <input type="checkbox" name="is_anonymous" value="1" class="mt-1" @checked(old('is_anonymous', $user->is_anonymous))>
                    <span>
                        <span class="block text-sm font-semibold">Conserver l'anonymat</span>
                        <span class="mt-1 block text-sm text-slate-500">Si active, l'email sera retire et le compte restera anonyme.</span>
                    </span>
                </label>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold transition hover:border-primary hover:text-primary">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white transition hover:bg-primary-dim">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
