<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ministre;
use Illuminate\Support\Str;
use App\Models\CategoryAgenda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->value('id');
        $ministreId = Ministre::inRandomOrder()->value('id');
        $catId = CategoryAgenda::inRandomOrder()->value('id');
        $slug = $this->faker->sentence();

        return [
            'title' => "Salon de  l'Entrepreneuriat Numérique et de l'Intelligence Artificielle ",
            'description' => "N’Djamena doit gérer plus de 1 570 000 personnes en déplacement forcé, dont plus de 1,1 million de réfugiés.",
            'content' => "Rentré d'exil en novembre après un accord avec le régime du général Mahamat Idriss Déby Itno, président de transition",
            'location' => "N’Djamena",
            'start_date' => Carbon::now(),
            'time' => Carbon::now()->format('H:m'),
            'end_date' => $this->faker->dateTimeBetween('now', '+3 days')->format('Y-m-d H:i:s'),
            'user_id' => $userId,
            'ministre_id' => 1,
            'type' => $this->faker->randomElement(['ministre','ministere']),
            'status' => $this->faker->randomElement(['isPublished' , 'isDraft', 'isPlanned', 'isUpdated']),
            'category_agenda_id' => $catId,
            'slug' => Str::slug($slug)
        ];
    }
}
