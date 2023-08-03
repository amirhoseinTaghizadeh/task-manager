<?php


namespace Tests\Feature;


use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Sample Task',
            'completed' => false,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Sample Task', 'completed' => false]);
    }

    public function test_can_update_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'Updated Task',
            'completed' => true,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Updated Task', 'completed' => true]);
    }

    public function test_can_delete_task()
    {
        $task = Tasks::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task->id));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
