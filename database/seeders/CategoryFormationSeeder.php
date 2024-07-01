<?php

namespace Database\Seeders;

use App\Models\CategoryFormation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryFormation = [
            ['name' => "Cybersécurité", 'user_id' => $userId],
            ['name' => "Intelligence Artificielle", 'user_id' => $userId],
            ['name' => "production de contenu", 'user_id' => $userId],
            ['name' => "développement personnel", 'user_id' => $userId],
        ];

        CategoryFormation::insert($categoryFormation);
    }
}
