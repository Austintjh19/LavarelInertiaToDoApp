<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Todo;

class ToDoController extends Controller
{
    public function todos()
    {
        return Inertia::render('ToDo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TaskName' => 'required|string|max:255',
            'Deadline' => 'nullable|date',
        ]);

        ToDo::create([
            'TaskName' => $request->TaskName,
            'Deadline' => $request->Deadline,
        ]);

        return redirect()->route(route: 'todos')->with('success', 'Todo added successfully!');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'TaskName' => 'required|string|max:255',
            'Deadline' => 'nullable|date',
        ]);

        $todo = ToDo::findOrFail($id);
        $todo->update([
            'TaskName' => $request->TaskName,
            'Deadline' => $request->Deadline,
        ]);

        return redirect()->route('todos')->with('success', 'Todo updated successfully!');
    }

    public function delete($id)
    {
        $todo = ToDo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos')->with('success', 'Todo deleted successfully!');
    }
}
