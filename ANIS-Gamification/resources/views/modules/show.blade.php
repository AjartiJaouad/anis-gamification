<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $module->title }} - ANIS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#89379f",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff1f2",
                        "surface-container": "#e6e8ea",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-surface font-body text-on-surface">
    <header class="bg-surface-container-lowest px-6 py-4 shadow-sm">
        <div class="mx-auto flex max-w-5xl flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Module {{ $module->order }}</p>
                <h1 class="mt-2 font-headline text-3xl font-extrabold">{{ $module->title }}</h1>
            </div>
            <a href="{{ route('modules.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                Retour aux modules
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-primary/20 bg-primary/10 p-4 text-sm font-semibold text-primary">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->has('module'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                {{ $errors->first('module') }}
            </div>
        @endif

        <article class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <span class="rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                    {{ $isCompleted ? 'Module deja complete' : 'Module en cours' }}
                </span>
                <div class="flex flex-wrap gap-3">
                    @if($previousModule)
                        <a href="{{ route('modules.show', $previousModule) }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                            Module precedent
                        </a>
                    @endif
                    @if($nextModule && $nextModule->order <= (auth()->user()->highest_unlocked_difficulty ?? 1))
                        <a href="{{ route('modules.show', $nextModule) }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                            Module suivant
                        </a>
                    @endif
                </div>
            </div>

            <div class="prose mt-8 max-w-none text-on-surface">
                {!! nl2br(e($module->content)) !!}
            </div>

            <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-on-surface-variant">Valide d'abord le quiz lié au module (70% min), puis confirme la completion.</p>
                <form method="POST" action="{{ route('modules.complete', $module) }}">
                    @csrf
                    <button type="submit" class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white transition hover:bg-primary-dim">
                        {{ $isCompleted ? 'Mettre a jour la completion' : 'Marquer comme complete' }}
                    </button>
                </form>
            </div>
            @if($moduleQuiz)
                <div class="mt-4">
                    <a href="{{ route('quizzes.show', $moduleQuiz) }}" class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-5 py-2 text-sm font-semibold text-primary transition hover:bg-primary/10">
                        Aller au quiz de ce module
                    </a>
                </div>
            @endif
        </article>
    </main>
</body>
</html>
