<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Connexion - ANIS</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#89379f",
                        "primary-dim": "#7c2992",
                        "surface": "#f5f6f7",
                        "on-surface": "#2c2f30",
                        "surface-container-lowest": "#ffffff",
                        "error": "#b41340",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md">

        <div class="mb-8 text-center">
            <span class="material-symbols-outlined text-4xl text-primary">local_florist</span>
            <h1 class="font-headline font-extrabold text-3xl mt-2">Bon retour sur <span class="text-primary">ANIS</span></h1>
            <p class="text-gray-500 text-sm mt-1">Connectez-vous avec votre pseudonyme</p>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-8 shadow-2xl border border-gray-100">

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Global error --}}
                @if ($errors->any())
                    <div class="text-sm text-error bg-red-50 border border-red-200 rounded-xl px-4 py-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Pseudo --}}
                <div class="space-y-2">
                    <label for="pseudo" class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Pseudonyme
                    </label>
                    <div class="relative">
                        <input
                            id="pseudo"
                            type="text"
                            name="pseudo"
                            value="{{ old('pseudo') }}"
                            required
                            autofocus
                            placeholder="ex: SilverFern42"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all @error('pseudo') border-red-400 @enderror"
                        />
                        <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 text-sm">face</span>
                    </div>
                    @error('pseudo')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <label for="password" class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all @error('password') border-red-400 @enderror"
                        />
                        <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 text-sm">lock</span>
                    </div>
                    @error('password')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-primary to-primary-dim text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 hover:opacity-90 transition-all active:scale-[0.98]"
                >
                    Se connecter
                </button>

                <p class="text-center text-sm text-gray-500">
                    Pas encore de compte ?
                    <a href="{{ route('register.show') }}" class="text-primary font-bold hover:underline">S'inscrire</a>
                </p>
            </form>

        </div>
    </div>

</body>
</html>
