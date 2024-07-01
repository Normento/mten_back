<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'title' => 'Administrateur',
            ],
            [
                'id' => 2,
                'title' => 'Utilisateur',
            ],
            [
                'id' => 3,
                'title' => 'Gestionnaire',
            ],
        ];

        Role::insert($roles);
    }
}
