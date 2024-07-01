<?php

namespace Database\Seeders;

use App\Models\CategoryActualite;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryActualiteSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryActualites = [
            ['name' => "tendance", 'user_id' => $userId],
            ['name' => "politique", 'user_id' => $userId],
            ['name' => "economie", 'user_id' => $userId],
        ];

        CategoryActualite::insert($categoryActualites);
    }
}
