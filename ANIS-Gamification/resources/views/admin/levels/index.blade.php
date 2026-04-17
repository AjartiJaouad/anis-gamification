<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Gestion des niveaux</title>
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
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-7xl flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Admin • Gestion des niveaux</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Niveaux</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Retour au dashboard
                </a>
                <a href="{{ route('admin.levels.create') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                    Créer un niveau
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-primary/20 bg-primary/10 p-4 text-sm text-primary">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl bg-white shadow-sm border border-surface-container">
            <div class="px-6 py-5 border-b border-surface-container bg-surface-container-lowest">
                <h2 class="text-lg font-semibold text-on-surface">Liste des niveaux</h2>
                <p class="text-sm text-on-surface-variant mt-1">Créer, modifier et supprimer les niveaux disponibles pour les parcours.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-surface-container">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Nom</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Difficulté</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Créé le</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low bg-white">
                        @forelse($levels as $level)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $level->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface">{{ $level->difficulty }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-on-surface-variant">{{ $level->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex flex-col items-end gap-2">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.levels.edit', $level) }}" class="inline-flex items-center gap-2 rounded-full border border-primary/10 bg-primary/5 px-3 py-2 text-primary hover:bg-primary/10 transition">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                                Modifier
                                            </a>
                                            <button type="button" data-target="delete-confirm-{{ $level->id }}" class="inline-flex items-center gap-2 rounded-full bg-error/10 px-3 py-2 text-sm font-semibold text-error hover:bg-error/20 transition delete-trigger">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                                Supprimer
                                            </button>
                                        </div>

                                        <div id="delete-confirm-{{ $level->id }}" class="hidden w-full rounded-2xl border border-error/20 bg-error/5 p-4 text-sm text-on-surface">
                                            <p class="font-semibold text-error">Voulez-vous vraiment supprimer ce niveau ?</p>
                                            <div class="mt-3 flex flex-wrap justify-end gap-2">
                                                <button type="button" class="cancel-delete inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                                                    Annuler
                                                </button>
                                                <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-error px-4 py-2 text-sm font-semibold text-on-error hover:bg-error-dim transition">
                                                        Confirmer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-on-surface-variant">Aucun niveau n'a encore été créé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $levels->links() }}
        </div>
    </main>

    <script>
        document.querySelectorAll('.delete-trigger').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.dataset.target;
                const panel = document.getElementById(targetId);
                if (!panel) return;

                document.querySelectorAll('[id^="delete-confirm-"]').forEach(node => {
                    if (node !== panel) {
                        node.classList.add('hidden');
                    }
                });

                panel.classList.toggle('hidden');
            });
        });

        document.querySelectorAll('.cancel-delete').forEach(button => {
            button.addEventListener('click', () => {
                const panel = button.closest('[id^="delete-confirm-"]');
                if (panel) {
                    panel.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
