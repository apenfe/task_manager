<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest(column: 'id')->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create', [
            'task' => new Task(),
            'submitButtonText' => 'Crear Tarea',
            'updating' => false,
            'actionUrl' => route('tasks.store')
        ]);
    }

    public function edit(Task $task) {
        return view('tasks.edit', [
            'task' => $task,
            'submitButtonText' => 'Modificar Tarea',
            'updating' => true,
            'actionUrl' => route('tasks.update', $task)
        ]);
    }

    public function store(TaskRequest $request): RedirectResponse
    {

        Task::create($request->validated());

        return redirect()->route('tasks.index');

    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index');
    }

    public function toggle(Task $task): RedirectResponse
    {
        $task->update(['completed' => !$task->completed]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

}
