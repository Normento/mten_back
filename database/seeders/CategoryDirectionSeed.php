<?php

namespace Database\Seeders;

use App\Models\CategoryDirection;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryDirectionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $userId = User::inRandomOrder()->value('id');
        $categoryDirection = [
            ['name' => "Direction technique", 'user_id' => $userId ],
            ['name' => "Direction centrale", 'user_id' => $userId],
        ];

        CategoryDirection::insert($categoryDirection);
    }
}
