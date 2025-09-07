<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Kiranti\Lib\FileHandler;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class WidgetTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function run()
    {
        $widgets = [
            'recent'        => 'Recent posts, categories or any other entities',
            'count'         => 'Total counts of posts, categories or any other entities',
            'aggregate'     => 'Aggregates of posts, categories or any other entities',
            'category-wise' => 'Category Wise Widget',
            'html'          => 'Html Widget will render any html given',
            'about'         => 'Simple About us information',
            'team'          => 'Simple Team Information Especially made for Footer',
            'menu'          => 'Menu Part for frontend',
            'ad'            => 'Show advertisement',
        ];

        $values = [];

        foreach ($widgets as $title => $description) :
            $values[$title] = [
                'view_path'   => config('widgets.widgets.'.strtolower($title)),
                'description' => $description,
                'type'        => $this->resolveWidgetType(strtolower($title)),
            ];
        endforeach;

        \Foundation\Models\Setting::query()
            ->updateOrCreate([ 'key' => \Foundation\Lib\Setting::WIDGET_META_KEY, ], [ 'value' => json_encode($values), ]);

        $this->insertComponents();
    }

    /**
     * Resolve if widget type is backend or frontend
     *
     * @param string $widget
     * @return string
     */
    private function resolveWidgetType(string $widget)
    {
        $widgetTypeCollection = config('widgets.widget-type');

        if (in_array($widget, $widgetTypeCollection['backend'])) {
            return 'backend';
        }
        return 'frontend';
    }

    /**
     * @throws FileNotFoundException
     */
    private function insertComponents()
    {
        $fileSystem = new FileHandler();

        $collection = json_decode($fileSystem->content(
            theme_path(strtolower(active_theme()).'/widget.json')
        ), 1);

        $components = Arr::get($collection, 'components');

        foreach ($components as $component => $description) :
            $prefix = app(\Foundation\Services\WidgetService::class)->getPrefixForComponent();
            \Foundation\Models\Setting::query()
                ->updateOrCreate([ 'key' => $prefix. $component, ], [ 'value' => null, ]);

            $prefix = app(\Foundation\Services\WidgetService::class)->getPrefixForComponent().(active_lang() == 'np' ? '' : '-en-');
            \Foundation\Models\Setting::query()
                ->updateOrCreate([ 'key' => $prefix. $component, ], [ 'value' => null, ]);

        endforeach;
    }

}
