<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mon profil - ANIS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#89379f",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#e6e8ea",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        error: "#b41340",
                    },
                    fontFamily: { headline: ["Plus Jakarta Sans"], body: ["Inter"] },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen">
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-3xl flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline">
                <span class="material-symbols-outlined">arrow_back</span>
                Dashboard
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-semibold text-on-surface-variant hover:text-primary">Déconnexion</button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-6 py-10 space-y-10">
        <div>
            <h1 class="font-headline text-3xl font-extrabold text-on-surface">Mon profil</h1>
            <p class="mt-2 text-sm text-on-surface-variant">Gérez vos informations et la confidentialité.</p>
        </div>

        @if(session('success'))
            <div class="rounded-xl bg-primary/10 px-4 py-3 text-sm font-semibold text-primary">
                {{ session('success') }}
            </div>
        @endif

        <section class="rounded-2xl border border-surface-container bg-surface-container-lowest p-6 shadow-sm">
            <h2 class="font-headline text-lg font-bold">Coordonnées</h2>
            <p class="mt-1 text-sm text-on-surface-variant">Le mot de passe actuel est requis pour toute modification.</p>
            <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="current_password_profile" class="block text-sm font-semibold">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password_profile" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3 text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/10" autocomplete="current-password">
                    @error('current_password')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="pseudo" class="block text-sm font-semibold">Pseudonyme</label>
                    <input type="text" name="pseudo" id="pseudo" value="{{ old('pseudo', $user->pseudo) }}" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3" minlength="3" maxlength="20" pattern="[A-Za-z0-9_]+"
                        title="Lettres, chiffres et underscore uniquement">
                    @error('pseudo')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold">E-mail (optionnel)</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3" autocomplete="email">
                    @error('email')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>
                <label class="flex items-start gap-3">
                    <input type="checkbox" name="stay_anonymous" value="1" class="mt-1 rounded border-surface-container text-primary" {{ old('stay_anonymous', $user->is_anonymous) ? 'checked' : '' }}>
                    <span class="text-sm text-on-surface-variant">Rester totalement anonyme (l’e-mail ne sera pas enregistré).</span>
                </label>
                <button type="submit" class="w-full rounded-full bg-primary py-3 text-sm font-semibold text-white hover:bg-primary-dim">Enregistrer</button>
            </form>
        </section>

        <section class="rounded-2xl border border-surface-container bg-surface-container-lowest p-6 shadow-sm">
            <h2 class="font-headline text-lg font-bold">Changer le mot de passe</h2>
            <form action="{{ route('profile.password') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="current_password_pwd" class="block text-sm font-semibold">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password_pwd" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3" autocomplete="current-password">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3" autocomplete="new-password">
                    <p class="mt-1 text-xs text-on-surface-variant">Min. 8 caractères, majuscule, minuscule et chiffre.</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold">Confirmer</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3" autocomplete="new-password">
                </div>
                @error('password')<p class="text-sm text-error">{{ $message }}</p>@enderror
                @error('current_password')@if(! $errors->has('pseudo'))<p class="text-sm text-error">{{ $message }}</p>@endif @enderror
                <button type="submit" class="w-full rounded-full bg-primary py-3 text-sm font-semibold text-white hover:bg-primary-dim">Mettre à jour le mot de passe</button>
            </form>
        </section>

        <section class="rounded-2xl border border-error/30 bg-error/5 p-6">
            <h2 class="font-headline text-lg font-bold text-error">Zone sensible</h2>
            <p class="mt-2 text-sm text-on-surface-variant">⚠️ Cette action est irréversible. Toutes vos données personnelles et votre progression associée à ce compte seront supprimées.</p>
            @error('delete')<p class="mt-2 text-sm text-error font-semibold">{{ $message }}</p>@enderror
            <form action="{{ route('profile.destroy') }}" method="POST" class="mt-6 space-y-4" onsubmit="return confirm('Supprimer définitivement votre compte ?');">
                @csrf
                @method('DELETE')
                <div>
                    <label for="delete_password" class="block text-sm font-semibold">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="delete_password" required
                        class="mt-2 w-full rounded-xl border border-surface-container bg-white px-4 py-3">
                </div>
                <button type="submit" class="w-full rounded-full border-2 border-error bg-white py-3 text-sm font-semibold text-error hover:bg-error hover:text-white">Supprimer mon compte</button>
            </form>
        </section>
    </main>
</body>
</html>
