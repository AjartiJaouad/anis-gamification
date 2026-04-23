<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Modifier un module</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#89379f",
                        "primary-dim": "#7c2992",
                        surface: "#f5f6f7",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff1f2",
                        "surface-container": "#e6e8ea",
                        "on-surface": "#2c2f30",
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-surface font-body text-on-surface">
    <header class="bg-surface-container-lowest px-6 py-4 shadow-sm">
        <div class="mx-auto flex max-w-3xl flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm text-slate-500">Admin • Modifier un module</p>
                <h1 class="mt-2 font-headline text-3xl font-extrabold">Edition du module</h1>
            </div>
            <a href="{{ route('admin.modules.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 text-sm font-semibold transition hover:border-primary hover:text-primary">
                Retour a la liste
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6">
        <div class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm">
            <form method="POST" action="{{ route('admin.modules.update', $module) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-semibold">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $module->title) }}" required class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold">Content</label>
                    <textarea id="content" name="content" rows="8" required class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">{{ old('content', $module->content) }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-semibold">Order</label>
                    <input id="order" type="number" min="1" name="order" value="{{ old('order', $module->order) }}" class="mt-2 w-full rounded-2xl border border-surface-container bg-surface-container-lowest px-4 py-3 outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    @error('order')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.modules.index') }}" class="inline-flex items-center justify-center rounded-full border border-surface-container bg-surface px-5 py-3 text-sm font-semibold transition hover:border-primary hover:text-primary">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white transition hover:bg-primary-dim">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
