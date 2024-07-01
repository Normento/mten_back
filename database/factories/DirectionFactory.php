<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direction>
 */
class DirectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'name' => $this->faker->firstName(),
            'content' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'user_id' => '1',
        ];
    }
}
