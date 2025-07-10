<x-app-layout>
    <h2>Login</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

        @if (Route::has('password.request'))
            <a class="link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        @endif
    </form>
</x-app-layout>