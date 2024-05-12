<?php

namespace Tests\Feature;

use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserShouldBeAbleToViewAListOfTasks(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('tasks.index'))
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Tasks/Index')
                ->has('tasks'));
    }

    public function testAUserShouldBeAbleToViewTheDetailsOfATask(): void
    {
        $task = Task::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('tasks.show', $task))
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Tasks/Index'));
    }

    public function testAUserShouldBeAbleToTakeOnATask(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->pending()->create();

        $payload = [
            'user_id' => $user->id,
            'status' => Status::InProgress->value,
        ];

        $this->actingAs($user)
            ->put(route('tasks.update', $task), $payload)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('message', 'Task updated successfully.');

        $this->assertDatabaseHas(Task::class, [
            'id' => $task->id,
            'user_id' => $user->id,
            'status' => Status::InProgress->value,
        ]);
    }

    public function testAUserShouldBeAbleToUpdateATask(): void
    {
        $task = Task::factory()->create();
        $payload = Task::factory()->make()->toArray();

        $this->actingAs(User::factory()->create())
            ->put(route('tasks.update', $task), $payload)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('message', 'Task updated successfully.');

        $this->assertDatabaseHas(Task::class, [
            'id' => $task->id,
        ] + $payload);
    }

    public function completableStatuses(): array
    {
        return [
            'pending' => [Status::Pending->value => 'pending'],
            'in-progress' => [Status::InProgress->value => 'inProgress'],
        ];
    }

    /**
     * @dataProvider completableStatuses
     */
    public function testAUserShouldBeAbleToMarkATaskAsCompleted($status): void
    {
        $task = Task::factory()->{$status}()->create();

        $payload = [
            'status' => Status::Completed->value,
        ];

        $this->actingAs(User::factory()->create())
            ->put(route('tasks.update', $task), $payload)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('message', 'Task updated successfully.');

        $this->assertDatabaseHas(Task::class, [
            'id' => $task->id,
            'status' => Status::Completed->value,
        ]);
    }

    public function testAUserShouldBeAbleToNavigateToTheCreateTaskPage(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('tasks.create'))
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Tasks/Index'));
    }

    public function testAUserShouldBeAbleToCreateATask(): void
    {
        $payload = Task::factory()->make()->toArray();

        $this->actingAs(User::factory()->create())
            ->post(route('tasks.store'), $payload)
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('message', 'Task created successfully.');

        $this->assertDatabaseHas(Task::class, $payload);
    }

    public function testAUserShouldBeAbleToDeleteATask(): void
    {
        $task = Task::factory()->create();

        $this->actingAs(User::factory()->create())
            ->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('tasks.index'))
            ->assertSessionHas('message', 'Task deleted successfully.');

        $this->assertDatabaseMissing(Task::class, [
            'id' => $task->id,
        ]);
    }

    public function testAUserShouldBeAbleToNavigateToTheEditTaskPage(): void
    {
        $task = Task::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('tasks.edit', $task))
            ->assertOk()
            ->assertInertia(fn ($page) => $page
                ->component('Tasks/Index'));
    }
}
