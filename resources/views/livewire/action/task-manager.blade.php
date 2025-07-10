<div class="task-manager">

    <!-- Add Task Form -->
    <form wire:submit.prevent="addTask" class="add-task-form">
        <input
            type="text"
            wire:model.defer="title"
            placeholder="Add a new task..."
            autocomplete="off"
            class="task-input"
        />
        <button type="submit" class="add-button">Add Task</button>
    </form>
    @error('title') <p class="error-message">{{ $message }}</p> @enderror

    <!-- Task List -->
    @if($tasks->isEmpty())
        <p class="empty-state">No tasks found. Add your first task above!</p>
    @else
        <ul class="task-list">
            @foreach($tasks as $task)
                <li class="task-item {{ $task->completed ? 'completed' : '' }}">
                    <div class="task-content">
                        <label class="checkbox-container">
                            <input
                                type="checkbox"
                                wire:change="toggleComplete({{ $task->id }})"
                                {{ $task->completed ? 'checked' : '' }}
                            />
                            <span class="checkmark"></span>
                        </label>

                        @if($editTaskId === $task->id)
                            <input
                                type="text"
                                class="edit-input"
                                wire:model.defer="editTitle"
                                autocomplete="off"
                            />
                        @else
                            <span class="task-title">{{ $task->title }}</span>
                        @endif
                    </div>

                    <div class="task-actions">
                        @if($editTaskId === $task->id)
                            <button class="action-button save-button" wire:click="updateTask">
                                ✅ Save
                            </button>
                            <button class="action-button cancel-button" wire:click="cancelEdit">
                                ✖ Cancel
                            </button>
                        @else
                            <button class="action-button edit-button" wire:click="editTask({{ $task->id }})">
                                ✏️ Edit
                            </button>
                            <button 
                                wire:click="deleteTask({{ $task->id }})"
                                onclick="return confirm('Are you sure you want to delete this task?')"
                                class="action-button delete-button"
                                title="Delete Task"
                            >
                                🗑️ Delete
                            </button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- ✅ Counter Component যুক্ত -->
    <div style="margin-top: 2rem;">
        @livewire('counter')
    </div>

    <style>
        /* ------ তোমার আগের Style 그대로 ------ */
        .task-manager {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .add-task-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .task-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .task-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .add-button {
            padding: 0.75rem 1.5rem;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .add-button:hover {
            background-color: #4338ca;
        }

        .error-message {
            color: #ef4444;
            margin-top: -1rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 2rem 0;
        }

        .task-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            background-color: #f8fafc;
            margin-bottom: 0.75rem;
            transition: all 0.2s;
        }

        .task-item:hover {
            background-color: #f1f5f9;
        }

        .task-item.completed {
            opacity: 0.7;
        }

        .task-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .checkbox-container {
            display: block;
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: relative;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .checkbox-container:hover input ~ .checkmark {
            border-color: #94a3b8;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .task-title {
            flex: 1;
            word-break: break-word;
        }

        .task-item.completed .task-title {
            text-decoration: line-through;
            color: #94a3b8;
        }

        .edit-input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
        }

        .edit-input:focus {
            outline: none;
            border-color: #4f46e5;
        }

        .task-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-button {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 0.75rem;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .edit-button {
            background-color: #e0e7ff;
            color: #4f46e5;
        }

        .edit-button:hover {
            background-color: #c7d2fe;
        }

        .delete-button {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .delete-button:hover {
            background-color: #fecaca;
        }

        .save-button {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .save-button:hover {
            background-color: #bbf7d0;
        }

        .cancel-button {
            background-color: #f1f5f9;
            color: #64748b;
        }

        .cancel-button:hover {
            background-color: #e2e8f0;
        }
    </style>
</div>
