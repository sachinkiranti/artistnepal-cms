<?php

namespace Database\Seeders;

use Foundation\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
            'first_name' => 'root',
            'last_name' => '',
            'email' => env('ROOT_EMAIL', 'root@cms.com'),
            'password' => bcrypt(env('ROOT_PASSWORD', 'secret')),
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        $user->assignRole((array) \Foundation\Models\Role::where('slug', User::DEFAULT_ROLE)->value('id'));

        $user = User::create([
            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
            'first_name' => 'Author',
            'last_name' => ' ',
            'email' => env('AUTHOR_EMAIL', 'author@cms.com'),
            'password' => bcrypt(env('AUTHOR_PASSWORD', 'secret')),
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        $user->assignRole((array) \Foundation\Models\Role::where('slug', \Foundation\Lib\Role::get(\Foundation\Lib\Role::ROLE_AUTHOR, false))->value('id'));
    }
}
