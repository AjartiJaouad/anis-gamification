<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quizzes - Difficulté {{ $level->difficulty }}</title>
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
                <p class="text-sm text-on-surface-variant">Quiz • Difficulté {{ $level->difficulty }}</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Quizzes disponibles</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('quizzes.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Retour aux niveaux
                </a>
                <a href="{{ route('dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Dashboard
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        <div class="mb-6 rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-on-surface">Difficulté {{ $level->difficulty }}</h2>
            <p class="mt-2 text-sm text-on-surface-variant">Sélectionne un quiz adapté à ce niveau.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @forelse($quizzes as $quiz)
                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <div class="mb-4">
                        <p class="text-sm font-semibold text-on-surface-variant">{{ $quiz->title }}</p>
                        <h3 class="mt-2 text-2xl font-headline font-extrabold text-on-surface">{{ $quiz->title }}</h3>
                        <p class="mt-2 text-sm text-on-surface-variant">{{ $quiz->description }}</p>
                    </div>
                    <div class="space-y-3 text-sm text-on-surface-variant">
                        <p>Durée : {{ $quiz->duration_minutes }} minutes</p>
                        <p>Questions : {{ $quiz->questions_for_level_count }}</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between gap-3">
                        <a href="{{ route('quizzes.play', ['level' => $level, 'quiz' => $quiz]) }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                            <span class="material-symbols-outlined">play_arrow</span>
                            Commencer
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-surface-container bg-white p-10 text-center text-on-surface-variant shadow-sm">
                    Aucun quiz disponible pour ce niveau pour le moment.
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>
