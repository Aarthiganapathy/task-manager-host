<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        // Paginate tasks with 10 tasks per page
        $tasks = Task::paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    // Show the form for creating a new task
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Task::create($request->only(['title', 'description', 'status']));

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }



    // Show the form for editing the specified task
    public function edit(Task $task)
    {
        return view('tasks.create', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $task->update($request->only(['title', 'description', 'status']));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Display the specified task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }


    
    

    // Remove the specified task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}