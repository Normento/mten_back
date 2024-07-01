<?php

namespace Database\Seeders;

use App\Models\Acteur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActeurSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $acteurs = [
            [
                'dirigant' => 'Mr ABALLO',
                'sigle' => 'OTM',
                'name' => 'OTM',
                'slug' => 'otm',
                'url' => 'https://www.google.com',
                'user_id' => $userId,
                'description' => 'Le projet D-CLIC a été officiellement lancé le 15 avril 2023 au Tchad, qui fait désormais partie des trois nouveaux pays concernés avec le Burkina Faso et la Mauritanie. ',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.

                            Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 

                            Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.

                            Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. "
            ],
            [
                'dirigant' => 'Mr ABALLO',
                'sigle' => 'FAI',
                'name' => 'FAI',
                'slug' => 'fai',
                'url' => 'https://www.google.com',
                'user_id' => $userId,
                'description' => 'Le projet D-CLIC a été officiellement lancé le 15 avril 2023 au Tchad, qui fait désormais partie des trois nouveaux pays concernés avec le Burkina Faso et la Mauritanie. ',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.

                            Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 

                            Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.

                            Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. "
            ],
            [
                'dirigant' => 'Mr ABALLO',
                'sigle' => 'ANSICE',
                'name' => 'ANSICE',
                'slug' => 'ansice',
                'url' => 'https://www.google.com',
                'user_id' => $userId,
                'description' => 'Le projet D-CLIC a été officiellement lancé le 15 avril 2023 au Tchad, qui fait désormais partie des trois nouveaux pays concernés avec le Burkina Faso et la Mauritanie. ',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.

                            Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 

                            Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.

                            Pour rappel, le  projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. "
            ]

        ];

        Acteur::insert($acteurs);
    }
}
