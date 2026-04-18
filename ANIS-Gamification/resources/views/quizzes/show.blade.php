<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $quiz->title }} - Choisir une difficulté</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen">
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-7xl flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Quiz • {{ $quiz->title }}</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Choisissez la difficulté</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('quizzes.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Retour à la liste
                </a>
                <a href="{{ route('dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Dashboard
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div class="space-y-6">
                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-on-surface">{{ $quiz->title }}</h2>
                    <p class="mt-4 text-sm text-on-surface-variant">{{ $quiz->description ?? 'Aucune description disponible.' }}</p>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-surface-container bg-surface-container-lowest p-4">
                            <p class="text-sm text-on-surface-variant">Questions prévues</p>
                            <p class="mt-2 text-2xl font-bold text-on-surface">{{ $quiz->questions_count }}</p>
                        </div>
                        <div class="rounded-3xl border border-surface-container bg-surface-container-lowest p-4">
                            <p class="text-sm text-on-surface-variant">Durée</p>
                            <p class="mt-2 text-2xl font-bold text-on-surface">{{ $quiz->duration_minutes }} min</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-on-surface">Difficultés disponibles</h2>
                    <p class="mt-2 text-sm text-on-surface-variant">Choisissez la difficulté pour lancer ce quiz.</p>
                    <div class="mt-6 grid gap-3">
                        @forelse($availableDifficulties as $difficultyOption)
                            @php
                                $locked = $difficultyOption > $unlockedDifficulty;
                            @endphp
                            <a href="{{ route('quizzes.play', ['quiz' => $quiz, 'difficulty' => $difficultyOption]) }}"
                                class="rounded-3xl border px-5 py-4 text-left transition {{ $locked ? 'border-surface-container bg-surface-container-lowest text-on-surface-variant pointer-events-none opacity-50' : 'border-primary bg-primary/5 text-on-surface hover:border-primary hover:bg-primary/10' }}">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold">Difficulté {{ $difficultyOption }}</p>
                                        <p class="mt-1 text-sm text-on-surface-variant">{{ $difficultyOption <= $unlockedDifficulty ? 'Débloqué' : 'Bloqué' }}</p>
                                    </div>
                                    <span class="material-symbols-outlined text-2xl">play_circle</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-on-surface-variant">Aucune difficulté disponible pour ce quiz pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-on-surface">Note</h2>
                    <p class="mt-4 text-sm text-on-surface-variant">Les difficultés verrouillées sont débloquées en réussissant au moins 50% du quiz au niveau précédent.</p>
                </div>
                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-on-surface">Progression actuelle</h2>
                    <p class="mt-4 text-sm text-on-surface-variant">Difficulté la plus élevée débloquée : {{ $unlockedDifficulty }}</p>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
