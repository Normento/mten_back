<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organisme>
 */
class OrganismeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->value('id');

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->text(),
            'institution' => "DSI",
            'type' => $this->faker->randomElement(['text','document']),
            'dirigant' => $this->faker->name(),
            'created_date' => Carbon::now(),
            'user_id' => $userId,
        ];
    }
}
