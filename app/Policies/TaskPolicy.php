<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        // Admin pode ver todas as tarefas; usuário comum só pode ver suas próprias
        return $user->role === 'admin' || $user->role === 'user';
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function view(User $user, Task $task)
    {
        // Usuário pode ver qualquer tarefa que ele tenha criado, ou um admin pode ver qualquer tarefa
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // Qualquer usuário autenticado pode criar tarefas
        return $user->role === 'user' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function update(User $user, Task $task)
    {
        // Usuário só pode editar suas próprias tarefas, ou um admin pode editar qualquer tarefa
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function delete(User $user, Task $task)
    {
        // Usuário só pode excluir suas próprias tarefas, ou um admin pode excluir qualquer tarefa
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function restore(User $user, Task $task)
    {
        // Admin pode restaurar qualquer tarefa, usuário comum não pode restaurar
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return bool
     */
    public function forceDelete(User $user, Task $task)
    {
        // Admin pode deletar permanentemente qualquer tarefa
        return $user->role === 'admin';
    }
}
