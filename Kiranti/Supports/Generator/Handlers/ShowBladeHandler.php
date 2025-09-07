<?php

namespace Kiranti\Supports\Generator\Handlers;

/**
 * Class ShowBladeHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class ShowBladeHandler
{

    public static function handle(string $model)
    {
        $rows = array_map(function ($column) use ($model) {
            return str_replace([ '{MODEL}', '{model}', '{COLUMN}', '{column}' ], [ ucwords($model) , strtolower($model), ucfirst($column), strtolower($column) ],
                app('files')->get(resource_path('views/generator/row.blade.php')));
        }, Builder::getColumns());
        return implode ( "", $rows );
    }

}
