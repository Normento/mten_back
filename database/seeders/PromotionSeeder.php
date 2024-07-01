<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $promotions = [
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-1',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-2',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-3',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-4',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-5',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-6',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
            [
                'title' => 'Promotion du startup Afkaarna',
                'user_id' => $userId,
                'slug' => 'promotion-7',
                'description' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
                'content' => "Afkaarna, une startup innovante qui vise à transformer l'éducation au Tchad. Notre mission est d'offrir un accès équitable aux ressources éducatives grâce à une plateforme numérique révolutionnaire. En tant que pionniers de l'apprentissage en ligne dans un pays où l'internet est souvent inaccessible, nous nous engageons à fournir des outils éducatifs accessibles et efficaces pour tous. Rejoignez-nous dans notre voyage pour façonner l'avenir de l'éducation avec Afkaarna.",
            ],
        ];

        Promotion::insert($promotions);
    }
}
