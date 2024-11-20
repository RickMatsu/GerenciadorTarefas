<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->role === 'admin'
            ? Task::all() // Admin vê todas as tarefas
            : Task::where('user_id', auth()->id())->get();        
        
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        return inertia::render('Tasks/Create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pendente,em andamento,concluída',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'user_id' => auth()->id(), // Associa a tarefa ao usuário autenticado
        ]);

        return Inertia::location(route('tasks.index'));
    }
    

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return inertia('Tasks/Edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,em andamento,concluída',
        ]);

        $task->update($request->only(['title', 'description', 'status']));

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
