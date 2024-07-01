<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryOpportunity;
use App\Models\User;
use Carbon\Carbon;

class CategoryOpportunitySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryOpportunities = [
            ['name' => "Appels d'offres", 'user_id' => $userId],
            ['name' => "Appels à projets", 'user_id' => $userId],
            ['name' => "Appels à propositions", 'user_id' => $userId],
            ['name' => "Appels à candidatures", 'user_id' => $userId],
            ['name' => "Avis de consultation publique", 'user_id' => $userId],
            ['name' => "Avis de subventions et financements", 'user_id' => $userId],
            ['name' => "Avis de recrutement", 'user_id' => $userId],
        ];

        CategoryOpportunity::insert($categoryOpportunities);
    }
}
