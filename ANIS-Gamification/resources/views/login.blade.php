<form action="{{ route('login') }}" method="POST" class="space-y-6">
    @csrf

    @if($errors->any())
        <div class="text-error text-xs mb-4 p-2 bg-error/10 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <input name="pseudo" type="text" value="{{ old('pseudo') }}" ... />

    <input name="password" type="password" ... />

    <button type="submit">Login</button>
</form>
