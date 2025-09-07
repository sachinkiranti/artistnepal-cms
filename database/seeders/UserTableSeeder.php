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
            'first_name' => 'root',
            'last_name' => '',
            'email' => env('ROOT_EMAIL', 'root@cms.com'),
            'password' => bcrypt(env('ROOT_PASSWORD', 'secret')),
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        $user->assignRole((array) \Foundation\Models\Role::where('slug', \App\Foundation\Enums\Role::ROLE_SUPER_ADMIN)->value('id'));

        $user = User::create([
            'first_name' => 'ArtistNepal',
            'last_name' => '',
            'email' => 'artistnepal@cms.com',
            'password' => bcrypt(env('ROOT_PASSWORD', 'secret')),
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        $user->assignRole((array) \Foundation\Models\Role::where('slug', \App\Foundation\Enums\Role::ROLE_ADMIN)->value('id'));

        $user = User::create([
            'first_name' => 'Author',
            'last_name' => ' ',
            'email' => env('AUTHOR_EMAIL', 'author@cms.com'),
            'password' => bcrypt(env('AUTHOR_PASSWORD', 'secret')),
            'status' => \Kiranti\Config\Status::ACTIVE_STATUS,
        ]);
        $user->assignRole((array) \Foundation\Models\Role::where('slug', \App\Foundation\Enums\Role::ROLE_AUTHOR)->value('id'));
    }
}
