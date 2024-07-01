<?php

namespace Database\Seeders;

use App\Models\CategoryStartup;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryStartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryStartups = [
            ['name' => "FineTech", 'user_id' => $userId],
            ['name' => "Agro", 'user_id' => $userId],
            ['name' => "HealthTech", 'user_id' => $userId],
            ['name' => "Environement", 'user_id' => $userId],
            ['name' => "Energie", 'user_id' => $userId],
            ['name' => "Biotechnologie", 'user_id' => $userId],
            ['name' => "Mobilité & transport", 'user_id' => $userId],
            ['name' => "Education", 'user_id' => $userId],
            ['name' => "Education", 'user_id' => $userId],
            ['name' => "Divertissement", 'user_id' => $userId],
        ];

        CategoryStartup::insert($categoryStartups);
    }
}
