<?php

namespace Database\Seeders;

use Foundation\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            \Foundation\Models\User::DEFAULT_ROLE, \Foundation\Lib\Role::get(\Foundation\Lib\Role::ROLE_AUTHOR, false),
        ];

        foreach ($roles as $role) {
            $name = ucwords(str_replace('-', ' ', $role));
            Role::updateOrCreate(
                [ 'name' => $name, ],
                [ 'slug' => $role, 'description' => $name, 'status' => 1 ]
            );
        }
    }
}
