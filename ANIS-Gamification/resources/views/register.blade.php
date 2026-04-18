<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Rejoindre ANIS - Sécurisé & Anonyme</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#89379f",
                        "primary-dim": "#7c2992",
                        "surface": "#f5f6f7",
                        "on-surface": "#2c2f30",
                        "primary-container": "#e88efc",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                    },
                },
            },
        }
    </script>

    <style>
        .botanical-mask {
            mask-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="M44.7,-76.4C58.3,-69.2,70.1,-59,78.5,-46.3C86.9,-33.5,92,-18.3,91.3,-3.4C90.6,11.5,84.1,26.1,75.4,39.6C66.7,53.1,55.8,65.5,42.5,73.1C29.2,80.7,13.6,83.5,-1.6,86.2C-16.7,88.9,-33.4,91.6,-47.5,85.5C-61.6,79.4,-73.1,64.6,-80.7,49C-88.3,33.5,-92.1,17.2,-91.2,1.5C-90.4,-14.2,-84.9,-29.3,-75.7,-42.6C-66.4,-55.8,-53.4,-67.2,-39.2,-74C-25,-80.8,-9.6,-83.1,3.4,-88.9C16.4,-94.7,31.2,-83.6,44.7,-76.4Z" transform="translate(100 100)" /></svg>');
            mask-size: contain;
            mask-repeat: no-repeat;
        }
        body { min-height: 100vh; }
    </style>
</head>

<body class="bg-surface font-body text-on-surface">

    <main class="min-h-screen flex flex-col items-center justify-center px-4 py-12 relative overflow-hidden">

        <div class="absolute top-[-10%] left-[-5%] w-[400px] h-[400px] bg-primary/5 botanical-mask blur-3xl -z-10"></div>

        <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div class="space-y-8">
                <div class="space-y-4">
                    <h1 class="font-headline font-extrabold text-4xl lg:text-5xl tracking-tight leading-tight">
                        Grow safely, <br/><span class="text-primary">Stay hidden.</span>
                    </h1>
                    <p class="text-gray-600 text-lg max-w-sm">
                        Votre parcours de santé mentale est personnel. Rejoignez une communauté où l'anonymat est la base de la croissance.
                    </p>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl p-8 shadow-2xl border border-gray-100 relative">
                <div class="mb-8 flex justify-between items-center">
                    <h2 class="font-headline font-bold text-2xl">Créer un compte</h2>
                    <span class="text-xs font-bold text-primary px-3 py-1 bg-primary/10 rounded-full text-center">Sécurisé</span>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pseudonyme</label>
                        <div class="relative">
                            <input type="text" name="pseudo" value="{{ old('pseudo') }}"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-all"
                                placeholder="ex: SilverFern42" required>
                            <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 text-sm">face</span>
                        </div>
                        @error('pseudo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email (Optionnel)</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-all"
                                placeholder="email@exemple.com">
                            <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 text-sm">mail</span>
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Mot de passe</label>
                            <input type="password" name="password"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-all" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Confirmer</label>
                            <input type="password" name="password_confirmation"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-all" required>
                            @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-primary to-primary-dim text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 hover:opacity-90 transition-all active:scale-[0.98] mt-4">
                        S'enregistrer anonymement
                    </button>

                    <p class="text-center text-sm text-gray-500">
                        Déjà un compte ? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Connexion</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
