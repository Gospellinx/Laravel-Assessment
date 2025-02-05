<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\ProfileController;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('status');
        $tasks = Task::latest();

        if ($filter === 'pending') {
            $tasks = $tasks->pending();
        } elseif ($filter === 'completed') {
            $tasks = $tasks->completed();
        }

        $tasks = $tasks->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'status' => 'in:pending,completed',
        ]);

        Task::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'status' => 'in:pending,completed',
        ]);

        $task->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }
}
