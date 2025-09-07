<?php

namespace Kiranti\Supports\Generator\Handlers;

use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Builder
 * @package Kiranti\Supports\Generator\Handlers
 */
final class Builder
{

    public static function getForm()
    {
        return Yaml::parse(file_get_contents(base_path('form.yml')));
    }

    public static function getColumns()
    {
        $args = [];
        return Arr::flatten(array_map(function ($item) use ($args) {
            return array_merge($args, explode('|', $item));
        },  array_values(self::getForm())));
    }

}
