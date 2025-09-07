<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComponentTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $npComponents = [];
        $enComponents = [];

        foreach (config('widgets.components') as $type => $component) :

            foreach ($component as $key => $viewPath) :
                $npComponents[$key] = [
                    'view_path'   => $viewPath,
                    'is_enabled' => 1,
                    'type'        => strtolower($type),
                ];

                $enComponents['en-'.$key] = [
                    'view_path'   => $viewPath,
                    'is_enabled'  => 1,
                    'type'        => strtolower($type),
                ];
            endforeach;

        endforeach;

        \Foundation\Models\Setting::query()
            ->updateOrCreate([ 'key' => \Foundation\Lib\Setting::COMPONENT_META_KEY, ], [ 'value' => json_encode($npComponents), 'lang' => \Kiranti\Config\Language::NEPALI, ]);

        \Foundation\Models\Setting::query()
            ->updateOrCreate([ 'key' => 'en-'.\Foundation\Lib\Setting::COMPONENT_META_KEY, ], [ 'value' => json_encode($enComponents), 'lang' => \Kiranti\Config\Language::ENGLISH, ]);
    }

}
