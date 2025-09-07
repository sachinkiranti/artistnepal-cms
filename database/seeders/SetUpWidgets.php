<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetUpWidgets extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            WidgetTableSeeder::class,
            ComponentTableSeeder::class,
        ]);
    }

}
