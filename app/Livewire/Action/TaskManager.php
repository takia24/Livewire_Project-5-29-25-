<?php

namespace App\Livewire\Action;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    public $title = "";
    public $tasks = [];

    protected $rules = [
        'title' => 'required|min:3|max:255|string',
    ];

    public function mount()
    {
        $this->loadTasks();
    }

    protected function loadTasks()
    {
        $this->tasks = Auth::user()->tasks()->latest()->get();
    }

    public function addTask()
    {
        $this->validate();
        
        Auth::user()->tasks()->create([
            'title' => $this->title,
            'completed' => false
        ]);
        
        $this->reset('title');
        $this->loadTasks();
        $this->dispatch('notify', type: 'success', message: 'Task added successfully!');
    }

    public function deleteTask($id)
    {
        Auth::user()->tasks()->findOrFail($id)->delete();
        $this->loadTasks();
        $this->dispatch('notify', type: 'success', message: 'Task deleted!');
    }

    public function toggleComplete($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update(['completed' => !$task->completed]);
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.action.task-manager')
            ->layout('layouts.app');
    }
}