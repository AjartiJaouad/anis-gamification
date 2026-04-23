<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ANIS | Parcours Quiz</title>
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
                        "surface-container-highest": "#dadddf",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        error: "#b41340",
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

        .bg-botanical-blob {
            background-image:
                radial-gradient(circle at 15% 20%, rgba(137, 55, 159, 0.08) 0%, transparent 32%),
                radial-gradient(circle at 85% 30%, rgba(183, 0, 73, 0.06) 0%, transparent 25%),
                radial-gradient(circle at 70% 80%, rgba(137, 55, 159, 0.05) 0%, transparent 30%);
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

            <a href="{{ route('dashboard') }}" class="rounded-full border border-surface-container bg-white px-4 py-2 text-sm font-bold text-primary transition hover:border-primary hover:bg-primary/5">
                Retour
            </a>
        </div>
    </header>

    <main class="bg-botanical-blob min-h-screen">
        <section class="mx-auto max-w-7xl px-4 pb-10 pt-10 sm:px-6 sm:pb-14">
            <div class="grid items-center gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                <div>
                    <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-secondary-container px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-secondary">
                        <span class="material-symbols-outlined text-base">explore</span>
                        Parcours Quiz
                    </div>
                    <h1 class="font-headline text-4xl font-extrabold leading-tight text-on-surface sm:text-5xl lg:text-6xl">
                        Choisis un quiz et valide ton <span class="text-primary italic">niveau</span>
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-7 text-on-surface-variant sm:text-lg">
                        Continue ton apprentissage avec des quizzes progressifs. Chaque réussite te rapporte de l'XP, débloque de nouvelles difficultés et renforce ton parcours sur ANIS.
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('modules.index') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-dim">
                            <span class="material-symbols-outlined">menu_book</span>
                            Revoir les modules
                        </a>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-bold text-primary shadow-sm transition hover:bg-surface-container-low">
                            <span class="material-symbols-outlined">dashboard</span>
                            Mon dashboard
                        </a>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                    <div class="rounded-[2rem] bg-white p-6 shadow-[0px_20px_60px_rgba(44,47,48,0.08)]">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-on-surface-variant">Difficulté débloquée</p>
                        <p class="mt-3 font-headline text-5xl font-extrabold text-primary">{{ $unlockedDifficulty }}</p>
                        <p class="mt-2 text-sm text-on-surface-variant">Ton niveau maximum disponible pour le moment.</p>
                    </div>
                    <div class="rounded-[2rem] bg-primary p-6 text-white shadow-[0px_20px_60px_rgba(137,55,159,0.22)]">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-white/80">Quizzes prêts</p>
                        <p class="mt-3 font-headline text-5xl font-extrabold">{{ $quizzes->count() }}</p>
                        <p class="mt-2 text-sm text-white/80">Des évaluations rapides, progressives et pensées pour garder ta motivation.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($quizzes as $quiz)
                    @php
                        $locked = $quiz->difficulty > $unlockedDifficulty;
                    @endphp
                    <article class="group overflow-hidden rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-[0px_20px_60px_rgba(44,47,48,0.08)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:shadow-[0px_24px_80px_rgba(44,47,48,0.12)]">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.25em] text-on-surface-variant">Quiz éducatif</p>
                                <h2 class="mt-3 font-headline text-2xl font-extrabold text-on-surface">{{ $quiz->title }}</h2>
                            </div>
                            <span class="rounded-full px-4 py-2 text-xs font-bold {{ $locked ? 'bg-red-50 text-red-700' : 'bg-primary/10 text-primary' }}">
                                Niveau {{ $quiz->difficulty }}
                            </span>
                        </div>

                        <p class="mt-5 min-h-[72px] text-sm leading-6 text-on-surface-variant">
                            {{ $quiz->description ?? 'Ce quiz te permet de consolider tes connaissances et de débloquer la suite de ton parcours.' }}
                        </p>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-surface px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-on-surface-variant">Questions</p>
                                <p class="mt-2 text-2xl font-headline font-extrabold text-on-surface">{{ $quiz->questions_count }}</p>
                            </div>
                            <div class="rounded-2xl bg-surface px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-on-surface-variant">Durée</p>
                                <p class="mt-2 text-2xl font-headline font-extrabold text-on-surface">{{ $quiz->duration_minutes }} min</p>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between gap-3">
                            @if($locked)
                                <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-4 py-3 text-sm font-bold text-red-700">
                                    <span class="material-symbols-outlined text-base">lock</span>
                                    Niveau bloqué
                                </span>
                            @else
                                <a href="{{ route('quizzes.show', $quiz) }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-bold text-white transition hover:bg-primary-dim">
                                    <span class="material-symbols-outlined text-base">play_circle</span>
                                    Choisir la difficulté
                                </a>
                            @endif

                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-on-surface-variant">
                                {{ $locked ? 'Complète le niveau précédent' : 'Prêt à jouer' }}
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-[2rem] border border-dashed border-surface-container bg-white/80 px-6 py-16 text-center shadow-sm">
                        <p class="font-headline text-2xl font-bold text-on-surface">Aucun quiz disponible</p>
                        <p class="mt-3 text-sm text-on-surface-variant">Ajoute des quizzes depuis l'administration pour enrichir le parcours.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>
