<?php

namespace Database\Seeders;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjetSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $projets = [
            [
                'title' => 'Tchad : L’encement officiel du programe D-CLIC, formez-vous au numérique avec l’OIF',
                'description' => 'L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-1',
                'category_projet_id' => 1,
                'type' => 'document',
            ],
            [
                'title' => 'L’Egypte et le Tchad souhaitent collaborer sur plusieurs projets numériques',
                'description' => 'Le Tchad a lancé en 2020 un nouveau plan stratégique de développement du numérique et des Postes, témoignant de la volonté du gouvernement de rattraper le retard technologique.',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-2',
                'category_projet_id' => 1,
                'type' => 'document',
            ],
            [
                'title' => 'L’Agence tchadienne des investissements et des exportations s’allie à Chad Innovation Hub pour promouvoir l’innovation tech',
                'description' => 'En Afrique, la diversification de l’économie est au cœur des préoccupations des gouvernements.',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-3',
                'category_projet_id' => 1,
                'type' => 'document',
            ],
            [
                'title' => 'Tchad : Simplon Africa et WenakLabs s’associent pour proposer des formations aux métiers du numérique',
                'description' => 'Pour réaliser la transition numérique en cours au Tchad, le pays a besoin de personnes formées. Des partenariats sont en cours dans le pays pour garantir aux jeunes des compétences et qualifications numériques.',
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-4',
                'category_projet_id' => 1,
                'type' => 'document',
            ],
            [
                'title' => "Le Tchad et le Maroc s'associent pour échanger des compétences en matière de TIC",
                'description' => "Pour réaliser la transition numérique en cours au Tchad, le pays a besoin de personnes formées. Des partenariats sont en cours dans le pays pour garantir aux jeunes des compétences et qualifications numériques.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-5',
                'category_projet_id' => 1,
                'type' => 'document',
            ],
            [
                'title' => "Le Tchad et le Maroc s'associent pour échanger des compétences en matière de TIC",
                'description' => "Alors que le numérique prend de l'ampleur à travers le monde, le gouvernement tchadien multiplie les mesures fortes pour rattraper le retard accusé dans le secteur.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-6',
                'category_projet_id' => 1,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-7',
                'category_projet_id' => 1,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-8',
                'category_projet_id' => 2,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-9',
                'category_projet_id' => 2,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-10',
                'category_projet_id' => 3,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-11',
                'category_projet_id' => 3,
                'type' => 'text',
            ],
            [
                'title' => "Le Tchad bénéficie du soutien de l’Union postale universelle en e-commerce",
                'description' => "Dans le cadre d’une mission qui se déroule du lundi 23 octobre au vendredi 27 octobre, l’Union postale universelle a dépêché deux experts techniques au Tchad.",
                'content' => "L’objectif du projet D-CLIC est de renforcer les compétences numériques des jeunes de l’espace francophone et de multiplier leurs chances d’accéder à des emplois décents, en entreprises et dans l’entrepreneuriat.
                                Ce lancement au Tchad intervient après un processus de sélection des apprenants ouvert et transparent ayant permis de retenir les jeunes les plus motivés et aptes à suivre les formations. Ce sont donc 120 jeunes tchadiennes et tchadiens sélectionnés sur plus 1 400 candidatures reçues qui suivront des modules de formation dans trois domaines : la communication et le marketing digital ; l’infographie et le design ; le développement web. Ces sessions sont organisées par l'Association pour le développement des sociétés de l’information au Tchad (ADESIT), l'opérateur de formation D-CLIC dans ce pays. 
                                Lors de la cérémonie organisée à N'Djamena sous la présidence du Secrétaire général du ministère des Télécommunications et de l'Economie numérique du Tchad, et en présence de plusieurs partenaires au développement, le Représentant de l'OIF pour l’Afrique centrale a invité les apprenant(e)s à faire preuve d’engagement et d’assiduité afin de tirer profit de cette opportunité de formation. Il a en outre suggéré à l’ADESIT à nouer dès à présent des partenariats avec des institutions publiques et privées dans le but de faciliter l’insertion professionnelle de ces jeunes.
                                Pour rappel, le projet D-CLIC est mis en œuvre depuis 2021, dans le cadre de la Stratégie de la Francophonie numérique 2022-2026. En 2022, sur les 1300 jeunes formés dans 10 pays, 51% étaient des femmes et 42% des formations se sont tenues en zones périurbaines ou rurales. Avec la reconduction des formations à Djibouti et Madagascar, plus les trois nouveaux pays (Burkina Faso, Mauritanie et Tchad), 920 jeunes supplémentaires sont touchés par le projet D-CLIC dès ce début d’année 2023. ",
                'status' => 'isPublished',
                'user_id' => $userId,
                'slug' => 'projet-12',
                'category_projet_id' => 3,
                'type' => 'text',
            ],

        ];

        Projet::insert($projets);
    }
}
