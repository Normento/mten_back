<?php

namespace Database\Seeders;

use App\Models\CategoryProjet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProjetSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryProjets = [
            ['name' => "Plan d'action", 'user_id' => $userId, 'slug' => 'plan-action'],
            ['name' => "Plan strategique 2030", 'user_id' => $userId, 'slug' => 'plan-strategique-2030'],
            ['name' => "Plan d'action 2024", 'user_id' => $userId, 'slug' => 'plan-action-2024'],
            ['name' => "Plan stratégique", 'user_id' => $userId, 'slug' => 'plan-strategique'],
            ['name' => "Projet realisé", 'user_id' => $userId, 'slug' => 'projet-realise'],
            ['name' => "Projet en cours de réalisation", 'user_id' => $userId, 'slug' => 'projet-en-cour-de-realisation' ],
        ];

        CategoryProjet::insert($categoryProjets);
    }
}
