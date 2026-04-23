<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $quiz->title }} | Difficulté</title>
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
                        "primary-container": "#e88efc",
                        secondary: "#b70049",
                        "secondary-container": "#ffc2ca",
                        surface: "#f5f6f7",
                        background: "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff1f2",
                        "surface-container": "#e6e8ea",
                        "surface-container-high": "#e0e3e4",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
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

        .bg-soft-pattern {
            background-image:
                radial-gradient(circle at 18% 20%, rgba(137, 55, 159, 0.08) 0%, transparent 28%),
                radial-gradient(circle at 82% 18%, rgba(183, 0, 73, 0.05) 0%, transparent 20%);
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface">
    <header class="sticky top-0 z-50 bg-[#f5f6f7]/90 backdrop-blur-xl">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl text-primary">local_florist</span>
                <span class="font-headline text-2xl font-black tracking-tight text-primary">ANIS</span>
            </div>

            <nav class="hidden items-center gap-6 md:flex">
                <a href="{{ route('dashboard') }}" class="font-headline font-semibold text-on-surface transition-colors hover:text-primary">Dashboard</a>
                <a href="{{ route('modules.index') }}" class="font-headline font-semibold text-on-surface transition-colors hover:text-primary">Modules</a>
                <a href="{{ route('quizzes.index') }}" class="rounded-full bg-primary px-4 py-2 text-sm font-bold text-white">Quiz</a>
                <a href="{{ route('profile.edit') }}" class="font-headline font-semibold text-on-surface transition-colors hover:text-primary">Profil</a>
            </nav>

            <a href="{{ route('quizzes.index') }}" class="rounded-full border border-surface-container bg-white px-4 py-2 text-sm font-bold text-primary transition hover:border-primary hover:bg-primary/5">
                Retour
            </a>
        </div>
    </header>

    <main class="bg-soft-pattern min-h-screen">
        <section class="mx-auto max-w-7xl px-4 pb-10 pt-10 sm:px-6">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="rounded-[2.5rem] bg-white/90 p-8 shadow-[0px_20px_60px_rgba(44,47,48,0.08)] backdrop-blur-sm sm:p-10">
                    <div class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-primary">
                        <span class="material-symbols-outlined text-base">tactic</span>
                        Sélection de niveau
                    </div>

                    <h1 class="mt-5 font-headline text-4xl font-extrabold leading-tight text-on-surface sm:text-5xl">
                        {{ $quiz->title }}
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-7 text-on-surface-variant">
                        {{ $quiz->description ?? 'Choisis la difficulté qui correspond à ton avancement pour lancer ce quiz et valider la suite de ton parcours.' }}
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[1.75rem] bg-surface px-5 py-5">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-on-surface-variant">Questions</p>
                            <p class="mt-2 font-headline text-3xl font-extrabold text-on-surface">{{ $quiz->questions_count }}</p>
                        </div>
                        <div class="rounded-[1.75rem] bg-surface px-5 py-5">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-on-surface-variant">Durée</p>
                            <p class="mt-2 font-headline text-3xl font-extrabold text-on-surface">{{ $quiz->duration_minutes }} min</p>
                        </div>
                        <div class="rounded-[1.75rem] bg-primary px-5 py-5 text-white">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-white/80">Débloqué</p>
                            <p class="mt-2 font-headline text-3xl font-extrabold">{{ $unlockedDifficulty }}</p>
                        </div>
                    </div>
                </div>

                <aside class="space-y-4">
                    <div class="rounded-[2rem] bg-white/90 p-6 shadow-[0px_20px_60px_rgba(44,47,48,0.08)] backdrop-blur-sm">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-on-surface-variant">Rappel</p>
                        <p class="mt-3 text-sm leading-6 text-on-surface-variant">
                            Pour débloquer le niveau suivant, tu dois réussir au moins <strong>70%</strong> au niveau précédent.
                        </p>
                    </div>

                    <div class="rounded-[2rem] bg-white/90 p-6 shadow-[0px_20px_60px_rgba(44,47,48,0.08)] backdrop-blur-sm">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-on-surface-variant">Conseil</p>
                        <p class="mt-3 text-sm leading-6 text-on-surface-variant">
                            Si une difficulté est bloquée, retourne d'abord relire les modules pédagogiques puis reviens tenter le quiz.
                        </p>
                        <a href="{{ route('modules.index') }}" class="mt-5 inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-bold text-white transition hover:bg-primary-dim">
                            <span class="material-symbols-outlined text-base">menu_book</span>
                            Aller aux modules
                        </a>
                    </div>
                </aside>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6">
            <div class="rounded-[2.5rem] bg-white/80 p-6 shadow-[0px_20px_60px_rgba(44,47,48,0.08)] backdrop-blur-sm sm:p-8">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-on-surface-variant">Difficultés disponibles</p>
                        <h2 class="mt-2 font-headline text-3xl font-extrabold text-on-surface">Choisis ton prochain défi</h2>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($availableDifficulties as $difficultyOption)
                        @php
                            $locked = $difficultyOption > $unlockedDifficulty;
                        @endphp
                        <a
                            href="{{ $locked ? '#' : route('quizzes.play', ['quiz' => $quiz, 'difficulty' => $difficultyOption]) }}"
                            class="group rounded-[2rem] border p-6 transition {{ $locked ? 'pointer-events-none border-surface-container bg-surface text-on-surface-variant opacity-60' : 'border-primary/10 bg-white hover:-translate-y-1 hover:border-primary hover:shadow-[0px_20px_50px_rgba(137,55,159,0.12)]' }}"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-on-surface-variant">Niveau</p>
                                    <h3 class="mt-3 font-headline text-3xl font-extrabold {{ $locked ? 'text-on-surface-variant' : 'text-on-surface' }}">
                                        {{ $difficultyOption }}
                                    </h3>
                                    <p class="mt-3 text-sm leading-6 {{ $locked ? 'text-on-surface-variant' : 'text-on-surface-variant' }}">
                                        {{ $locked ? 'Verrouillé pour le moment. Réussis le niveau précédent pour y accéder.' : 'Tu peux lancer ce niveau immédiatement et viser au moins 70%.' }}
                                    </p>
                                </div>
                                <span class="rounded-full px-4 py-2 text-xs font-bold {{ $locked ? 'bg-surface-container text-on-surface-variant' : 'bg-primary/10 text-primary' }}">
                                    {{ $locked ? 'Bloqué' : 'Débloqué' }}
                                </span>
                            </div>

                            <div class="mt-6 inline-flex items-center gap-2 text-sm font-bold {{ $locked ? 'text-on-surface-variant' : 'text-primary' }}">
                                <span class="material-symbols-outlined text-base">{{ $locked ? 'lock' : 'play_circle' }}</span>
                                {{ $locked ? 'Progression requise' : 'Commencer maintenant' }}
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full rounded-[2rem] border border-dashed border-surface-container bg-white px-6 py-16 text-center">
                            <p class="font-headline text-2xl font-bold text-on-surface">Aucune difficulté disponible</p>
                            <p class="mt-3 text-sm text-on-surface-variant">Configure les questions de ce quiz pour afficher les niveaux jouables.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</body>
</html>
