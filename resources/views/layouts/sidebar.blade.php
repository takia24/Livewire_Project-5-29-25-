<!-- resources/views/layouts/sidebar.blade.php -->
<div class="flex">
    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
        <h2 class="text-lg font-bold mb-4">Sidebar</h2>
        <!-- Add your sidebar items here -->
        <ul>
            <li><a href="#" class="block py-1">Dashboard</a></li>
            <li><a href="#" class="block py-1">Tasks</a></li>
            <li><a href="#" class="block py-1">Settings</a></li>
        </ul>
    </aside>
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>
</div>
