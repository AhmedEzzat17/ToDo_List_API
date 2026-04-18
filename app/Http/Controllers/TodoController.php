<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function List_Todos(Request $request)
    {
        $todos = Todo::all();
        return response()->json([
            'success' => true,
            'data' => $todos,
            'message' => 'Todos retrieved successfully'
        ]);
    }

    public function Create_Todo(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:pending,in_progress,done',
            'due_date'    => 'nullable|date',
        ]);

        $todo = Todo::create($validated);

        return response()->json([
            'success' => true,
            'data' => $todo,
            'message' => 'Todo created successfully'
        ], 201);
    }

    public function View_Todo($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $todo,
            'message' => 'Todo retrieved successfully'
        ]);
    }

    public function Update_Todo(Request $request, $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 404);
        }

        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'sometimes|in:pending,in_progress,done',
            'due_date'    => 'nullable|date',
        ]);

        $todo->update($validated);

        return response()->json([
            'success' => true,
            'data'    => $todo,
            'message' => 'Todo updated successfully'
        ]);
    }

    public function Delete_Todo($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 404);
        }

        $todo->delete();

        return response()->json([
            'success' => true,
            'data'    => null,
            'message' => 'Todo deleted successfully'
        ]);
    }
}
