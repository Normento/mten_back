<?php

namespace Database\Seeders;

use App\Models\Secteur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecteurSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Secteur::factory()->count(15)->create();
    }
}
