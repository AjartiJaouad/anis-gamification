<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parcours modules - ANIS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
                        success: "#0f766e",
                        warning: "#b45309",
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
        <div class="mx-auto flex max-w-7xl flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Parcours d'apprentissage</p>
                <h1 class="mt-2 font-headline text-3xl font-extrabold">Modules educatifs</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                    Retour au dashboard
                </a>
                <a href="{{ route('quizzes.index') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white transition hover:bg-primary-dim">
                    Passer aux quiz
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        <section class="mb-8 overflow-hidden rounded-[2rem] border border-primary/10 bg-white shadow-sm">
            <div class="grid gap-6 px-6 py-8 md:grid-cols-[1.6fr_1fr] md:px-8">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">Progression</p>
                    <h2 class="mt-3 font-headline text-3xl font-extrabold">Continue ton parcours a ton rythme</h2>
                    <p class="mt-3 max-w-2xl text-sm text-on-surface-variant">Lis les modules debloques, marque-les comme completes puis valide ton niveau avec les quiz pour ouvrir la suite.</p>
                </div>
                <div class="rounded-[1.75rem] bg-surface px-5 py-5">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <p class="text-sm text-on-surface-variant">Completion globale</p>
                            <p class="mt-2 text-4xl font-headline font-extrabold text-primary">{{ $completionRate }}%</p>
                        </div>
                        <span class="rounded-full bg-primary/10 px-3 py-2 text-sm font-semibold text-primary">{{ count($completedModuleIds) }} termines</span>
                    </div>
                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-surface-container">
                        <div class="h-full rounded-full bg-primary" style="width: {{ $completionRate }}%"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($modules as $module)
                @php
                    $isUnlocked = $module->order <= (auth()->user()->highest_unlocked_difficulty ?? 1);
                    $isCompleted = in_array($module->id, $completedModuleIds, true);
                @endphp
                <article class="rounded-[2rem] border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md {{ $isUnlocked ? 'border-primary/10' : 'border-surface-container opacity-90' }}">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-on-surface-variant">Module {{ $module->order }}</p>
                            <h2 class="mt-2 font-headline text-2xl font-bold">{{ $module->title }}</h2>
                        </div>
                        <span class="rounded-full px-3 py-2 text-xs font-semibold {{ $isCompleted ? 'bg-emerald-100 text-emerald-700' : ($isUnlocked ? 'bg-primary/10 text-primary' : 'bg-amber-100 text-amber-700') }}">
                            {{ $isCompleted ? 'Complete' : ($isUnlocked ? 'Debloque' : 'Bloque') }}
                        </span>
                    </div>

                    <p class="mt-4 text-sm leading-6 text-on-surface-variant">{{ \Illuminate\Support\Str::limit($module->content, 140) }}</p>

                    <div class="mt-6 flex items-center justify-between gap-3">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-on-surface-variant">Ordre {{ $module->order }}</span>
                        @if($isUnlocked)
                            <a href="{{ route('modules.show', $module) }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary-dim">
                                Ouvrir
                            </a>
                        @else
                            <span class="inline-flex items-center rounded-full border border-surface-container px-4 py-2 text-sm font-semibold text-on-surface-variant">
                                Termine le niveau precedent
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-[2rem] border border-dashed border-surface-container bg-white px-6 py-12 text-center text-sm text-on-surface-variant">
                    Aucun module n'est disponible pour le moment.
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
