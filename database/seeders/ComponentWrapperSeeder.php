<?php

namespace Database\Seeders;

use Kiranti\Lib\FileHandler;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ComponentWrapperSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function run()
    {
        $this->insertComponentWrappers();
    }

    /**
     * @throws FileNotFoundException
     */
    private function insertComponentWrappers()
    {
        $fileSystem = new FileHandler();

        $collection = json_decode($fileSystem->content(
            theme_path(strtolower(active_theme()).'/widget.json')
        ), 1);

        $wrappers = Arr::get($collection, 'wrapper');

        \Foundation\Models\Setting::query()
            ->updateOrCreate([ 'key' => 'wrappers', ], [ 'value' => json_encode($wrappers), 'lang' => \Kiranti\Config\Language::NEPALI, ]);

        \Foundation\Models\Setting::query()
            ->updateOrCreate([ 'key' => 'en-wrappers', ], [ 'value' => json_encode($wrappers), 'lang' => \Kiranti\Config\Language::ENGLISH, ]);

    }

}
