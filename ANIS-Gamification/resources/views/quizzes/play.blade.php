<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $quiz->title }} - Quiz</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .option-button { transition: background-color 0.2s, color 0.2s; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen">
    <header class="bg-surface-container-lowest shadow-sm px-6 py-4">
        <div class="mx-auto max-w-7xl flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-on-surface-variant">Quiz • {{ $quiz->title }}</p>
                <h1 class="mt-2 text-3xl font-headline font-extrabold text-on-surface">Questionnaire</h1>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('quizzes.level', $level) }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold text-on-surface hover:border-primary hover:text-primary transition">
                    Retour aux quizzes
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
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-on-surface-variant">Durée totale</p>
                            <p class="mt-1 text-3xl font-headline font-extrabold text-on-surface">{{ $quiz->duration_minutes }} min</p>
                        </div>
                        <div>
                            <p class="text-sm text-on-surface-variant">Questions</p>
                            <p class="mt-1 text-3xl font-headline font-extrabold text-on-surface">{{ $questions->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-on-surface-variant">Difficulté</p>
                            <p class="mt-1 text-3xl font-headline font-extrabold text-on-surface">{{ $level->difficulty }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-on-surface-variant">Question</p>
                            <p id="question-number" class="mt-1 text-xl font-semibold text-on-surface">1 / {{ $questions->count() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-on-surface-variant">Temps restant</p>
                            <p id="timer" class="mt-1 text-2xl font-bold text-primary">00:00</p>
                        </div>
                    </div>

                    <div class="h-3 overflow-hidden rounded-full bg-surface-container">
                        <div id="progress-bar" class="h-full rounded-full bg-primary" style="width: 0%;"></div>
                    </div>
                </div>

                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <form id="quiz-form" action="{{ route('quizzes.complete', ['level' => $level, 'quiz' => $quiz]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="answers" id="answers-input" value="[]" />
                        <input type="hidden" name="level_id" value="{{ $level->id }}" />
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}" />

                        <div>
                            <h2 id="question-text" class="text-xl font-semibold text-on-surface">Chargement...</h2>
                        </div>

                        <div id="options" class="mt-6 grid gap-4"></div>
                    </form>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-on-surface">Règles rapides</h2>
                    <ul class="mt-4 space-y-3 text-sm text-on-surface-variant">
                        <li>Le temps total du quiz est divisé par le nombre de questions.</li>
                        <li>Les réponses correctes deviennent vertes.</li>
                        <li>Les réponses incorrectes deviennent rouges, et la bonne réponse est affichée en bleu.</li>
                        <li>Si le temps s'écoule, la question passe automatiquement.</li>
                        <li>Réussite requise : 50% de bonnes réponses pour débloquer le niveau suivant.</li>
                    </ul>
                </div>

                <div class="rounded-3xl border border-surface-container bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-on-surface">Avancement</h2>
                    <p class="mt-4 text-sm text-on-surface-variant">Réponses correctes : <span id="correct-count">0</span></p>
                    <p class="mt-2 text-sm text-on-surface-variant">Questions restantes : <span id="remaining-count">{{ $questions->count() }}</span></p>
                </div>
            </aside>
        </div>
    </main>

    <script>
        const questions = @json($questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'text' => $option->option_text,
                        'is_correct' => $option->is_correct,
                    ];
                }),
            ];
        }));

        const totalTime = {{ $totalTime }};
        const perQuestionTime = {{ $perQuestionTime }};
        let currentIndex = 0;
        let secondsLeft = perQuestionTime;
        let correctCount = 0;
        let answers = [];
        let timerInterval = null;
        const questionText = document.getElementById('question-text');
        const optionsContainer = document.getElementById('options');
        const timerElement = document.getElementById('timer');
        const progressBar = document.getElementById('progress-bar');
        const questionNumber = document.getElementById('question-number');
        const correctCountElement = document.getElementById('correct-count');
        const remainingCountElement = document.getElementById('remaining-count');
        const answersInput = document.getElementById('answers-input');
        const quizForm = document.getElementById('quiz-form');

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60).toString().padStart(2, '0');
            const remainder = (seconds % 60).toString().padStart(2, '0');
            return `${minutes}:${remainder}`;
        }

        function updateProgress() {
            const total = questions.length;
            progressBar.style.width = `${Math.round((currentIndex / total) * 100)}%`;
            questionNumber.textContent = `${currentIndex + 1} / ${total}`;
            correctCountElement.textContent = correctCount;
            remainingCountElement.textContent = total - currentIndex;
        }

        function renderQuestion() {
            if (currentIndex >= questions.length) {
                submitAnswers();
                return;
            }

            const question = questions[currentIndex];
            questionText.textContent = question.question;
            optionsContainer.innerHTML = '';

            question.options.forEach(option => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'option-button w-full rounded-3xl border border-surface-container bg-surface-container-lowest px-4 py-4 text-left text-on-surface transition hover:border-primary hover:bg-surface-container focus:outline-none';
                button.textContent = option.text;
                button.dataset.optionId = option.id;

                button.addEventListener('click', () => selectAnswer(option.id));
                optionsContainer.appendChild(button);
            });

            secondsLeft = perQuestionTime;
            timerElement.textContent = formatTime(secondsLeft);
            updateProgress();
            startTimer();
        }

        function setOptionStyles(selectedId, correctId) {
            document.querySelectorAll('#options button').forEach(button => {
                const optionId = Number(button.dataset.optionId);
                button.disabled = true;
                if (optionId === correctId) {
                    button.classList.remove('border-surface-container', 'bg-surface-container-lowest');
                    button.classList.add('border-blue-300', 'bg-blue-100', 'text-blue-800');
                }
                if (optionId === selectedId && optionId !== correctId) {
                    button.classList.remove('border-surface-container', 'bg-surface-container-lowest');
                    button.classList.add('border-error', 'bg-error/10', 'text-error');
                }
            });
        }

        function selectAnswer(optionId) {
            clearInterval(timerInterval);
            const question = questions[currentIndex];
            const selected = question.options.find(option => option.id === optionId);
            const correct = question.options.find(option => option.is_correct);

            if (selected && selected.is_correct) {
                correctCount++;
            }

            answers.push({ question_id: question.id, selected_option_id: selected ? selected.id : null });
            setOptionStyles(selected?.id, correct?.id);

            setTimeout(() => {
                currentIndex++;
                renderQuestion();
            }, 900);
        }

        function startTimer() {
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                secondsLeft -= 1;
                timerElement.textContent = formatTime(secondsLeft);

                if (secondsLeft <= 0) {
                    clearInterval(timerInterval);
                    const question = questions[currentIndex];
                    const correct = question.options.find(option => option.is_correct);

                    answers.push({ question_id: question.id, selected_option_id: null });
                    setOptionStyles(null, correct?.id);

                    setTimeout(() => {
                        currentIndex++;
                        renderQuestion();
                    }, 900);
                }
            }, 1000);
        }

        function submitAnswers() {
            answersInput.value = JSON.stringify(answers.reduce((carry, item) => {
                carry[item.question_id] = item.selected_option_id;
                return carry;
            }, {}));
            quizForm.submit();
        }

        renderQuestion();
    </script>
</body>
</html>
