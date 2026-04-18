<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Gestion des quizzes</title>
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
                @if(session('success'))
                    <div class="rounded-2xl border border-primary/20 bg-primary/10 p-4 text-sm text-primary">
                        {{ session('success') }}
                    </div>
                @endif

                <header class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Admin • Gestion des quizzes</p>
                        <h1 class="text-3xl font-headline font-extrabold text-on-surface">Quizzes</h1>
                    </div>
                    <a href="{{ route('admin.quizzes.create') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                        <span class="material-symbols-outlined">add</span>
                        Créer un quiz
                    </a>
                </header>

                <div class="overflow-hidden rounded-3xl bg-white shadow-sm border border-surface-container">
                    <div class="px-6 py-5 border-b border-surface-container bg-surface-container-lowest">
                        <h2 class="text-lg font-semibold text-on-surface">Liste des quizzes</h2>
                        <p class="text-sm text-on-surface-variant mt-1">Créer, modifier et supprimer les quizzes.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-surface-container">
                            <thead class="bg-surface-container">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Titre</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Difficulté</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Questions créées / prévues</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Durée</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Créé le</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-container-low bg-white">
                                @forelse($quizzes as $quiz)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $quiz->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $quiz->difficulty }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $quiz->questions_configured_count }} / {{ $quiz->questions_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $quiz->duration_minutes }} min</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface-variant">{{ $quiz->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="inline-flex items-center gap-2 rounded-full border border-primary/10 bg-primary/5 px-3 py-2 text-primary hover:bg-primary/10 transition">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                                Modifier
                                            </a>
                                            <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-error/10 px-3 py-2 text-sm font-semibold text-error hover:bg-error/20 transition">
                                                    <span class="material-symbols-outlined text-base">delete</span>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-on-surface-variant">Aucun quiz n'a encore été créé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>
