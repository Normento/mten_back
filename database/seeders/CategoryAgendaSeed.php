<?php

namespace Database\Seeders;

use App\Models\CategoryAgenda;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryAgendaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryAgendas = [
            ['name' => "evenement present", 'user_id' => $userId ],
            ['name' => "evenement en direct", 'user_id' => $userId],
            ['name' => "evenement en ligne", 'user_id' => $userId],
        ];

        CategoryAgenda::insert($categoryAgendas);
    }
}
