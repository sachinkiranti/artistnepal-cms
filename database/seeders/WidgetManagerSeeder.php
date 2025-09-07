<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WidgetManagerSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ComponentTableSeeder::class,
            WidgetTableSeeder::class,
        ]);
    }

}
