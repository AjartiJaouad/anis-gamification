<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Créer un quiz</title>
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
    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid gap-8 lg:grid-cols-[260px_minmax(0,1fr)]">
            <aside class="rounded-3xl bg-surface-container-lowest border border-surface-container p-6 shadow-sm">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-on-surface-variant">Navigation Admin</p>
                    <h2 class="mt-3 text-2xl font-headline font-bold text-on-surface">Tableau de bord</h2>
                </div>
                <nav class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl border border-primary/10 bg-primary/5 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/10">
                        <span class="material-symbols-outlined">dashboard</span>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.levels.index') }}" class="flex items-center gap-3 rounded-2xl border border-surface-container bg-white px-4 py-3 text-sm font-semibold text-on-surface transition hover:border-primary hover:bg-surface-container-low">
                        <span class="material-symbols-outlined">layers</span>
                        Gestion des niveaux
                    </a>
                    <a href="{{ route('admin.quizzes.index') }}" class="flex items-center gap-3 rounded-2xl border border-primary/10 bg-primary/5 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/10">
                        <span class="material-symbols-outlined">quiz</span>
                        Gestion des quizzes
                    </a>
                    <a href="{{ route('admin.questions.index') }}" class="flex items-center gap-3 rounded-2xl border border-surface-container bg-white px-4 py-3 text-sm font-semibold text-on-surface transition hover:border-primary hover:bg-surface-container-low">
                        <span class="material-symbols-outlined">help</span>
                        Gestion des questions
                    </a>
                </nav>
            </aside>

            <div class="space-y-8">
                <header class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Admin • Créer un quiz</p>
                        <h1 class="text-3xl font-headline font-extrabold text-on-surface">Nouveau quiz</h1>
                    </div>
                    <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center gap-2 rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Retour à la liste
                    </a>
                </header>

                <div class="rounded-3xl bg-white p-8 shadow-sm border border-surface-container">
                    <form action="{{ route('admin.quizzes.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-semibold text-on-surface">Titre du quiz</label>
                            <input id="title" name="title" type="text" value="{{ old('title') }}" required
                                class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            @error('title')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-semibold text-on-surface">Difficulté</label>
                            <input id="difficulty" name="difficulty" type="number" min="1" max="10" value="{{ old('difficulty', 1) }}" required
                                class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            @error('difficulty')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="questions_count" class="block text-sm font-semibold text-on-surface">Nombre de questions</label>
                            <input id="questions_count" name="questions_count" type="number" min="1" max="100" value="{{ old('questions_count', 10) }}" required
                                class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            @error('questions_count')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration_minutes" class="block text-sm font-semibold text-on-surface">Durée (minutes)</label>
                            <input id="duration_minutes" name="duration_minutes" type="number" min="1" max="240" value="{{ old('duration_minutes', 30) }}" required
                                class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            @error('duration_minutes')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-on-surface">Description</label>
                            <textarea id="description" name="description" rows="5" class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                                Créer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
