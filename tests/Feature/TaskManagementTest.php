<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_and_view_tasks(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Buy groceries',
            'description' => 'Pick up fruit and vegetables',
            'status' => 'Pending',
            'due_date' => '2026-10-15',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Buy groceries',
            'status' => 'Pending',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Buy groceries')
            ->assertSee('Pending');
    }

    public function test_user_can_delete_a_task(): void
    {
        $task = Task::create([
            'task_name' => 'Submit report',
            'description' => 'Finish final report',
            'status' => 'Pending',
            'due_date' => '2026-10-20',
        ]);

        $response = $this->delete('/tasks/'.$task->id);

        $response->assertRedirect('/');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
