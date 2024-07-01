<?php

namespace Database\Seeders;

use App\Models\CategoryEcosysteme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryEcosystemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $category = [
            ['name' => "Decret", 'user_id' => $userId],
            ['name' => "Lois et reglementations", 'user_id' => $userId],
            ['name' => "Politiques et directives", 'user_id' => $userId],
            ['name' => "Rapports et etudes", 'user_id' => $userId],
            ['name' => "Communications publiques", 'user_id' => $userId],
            ['name' => "Budgets et finances", 'user_id' => $userId],
            ['name' => "Contrats et appels d'offres", 'user_id' => $userId],
            ['name' => "Donnees et statistiques", 'user_id' => $userId],
        ];

        CategoryEcosysteme::insert($category);
    }
}
