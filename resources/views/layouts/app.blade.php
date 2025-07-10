<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel Task Manager') }}</title>

    <style>
        body {
            font-family: sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
        }
        nav {
            background: #4f46e5;
            padding: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        nav a, nav form button {
            color: #fff;
            background: none;
            border: none;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px #ddd;
        }
    </style>

    @livewireStyles
</head>
<body>

    <nav>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="{{ route('tasks') }}">Tasks</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </nav>

    <div class="container">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>