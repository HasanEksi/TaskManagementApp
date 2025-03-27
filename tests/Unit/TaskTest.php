<?php

namespace Tests\Unit;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->user);
        $this->assertEquals($user->id, $task->user->id);
    }

    public function test_task_can_be_created()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => TaskStatus::PENDING,
            'priority' => TaskPriority::MEDIUM,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'user_id' => $user->id,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => TaskStatus::PENDING->value,
            'priority' => TaskPriority::MEDIUM->value,
        ]);
    }

    public function test_task_can_be_updated()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $task->update([
            'title' => 'Updated Task',
            'status' => TaskStatus::COMPLETED,
            'priority' => TaskPriority::HIGH,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
            'status' => TaskStatus::COMPLETED->value,
            'priority' => TaskPriority::HIGH->value,
        ]);
    }

    public function test_task_can_be_deleted()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $task->delete();

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_task_completed_at_is_set_when_status_changes_to_completed()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'status' => TaskStatus::PENDING
        ]);

        $task->update(['status' => TaskStatus::COMPLETED]);

        $this->assertNotNull($task->fresh()->completed_at);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => TaskStatus::COMPLETED->value,
        ]);
    }
}
