<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Join ANIS - Secure & Anonymous</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: "#89379f",
                "primary-dim": "#7c2992",
                surface: "#f5f6f7",
                "surface-container-low": "#eff1f2"
            }
        }
    }
}
</script>
</head>

<body class="bg-surface font-sans">

<header class="flex justify-between items-center px-6 h-16">
    <h1 class="text-xl font-bold text-primary">ANIS</h1>
    <a href="/login" class="text-primary font-bold">Login</a>
</header>

<main class="flex justify-center items-center min-h-screen">

<div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

<h2 class="text-2xl font-bold mb-6">Create Account</h2>

<!-- SUCCESS -->
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<!-- ERRORS -->
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/register" class="space-y-4">
@csrf

<!-- Pseudonym -->
<input name="name" type="text"
class="w-full bg-surface-container-low p-3 rounded"
placeholder="Pseudonym">

<!-- Email -->
<input name="email" type="email"
class="w-full bg-surface-container-low p-3 rounded"
placeholder="Email (optional)">

<!-- Password -->
<input name="password" type="password"
class="w-full bg-surface-container-low p-3 rounded"
placeholder="Password">

<!-- Confirm -->
<input name="password_confirmation" type="password"
class="w-full bg-surface-container-low p-3 rounded"
placeholder="Confirm Password">

<!-- Hidden Anonymous -->
<input type="hidden" name="is_anonymous" value="1">

<!-- Button -->
<button type="submit"
class="w-full bg-gradient-to-r from-primary to-primary-dim text-white py-3 rounded font-bold">
Register Anonymously
</button>

</form>

<p class="text-center mt-4">
Already have account ?
<a href="/login" class="text-primary font-bold">Login</a>
</p>

</div>
</main>

</body>
</html>
