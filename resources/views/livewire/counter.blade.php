<div class="text-center mt-10">
    <h1 class="text-2xl font-bold mb-4">Livewire Counter</h1>

    <div class="text-4xl font-semibold mb-4">{{ $count }}</div>

    <button wire:click="increment" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">
        Increment
    </button>

    <button wire:click="decrement" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
        Decrement
    </button>
</div>
