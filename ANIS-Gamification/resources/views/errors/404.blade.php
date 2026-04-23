<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Introuvable | ANIS</title>
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
                        "surface": "#f5f6f7",
                        "surface-container-low": "#eff1f2",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#2c2f30",
                        "on-surface": "#2c2f30",
                        "on-surface-variant": "#595c5d",
                        secondary: "#b70049",
                        "secondary-container": "#ffc2ca",
                        "error": "#b41340",
                        "error-container": "#f74b6d",
                        "on-error": "#ffefef",
                        "on-error-container": "#510017",
                        "outline-variant": "#abadae",
                        "surface-container": "#e6e8ea",
                        "surface-variant": "#dadddf"
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
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-background font-body selection:bg-primary-container selection:text-on-primary-container min-h-screen flex items-center justify-center px-4 py-10">
    <div class="relative w-full max-w-4xl rounded-[2rem] bg-white shadow-[0px_40px_90px_rgba(137,55,159,0.12)] overflow-hidden border border-surface-container">
        <div class="absolute -left-20 top-1/2 h-72 w-72 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="absolute -right-24 -bottom-16 h-72 w-72 rounded-full bg-secondary/10 blur-3xl"></div>
        <div class="relative z-10 grid gap-10 lg:grid-cols-[1.2fr_0.8fr] p-10 sm:p-14">
            <div class="space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                    <span class="material-symbols-outlined">search_off</span>
                    Page introuvable
                </span>
                <h1 class="text-6xl font-headline font-extrabold tracking-tight text-on-background">404</h1>
                <div class="space-y-4 text-base text-on-surface-variant max-w-xl">
                    <p class="text-xl font-semibold text-on-background">La page que vous cherchez n'existe pas ou a été déplacée.</p>
                    <p>Retournez à l'accueil ou consultez votre tableau de bord pour reprendre votre navigation.</p>
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-bold text-on-primary transition hover:bg-primary-dim">Accueil</a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-6 py-3 text-sm font-bold text-on-surface transition hover:border-primary hover:text-primary">Tableau de bord</a>
                </div>
            </div>

            <div class="rounded-[2rem] bg-primary/5 p-8 sm:p-12 flex flex-col justify-center items-center text-center">
                <div class="flex h-28 w-28 items-center justify-center rounded-full bg-secondary/20 text-secondary text-6xl shadow-[0px_20px_60px_rgba(183,0,73,0.12)]">?</div>
                <p class="mt-6 text-sm text-on-surface-variant max-w-sm">Si vous avez saisi manuellement l'URL, vérifiez qu'elle est correcte ou revenez en arrière.</p>
                <div class="mt-8 rounded-3xl bg-white px-5 py-4 text-left shadow-sm border border-surface-container w-full">
                    <p class="text-xs uppercase tracking-[0.24em] text-on-surface-variant">Erreur</p>
                    <p class="mt-3 text-sm text-on-surface">{{ $message ?? 'Page non trouvée.' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
