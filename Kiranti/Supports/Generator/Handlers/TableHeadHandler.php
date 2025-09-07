<?php

namespace Kiranti\Supports\Generator\Handlers;

/**
 * Class TableHeadHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class TableHeadHandler
{

    public static function handle()
    {
        $heads = array_map(function ($column) {
            return ucwords(str_replace("_", " ", $column));
        }, Builder::getColumns());
        return "<th>" . implode ( "</th><th>", $heads ) . "</th>";
    }

}
