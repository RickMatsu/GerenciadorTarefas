<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // Teste para validar que um usuário não autenticado é redirecionado
    public function test_guest_cannot_access_tasks()
    {
        $this->get('/tasks')
             ->assertRedirect('/login');
    }

    // Teste para verificar se um usuário autenticado pode acessar as tarefas
    public function test_authenticated_user_can_access_tasks()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get('/tasks')
             ->assertStatus(200);
    }

    // Teste para verificar a validação de campos obrigatórios ao criar uma tarefa
    public function test_task_validation_required_fields()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/tasks', [])
             ->assertSessionHasErrors(['title', 'description']);
    }

    // Teste para verificar a validação de título máximo e descrição obrigatória
    public function test_task_validation_max_title_length()
    {
        $user = User::factory()->create();
        $longTitle = str_repeat('a', 256); // Um título maior que 255 caracteres

        $this->actingAs($user)
             ->post('/tasks', [
                 'title' => $longTitle,
                 'description' => 'Descrição da tarefa'
             ])
             ->assertSessionHasErrors(['title']);
    }

    // Teste para verificar se um usuário comum não pode excluir tarefas
    public function test_regular_user_cannot_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $this->actingAs($user)
             ->delete('/tasks/' . $task->id)
             ->assertStatus(403); // Forbidden
    }

    // Teste para verificar se um administrador pode excluir tarefas
    public function test_admin_user_can_delete_task()
    {
        $admin = User::factory()->create([
            'is_admin' => true // Supondo que você tenha um campo `is_admin` no seu modelo User
        ]);
        $task = Task::factory()->create();

        $this->actingAs($admin)
             ->delete('/tasks/' . $task->id)
             ->assertStatus(200); // Ou outra resposta de sucesso
    }

    // Teste para verificar se um usuário comum não pode editar tarefas
    public function test_regular_user_cannot_edit_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $this->actingAs($user)
             ->get('/tasks/' . $task->id . '/edit')
             ->assertStatus(403); // Forbidden
    }

    // Teste para verificar se um administrador pode editar tarefas
    public function test_admin_user_can_edit_task()
    {
        $admin = User::factory()->create([
            'is_admin' => true // Supondo que você tenha um campo `is_admin` no seu modelo User
        ]);
        $task = Task::factory()->create();

        $this->actingAs($admin)
             ->get('/tasks/' . $task->id . '/edit')
             ->assertStatus(200); // Ou outra resposta de sucesso
    }
}
