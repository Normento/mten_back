<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actualite>
 */
class ActualiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'category_actualite_id' => $this->faker->numberBetween(1, 10),
            'user_id' => '1',
            'status' => $this->faker->randomElement(['isPublished' , 'isDraft', 'isPlanned', 'isUpdated']),
            'published_at' => $this->faker->dateTime(),
            //'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
