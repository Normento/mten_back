<?php

namespace Database\Factories;

use App\Models\CategoryProjet;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{

    protected $model = Projet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryProjetId = CategoryProjet::inRandomOrder()->value('id');
        $userId = User::inRandomOrder()->value('id');
        $publishedAt = $this->faker->dateTimeBetween('-1 year', 'now');
        $statusOptions = ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'];
        $status = $statusOptions[array_rand($statusOptions)];
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            'content' => $this->faker->text(100),
            'category_projet_id' => $categoryProjetId,
            'user_id' => $userId,

            'status' => $status,
        ];
    }
}
