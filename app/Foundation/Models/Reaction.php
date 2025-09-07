<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel;

/**
 * Class Reaction
 * @package Foundation\Models
 */
class Reaction extends BaseModel
{

    protected $guarded = [];

    /**
     * Get all of the owning reactable models.
     */
    public function reactable()
    {
        return $this->morphTo();
    }

}
