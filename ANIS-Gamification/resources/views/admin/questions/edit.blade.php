<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Modifier une question</title>
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
                    <a href="{{ route('admin.questions.index') }}" class="flex items-center gap-3 rounded-2xl border border-primary/10 bg-primary/5 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/10">
                        <span class="material-symbols-outlined">help</span>
                        Gestion des questions
                    </a>
                </nav>
            </aside>

            <div class="space-y-8">
                <header class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Admin • Modifier une question</p>
                        <h1 class="text-3xl font-headline font-extrabold text-on-surface">Modifier la question</h1>
                    </div>
                    <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center gap-2 rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Retour à la liste
                    </a>
                </header>

                <div class="rounded-3xl bg-white p-8 shadow-sm border border-surface-container">
                    <form action="{{ route('admin.questions.update', $question) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label for="quiz_id" class="block text-sm font-semibold text-on-surface">Quiz</label>
                                <select id="quiz_id" name="quiz_id" required
                                    class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                    <option value="">Sélectionnez un quiz</option>
                                    @foreach($quizzes as $quiz)
                                        <option value="{{ $quiz->id }}" data-max="{{ $quiz->questions_count }}" data-current="{{ $quiz->created_questions_count }}"
                                            {{ old('quiz_id', $question->quiz_id) == $quiz->id ? 'selected' : '' }}>
                                            {{ $quiz->title }} ({{ $quiz->created_questions_count }}/{{ $quiz->questions_count }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('quiz_id')
                                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="level_id" class="block text-sm font-semibold text-on-surface">Difficulté</label>
                                <select id="level_id" name="level_id" required
                                    class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                    <option value="">Sélectionnez une difficulté</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ old('level_id', $question->level_id) == $level->id ? 'selected' : '' }}>
                                            Difficulté {{ $level->difficulty }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level_id')
                                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded-3xl border border-surface-container bg-surface-container-lowest p-5">
                            <p class="text-sm text-on-surface-variant">Nombre actuel de questions pour le quiz sélectionné :</p>
                            <p id="quiz-counter" class="mt-2 text-base font-semibold text-on-surface">Choisissez un quiz pour voir le maximum autorisé.</p>
                        </div>

                        <div>
                            <label for="question" class="block text-sm font-semibold text-on-surface">Question</label>
                            <textarea id="question" name="question" rows="4" required
                                class="mt-2 w-full rounded-2xl border border-surface-container bg-white px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">{{ old('question', $question->question) }}</textarea>
                            @error('question')
                                <p class="mt-2 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6">
                            @foreach($question->options as $index => $option)
                                <div class="rounded-3xl border border-surface-container p-5 bg-surface-container-lowest">
                                    <div class="flex items-center justify-between gap-4">
                                        <label for="option_{{ $index }}" class="text-sm font-semibold text-on-surface">Réponse {{ $index + 1 }}</label>
                                        <label class="inline-flex items-center gap-2 text-sm text-on-surface-variant">
                                            <input type="checkbox" name="correct_options[]" value="{{ $index }}" {{ is_array(old('correct_options')) ? (in_array($index, old('correct_options')) ? 'checked' : '') : ($option->is_correct ? 'checked' : '') }} class="h-4 w-4 rounded border-surface-container text-primary focus:ring-primary" />
                                            Correcte
                                        </label>
                                    </div>
                                    <input id="option_{{ $index }}" name="options[{{ $index }}]" type="text" value="{{ old('options.' . $index, $option->option_text) }}" required
                                        class="mt-3 w-full rounded-2xl border border-surface-container bg-white px-4 py-3 text-on-surface outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                                    @error('options.' . $index)
                                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        @error('correct_options')
                            <p class="text-sm text-error">{{ $message }}</p>
                        @enderror

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-on-primary hover:bg-primary-dim transition">
                                Mettre à jour la question
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        const quizSelect = document.getElementById('quiz_id');
        const counter = document.getElementById('quiz-counter');

        function updateCounter() {
            const selected = quizSelect.selectedOptions[0];
            if (!selected || !selected.dataset.max) {
                counter.textContent = 'Choisissez un quiz pour voir le maximum autorisé.';
                return;
            }

            const max = selected.dataset.max;
            const current = selected.dataset.current;
            counter.textContent = `Questions créées: ${current} / ${max}`;
            if (parseInt(current, 10) >= parseInt(max, 10)) {
                counter.classList.add('text-error');
                counter.classList.remove('text-on-surface');
                counter.textContent += ' — Ce quiz est déjà plein.';
            } else {
                counter.classList.remove('text-error');
                counter.classList.add('text-on-surface');
            }
        }

        quizSelect?.addEventListener('change', updateCounter);
        updateCounter();
    </script>
</body>
</html>
