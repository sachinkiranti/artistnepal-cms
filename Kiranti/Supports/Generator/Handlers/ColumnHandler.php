<?php

namespace Kiranti\Supports\Generator\Handlers;

/**
 * Class ColumnHandler
 * @package Kiranti\Supports\Generator\Handlers
 */
final class ColumnHandler
{

    /**
     * Columns to be ignored
     *
     * @var array
     */
    private static $_exceptColumns = [
        'id', 'created_at', 'updated_at',
    ];

    public static function handle() // string $table
    {
//        $columns = array_diff(Schema::getColumnListing($table), static::$_exceptColumns);
        return "'" . implode ( "', '", Builder::getColumns() ) . "'";
    }

}
