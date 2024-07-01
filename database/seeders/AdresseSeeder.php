<?php

namespace Database\Seeders;

use App\Models\Adresse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdresseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adresse::factory()->count(1)->create();
    }
}
