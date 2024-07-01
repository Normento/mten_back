<?php

namespace Database\Seeders;

use App\Models\Opportunite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpportuniteSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opportunite::factory()->count(20)->create();
    }
}
