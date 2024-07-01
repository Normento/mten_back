<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acteur>
 */
class ActeurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'name' => $this->faker->sentence(4),
            'sigle' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'user_id' => '1',
        ];
    }
}
