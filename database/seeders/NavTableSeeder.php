<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class NavTableSeeder
 */
class NavTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->connection()->disableQueryLog();

        \Illuminate\Database\Eloquent\Model::unguard();

        Schema::disableForeignKeyConstraints();

        \Foundation\Models\Nav::truncate();

        if (Schema::hasTable((new \Foundation\Models\Nav())->getTable())) :

            (new \Importer\NavsImporter())->import();

        endif;

        Schema::enableForeignKeyConstraints();
    }

}
