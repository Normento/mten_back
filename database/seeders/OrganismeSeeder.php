<?php

namespace Database\Seeders;

use App\Models\Organisme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganismeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organisme::factory()->count(10)->create();
    }
}
