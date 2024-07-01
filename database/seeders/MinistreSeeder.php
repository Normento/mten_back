<?php

namespace Database\Seeders;

use App\Models\Ministre;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MinistreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');

        $ministres = [

        ['firstname' => 'Mahamat', 
            'lastname' => 'Zene Bada', 
            'poste' => 'Ministre de la Santé Publique', 
            'biographie' => "Mahamat Zene Bada est un médecin de renom ayant une vaste expérience dans le domaine de la santé publique. Il a dirigé plusieurs initiatives de santé visant à améliorer l'accès aux soins de santé dans tout le pays. Sa passion pour la médecine et son engagement envers le bien-être de la population font de lui un leader exemplaire dans le domaine de la santé.", 
            'mot' => "Je m'engage à améliorer le système de santé pour le bien-être de tous les citoyens. Ensemble, nous pouvons œuvrer pour une nation en meilleure santé.", 
            'user_id' => $userId, 
            'on_poste' => 1
        ],

        ['firstname' => 'Mariam', 
            'lastname' => 'Mahamat Nour', 
            'poste' => "Ministre de l'Éducation Nationale", 
            'biographie' => "Mariam Mahamat Nour est une éducatrice dévouée ayant travaillé dans le domaine de l'éducation depuis plus de deux décennies. Elle a occupé divers postes dans le secteur de l'éducation, mettant en œuvre des réformes et des programmes pour améliorer la qualité de l'enseignement. Sa vision pour l'éducation inclusive et de qualité en fait une leader éclairée dans son domaine.", 
            'mot' => "Mon objectif est de garantir un accès à une éducation de qualité pour tous les enfants du Tchad. Ensemble, nous pouvons créer un avenir meilleur pour notre pays à travers l'éducation.", 
            'user_id' => $userId, 
            'on_poste' => 0
        ],

        ['firstname' => 'Acheick', 
            'lastname' => 'Abdoulaye Idriss', 
            'poste' => "Ministre de l'Agriculture et de l'Irrigation", 
            'biographie' => "Acheick Abdoulaye Idriss est un agriculteur chevronné ayant une grande expertise dans le domaine de l'agriculture et de l'irrigation. Il a dirigé plusieurs projets agricoles innovants et a travaillé en étroite collaboration avec les communautés agricoles pour améliorer les pratiques agricoles et accroître la productivité. Son engagement envers le développement rural en fait un leader reconnu dans le secteur agricole.", 
            'mot' => "Je m'engage à moderniser les pratiques agricoles pour améliorer la sécurité alimentaire au Tchad. Ensemble, nous pouvons transformer notre secteur agricole et contribuer à la prospérité de notre nation.", 
            'user_id' => $userId, 
            'on_poste' => 0
        ],

        ['firstname' => 'Amina', 
            'lastname' => 'Ali Mahamat', 
            'poste' => "Ministre de la Promotion de la Femme, de la Protection de la Petite Enfance et de la Solidarité Nationale", 
            'biographie' => "Amina Ali Mahamat est une militante des droits des femmes et une défenseure de la protection de l'enfance. Elle a travaillé sur plusieurs projets visant à autonomiser les femmes et à protéger les droits des enfants. Son leadership éclairé et son engagement envers l'égalité des genres en font une voix influente dans la lutte pour les droits de la femme et de l'enfant.", 
            'mot' => "Je m'engage à promouvoir l'égalité des genres et à protéger les droits des enfants au Tchad. Ensemble, nous pouvons créer un environnement plus sûr et plus équitable pour tous.", 
            'user_id' => $userId, 
            'on_poste' => 0
        ],

        
        ];

        Ministre::insert($ministres);
    }
    
}
