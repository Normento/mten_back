<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $formations = [
            [
                'title' => 'Formation en securité des application web et mobile',
                'user_id' => $userId,
                'slug' => 'formation-1',
                'description' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'content' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'category_formation_id' => 1,
            ],
            [
                'title' => 'Formation en securité des application web et mobile',
                'user_id' => $userId,
                'slug' => 'formation-2',
                'description' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'content' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'category_formation_id' => 2,
            ],
            [
                'title' => 'Formation en securité des application web et mobile',
                'user_id' => $userId,
                'slug' => 'formation-3',
                'description' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'content' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'category_formation_id' => 1,
            ],
            [
                'title' => 'Formation en securité des application web et mobile',
                'user_id' => $userId,
                'slug' => 'formation-4',
                'description' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'content' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'category_formation_id' => 2,
            ],
            [
                'title' => 'Formation en securité des application web et mobile',
                'user_id' => $userId,
                'slug' => 'formation-5',
                'description' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'content' => "Découvrez notre formation en sécurité informatique, conçue pour vous fournir les compétences et les connaissances nécessaires pour protéger efficacement les systèmes informatiques contre les menaces et les attaques cybernétiques. Apprenez les principes fondamentaux de la sécurité des réseaux, les meilleures pratiques en matière de protection des données, et les techniques avancées de détection et de réponse aux incidents. Avec notre programme de formation interactif, vous serez prêt à relever les défis complexes de la sécurité informatique dans un monde numérique en constante évolution. Rejoignez-nous pour renforcer vos compétences et devenir un expert en sécurité informatique.",
                'category_formation_id' => 2,
            ],
        ];

        Formation::insert($formations);
    }
}
