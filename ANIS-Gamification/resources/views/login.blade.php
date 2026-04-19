<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | Anis Ethos</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-low": "#eff1f2",
                        "on-background": "#2c2f30",
                        "on-primary": "#ffeefd",
                        "surface": "#f5f6f7",
                        "inverse-surface": "#0c0f10",
                        "primary-dim": "#7c2992",
                        "surface-dim": "#d1d5d7",
                        "on-secondary-fixed-variant": "#a30040",
                        "secondary-container": "#ffc2ca",
                        "on-tertiary-fixed-variant": "#62696b",
                        "on-primary-fixed-variant": "#620779",
                        "tertiary": "#565d5f",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed": "#6e0028",
                        "surface-container-highest": "#dadddf",
                        "on-surface-variant": "#595c5d",
                        "error-dim": "#a70138",
                        "on-tertiary": "#edf4f6",
                        "error": "#b41340",
                        "background": "#f5f6f7",
                        "surface-container-high": "#e0e3e4",
                        "secondary": "#b70049",
                        "tertiary-fixed-dim": "#e2e9ec",
                        "surface-variant": "#dadddf",
                        "surface-container": "#e6e8ea",
                        "surface-bright": "#f5f6f7",
                        "on-surface": "#2c2f30",
                        "on-secondary-container": "#910038",
                        "inverse-primary": "#e88efc",
                        "inverse-on-surface": "#9b9d9e",
                        "outline": "#757778",
                        "error-container": "#f74b6d",
                        "tertiary-dim": "#4a5153",
                        "secondary-fixed-dim": "#ffaeba",
                        "on-primary-container": "#55006b",
                        "surface-tint": "#89379f",
                        "tertiary-container": "#f1f8fa",
                        "on-primary-fixed": "#2e003b",
                        "secondary-fixed": "#ffc2ca",
                        "primary-fixed": "#e88efc",
                        "on-error": "#ffefef",
                        "outline-variant": "#abadae",
                        "tertiary-fixed": "#f1f8fa",
                        "on-tertiary-container": "#575f61",
                        "secondary-dim": "#a1003f",
                        "primary": "#89379f",
                        "on-tertiary-fixed": "#454c4f",
                        "on-secondary": "#ffeff0",
                        "primary-fixed-dim": "#d981ee",
                        "on-error-container": "#510017",
                        "primary-container": "#e88efc"
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
        .botanical-blob {
            position: absolute;
            filter: blur(60px);
            z-index: 0;
            opacity: 0.15;
            border-radius: 50%;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-background font-body selection:bg-primary-container selection:text-on-primary-container min-h-screen flex flex-col">

<main class="flex-grow flex items-center justify-center px-6 py-12 relative overflow-hidden">
    <div class="botanical-blob bg-primary w-[500px] h-[500px] -top-24 -left-24"></div>
    <div class="botanical-blob bg-secondary w-[400px] h-[400px] -bottom-32 -right-16"></div>
    <div class="botanical-blob bg-inverse-primary w-[300px] h-[300px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="w-full max-w-[480px] relative z-10">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white shadow-sm mb-6">
                <span class="material-symbols-outlined text-primary text-4xl">eco</span>
            </div>
            <h1 class="font-headline font-extrabold text-4xl tracking-tight text-on-background mb-3">Anis Ethos</h1>
            <p class="text-on-surface-variant font-medium">Your private garden for personal growth.</p>
        </div>

        <div class="bg-surface-container-lowest rounded-lg p-8 md:p-10 shadow-[0px_12px_32px_rgba(44,47,48,0.06)] relative overflow-hidden">
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-primary opacity-5 rounded-full"></div>

            <header class="mb-8">
                <h2 class="font-headline font-bold text-2xl text-on-background">Welcome back</h2>
                <p class="text-on-surface-variant text-sm mt-1">Sign in to continue your journey.</p>
            </header>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                @if($errors->any())
                    <div class="bg-error/10 text-error text-xs p-4 rounded-lg border border-error/20 flex items-center gap-3">
                        <span class="material-symbols-outlined text-sm">error</span>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="block font-label font-bold text-xs uppercase tracking-wider text-on-surface-variant ml-1" for="login">Pseudo ou e-mail</label>
                    <div class="relative">
                        <input
                            class="w-full bg-surface-container-low border-none rounded-sm px-4 py-3.5 text-on-surface focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant"
                            id="login"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="Pseudo ou votre e-mail"
                            type="text"
                            required
                            autocomplete="username"
                        />
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant text-xl">person</span>
                    </div>
                    @error('login')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="block font-label font-bold text-xs uppercase tracking-wider text-on-surface-variant" for="password">Mot de passe</label>
                        <span class="text-on-surface-variant font-label text-xs opacity-60">Mot de passe oublié&nbsp;: bientôt</span>
                    </div>
                    <div class="relative">
                        <input
                            class="w-full bg-surface-container-low border-none rounded-sm px-4 py-3.5 text-on-surface focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            type="password"
                            required
                            autocomplete="current-password"
                        />
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant text-xl">lock</span>
                    </div>
                </div>

                <label class="flex items-center gap-3 px-1 cursor-pointer">
                    <input type="checkbox" name="remember" value="1" class="rounded border-outline-variant text-primary focus:ring-primary/20" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-sm font-medium text-on-surface-variant">Se souvenir de moi</span>
                </label>

                <button class="w-full bg-gradient-to-br from-primary to-primary-dim text-on-primary font-headline font-bold py-4 rounded-lg shadow-lg shadow-primary/20 hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-2" type="submit">
                    Connexion
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-outline-variant/10 text-center">
                <p class="text-on-surface-variant text-sm">
                    Don't have an account?
                    <a class="text-primary font-bold hover:underline decoration-2 underline-offset-4 ml-1" href="{{ route('register') }}">Sign up</a>
                </p>
            </div>
        </div>

        <div class="mt-8 flex flex-col items-center gap-4">
            <div class="flex items-center gap-6 opacity-60">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">shield</span>
                    <span class="text-xs font-medium">Encrypted</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">visibility_off</span>
                    <span class="text-xs font-medium">Anonymous</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">verified_user</span>
                    <span class="text-xs font-medium">Secure</span>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="w-full py-8 mt-auto bg-[#eff1f2] dark:bg-slate-950">
    <div class="flex flex-col md:flex-row items-center justify-between px-8 max-w-7xl mx-auto gap-4 font-['Inter'] text-xs text-[#2c2f30] dark:text-slate-400">
        <p>© 2026 Anis Ethos. Grow at your own pace.</p>
        <div class="flex gap-6">
            <a class="opacity-70 hover:text-[#89379f] dark:hover:text-[#e88efc] transition-colors" href="#">Privacy</a>
            <a class="opacity-70 hover:text-[#89379f] dark:hover:text-[#e88efc] transition-colors" href="#">Terms</a>
            <a class="opacity-70 hover:text-[#89379f] dark:hover:text-[#e88efc] transition-colors" href="#">Support</a>
        </div>
    </div>
</footer>

</body>
</html>
