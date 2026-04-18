<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ANIS Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f5f6f7;
        color: #2c2f30;
        min-height: max(884px, 100dvh);
    }
</style>
</head>
<body class="bg-surface text-on-surface antialiased">

{{-- ===== NAVBAR ===== --}}
<header class="flex justify-between items-center px-6 h-16 w-full bg-[#f5f6f7] sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">local_florist</span>
        <span class="text-primary font-black tracking-tight font-headline text-xl">ANIS ADMIN</span>
    </div>
    <div class="hidden md:flex items-center gap-8">
        <nav class="flex items-center gap-6">
            <a class="text-primary font-bold font-label" href="#">Dashboard</a>
            <a class="text-on-surface font-label hover:bg-surface-container-low px-3 py-1 rounded-full transition-colors" href="#">Users</a>
            <a class="text-on-surface font-label hover:bg-surface-container-low px-3 py-1 rounded-full transition-colors" href="#">Modules</a>
        </nav>
        <div class="flex items-center gap-3">
            <span class="text-sm text-on-surface-variant">
                Bonjour, <span class="font-bold text-primary">{{ auth()->user()->pseudo }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-surface-container-highest text-primary font-label font-bold px-6 py-2 rounded-full hover:opacity-80 transition-opacity">
                    Logout
                </button>
            </form>
        </div>
    </div>
    <button class="md:hidden material-symbols-outlined text-on-surface">menu</button>
</header>

<main class="max-w-7xl mx-auto px-6 py-8 space-y-8">

    {{-- ===== SUCCESS MESSAGE ===== --}}
    @if(session('success'))
        <div class="flex items-center gap-3 rounded-xl bg-primary/10 px-6 py-4 text-primary font-semibold">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- ===== STATS BENTO GRID ===== --}}
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-5 text-primary group-hover:scale-110 transition-transform duration-500">
                <span class="material-symbols-outlined text-8xl" style="font-variation-settings: 'FILL' 1;">group</span>
            </div>
            <p class="text-on-surface-variant font-label text-xs uppercase tracking-wider mb-2">Total Users</p>
            <h3 class="text-3xl font-headline font-extrabold text-on-surface">{{ \App\Models\User::count() }}</h3>
            <div class="mt-4 flex items-center gap-1 text-primary text-xs font-bold">
                <span class="material-symbols-outlined text-sm">group</span>
                <span>{{ \App\Models\User::where('role','admin')->count() }} admin · {{ \App\Models\User::where('role','user')->count() }} users</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-5 text-primary">
                <span class="material-symbols-outlined text-8xl" style="font-variation-settings: 'FILL' 1;">bolt</span>
            </div>
            <p class="text-on-surface-variant font-label text-xs uppercase tracking-wider mb-2">XP Total</p>
            <h3 class="text-3xl font-headline font-extrabold text-on-surface">{{ \App\Models\User::sum('xp_total') }}</h3>
            <div class="mt-4 flex items-center gap-1 text-primary text-xs font-bold">
                <span class="material-symbols-outlined text-sm">visibility</span>
                <span>Cumul de tous les users</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-5 text-primary">
                <span class="material-symbols-outlined text-8xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
            </div>
            <p class="text-on-surface-variant font-label text-xs uppercase tracking-wider mb-2">Anonymes</p>
            <h3 class="text-3xl font-headline font-extrabold text-on-surface">{{ \App\Models\User::where('is_anonymous', true)->count() }}</h3>
            <div class="mt-4 flex items-center gap-1 text-primary text-xs font-bold">
                <span class="material-symbols-outlined text-sm">visibility_off</span>
                <span>Sans email enregistré</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-5 text-primary">
                <span class="material-symbols-outlined text-8xl" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
            </div>
            <p class="text-on-surface-variant font-label text-xs uppercase tracking-wider mb-2">Meilleur Streak</p>
            <h3 class="text-3xl font-headline font-extrabold text-on-surface">{{ \App\Models\User::max('streak_days') }}j</h3>
            <div class="mt-4 flex items-center gap-1 text-primary text-xs font-bold">
                <span class="material-symbols-outlined text-sm">analytics</span>
                <span>Record actuel</span>
            </div>
        </div>

    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ===== USERS TABLE ===== --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="flex justify-between items-end px-2">
                <div>
                    <h2 class="text-2xl font-headline font-bold text-on-surface">Gestion des Utilisateurs</h2>
                    <p class="text-on-surface-variant text-sm">Liste complète des comptes enregistrés.</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-lg overflow-hidden shadow-[0px_12px_32px_rgba(44,47,48,0.06)]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low text-on-surface-variant text-xs uppercase font-bold tracking-widest">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Pseudo</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">XP</th>
                            <th class="px-6 py-4">Streak</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low font-body text-sm">
                        @forelse(\App\Models\User::latest()->get() as $user)
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="px-6 py-5 text-on-surface-variant">{{ $user->id }}</td>
                            <td class="px-6 py-5 font-semibold text-on-surface">{{ $user->pseudo }}</td>
                            <td class="px-6 py-5 text-on-surface-variant">{{ $user->email ?? '—' }}</td>
                            <td class="px-6 py-5">
                                @if($user->role === 'admin')
                                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-[10px] font-bold">ADMIN</span>
                                @else
                                    <span class="bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-[10px] font-bold">USER</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 font-bold text-primary">{{ $user->xp_total }}</td>
                            <td class="px-6 py-5">{{ $user->streak_days }}j</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-on-surface-variant">Aucun utilisateur enregistré.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== ANALYTICS ===== --}}
        <div class="space-y-6">
            <div class="px-2">
                <h2 class="text-2xl font-headline font-bold text-on-surface">Analytics</h2>
                <p class="text-on-surface-variant text-sm">Répartition des rôles et activité.</p>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0px_12px_32px_rgba(44,47,48,0.06)] space-y-8">

                @php
                    $total      = \App\Models\User::count() ?: 1;
                    $adminCount = \App\Models\User::where('role','admin')->count();
                    $userCount  = \App\Models\User::where('role','user')->count();
                    $anonCount  = \App\Models\User::where('is_anonymous', true)->count();
                    $adminPct   = round($adminCount / $total * 100);
                    $userPct    = round($userCount  / $total * 100);
                    $anonPct    = round($anonCount  / $total * 100);
                @endphp

                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                        <span>Admins</span><span>{{ $adminPct }}%</span>
                    </div>
                    <div class="w-full bg-surface-container-low h-3 rounded-full overflow-hidden">
                        <div class="bg-primary h-full rounded-full" style="width: {{ $adminPct }}%"></div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                        <span>Users</span><span>{{ $userPct }}%</span>
                    </div>
                    <div class="w-full bg-surface-container-low h-3 rounded-full overflow-hidden">
                        <div class="bg-primary h-full rounded-full opacity-70" style="width: {{ $userPct }}%"></div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                        <span>Anonymes</span><span>{{ $anonPct }}%</span>
                    </div>
                    <div class="w-full bg-surface-container-low h-3 rounded-full overflow-hidden">
                        <div class="bg-primary h-full rounded-full opacity-40" style="width: {{ $anonPct }}%"></div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-primary-container/20 rounded-lg border border-primary/10">
                    <div class="flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">insights</span>
                        <div>
                            <p class="text-sm font-bold text-on-primary-container">Info</p>
                            <p class="text-xs text-on-surface-variant mt-1 leading-relaxed">
                                Le premier utilisateur enregistré reçoit automatiquement le rôle <strong>Admin</strong>.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

{{-- Decorative --}}
<div class="fixed -bottom-12 -left-12 opacity-[0.03] pointer-events-none select-none rotate-45">
    <span class="material-symbols-outlined text-[300px]" style="font-variation-settings: 'FILL' 1;">local_florist</span>
</div>

</body>
</html>
