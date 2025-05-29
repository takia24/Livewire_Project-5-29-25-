<aside class="w-64 bg-gray-800 text-white">
    <div class="p-4">
        <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
    </div>
    
    <nav class="mt-6">
        <x-nav-link href="{{ route('tasks') }}" :active="request()->routeIs('tasks')">
            Tasks
        </x-nav-link>
        
        @auth
            <x-nav-link href="{{ route('profile') }}" :active="request()->routeIs('profile')">
                Profile
            </x-nav-link>
        @endauth
    </nav>
</nav>

<style>
    .nav-link {
        display: block;
        padding: 0.75rem 1rem;
        color: rgba(255, 255, 255, 0.75);
        transition: all 0.15s ease;
    }
    
    .nav-link:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .nav-link.active {
        color: white;
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>