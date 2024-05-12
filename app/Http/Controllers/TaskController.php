<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Momentum\Modal\Modal;

class TaskController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => Task::when(
                $request->filled('search'),
                fn ($tasks) => $tasks->where('name', 'LIKE', "%{$request->search}%")
            )->paginate(),
            'hasSearch' => $request->filled('search'),
        ]);
    }

    public function create(): Modal
    {
        return Inertia::modal('Tasks/Create')
            ->baseRoute('tasks.index');
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index')
            ->with('message', 'Task created successfully.');
    }

    public function show(Task $task): Modal
    {
        return Inertia::modal('Tasks/Show')
            ->with(['task' => $task->load('user')])
            ->baseRoute('tasks.index');
    }

    public function edit(Task $task)
    {
        return Inertia::modal('Tasks/Edit')
            ->with(compact('task'))
            ->baseRoute('tasks.index');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index')
            ->with('message', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('message', 'Task deleted successfully.');
    }
}
