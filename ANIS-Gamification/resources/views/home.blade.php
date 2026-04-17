<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ANIS | Cultiver la Resilience et la Croissance</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "#f1f8fa",
                        secondary: "#b70049",
                        "outline-variant": "#abadae",
                        "tertiary-fixed-dim": "#e2e9ec",
                        "on-tertiary-fixed": "#454c4f",
                        "inverse-primary": "#e88efc",
                        "error-container": "#f74b6d",
                        "surface-container-lowest": "#ffffff",
                        primary: "#89379f",
                        "on-error": "#ffefef",
                        "on-primary-fixed": "#2e003b",
                        "on-secondary-container": "#910038",
                        "tertiary-fixed": "#f1f8fa",
                        "inverse-on-surface": "#9b9d9e",
                        "surface-tint": "#89379f",
                        "error-dim": "#a70138",
                        "secondary-container": "#ffc2ca",
                        outline: "#757778",
                        error: "#b41340",
                        "tertiary-dim": "#4a5153",
                        "on-tertiary": "#edf4f6",
                        tertiary: "#565d5f",
                        "primary-fixed-dim": "#d981ee",
                        "on-tertiary-fixed-variant": "#62696b",
                        "secondary-dim": "#a1003f",
                        "surface-container-highest": "#dadddf",
                        "surface-container-high": "#e0e3e4",
                        "on-surface": "#2c2f30",
                        "on-error-container": "#510017",
                        "surface-container-low": "#eff1f2",
                        "primary-fixed": "#e88efc",
                        "on-secondary": "#ffeff0",
                        "surface-container": "#e6e8ea",
                        "on-background": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        "secondary-fixed": "#ffc2ca",
                        "on-primary-container": "#55006b",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        background: "#f5f6f7",
                        "on-primary": "#ffeefd",
                        "inverse-surface": "#0c0f10",
                        "surface-dim": "#d1d5d7",
                        "on-primary-fixed-variant": "#620779",
                        "on-secondary-fixed": "#6e0028",
                        "surface-variant": "#dadddf",
                        "on-tertiary-container": "#575f61",
                        "on-secondary-fixed-variant": "#a30040",
                        "secondary-fixed-dim": "#ffaeba",
                        "primary-container": "#e88efc",
                        "surface-bright": "#f5f6f7"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                        label: ["Inter"]
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                        lg: "2rem",
                        xl: "3rem",
                        full: "9999px"
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .bg-botanical-blob {
            background-image:
                radial-gradient(circle at 20% 30%, rgba(137, 55, 159, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(137, 55, 159, 0.03) 0%, transparent 40%);
        }

        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background font-body text-on-background">
    <header class="fixed inset-x-0 top-0 z-50 bg-[#f5f6f7]/90 backdrop-blur-xl">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-3xl text-primary">local_florist</span>
                <span class="font-headline text-xl font-black tracking-tight text-primary sm:text-2xl">ANIS</span>
            </div>

            <nav class="hidden items-center gap-8 md:flex">
                <a class="border-b-2 border-primary font-headline font-bold text-primary" href="#">Accueil</a>
                <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim"
                    href="#about">A propos</a>
                <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim"
                    href="#services">Services</a>
                <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim"
                    href="#team">Equipe</a>
            </nav>

            <a href="#cta"
                class="rounded-full bg-primary px-4 py-2.5 text-xs font-bold text-on-primary shadow-sm transition-all active:scale-95 active:opacity-80 sm:px-6 sm:py-3 sm:text-sm">
                Commencer
            </a>
        </div>

        <nav
            class="mx-auto flex w-full max-w-7xl items-center gap-2 overflow-x-auto px-4 pb-4 text-sm md:hidden sm:px-6">
            <a class="whitespace-nowrap rounded-full bg-primary px-4 py-2 font-headline font-bold text-on-primary"
                href="#">Accueil</a>
            <a class="whitespace-nowrap rounded-full bg-white px-4 py-2 font-headline font-medium text-on-background shadow-sm"
                href="#about">A propos</a>
            <a class="whitespace-nowrap rounded-full bg-white px-4 py-2 font-headline font-medium text-on-background shadow-sm"
                href="#services">Services</a>
            <a class="whitespace-nowrap rounded-full bg-white px-4 py-2 font-headline font-medium text-on-background shadow-sm"
                href="#team">Equipe</a>
        </nav>
    </header>

    <main class="overflow-hidden pt-36 md:pt-24">
        <section
            class="relative mx-auto flex min-h-[auto] max-w-7xl items-center px-4 py-10 sm:px-6 sm:py-12 lg:min-h-[751px]">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="z-10">
                    <div
                        class="mb-6 inline-flex max-w-full items-center gap-2 rounded-full bg-secondary-container px-4 py-2 text-[11px] font-bold text-on-secondary-fixed sm:text-xs">
                        <span class="material-symbols-outlined text-sm"
                            style="font-variation-settings: 'FILL' 1;">eco</span>
                        CROISSANCE VALIDEE CLINIQUEMENT
                    </div>

                    <h1
                        class="mb-6 font-headline text-4xl font-extrabold leading-tight text-on-background sm:text-5xl lg:text-7xl">
                        ANIS : Apprendre a gerer <span class="italic text-primary">les addictions</span> de maniere
                        interactive
                    </h1>

                    <p class="mb-10 max-w-xl text-base leading-relaxed text-on-surface-variant sm:text-lg">
                        ANIS est une plateforme interactive conçue pour vous aider à comprendre et gérer les différentes
                        formes d’addiction. Grâce à des modules ludiques, des quiz engageants et un système de
                        progression personnalisé, vous avancez à votre rythme dans un environnement sécurisé et
                        totalement confidentiel. </p>

                    <div class="flex flex-col gap-4 sm:flex-row sm:flex-wrap">
                        <a href="#services"
                            class="w-full rounded-lg bg-primary px-8 py-4 text-center text-base font-bold text-on-primary shadow-lg shadow-primary/20 transition-all hover:bg-primary-dim sm:w-auto sm:text-lg">
                            Debuter mon parcours
                        </a>
                        <a href="#about"
                            class="w-full rounded-lg bg-surface-container-highest px-8 py-4 text-center text-base font-bold text-primary transition-all hover:bg-surface-container-high sm:w-auto sm:text-lg">
                            Voir les ressources
                        </a>
                    </div>
                </div>

                <div class="relative order-first lg:order-none">
                    <div class="relative z-10 overflow-hidden rounded-xl shadow-2xl lg:rotate-2">
                        <img class="h-[320px] w-full object-cover sm:h-[420px] lg:h-[500px]" alt="Illustration ANIS"
                            src="{{ asset('images/img1.jpg') }}" />
                    </div>
                    <div
                        class="absolute -right-4 -top-4 -z-0 h-32 w-32 rounded-full bg-primary-container/30 blur-3xl sm:-right-10 sm:-top-10 sm:h-64 sm:w-64">
                    </div>
                    <div
                        class="absolute -bottom-6 -left-4 -z-0 h-24 w-24 rounded-full bg-secondary-container/20 blur-2xl sm:-bottom-10 sm:-left-10 sm:h-48 sm:w-48">
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface-container-low px-4 py-20 sm:px-6 sm:py-24" id="about">
            <div class="mx-auto grid max-w-7xl items-center gap-16 lg:grid-cols-12">
                <div class="grid gap-4 sm:grid-cols-2 lg:col-span-7">
                    <div class="space-y-4">
                        <div class="h-56 overflow-hidden rounded-lg shadow-sm sm:h-64">
                            <img class="h-full w-full object-cover" alt="Session clinique de groupe"
                                src="{{ asset('images/unnamed (1).png') }}" />
                        </div>
                        <div class="h-64 overflow-hidden rounded-lg shadow-md sm:h-80">
                            <img class="h-full w-full object-cover" alt="Conversation de soutien"
                                src="{{ asset('images/unnamed (2).png') }}" />
                        </div>
                    </div>
                    <div class="sm:pt-12">
                        <div class="h-64 overflow-hidden rounded-lg shadow-lg sm:h-full">
                            <img class="h-full w-full object-cover" alt="Collaboration creative"
                                src="{{ asset('images/unnamed (3).png') }}" />
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <h2 class="mb-6 font-headline text-3xl font-extrabold text-on-background sm:text-4xl">
                        Enracine dans le soin, porte par l'innovation.
                    </h2>
                    <p class="mb-8 leading-relaxed text-on-surface-variant">
                        Chez ANIS, nous transformons la manière d'aborder les addictions. Grâce à une approche humaine,
                        interactive et progressive, nous aidons chaque utilisateur à évoluer à son rythme vers un
                        équilibre durable.


                    </p>
                    <ul class="mb-10 space-y-4">
                        <li class="flex items-center gap-3 font-semibold text-on-background">
                            <span class="material-symbols-outlined text-primary"
                                style="font-variation-settings: 'FILL' 1;">check_circle</span>
                             Approches validées scientifiquement

                        </li>
                        <li class="flex items-center gap-3 font-semibold text-on-background">
                            <span class="material-symbols-outlined text-primary"
                                style="font-variation-settings: 'FILL' 1;">check_circle</span>
                             Accompagnement humain et bienveillant

                        </li>
                        <li class="flex items-center gap-3 font-semibold text-on-background">
                            <span class="material-symbols-outlined text-primary"
                                style="font-variation-settings: 'FILL' 1;">check_circle</span>
                             Support digital accessible 24h/24
                        </li>
                    </ul>
                    <a class="inline-flex items-center gap-2 font-bold text-primary hover:underline" href="#services">
                         Découvrir notre mission

                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

       <section class="bg-botanical-blob mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24" id="services">
    <div class="mb-16 text-center">
        <h2 class="mb-4 font-headline text-3xl font-extrabold sm:text-4xl">Nos Services</h2>
        <p class="mx-auto max-w-2xl text-on-surface-variant">
            Des solutions de soutien sur mesure pour vous accompagner là où vous en êtes.
        </p>
    </div>

    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">

        <div class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
                <span class="material-symbols-outlined text-3xl">sports_esports</span>
            </div>
            <h3 class="mb-4 font-headline text-xl font-bold">Sensibilisation ludique</h3>
            <p class="text-sm leading-relaxed text-on-surface-variant">
                Des modules interactifs pour rendre l’éducation engageante, accessible et facile à comprendre.
            </p>
        </div>

        <div class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
                <span class="material-symbols-outlined text-3xl">groups</span>
            </div>
            <h3 class="mb-4 font-headline text-xl font-bold">Cercles de soutien</h3>
            <p class="text-sm leading-relaxed text-on-surface-variant">
                Des sessions de groupe et un accompagnement individuel avec des intervenants spécialisés.
            </p>
        </div>

        <div class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
                <span class="material-symbols-outlined text-3xl">monitoring</span>
            </div>
            <h3 class="mb-4 font-headline text-xl font-bold">Suivi des progrès</h3>
            <p class="text-sm leading-relaxed text-on-surface-variant">
                Visualisez vos étapes d’évolution grâce à des indicateurs clairs, motivants et personnalisés.
            </p>
        </div>

        <div class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
                <span class="material-symbols-outlined text-3xl">library_books</span>
            </div>
            <h3 class="mb-4 font-headline text-xl font-bold">Bibliothèque clinique</h3>
            <p class="text-sm leading-relaxed text-on-surface-variant">
                Accédez à des ressources certifiées et à des contenus éducatifs de qualité professionnelle.
            </p>
        </div>

    </div>
</section>
       <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24" id="team">
    <div class="mb-16 text-center">
        <h2 class="mb-4 font-headline text-3xl font-extrabold text-on-background sm:text-4xl">
            Les jardiniers de votre croissance
        </h2>
        <p class="mx-auto max-w-2xl text-on-surface-variant">
            Rencontrez nos cliniciens et mentors dévoués à votre progression.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-12 text-center min-[480px]:grid-cols-2 md:grid-cols-4">

        <div class="group flex flex-col items-center">
            <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30 transition group-hover:scale-105">
                <img class="h-full w-full object-cover" alt="Dr. Sarah Chen"
                    src="{{ asset('images/unnamed (4).png') }}" />
            </div>
            <h4 class="font-headline text-lg font-bold">Dr. Sarah Chen</h4>
            <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Directrice clinique</p>
        </div>

        <div class="group flex flex-col items-center">
            <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30 transition group-hover:scale-105">
                <img class="h-full w-full object-cover" alt="Marcus Aris"
                    src="{{ asset('images/unnamed (5).png') }}" />
            </div>
            <h4 class="font-headline text-lg font-bold">Marcus Aris</h4>
            <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Mentor principal</p>
        </div>

        <div class="group flex flex-col items-center">
            <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30 transition group-hover:scale-105">
                <img class="h-full w-full object-cover" alt="Elena Rodriguez"
                    src="{{ asset('images/unnamed (6).png') }}" />
            </div>
            <h4 class="font-headline text-lg font-bold">Elena Rodriguez</h4>
            <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Spécialiste soins</p>
        </div>

        <div class="group flex flex-col items-center">
            <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30 transition group-hover:scale-105">
                <img class="h-full w-full object-cover" alt="David Park"
                    src="{{ asset('images/unnamed.png') }}" />
            </div>
            <h4 class="font-headline text-lg font-bold">David Park</h4>
            <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Tech & support</p>
        </div>

    </div>
</section>

<!-- CONFIDENTIALITÉ -->
<section class="bg-surface-container-low px-4 py-20 sm:px-6 sm:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-8 lg:grid-cols-3">

            <div class="lg:col-span-2 flex min-h-[320px] flex-col justify-between rounded-lg bg-primary p-8 text-on-primary sm:min-h-[400px] sm:p-12 shadow-lg">
                <h2 class="max-w-md font-headline text-3xl font-extrabold leading-tight sm:text-4xl">
                    Notre engagement pour votre confidentialité
                </h2>
                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                    <p class="max-w-sm text-base opacity-90 sm:text-lg">
                        Nous utilisons des technologies avancées pour garantir la sécurité et la confidentialité de votre parcours.
                    </p>
                    <span class="material-symbols-outlined text-6xl opacity-20 sm:text-7xl">
                        verified_user
                    </span>
                </div>
            </div>

            <div class="flex flex-col justify-center rounded-lg bg-surface-container-lowest p-8 shadow-sm sm:p-12">
                <h3 class="mb-4 font-headline text-2xl font-bold">Assistance 24h/24</h3>
                <p class="mb-8 text-on-surface-variant">
                    Accédez à une aide immédiate via notre plateforme sécurisée.
                </p>
                <button class="w-full rounded-lg border-2 border-primary py-4 font-bold text-primary transition-all hover:bg-primary/5 hover:scale-[1.02]">
                    Contact d'urgence
                </button>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="px-4 py-20 sm:px-6 sm:py-24" id="cta">
    <div class="mx-auto max-w-5xl rounded-lg bg-surface-container-highest/50 p-8 text-center sm:p-12 shadow-sm">
        <h2 class="mb-6 font-headline text-3xl font-extrabold sm:text-4xl">
            Prêt à commencer votre transformation ?
        </h2>
        <p class="mx-auto mb-10 max-w-2xl text-base text-on-surface-variant sm:text-lg">
            Rejoignez ANIS dès aujourdhui et entamez un parcours personnalisé vers un mieux-être durable.
        </p>
        <a href="{{ route('register') }}"
            class="inline-flex w-full justify-center rounded-lg bg-primary px-8 py-4 text-lg font-bold text-on-primary shadow-xl shadow-primary/30 transition-all hover:scale-105 active:scale-95 sm:w-auto sm:px-10 sm:py-5 sm:text-xl">
            S'inscrire gratuitement
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="mt-auto bg-[#eff1f2] px-4 py-12 sm:px-6">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-8 md:flex-row">

        <div class="flex flex-col items-center gap-4 md:items-start">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-2xl text-primary">local_florist</span>
                <span class="text-xl font-bold text-primary">ANIS</span>
            </div>
            <p class="text-sm text-[#2c2f30] opacity-70">
                © 2026 ANIS. Cultiver la résilience par la croissance.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-6">
            <a class="text-sm text-[#2c2f30] transition-all hover:text-primary hover:underline" href="#">Confidentialité</a>
            <a class="text-sm text-[#2c2f30] transition-all hover:text-primary hover:underline" href="#">Conditions</a>
            <a class="text-sm text-[#2c2f30] transition-all hover:text-primary hover:underline" href="#">Normes cliniques</a>
            <a class="text-sm text-[#2c2f30] transition-all hover:text-primary hover:underline" href="#">Contact</a>
        </div>

    </div>
</footer>
</body>

</html>
