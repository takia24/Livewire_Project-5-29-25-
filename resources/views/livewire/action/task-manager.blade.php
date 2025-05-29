<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md text-sm font-medium text-gray-700">
            Back
        </a>
    </div>

    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Task Manager</h1>
        <p class="text-gray-500 text-sm mt-1">Manage your tasks efficiently</p>
    </div>

    <!-- Add Task Form -->
    <div class="bg-white rounded-md shadow p-4 mb-6">
        <form wire:submit.prevent="addTask" class="flex gap-2">
            <input 
                type="text"
                wire:model="title"
                placeholder="Add a new task..."
                class="flex-1 border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            <button 
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm transition"
            >
                Add
            </button>
        </form>
        @error('title')
            <p class="text-red-500 text-xs mt-2 pl-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Task List -->
    <div class="space-y-3">
        @forelse($tasks as $task)
            <div class="flex items-center justify-between p-3 rounded-md bg-white shadow border border-gray-200">
                
                <div class="flex items-center space-x-3">
                    <input 
                        type="checkbox"
                        wire:change="toggleComplete({{ $task->id }})"
                        {{ $task->completed ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300"
                    >
                    <span class="{{ $task->completed ? 'line-through text-gray-500 text-sm' : 'text-gray-800 text-sm' }}">
                        {{ $task->title }}
                    </span>
                </div>
                
                <button 
                    wire:click="deleteTask({{ $task->id }})"
                    class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50 transition"
                    title="Delete Task"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @empty
            <div class="bg-white rounded-md shadow p-6 text-center text-gray-500 border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-3 text-sm">No tasks found. Add your first task above!</p>
            </div>
        @endforelse
    </div>
</div>
