<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Artisan::call('cache:clear');
        $this->call([
            WidgetManagerSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            TagTableSeeder::class,
            FaqTableSeeder::class,
            CategoryTableSeeder::class,
            PostTableSeeder::class,
//            NavTableSeeder::class,
            EmailTemplateTableSeeder::class,
            SettingTableSeeder::class,
//            ComponentTableSeeder::class,
//            ComponentWrapperSeeder::class,
        ]);
        \Artisan::call('cache:clear');
    }
}
