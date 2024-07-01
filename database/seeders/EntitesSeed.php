<?php

namespace Database\Seeders;

use App\Models\Entite;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::inRandomOrder()->value('id');
        $entites = [
            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'ARCEP',
                'slug' => 'arcep',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'ADETIC',
                'slug' => 'adetic',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'STPE',
                'slug' => 'stpe',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'SOTEL',
                'slug' => 'sotel',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'ENASTIC',
                'slug' => 'enastic',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

            [
                'dirigeant' => 'NKENG George ELAMBO',
                'name' => 'Ecole Nationale Supérieure des
                            Travaux Publics (ENSTP)',
                'user_id' => $userId,
                'content' => "L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.",
                'sigle' => 'SAFITEL',
                'slug' => 'safitel',
                'description' => 'L’Ecole Nationale des Travaux Publics (ENTP) créée par la loi N°02/65/PR du 15 janvier 1965, a pris la dénomination de Ecole Nationale Supérieure des Travaux Publics (ENSTP) par la loi No051/PR/2015 du 31 décembre 2015. Conformément au décret N°201/PR/PM/MID/2017, du 24 mars 2017, qui l’organise, l’ENSTP est un Etablissement Public d’Enseignement et de Formation Supérieurs à caractère scientifique, technique et professionnel, doté de la personnalité juridique et de l’autonomie administrative et financière.',
                'url' => 'www.google.com',
            ],

        ];

        Entite::insert($entites);
    }
}
