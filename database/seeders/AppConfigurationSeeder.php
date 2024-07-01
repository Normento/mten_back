<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                'name' => 'Délais de verrouillage de conpte',
                'code' => 'delais.verroullage.compte',
                'value' => 5,
                'type' => 'integer',
            ],
            [
                'name' => 'Nombre de tentative de connexion',
                'code' => 'tentative.connexion',
                'value' => 3,
                'type' => 'integer',
            ],
            [
                'name' => 'Changement de mot de passe par les utilisateurs',
                'code' => 'changement.mot.passe',
                'value' => true,
                'type' => 'boolean',
            ],
            [
                'name' => 'Alerte changement de mot de passe',
                'code' => 'alert.mot.passe.changement',
                'value' => true,
                'type' => 'boolean',
            ],
        ];

        AppConfiguration::insert($configs);
    }
}
