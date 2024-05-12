<?php

namespace Database\Factories;

use App\Enums\Priority;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(Status::values()),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month')
                ->format('Y-m-d H:i:s'),
            'priority' => $this->faker->randomElement(Priority::values()),
        ];
    }

    public function pending(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::Pending->value,
        ]);
    }

    public function inProgress(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::InProgress->value,
        ]);
    }
}
