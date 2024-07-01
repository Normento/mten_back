<?php

namespace Database\Seeders;

use App\Models\CategoryDocument;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDocumentSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $categoryDocuments = [
            ['name' => "Decrets", 'user_id' => $userId , 'slug' => 'decrets' , 'type' => 'juridique' ],
            ['name' => "Lois", 'user_id' => $userId , 'slug' => 'lois' , 'type' => 'juridique'],
            ['name' => "Aretes", 'user_id' => $userId , 'slug' => 'aretes' , 'type' => 'juridique'],
            ['name' => "Observatoire", 'user_id' => $userId , 'slug' => 'observatoire' , 'type' => 'juridique'],
            ['name' => "Politiques et directives", 'user_id' => $userId , 'slug' => 'politiques-et-directives' , 'type' => 'classique'],
            ['name' => "Rapports et etudes", 'user_id' => $userId , 'slug' => 'rapports-et-etudes' , 'type' => 'classique'],
            ['name' => "Communications publiques", 'user_id' => $userId , 'slug' => 'communications-publiques' , 'type' => 'classique'],
            ['name' => "Budgets et finances", 'user_id' => $userId , 'slug' => 'budgets-et-finances' , 'type' => 'classique'],
            ['name' => "Contrats et appels d'offres", 'user_id' => $userId , 'slug' => 'contrats-et-appels-offres' , 'type' => 'classique'],
            ['name' => "Donnees et statistiques", 'user_id' => $userId , 'slug' => 'donnees-et-statistiques' , 'type' => 'classique'],
        ];

        CategoryDocument::insert($categoryDocuments);
    }
}
