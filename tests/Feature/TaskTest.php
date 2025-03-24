<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public Task $task;
    public Status $status;
    public User $user;
    public User $assigned_to_user;

    public function setUp(): void
    {
        parent::setUp();

        $this->status = Status::create(['name' => 'status1']);

        $this->user = User::factory()->create();

        $this->task = Task::create([
            'name' => 'task1',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id
        ]);

        $this->assigned_to_user = User::factory()->create();
    }

    public function testValidTaskCreationWithNullableParamsWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('task.create'), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'description' => 'some description for task2',
                'created_by_id' => $this->user->id,
                'assigned_to_id' => $this->assigned_to_user->id
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'name' => 'task2',
            'status_id' => $this->status->id,
            'description' => 'some description for task2',
            'assigned_to_id' => $this->assigned_to_user->id,
            'created_by_id' => $this->user->id
        ]);
    }

    public function testSuccessTaskWithNullableParamsCreationDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('task.create'), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'description' => 'some description for task2',
                'created_by_id' => $this->user->id,
                'assigned_to_id' => $this->assigned_to_user->id
            ]);

        $response->assertSee('Задача успешно создана');
        $response->assertSee('4');
        $response->assertSee('task2');
        $response->assertSee($this->status->name);
        $response->assertSee($this->user->name);
        $response->assertSee((string)$this->assigned_to_user->id);
    }

    public function testValidTaskCreationWithoutNullableParamsWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('task.create'), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'description' => 'some description for task2',
                'created_by_id' => $this->user->id,
                'assigned_to_id' => $this->assigned_to_user->id
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'name' => 'task2',
            'status_id' => $this->status->id,
            'description' => 'some description for task2',
            'assigned_to_id' => $this->assigned_to_user->id,
            'created_by_id' => $this->user->id
        ]);
    }

    public function testSuccessTaskWithoutNullableParamsCreationDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('task.create'), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);

        $response->assertSee('Задача успешно создана');
        $response->assertSee('4');
        $response->assertSee('task2');
        $response->assertSee($this->status->name);
        $response->assertSee($this->user->name);
    }

    public function testTaskCreationWhileGuest(): void
    {
        $response = $this->post(route('status.create'), ['name' => 'status2']);

        $response->assertForbidden();
        $this->assertDatabaseMissing('statuses', ['name' => 'status2']);
    }

    public function testNonValidTaskCreation(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('task.create'), [
                'name' => 'task1',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tasks/create');
        $this->assertDatabaseCount('tasks', 1);
        $response->assertSessionHasErrors(['name' => 'Задача с таким именем уже существует']);
    }

    public function testNonValidTaskCreationErrorDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('task.create'), [
                'name' => 'task1',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);
        $response->assertSee('Задача с таким именем уже существует');
    }

    public function testValidTaskUpdateWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('task.update', ['task' => $this->task]), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tasks');
        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'name' => 'task2',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id
        ]);
    }

    public function testValidTaskUpdateDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->patch(route('task.update', ['task' => $this->task]), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);

        $response->assertSee('Задача успешно изменена');
        $response->assertSee('9');
        $response->assertSee('task2');
        $response->assertSee($this->status->name);
        $response->assertSee($this->user->name);
    }

    public function testValidTaskUpdateWhileGuest(): void
    {
        $response = $this->patch(route('task.update', ['task' => $this->task]), [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('statuses', [
                'name' => 'task2',
                'status_id' => $this->status->id,
                'created_by_id' => $this->user->id
            ]);
    }

    public function testTaskDeleteWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('task.destroy', ['task' => $this->task]));

        $response->assertRedirect('/tasks');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks', [
            'name' => 'task1',
            'status_id' => $this->status->id,
            'created_by_id' => $this->user->id
        ]);
        $this->assertDatabaseCount('tasks', 0);
    }

    public function testTaskDeleteDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->delete(route('task.destroy', ['task' => $this->task]));

        $response->assertDontSee('task1');
        $response->assertSee('Задача успешно удалена');
    }

    public function testTaskDeleteWhileGuest(): void
    {
        $response = $this->delete(route('task.destroy', ['task' => $this->task]));

        $response->assertForbidden();
        $this->assertDatabaseHas('tasks', ['name' => 'task1']);
    }
}
