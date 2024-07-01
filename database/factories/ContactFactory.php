<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'civil_status' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'object' => $this->faker->sentence(),
            "message" => $this->faker->paragraph(),
        ];
    }
}
