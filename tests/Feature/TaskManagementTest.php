<?php

namespace Tests\Feature;

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
}
