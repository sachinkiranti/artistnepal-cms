<?php

namespace Kiranti\Supports\Concerns;

use Foundation\Models\Video;

/**
 * Trait Videoable
 *
 * @package Kiranti\Supports\Concerns
 */
trait Videoable
{

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }

}
