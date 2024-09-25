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
        // $requestData = json_encode($request->all());
        // echo "<script>console.log('Request: $requestData');</script>";

        // dd($request);

        $request->validate([
            'TaskName' => 'required|string|max:255',
            'Deadline' => 'required|date',
        ]);

        ToDo::create([
            'TaskName' => $request->TaskName,
            'Deadline' => $request->Deadline,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('todos.index');
    }


    public function update(Request $request, ToDo $toDo)
    {

        $request->validate([
            'TaskName' => 'required|string|max:255',
            'Deadline' => 'required|date',
        ]);

        $toDo->update([
            'TaskName' => $request->TaskName,
            'Deadline' => $request->Deadline,
        ]);

        return redirect()->route('todos.index');
    }

    public function destroy(ToDo $toDo)
    {
        $toDo->delete();

        return redirect()->route('todos.index');
    }
}
