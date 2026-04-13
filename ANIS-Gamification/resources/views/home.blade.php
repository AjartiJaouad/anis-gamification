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
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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
  <header
    class="fixed inset-x-0 top-0 z-50 mx-auto flex w-full max-w-7xl items-center justify-between bg-[#f5f6f7]/80 px-6 py-4 backdrop-blur-xl">
    <div class="flex items-center gap-2">
      <span class="material-symbols-outlined text-3xl text-primary">local_florist</span>
      <span class="font-headline text-2xl font-black tracking-tight text-primary">ANIS</span>
    </div>

    <nav class="hidden items-center gap-8 md:flex">
      <a class="font-headline font-bold text-primary border-b-2 border-primary" href="#">Accueil</a>
      <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim" href="#about">A propos</a>
      <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim" href="#services">Services</a>
      <a class="font-headline font-medium text-[#2c2f30] transition-colors duration-300 hover:text-primary-dim" href="#team">Equipe</a>
    </nav>

    <a href="#cta"
      class="rounded-full bg-primary px-6 py-3 text-sm font-bold text-on-primary shadow-sm transition-all active:scale-95 active:opacity-80">
      Commencer
    </a>
  </header>

  <main class="overflow-hidden pt-24">
    <section class="relative mx-auto flex min-h-[751px] max-w-7xl items-center px-6 py-12">
      <div class="grid items-center gap-12 lg:grid-cols-2">
        <div class="z-10">
          <div
            class="mb-6 inline-flex items-center gap-2 rounded-full bg-secondary-container px-4 py-2 text-xs font-bold text-on-secondary-fixed">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">eco</span>
            CROISSANCE VALIDEE CLINIQUEMENT
          </div>

          <h1 class="mb-6 font-headline text-5xl font-extrabold leading-tight text-on-background lg:text-7xl">
            ANIS : Apprendre a gerer <span class="italic text-primary">les addictions</span> de maniere interactive
          </h1>

          <p class="mb-10 max-w-xl text-lg leading-relaxed text-on-surface-variant">
            ANIS est une plateforme interactive qui vous aide a comprendre les addictions grace a des modules ludiques,
            des quiz et un systeme de progression motivant, tout en garantissant votre anonymat.
          </p>

          <div class="flex flex-wrap gap-4">
            <a href="#services"
              class="rounded-lg bg-primary px-8 py-4 text-lg font-bold text-on-primary shadow-lg shadow-primary/20 transition-all hover:bg-primary-dim">
              Debuter mon parcours
            </a>
            <a href="#about"
              class="rounded-lg bg-surface-container-highest px-8 py-4 text-lg font-bold text-primary transition-all hover:bg-surface-container-high">
              Voir les ressources
            </a>
          </div>
        </div>

        <div class="relative">
          <div class="relative z-10 overflow-hidden rounded-xl shadow-2xl rotate-2">
            <img class="h-[500px] w-full object-cover" alt="Illustration ANIS" src="{{ asset('images/img1.jpg') }}" />
          </div>
          <div class="absolute -right-10 -top-10 -z-0 h-64 w-64 rounded-full bg-primary-container/30 blur-3xl"></div>
          <div class="absolute -bottom-10 -left-10 -z-0 h-48 w-48 rounded-full bg-secondary-container/20 blur-2xl"></div>
        </div>
      </div>
    </section>

    <section class="bg-surface-container-low px-6 py-24" id="about">
      <div class="mx-auto grid max-w-7xl items-center gap-16 lg:grid-cols-12">
        <div class="grid grid-cols-2 gap-4 lg:col-span-7">
          <div class="space-y-4">
            <div class="h-64 overflow-hidden rounded-lg shadow-sm">
              <img class="h-full w-full object-cover" alt="Session clinique de groupe"
                src="{{ asset('images/unnamed (1).png') }}" />
            </div>
            <div class="h-80 overflow-hidden rounded-lg shadow-md">
              <img class="h-full w-full object-cover" alt="Conversation de soutien"
                src="{{ asset('images/unnamed (2).png') }}" />
            </div>
          </div>
          <div class="pt-12">
            <div class="h-full overflow-hidden rounded-lg shadow-lg">
              <img class="h-full w-full object-cover" alt="Collaboration creative"
                src="{{ asset('images/unnamed (3).png') }}" />
            </div>
          </div>
        </div>

        <div class="lg:col-span-5">
          <h2 class="mb-6 font-headline text-4xl font-extrabold text-on-background">
            Enracine dans le soin, porte par l'innovation.
          </h2>
          <p class="mb-8 leading-relaxed text-on-surface-variant">
            Chez ANIS, nous pensons que la guerison ne doit pas etre une corvee. Notre philosophie repose sur une
            approche humaine, engageante et progressive pour aider chacun a retrouver un equilibre durable.
          </p>
          <ul class="mb-10 space-y-4">
            <li class="flex items-center gap-3 font-semibold text-on-background">
              <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              Methodologies fondees sur des preuves
            </li>
            <li class="flex items-center gap-3 font-semibold text-on-background">
              <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              Equipe clinique empathique
            </li>
            <li class="flex items-center gap-3 font-semibold text-on-background">
              <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              Soutien numerique 24h/24
            </li>
          </ul>
          <a class="inline-flex items-center gap-2 font-bold text-primary hover:underline" href="#services">
            Decouvrir notre mission
            <span class="material-symbols-outlined">arrow_forward</span>
          </a>
        </div>
      </div>
    </section>

    <section class="bg-botanical-blob mx-auto max-w-7xl px-6 py-24" id="services">
      <div class="mb-16 text-center">
        <h2 class="mb-4 font-headline text-4xl font-extrabold">Nos Services</h2>
        <p class="mx-auto max-w-2xl text-on-surface-variant">
          Des structures de soutien sur mesure pour vous accompagner la ou vous en etes.
        </p>
      </div>

      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
        <div
          class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
          <div
            class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
            <span class="material-symbols-outlined text-3xl">sports_esports</span>
          </div>
          <h3 class="mb-4 font-headline text-xl font-bold">Sensibilisation Ludique</h3>
          <p class="text-sm leading-relaxed text-on-surface-variant">
            Des modules interactifs pour rendre l'education engageante et facile a comprendre.
          </p>
        </div>

        <div
          class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
          <div
            class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
            <span class="material-symbols-outlined text-3xl">groups</span>
          </div>
          <h3 class="mb-4 font-headline text-xl font-bold">Cercles de Soutien</h3>
          <p class="text-sm leading-relaxed text-on-surface-variant">
            Sessions de groupe et accompagnement individuel avec des intervenants specialises.
          </p>
        </div>

        <div
          class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
          <div
            class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
            <span class="material-symbols-outlined text-3xl">monitoring</span>
          </div>
          <h3 class="mb-4 font-headline text-xl font-bold">Suivi des Progres</h3>
          <p class="text-sm leading-relaxed text-on-surface-variant">
            Visualisez vos etapes d'evolution avec des indicateurs clairs et motivants.
          </p>
        </div>

        <div
          class="group flex flex-col items-start rounded-lg bg-surface-container-lowest p-8 shadow-sm transition-transform hover:-translate-y-2">
          <div
            class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-container/20 text-primary transition-colors group-hover:bg-primary group-hover:text-on-primary">
            <span class="material-symbols-outlined text-3xl">library_books</span>
          </div>
          <h3 class="mb-4 font-headline text-xl font-bold">Bibliotheque Clinique</h3>
          <p class="text-sm leading-relaxed text-on-surface-variant">
            Acces a des ressources certifiees et des contenus educatifs premium.
          </p>
        </div>
      </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-24" id="team">
      <div class="mb-16 text-center">
        <h2 class="mb-4 font-headline text-4xl font-extrabold text-on-background">Les Jardiniers de la Croissance</h2>
        <p class="mx-auto max-w-2xl text-on-surface-variant">
          Rencontrez nos cliniciens et mentors devoues a votre progression.
        </p>
      </div>

      <div class="grid grid-cols-2 gap-12 text-center md:grid-cols-4">
        <div class="flex flex-col items-center">
          <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30">
            <img class="h-full w-full object-cover" alt="Dr. Sarah Chen" src="{{ asset('images/unnamed (4).png') }}" />
          </div>
          <h4 class="font-headline text-lg font-bold">Dr. Sarah Chen</h4>
          <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Directrice Clinique</p>
        </div>

        <div class="flex flex-col items-center">
          <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30">
            <img class="h-full w-full object-cover" alt="Marcus Aris" src="{{ asset('images/unnamed (5).png') }}" />
          </div>
          <h4 class="font-headline text-lg font-bold">Marcus Aris</h4>
          <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Mentor Principal</p>
        </div>

        <div class="flex flex-col items-center">
          <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30">
            <img class="h-full w-full object-cover" alt="Elena Rodriguez" src="{{ asset('images/unnamed (6).png') }}" />
          </div>
          <h4 class="font-headline text-lg font-bold">Elena Rodriguez</h4>
          <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Specialiste Soins</p>
        </div>

        <div class="flex flex-col items-center">
          <div class="mb-6 h-32 w-32 overflow-hidden rounded-full border-4 border-primary-container/30">
            <img class="h-full w-full object-cover" alt="David Park" src="{{ asset('images/unnamed.png') }}" />
          </div>
          <h4 class="font-headline text-lg font-bold">David Park</h4>
          <p class="mt-1 text-xs font-bold uppercase tracking-widest text-primary">Tech &amp; Support</p>
        </div>
      </div>
    </section>
  </main>

  <footer class="bg-black px-6 py-10 text-center text-white">
    <p>© 2026 ANIS. Tous droits reserves.</p>
  </footer>
</body>

</html>
