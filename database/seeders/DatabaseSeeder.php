<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\MinistreSeeder;
use Database\Seeders\AppConfigurationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([

            UserSeeder::class,
            PermissionSeed::class,
            RoleSeed::class,
            UserSeedPivot::class,
            RoleSeedPivot::class,
            CategoryProjetSeed::class,
            CategoryDocumentSeed::class,
            CategoryOpportunitySeed::class,
            CategoryActualiteSeed::class,
            CategoryAgendaSeed::class,
            CategoryFormationSeeder::class,
            CategoryStartupSeeder::class,
            CategoryEcosystemeSeeder::class,
            CategoryRapportSeed::class,
            CategoryDirectionSeed::class,
            ProjetSeed::class,
            DocumentSeed::class,
            SecteurSeed::class,
            EntitesSeed::class,
            OpportuniteSeed::class,
            AppConfigurationSeeder::class,
            ActeurSeed::class,
            PlateformeSeed::class,
            EcosystemeDuTchadSeed::class,
            ReformeSeed::class,
            RapportSeed::class,
            DirectionSeed::class,
            ActualiteSeed::class,
            AgendaSeed::class,
            StartupSeeder::class,
            FormationSeeder::class,
            SensibilisationSeeder::class,
            PromotionSeeder::class,
            MinistreSeeder::class,
            AboutSeeder::class,
            TagSeeder::class,
            TaggablesSedder::class,
            EtatDesLieuxSeeder::class,
            newsletterSeed::class,
            OrganismeSeeder::class,
            AdresseSeeder::class,

        ]);


    }
}
