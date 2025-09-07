<?php

namespace Kiranti\Supports\Concerns;

use Kiranti\Config\Status;

/**
 * Trait HasStatuses
 *
 * $appendsStatus array of status to be appended
 * $prependStatus array of status to be prepended
 * $exceptStatus array of status to be removed
 *
 * @package Kiranti\Supports\Concerns
 */
trait HasStatuses
{

    /**
     * @return array
     */
    public static function getStatuses()
    {
        $status = Status::init();
        if (property_exists(static::class, 'appendsStatus')) {
            $status = $status->append(self::$appendsStatus);
        }

        if (property_exists(static::class, 'prependStatus')) {
            $status = $status->prepend(self::$prependStatus);
        }

        if (property_exists(static::class, 'exceptStatus')) {
            $status = $status->except(self::$exceptStatus);
        }
        return $status->all();
    }

}
