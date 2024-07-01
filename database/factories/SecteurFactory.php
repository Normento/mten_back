<?php

namespace Database\Factories;

use App\Models\Secteur;
use App\Models\CategorySecteur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secteur>
 */
class SecteurFactory extends Factory
{

    protected $model = Secteur::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $userId = User::inRandomOrder()->value('id');
        $statusOptions = ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'];
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            'url' => $this->faker->url,
            'content' => $this->faker->text(100),
            'user_id' => $userId,
        ];
    }
}
