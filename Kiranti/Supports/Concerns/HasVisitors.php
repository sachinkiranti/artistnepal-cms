<?php

namespace Kiranti\Supports\Concerns;

/**
 * Trait HasVisitors
 * @package Kiranti\Supports\Concerns
 */
trait HasVisitors
{

    public function isVisiting()
    {
        $this->{static::setVisitorCounterColumn()} = $this->{static::setVisitorCounterColumn()} ?? 0;
        $this->{static::setVisitorCounterColumn()} += 1;
        $this->save();
    }

    /**
     * Set the visitor's counts column name
     *
     * @return string
     */
    abstract public static function setVisitorCounterColumn() : string;

}
