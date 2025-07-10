<?php

namespace App\Livewire\Action;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    public $title = "";
    public $tasks = [];

    public $editTaskId = null;
    public $editTitle = "";

    protected $rules = [
        'title' => 'required|min:3|max:255|string',
        'editTitle' => 'required|min:3|max:255|string',
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
        $this->validateOnly('title');

        Auth::user()->tasks()->create([
            'title' => $this->title,
            'completed' => false,
        ]);

        $this->reset('title');
        $this->loadTasks();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Task added successfully!']);
    }

    public function deleteTask($id)
    {
        Auth::user()->tasks()->findOrFail($id)->delete();
        $this->loadTasks();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Task deleted!']);
    }

    public function toggleComplete($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update(['completed' => !$task->completed]);
        $this->loadTasks();
    }

    public function editTask($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $this->editTaskId = $task->id;
        $this->editTitle = $task->title;
    }

    public function updateTask()
    {
        $this->validateOnly('editTitle');

        $task = Auth::user()->tasks()->findOrFail($this->editTaskId);
        $task->update(['title' => $this->editTitle]);

        $this->editTaskId = null;
        $this->editTitle = '';

        $this->loadTasks();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Task updated!']);
    }

    public function cancelEdit()
    {
        $this->editTaskId = null;
        $this->editTitle = '';
    }

    public function render()
    {
        return view('livewire.action.task-manager')
            ->layout('layouts.app');
    }
}
