<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public Label $label;
    public User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->label = Label::create(['name' => 'label1', 'description' => 'some description']);

        $this->user = User::factory()->create();
    }

    public function testValidLabelCreationWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('label.create'), ['name' => 'label2']);

        $response->assertStatus(302);
        $response->assertRedirect('/labels');
        $this->assertDatabaseHas('labels', [
            'name' => 'label2'
        ]);
    }

    public function testSuccessLabelCreationDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('label.create'), ['name' => 'label2', 'description' => 'second label']);

        $response->assertSee('Метка успешно создана');
        $response->assertSee('4');
        $response->assertSee('label2');
        $response->assertSee('second label');
    }

    public function testValidLabelCreationWhileGuest(): void
    {
        $response = $this->post(route('label.create'), ['name' => 'label2']);

        $response->assertForbidden();
        $this->assertDatabaseMissing('labels', ['name' => 'label2']);
    }

    public function testNonValidLabelCreation(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('label.create'), ['name' => 'label1']);

        $response->assertStatus(302);
        $response->assertRedirect('/labels/create');
        $this->assertDatabaseCount('labels', 1);
        $response->assertSessionHasErrors(['name' => 'Метка с таким именем уже существует']);
    }

    public function testNonValidLabelCreationErrorDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('label.create'), ['name' => 'label1']);

        $response->assertSee('Метка с таким именем уже существует');
    }

    public function testValidLabelUpdateWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('label.update', ['label' => $this->label]), ['name' => 'label2']);
        $response->assertStatus(302);
        $response->assertRedirect('/labels');
        $this->assertDatabaseCount('labels', 1);
        $this->assertDatabaseHas('labels', [
            'name' => 'label2'
        ]);
    }

    public function testValidLabelUpdateWithSameNameWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->patch(route('label.update', ['label' => $this->label]), ['name' => 'label1', 'description' => 'new description']);
        $response->assertStatus(302);
        $response->assertRedirect('/labels');
        $this->assertDatabaseCount('labels', 1);
        $this->assertDatabaseHas('labels', [
            'name' => 'label1',
            'description' => 'new description'
        ]);
    }

    public function testValidLabelUpdateDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->patch(route('label.update', ['label' => $this->label]), ['name' => 'label2']);
        $response->assertSee('Метка успешно изменена');
        $response->assertSee('9');
        $response->assertSee('label2');
    }

    public function testValidLabelUpdateWhileGuest(): void
    {
        $response = $this->patch(route('label.update', ['label' => $this->label]), ['name' => 'label2']);

        $response->assertForbidden();
        $this->assertDatabaseMissing('labels', ['name' => 'label2']);
    }

    public function testLabelDeleteWhileAuth(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('label.destroy', ['label' => $this->label]));

        $response->assertRedirect('/labels');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('labels', ['name' => 'label1']);
        $this->assertDatabaseCount('labels', 0);
    }

    public function testLabelDeleteDisplay(): void
    {
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->delete(route('label.destroy', ['label' => $this->label]));

        $response->assertDontSee('label1');
        $response->assertSee('Метка успешно удалена');
    }

    public function testLabelDeleteWhileGuest(): void
    {
        $response = $this->delete(route('label.destroy', ['label' => $this->label]));

        $response->assertForbidden();
        $this->assertDatabaseHas('labels', ['name' => 'label1']);
    }

    public function testDeleteTaskRelatedLabel(): void
    {
        $realetedLabel = Label::create(['name' => 'realeted label']);
        $task = Task::create(['name' => 'task1']);
        $task->labels()->attach($realetedLabel->id);
        $response = $this->actingAs($this->user)
            ->followingRedirects()
            ->delete(route('label.destroy', ['label' => $realetedLabel]));

        $response->assertSee('realeted label');
        $response->assertSee('Не удалось удалить метку');
        $this->assertDatabaseHas('labels', ['name' => 'realeted label']);
    }
}
