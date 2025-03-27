<?php

namespace Tests\Feature;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_all_tasks()
    {
        $user = User::factory()->create();
        $tasks = Task::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_user_can_create_a_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/tasks', [
                'title' => 'New Task',
                'description' => 'Task Description',
                'status' => TaskStatus::PENDING->value,
                'priority' => TaskPriority::MEDIUM->value,
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'title' => 'New Task',
                'description' => 'Task Description',
                'status' => TaskStatus::PENDING->value,
                'priority' => TaskPriority::MEDIUM->value,
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_a_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->putJson("/api/tasks/{$task->id}", [
                'title' => 'Updated Task',
                'status' => TaskStatus::COMPLETED->value,
                'priority' => TaskPriority::HIGH->value,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'title' => 'Updated Task',
                'status' => TaskStatus::COMPLETED->value,
                'priority' => TaskPriority::HIGH->value,
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
            'status' => TaskStatus::COMPLETED->value,
            'priority' => TaskPriority::HIGH->value,
        ]);
    }

    public function test_user_can_delete_a_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
            'completed_at' => now(),
        ]);
    }
}
