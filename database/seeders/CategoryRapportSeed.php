<?php

namespace Database\Seeders;

use App\Models\CategoryRapport;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryRapportSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryRapports = [
            ['name' => "Rapports de Bilan Annuel", 'user_id' => $userId],
            ['name' => "Rapports de Performance", 'user_id' => $userId],
            ['name' => "Rapports Sectoriels", 'user_id' => $userId],
            ['name' => "Rapports d'Activités Législatives", 'user_id' => $userId],
            ['name' => "Rapports Financiers", 'user_id' => $userId],
            ['name' => "Rapports sur les Politiques Publiques", 'user_id' => $userId],
            ['name' => "Rapports de Communication et de Relations Publiques", 'user_id' => $userId],
            ['name' => "Rapports de Suivi et Evaluation", 'user_id' => $userId],
        ];

        CategoryRapport::insert($categoryRapports);
    }
}
