<?php

namespace Database\Seeders;

use App\Models\Plateforme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlateformeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $plateformes = [
            [
                'name' => 'Iram', 
                'description' => "L'IRAM assure l'assistance technique à la Plateforme Pastorale, qui constitue un cadre de concertation ouvert, réunissant les organisations des acteurs du développement pastoral, centré sur l’amélioration des politiques de développement du monde rural, au plan national, sous régional et international.",
                'url' => 'www.google.com',
                'user_id' => $userId,
            ],
            [
                'name' => 'Inter Reseau',
                'description' => "L'IRAM assure l'assistance technique à la Plateforme Pastorale, qui constitue un cadre de concertation ouvert, réunissant les organisations des acteurs du développement pastoral, centré sur l’amélioration des politiques de développement du monde rural, au plan national, sous régional et international.",
                'url' => 'www.google.com',
                'user_id' => $userId,
            ],
            [
                'name' => 'Iram',
                'description' => "L'IRAM assure l'assistance technique à la Plateforme Pastorale, qui constitue un cadre de concertation ouvert, réunissant les organisations des acteurs du développement pastoral, centré sur l’amélioration des politiques de développement du monde rural, au plan national, sous régional et international.",
                'url' => 'www.google.com',
                'user_id' => $userId,
            ],
            [
                'name' => 'Iram',
                'description' => "L'IRAM assure l'assistance technique à la Plateforme Pastorale, qui constitue un cadre de concertation ouvert, réunissant les organisations des acteurs du développement pastoral, centré sur l’amélioration des politiques de développement du monde rural, au plan national, sous régional et international.",
                'url' => 'www.google.com',
                'user_id' => $userId,
            ],
        ];

        Plateforme::insert($plateformes);
    }
}
