<?php

namespace Database\Seeders;

use App\Models\Startup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $startups = [
            [
                'name' => 'Afkaarna',
                'user_id' => $userId,
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'category_startup_id' => 1,
                'slug' => 'startup-1',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Afkaarna',
                'user_id' => $userId,
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'category_startup_id' => 2,
                'slug' => 'startup-2',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Afkaarna',
                'user_id' => $userId,
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'category_startup_id' => 3,
                'slug' => 'startup-3',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Afkaarna',
                'user_id' => $userId,
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'category_startup_id' => 4,
                'slug' => 'startup-4',
                'created_at' => Carbon::now(),
            ],
        ];

        Startup::insert($startups);
    }
}
