<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
    <div class="min-h-screen">
        {{ $header ?? '' }}

        <main class="py-4">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
