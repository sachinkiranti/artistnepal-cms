<?php

namespace Kiranti\Supports\Generator\Handlers;

/**
 * Class FormHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class FormHandler
{

    private static $_text = 'generator/form/text';
    private static $_textarea = 'generator/form/textarea';
    private static $_radio = 'generator/form/radio';

    public static function handle()
    {
        $args = [];

        foreach (Builder::getForm() as $input => $columns) :

            $prop = '_'.strtolower($input);
            if (array_key_exists($prop, get_class_vars(self::class))) {
                $viewPath = get_class_vars(self::class)['_'.strtolower($input)];

                foreach (explode('|', $columns) as $column) {
//                    $args[] = '@include("' . $viewPath . '", [ "input" => "'. ucwords($column) .'", ])';
                    $content = app('files')->get(realpath(base_path('resources/views/').$viewPath.'.blade.php'));
                    $args[] = str_replace([ 'input' ], [ $column ], $content);
                }
            }

        endforeach;

        return implode(PHP_EOL, $args);
    }

}
