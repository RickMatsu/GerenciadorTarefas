<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_tasks()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
             ->get('/tasks')
             ->assertStatus(200)
             ->assertSee($task->title);
    }

    public function test_authenticated_user_can_create_task()
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Nova Tarefa',
            'description' => 'Descrição da tarefa',
        ];

        $this->actingAs($user)
             ->post('/tasks', $data)
             ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_authenticated_user_can_update_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'title' => 'Tarefa Atualizada',
            'description' => 'Descrição atualizada',
        ];

        $this->actingAs($user)
             ->put("/tasks/{$task->id}", $updatedData)
             ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', $updatedData);
    }

    public function test_authenticated_user_can_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
             ->delete("/tasks/{$task->id}")
             ->assertRedirect('/tasks');

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
