<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Opportunite;
use Illuminate\Support\Str;
use App\Models\CategoryOpportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OpportuniteFactory extends Factory
{

    protected $model = Opportunite::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categoryOpportunityId = CategoryOpportunity::inRandomOrder()->value('id');
        $userId = User::inRandomOrder()->value('id');
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'structure_acceuil' => "Agence des Systèmes d'Information et du Numérique (ASIN)",
            'description' => "L’Agent d’enregistrement de certificats numériques est la personne responsable de toutes les activités PKI liées à la délivrance et le support à la gestion des certificats numériques des utilisateurs.Postulez en ligne sur le portail national des services publics",
            'content' => $this->faker->text(100),
            'category_opportunity_id' => $categoryOpportunityId,
            'user_id' => $userId,
            'slug' => Str::slug($title)
        ];
    }
}
