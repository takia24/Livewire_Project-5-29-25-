<x-app-layout>
    <div class="container">
        <h1>Welcome to Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</x-app-layout>