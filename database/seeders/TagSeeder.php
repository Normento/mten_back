<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'title' => 'Méditation',

            ],
            [
                'title' => 'Santé mentale',


            ],
            [
                'title' => 'Santé au travail',


            ],
            [
                'title' => 'Sommeil',


            ],
            [
                'title' => 'Perte de poids',


            ],
            [
                'title' => 'Santé physique',


            ],
        ];
        Tag::insert($tags);
    }
}
