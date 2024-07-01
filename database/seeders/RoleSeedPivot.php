<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            1 => [
                'permissions' => Permission::pluck('id')->toArray(),
            ],
            2 => [
                'permissions' => [1],
            ],
            3 => [
                'permissions' => [2, 6, 7, 8, 9, 10,],
            ],

        ];

        foreach ($permissions as $id => $permission) {
            $role = Role::find($id);

            foreach ($permission as $key => $ids) {
                $role->{$key}()->sync($ids);
            }
        }
    }
}
