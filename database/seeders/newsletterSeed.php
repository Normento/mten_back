<?php

namespace Database\Seeders;

use App\Models\Newsletter;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class newsletterSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [

            [
                'name' => 'SOSSOU1',
                'email' => 'sossou1@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU2',
                'email' => 'sossou2@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU3',
                'email' => 'sossou3@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU4',
                'email' => 'sossou4@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU5',
                'email' => 'sossou5@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU6',
                'email' => 'sossou6@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],
            [
                'name' => 'SOSSOU7',
                'email' => 'sossou7@gmail.com',
                'token' => Str::random(60),
                'status' => true,
            ],

        ];

        Newsletter::insert($user);
    }
}
