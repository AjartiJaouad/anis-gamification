<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard - ANIS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#89379f",
                        "primary-dim": "#7c2992",
                        "primary-container": "#e88efc",
                        "on-primary": "#ffeefd",
                        "surface": "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff1f2",
                        "surface-container": "#e6e8ea",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        "secondary-container": "#ffc2ca",
                        "on-secondary-fixed": "#6e0028",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen">

    {{-- Navbar --}}
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-7xl flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-2xl text-primary">local_florist</span>
                <span class="font-headline font-black text-xl text-primary">ANIS</span>
            </div>
            <div class="flex items-center gap-4 flex-wrap justify-end">
                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-primary hover:underline inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">person</span>
                    Profil
                </a>
                <a href="{{ route('modules.index') }}" class="text-sm font-semibold text-primary hover:underline inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">library_books</span>
                    Modules
                </a>
                <span class="text-sm text-on-surface-variant font-medium">
                    Bonjour, <span class="font-bold text-primary">{{ $user->pseudo }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1 text-sm font-bold text-primary hover:underline">
                        <span class="material-symbols-outlined text-base">logout</span>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-12">

        {{-- Welcome banner --}}
        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 rounded-xl bg-primary/10 px-6 py-4 text-primary font-semibold">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-10">
            <h1 class="font-headline font-extrabold text-3xl text-on-surface">
                Bienvenue sur votre espace, <span class="text-primary">{{ $user->pseudo }}</span> 🌱
            </h1>
            <p class="mt-2 text-on-surface-variant">Suivez votre progression et continuez votre parcours.</p>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 mb-12">
            <div class="rounded-xl bg-surface-container-lowest p-6 shadow-sm border border-surface-container">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1;">bolt</span>
                    <span class="font-headline font-bold text-lg">XP Total</span>
                </div>
                <p class="text-4xl font-extrabold text-primary">{{ $user->xp_total }}</p>
                <p class="text-xs text-on-surface-variant mt-1">Points d'expérience accumulés</p>
            </div>

            <div class="rounded-xl bg-surface-container-lowest p-6 shadow-sm border border-surface-container">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1;">local_fire_department</span>
                    <span class="font-headline font-bold text-lg">Streak</span>
                </div>
                <p class="text-4xl font-extrabold text-primary">{{ $user->streak_days }}</p>
                <p class="text-xs text-on-surface-variant mt-1">Jours consécutifs actifs</p>
            </div>

            <div class="rounded-xl bg-surface-container-lowest p-6 shadow-sm border border-surface-container">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1;">shield_person</span>
                    <span class="font-headline font-bold text-lg">Statut</span>
                </div>
                <p class="text-2xl font-extrabold text-primary">
                    {{ $user->is_anonymous ? 'Anonyme' : 'Identifie' }}
                </p>
                <p class="text-xs text-on-surface-variant mt-1">Mode de confidentialité</p>
            </div>

            <div class="rounded-xl bg-surface-container-lowest p-6 shadow-sm border border-surface-container">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings:'FILL' 1;">military_tech</span>
                    <span class="font-headline font-bold text-lg">Niveau actuel</span>
                </div>
                <p class="text-4xl font-extrabold text-primary">{{ $currentLevel }}</p>
                <p class="text-xs text-on-surface-variant mt-1">Difficulte maximale debloquee</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
            <div class="rounded-xl bg-surface-container-lowest p-8 shadow-sm border border-surface-container">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <span class="text-sm font-semibold uppercase tracking-[0.25em] text-on-surface-variant">Parcours d'apprentissage</span>
                        <h2 class="mt-2 text-2xl font-headline font-bold text-on-surface">Continue tes modules et quiz</h2>
                        <p class="mt-2 text-sm text-on-surface-variant">Tu as complete <strong>{{ $completedModulesCount }}</strong> module(s) sur <strong>{{ $modulesCount }}</strong>. Ton quiz maximum reste le niveau <strong>{{ $currentLevel }}</strong>.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('modules.index') }}" class="inline-flex items-center gap-2 rounded-full border border-primary/10 bg-white px-5 py-3 text-sm font-semibold text-primary hover:bg-primary/5 transition">
                            <span class="material-symbols-outlined">menu_book</span>
                            Voir les modules
                        </a>
                        <a href="{{ route('quizzes.index') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                            <span class="material-symbols-outlined">play_arrow</span>
                            Commencer un quiz
                        </a>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl bg-white p-5">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-on-surface-variant">Progression globale</p>
                            <p class="mt-2 text-4xl font-extrabold text-primary">{{ $moduleProgress }}%</p>
                        </div>
                        <span class="rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">{{ $completedModulesCount }} modules termines</span>
                    </div>
                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-surface-container">
                        <div class="h-full rounded-full bg-primary" style="width: {{ $moduleProgress }}%"></div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-xl bg-surface-container-lowest p-8 shadow-sm border border-surface-container">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-on-surface-variant">Quiz stats</p>
                            <h2 class="mt-2 text-2xl font-headline font-bold">Tes performances</h2>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-3 xl:grid-cols-1">
                        <div class="rounded-2xl bg-white p-4">
                            <p class="text-sm text-on-surface-variant">Tentatives</p>
                            <p class="mt-2 text-3xl font-headline font-extrabold text-primary">{{ $quizAttemptsCount }}</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4">
                            <p class="text-sm text-on-surface-variant">Taux de reussite</p>
                            <p class="mt-2 text-3xl font-headline font-extrabold text-primary">{{ $quizPassRate }}%</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4">
                            <p class="text-sm text-on-surface-variant">Score moyen</p>
                            <p class="mt-2 text-3xl font-headline font-extrabold text-primary">{{ $averageQuizScore }}%</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-surface-container-lowest p-8 shadow-sm border border-surface-container">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-on-surface-variant">Badges recents</p>
                            <h2 class="mt-2 text-2xl font-headline font-bold">Tes recompenses</h2>
                        </div>
                        <span class="rounded-full bg-primary/10 px-3 py-2 text-sm font-semibold text-primary">{{ $recentBadges->count() }}</span>
                    </div>

                    <div class="mt-6 space-y-4">
                        @forelse($recentBadges as $badge)
                            <div class="rounded-2xl bg-white p-4">
                                <p class="font-headline text-lg font-bold text-on-surface">{{ $badge->name }}</p>
                                <p class="mt-1 text-sm text-on-surface-variant">{{ $badge->description }}</p>
                            </div>
                        @empty
                            <div class="rounded-2xl bg-white p-4 text-sm text-on-surface-variant">
                                Aucun badge recent pour le moment. Continue ton parcours pour en debloquer.
                            </div>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>

    </main>
</body>
</html>
