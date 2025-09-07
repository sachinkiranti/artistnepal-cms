<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;

class SettingTableSeeder extends \Illuminate\Database\Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->connection()->disableQueryLog();

        try {
            if (Schema::hasTable((new \Foundation\Models\Setting())->getTable())) :
                \Foundation\Models\Setting::truncate();
                \Illuminate\Support\Facades\DB::unprepared(file_get_contents(storage_path('data/sql/settings.sql')));
            endif;
        } catch (\Exception $exception) {
            //
        }

//        \Illuminate\Database\Eloquent\Model::unguard();
//
//        Schema::disableForeignKeyConstraints();
//
//        if (Schema::hasTable((new \Foundation\Models\Setting())->getTable())) :
//
//            (new \Importer\SettingImporter())->import();
//
//        endif;

//        Schema::enableForeignKeyConstraints();
    }

}
