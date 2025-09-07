<?php

namespace Foundation\Builders\SubQueries;

use Foundation\Models\User;

/**
 * Class UserQuery
 * @package Foundation\Builders\SubQueries
 */
final class UserQuery
{

    public static function getFullName($joinTable)
    {
        return User::query()
            ->selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name')
            ->whereColumn('id', $joinTable);
    }

}
