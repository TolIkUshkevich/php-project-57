<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->status = Status::create(['name' => 'status1']);

        $this->user = User::factory()->create();
    }

    public function testValidStatusCreationWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('status.create'), ['name' => 'status2']);
        
        $response->assertStatus(302);
        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('statuses', [
            'name' => 'status2'
        ]);
    }

    public function testSuccessStatusCreationDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('status.create'), ['name' => 'status2']);
        
        $response->assertSee('Статус успешно создан');
        $response->assertSee('4');
        $response->assertSee('status2');
    }

    public function testValidStatusCreationWhileGuest(): void
    {
        $response = $this->post(route('status.create'), ['name' => 'status2']);

        $response->assertForbidden();
        $this->assertDatabaseMissing('statuses', ['name' => 'status2']);
    }

    public function testNonValidStatusCreation(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('status.create'), ['name' => 'status1']);

        $response->assertStatus(302);
        $response->assertRedirect('/task_statuses/create');
        $this->assertDatabaseCount('statuses', 1);
        $response->assertSessionHasErrors(['name' => 'Статус с таким именем уже существует']);
    }

    public function testNonValidStatusCreationErrorDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('status.create'), ['name' => 'status1']);

        $response->assertSee('Статус с таким именем уже существует');
    }

    public function testValidStatusUpdateWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('status.update', ['status' => $this->status]), ['name' => 'status2']);
        $response->assertStatus(302);
        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseCount('statuses', 1);
        $this->assertDatabaseHas('statuses', [
            'name' => 'status2'
        ]);
    }

    public function testValidStatusUpdateDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('status.update', ['status' => $this->status]), ['name' => 'status2']);
        
        $response->assertSee('Статус успешно обновлен');
        $response->assertSee('9');
        $response->assertSee('status2');
    }

    public function testValidStatusUpdateWhileGuest(): void
    {
        $response = $this->patch(route('status.update', ['status' => $this->status]), ['name' => 'status2']);
        
        $response->assertForbidden();
        $this->assertDatabaseMissing('statuses', ['name' => 'status2']);
    }

    public function testStatusDeleteWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('status.destroy', ['status' => $this->status]));

        $response->assertRedirect('/task_statuses');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('statuses', ['name' => 'status1']);
        $this->assertDatabaseCount('statuses', 0);
    }

    public function testStatusDeleteDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->delete(route('status.destroy', ['status' => $this->status]));

        $response->assertDontSee('status1');
        $response->assertSee('Статус успешно удалён');
    }

    public function testStatusDeleteWhileGuest(): void
    {
        $response = $this->delete(route('status.destroy', ['status' => $this->status]));

        $response->assertForbidden();
        $this->assertDatabaseHas('statuses', ['name' => 'status1']);
    }

    public function testDeleteTaskRelatedStatus(): void
    {
        $this->realetedStatus = Status::create(['name' => 'realeted status']);
        $this->task = Task::create(['name' => 'task1', 'status_id' => $this->realetedStatus->id]);
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->delete(route('status.destroy', ['status' => $this->realetedStatus]));

        $response->assertSee('realeted status');
        $response->assertSee('Не удалось удалить статус');
        $this->assertDatabaseHas('statuses', ['name' => 'realeted status']);
    }
}
