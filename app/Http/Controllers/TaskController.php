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
        return inertia('Tasks/Edit', [
            'task' => $task,
        ]);
    }    

    public function update(Request $request, Task $task)
    {
        // Valida os dados recebidos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Atualiza a tarefa com os dados validados
        $task->update($validated);
    
        // Redireciona para a página de listagem de tarefas com uma mensagem de sucesso
        return Inertia::location(route('tasks.index'));
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['message' => 'Tarefa excluída com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir a tarefa.'], 500);
        }
    }
}
