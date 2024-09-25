<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ToDo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ToDoController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        $todos = ToDo::with('user:id, name')
                ->where('user_id', $userId)
                ->latest()
                ->get();

        return Inertia::render('ToDo/Index', ['todos' => $todos, 'user_id' => $userId]);
    }

    public function store(Request $request)
    {
        $requestData = json_encode($request->all());
        echo "<script>console.log('Request: $requestData');</script>";

        $request->validate([
            'TaskName' => 'required|string|max:255',
            'Deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        ToDo::create([
            'TaskName' => $request->TaskName,
            'Deadline' => $request->Deadline,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('todos');
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

        return redirect()->route('todos');
    }
}
