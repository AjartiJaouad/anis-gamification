<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Créer un niveau</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#89379f",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        "surface-container-low": "#eff1f2",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#2c2f30",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        secondary: "#b70049",
                        "secondary-container": "#ffc2ca",
                        "outline-variant": "#abadae",
                        "surface-container": "#e6e8ea",
                        "surface-variant": "#dadddf",
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                        lg: "2rem",
                        xl: "3rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen">
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-7xl flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Admin • Créer un niveau</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Nouveau niveau</h1>
            </div>
            <a href="{{ route('admin.levels.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                Retour à la liste
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6">
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-surface-container">
            <form action="{{ route('admin.levels.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-on-surface">Nom du niveau</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text" required
                        class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                    @error('name')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="difficulty" class="block text-sm font-semibold text-on-surface">Difficulté</label>
                    <input id="difficulty" name="difficulty" value="{{ old('difficulty', 1) }}" type="number" min="1" max="10" required
                        class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                    @error('difficulty')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-on-surface">Description</label>
                    <textarea id="description" name="description" rows="5"
                        class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.levels.index') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
