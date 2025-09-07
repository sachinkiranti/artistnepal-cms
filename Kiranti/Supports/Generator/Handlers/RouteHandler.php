<?php

namespace Kiranti\Supports\Generator\Handlers;

use Illuminate\Support\Str;

/**
 * Class RouteHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class RouteHandler
{

    private static $_route = 'admin';

    public static function handle(string $model)
    {
        $content = app('files')->get(base_path('routes/'.static::$_route.'.php'));

        $name = Str::kebab(strtolower($model));
        $className = Str::studly($model);

        $route = "Route::resource('{$name}', '{$className}Controller');";

        $content = $content . PHP_EOL . $route;

        file_put_contents(
            base_path('routes/'.static::$_route.'.php'),
            $content
        );
    }

}
