<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
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
}
