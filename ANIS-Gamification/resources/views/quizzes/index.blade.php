<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Choisir un niveau - Quiz</title>
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
                <p class="text-sm text-on-surface-variant">Quiz • Choisis un niveau</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Niveaux disponibles</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($levels as $level)
                @php
                    $locked = $level->difficulty > $unlockedDifficulty;
                    $current = $level->difficulty === $unlockedDifficulty;
                @endphp
                <div class="rounded-3xl border p-6 shadow-sm transition hover:shadow-md {{ $locked ? 'border-surface-container bg-surface-container-lowest' : 'border-primary/10 bg-white' }}">
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div>
                            <p class="text-sm font-semibold text-on-surface-variant">Difficulté</p>
                            <p class="mt-2 text-3xl font-headline font-extrabold text-on-surface">{{ $level->difficulty }}</p>
                        </div>
                        <span class="rounded-full px-3 py-2 text-xs font-semibold {{ $locked ? 'bg-error/10 text-error' : ($current ? 'bg-primary/10 text-primary' : 'bg-surface-container text-on-surface-variant') }}">
                            {{ $locked ? 'Bloqué' : ($current ? 'Ouvert' : 'Déjà débloqué') }}
                        </span>
                    </div>
                    <p class="text-sm text-on-surface-variant mb-8">Réussis au moins 50% d'un quiz à ce niveau pour débloquer la suite.</p>
                    <div class="flex items-center justify-between gap-3">
                        @if($locked)
                            <span class="inline-flex items-center rounded-full bg-error/10 px-4 py-2 text-sm font-semibold text-error">Débloque le niveau précédent</span>
                        @else
                            <a href="{{ route('quizzes.level', $level) }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                                <span class="material-symbols-outlined">play_circle</span>
                                Choisir
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
