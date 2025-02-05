<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\Response;

class BuggyTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Ensure authentication
    }

    public function index()
    {
        return response()->json(Task::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'required|date|after:today',
        ]);

        $task = Task::create($request->all());

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(["error" => "Task not found"], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,completed',
            'due_date' => 'sometimes|date|after:today',
        ]);

        $task->update($request->all());

        return response()->json($task, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(["error" => "Task not found"], Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json(["message" => "Task deleted successfully"], Response::HTTP_NO_CONTENT);
    }
}
