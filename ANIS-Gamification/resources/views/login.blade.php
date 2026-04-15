<form action="{{ route('login') }}" method="POST" class="space-y-6">
    @csrf
    <input name="pseudo" type="text" ... />
    <input name="password" type="password" ... />
    <button type="submit">Login</button>
</form>
