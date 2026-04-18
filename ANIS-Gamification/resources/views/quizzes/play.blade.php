<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ANIS - Interactive Quiz</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "error-container": "#f74b6d",
              "tertiary-container": "#f1f8fa",
              "on-secondary-container": "#910038",
              "primary": "#89379f",
              "surface-container": "#e6e8ea",
              "inverse-primary": "#e88efc",
              "primary-dim": "#7c2992",
              "tertiary": "#565d5f",
              "on-tertiary": "#edf4f6",
              "outline": "#757778",
              "surface-variant": "#dadddf",
              "surface-container-highest": "#dadddf",
              "tertiary-fixed": "#f1f8fa",
              "tertiary-fixed-dim": "#e2e9ec",
              "secondary-dim": "#a1003f",
              "surface-bright": "#f5f6f7",
              "inverse-on-surface": "#9b9d9e",
              "on-tertiary-container": "#575f61",
              "surface-dim": "#d1d5d7",
              "on-primary-fixed-variant": "#620779",
              "error": "#b41340",
              "primary-container": "#e88efc",
              "on-error": "#ffefef",
              "on-tertiary-fixed": "#454c4f",
              "background": "#f5f6f7",
              "surface-container-high": "#e0e3e4",
              "primary-fixed": "#e88efc",
              "inverse-surface": "#0c0f10",
              "on-primary-fixed": "#2e003b",
              "secondary-fixed": "#ffc2ca",
              "surface-container-low": "#eff1f2",
              "error-dim": "#a70138",
              "secondary-container": "#ffc2ca",
              "on-tertiary-fixed-variant": "#62696b",
              "on-surface-variant": "#595c5d",
              "on-background": "#2c2f30",
              "on-secondary": "#ffeff0",
              "on-primary": "#ffeefd",
              "surface-container-lowest": "#ffffff",
              "primary-fixed-dim": "#d981ee",
              "outline-variant": "#abadae",
              "on-error-container": "#510017",
              "tertiary-dim": "#4a5153",
              "surface": "#f5f6f7",
              "secondary-fixed-dim": "#ffaeba",
              "on-secondary-fixed-variant": "#a30040",
              "on-secondary-fixed": "#6e0028",
              "secondary": "#b70049",
              "on-primary-container": "#55006b",
              "on-surface": "#2c2f30",
              "surface-tint": "#89379f"
            },
            fontFamily: {
              "headline": ["Plus Jakarta Sans"],
              "body": ["Inter"],
              "label": ["Inter"]
            },
            borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bg-botanical-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(137, 55, 159, 0.05) 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen pb-32">
<header class="flex justify-between items-center px-4 h-14 w-full sticky top-0 bg-[#f5f6f7]/80 backdrop-blur-md z-50 shadow-sm">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full overflow-hidden bg-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-primary">person</span>
</div>
<span class="font-headline font-semibold text-sm text-[#89379f]">Quiz • {{ $quiz->title }}</span>
</div>
<div class="flex items-center gap-4">
<button class="material-symbols-outlined text-[#89379f] hover:opacity-80 transition-opacity">bolt</button>
<a href="{{ route('dashboard') }}" class="material-symbols-outlined text-on-surface hover:opacity-80 transition-opacity">close</a>
</div>
</header>
<main class="max-w-2xl mx-auto px-6 pt-8 space-y-10">
<div class="space-y-4">
<div class="flex justify-between items-end">
<div class="space-y-1">
<p class="text-label text-xs font-bold text-primary uppercase tracking-wider">{{ $quiz->title }}</p>
<h1 class="text-headline text-2xl font-extrabold text-on-background">Questionnaire interactif</h1>
</div>
<div class="text-right">
<span class="text-headline font-black text-primary text-xl" id="question-progress">1/{{ $questions->count() }}</span>
</div>
</div>
<div class="h-3 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-primary rounded-full w-[0%]" id="progress-fill"></div>
</div>
</div>
<div class="relative group">
<div class="absolute -top-6 -right-6 w-32 h-32 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors"></div>
<div class="relative bg-surface-container-lowest p-8 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] space-y-8">
<div class="space-y-4">
<div class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary-container text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">
<span class="material-symbols-outlined text-sm">psychology</span>
<span>Difficulté {{ $difficulty }}</span>
</div>
<h2 class="text-headline text-xl font-bold leading-tight" id="question-text">Chargement...</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="options"></div>
<div class="p-5 bg-error-container/5 rounded-md border-l-4 border-error-container hidden" id="feedback-box">
<span class="material-symbols-outlined text-error-container mt-1">info</span>
<div class="space-y-1">
<p class="font-headline font-bold text-on-error-container" id="feedback-title">Incorrect choice</p>
<p class="text-body text-sm text-on-surface-variant" id="feedback-text">Feedback texte.</p>
</div>
</div>
</div>
</div>
<div class="flex flex-col md:flex-row gap-4 items-center justify-between">
<div class="flex items-center gap-3 text-on-surface-variant">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">timer</span>
<span class="text-sm font-semibold tracking-tight" id="timer">00:00</span>
</div>
<button id="skip-button" class="w-full md:w-auto px-8 py-4 bg-primary text-on-primary rounded-full font-headline font-bold text-lg shadow-lg hover:bg-primary-dim transition-transform active:scale-95 flex items-center justify-center gap-2">
Suivant
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</main>
<section class="fixed inset-0 z-[60] bg-on-background/40 backdrop-blur-sm flex items-center justify-center p-6 hidden" id="results-modal">
<div class="bg-surface-container-lowest w-full max-w-md rounded-xl p-10 shadow-2xl relative overflow-hidden text-center space-y-8 bg-botanical-pattern">
<div class="absolute -top-10 -left-10 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>
<div class="relative space-y-6">
<div class="w-24 h-24 bg-primary-container/30 rounded-full mx-auto flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-5xl" style="font-variation-settings: 'FILL' 1;">military_tech</span>
</div>
<div class="space-y-2">
<h3 class="text-headline text-3xl font-black text-on-background">Félicitations !</h3>
<p class="text-body text-on-surface-variant">Vous avez terminé le quiz.</p>
</div>
<div class="flex justify-center gap-4">
<div class="bg-surface-container p-4 rounded-md min-w-[100px]">
<p class="text-[10px] font-bold uppercase text-on-surface-variant">Score</p>
<p class="text-headline text-2xl font-black text-primary" id="result-score">0/{{ $questions->count() }}</p>
</div>
<div class="bg-secondary-container p-4 rounded-md min-w-[100px]">
<p class="text-[10px] font-bold uppercase text-on-secondary-container">Bonus</p>
<p class="text-headline text-2xl font-black text-secondary" id="result-xp">+0 XP</p>
</div>
</div>
<div class="space-y-3">
<button class="w-full py-4 bg-primary text-on-primary rounded-full font-headline font-bold hover:bg-primary-dim transition-colors" id="continue-button">
Continuer
</button>
<button class="w-full py-4 text-primary font-headline font-bold hover:bg-surface-container transition-colors rounded-full" id="review-button">
Revoir les réponses
</button>
</div>
</div>
</div>
</section>
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center pb-6 pt-3 px-4 bg-[#ffffff]/80 backdrop-blur-xl shadow-[0px_-12px_32px_rgba(44,47,48,0.06)] rounded-t-[2.5rem]">
<a class="flex flex-col items-center justify-center text-[#abadae] px-5 py-1.5 hover:text-[#89379f] transition-all group active:scale-90 duration-300 ease-out" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined mb-1">dashboard</span>
<span class="font-['Inter'] font-bold text-[10px]">Dashboard</span>
</a>
<a class="flex flex-col items-center justify-center bg-[#e88efc] text-[#89379f] rounded-full px-5 py-1.5 active:scale-90 duration-300 ease-out" href="{{ route('quizzes.index') }}">
<span class="material-symbols-outlined mb-1" style="font-variation-settings: 'FILL' 1;">explore</span>
<span class="font-['Inter'] font-bold text-[10px]">Quiz</span>
</a>
<a class="flex flex-col items-center justify-center text-[#abadae] px-5 py-1.5 hover:text-[#89379f] transition-all active:scale-90 duration-300 ease-out" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined mb-1">military_tech</span>
<span class="font-['Inter'] font-bold text-[10px]">Badges</span>
</a>
<a class="flex flex-col items-center justify-center text-[#abadae] px-5 py-1.5 hover:text-[#89379f] transition-all active:scale-90 duration-300 ease-out" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined mb-1">person</span>
<span class="font-['Inter'] font-bold text-[10px]">Profil</span>
</a>
</nav>
<form id="quiz-form" action="{{ route('quizzes.complete', ['quiz' => $quiz, 'difficulty' => $difficulty]) }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="answers" id="answers-input" value="[]" />
    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}" />
    <input type="hidden" name="difficulty" value="{{ $difficulty }}" />
</form>
<script>
        const questions = @json($questionsJson);
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
        const progressFill = document.getElementById('progress-fill');
        const questionProgress = document.getElementById('question-progress');
        const correctCountElement = document.getElementById('correct-count');
        const remainingCountElement = document.getElementById('remaining-count');
        const answersInput = document.getElementById('answers-input');
        const quizForm = document.getElementById('quiz-form');
        const skipButton = document.getElementById('skip-button');

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60).toString().padStart(2, '0');
            const remainder = (seconds % 60).toString().padStart(2, '0');
            return `${minutes}:${remainder}`;
        }

        function updateProgress() {
            const total = questions.length;
            const progress = total === 0 ? 0 : Math.round((currentIndex / total) * 100);
            progressFill.style.width = `${progress}%`;
            questionProgress.textContent = `${Math.min(currentIndex + 1, total)}/${total}`;
            correctCountElement.textContent = correctCount;
            remainingCountElement.textContent = Math.max(total - currentIndex, 0);
        }

        function renderQuestion() {
            if (currentIndex >= questions.length) {
                submitAnswers();
                return;
            }

            const question = questions[currentIndex];
            questionText.textContent = question.question;
            optionsContainer.innerHTML = '';

            question.options.forEach((option, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'option-button relative flex flex-col items-start p-6 bg-surface-container-low hover:bg-surface-container-highest border-2 border-transparent transition-all rounded-md text-left';
                button.innerHTML = `
                    <div class="w-10 h-10 mb-4 rounded-full bg-white flex items-center justify-center text-primary font-bold shadow-sm">${String.fromCharCode(65 + index)}</div>
                    <span class="font-headline font-bold text-lg">${option.text}</span>
                `;
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
                    button.classList.remove('border-transparent', 'bg-surface-container-low', 'hover:bg-surface-container-highest');
                    button.classList.add('border-blue-300', 'bg-blue-100', 'text-blue-800');
                }
                if (optionId === selectedId && optionId !== correctId) {
                    button.classList.remove('border-transparent', 'bg-surface-container-low', 'hover:bg-surface-container-highest');
                    button.classList.add('border-error-container', 'bg-error-container/10', 'text-on-error-container');
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

        skipButton.addEventListener('click', () => {
            if (currentIndex < questions.length) {
                const question = questions[currentIndex];
                const correct = question.options.find(option => option.is_correct);
                answers.push({ question_id: question.id, selected_option_id: null });
                setOptionStyles(null, correct?.id);
                clearInterval(timerInterval);
                setTimeout(() => {
                    currentIndex++;
                    renderQuestion();
                }, 900);
            }
        });

        renderQuestion();
    </script>
</body>
</html>
