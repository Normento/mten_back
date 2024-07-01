<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agenda::factory()->count(20)->create();
    }
}
