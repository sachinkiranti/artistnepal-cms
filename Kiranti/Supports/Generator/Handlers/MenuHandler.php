<?php

namespace Kiranti\Supports\Generator\Handlers;

use Illuminate\Support\Str;

/**
 * Class MenuHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class MenuHandler
{

    public static function handle(string $model)
    {
        $content = app('files')->get(resource_path('views/admin/menu.blade.php'));

        $menu = str_replace([ '{MENU}', '{menu}' ], [ ucwords($model) ,strtolower($model) ],
            app('files')->get(resource_path('views/generator/menu.blade.php')));

        $content = $content . PHP_EOL . $menu;

        file_put_contents(
            resource_path('views/admin/menu.blade.php'),
            $content
        );
    }

}
