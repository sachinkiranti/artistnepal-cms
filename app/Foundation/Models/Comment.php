<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel;

/**
 * Class Comment
 * @package Foundation\Models
 */
class Comment extends BaseModel
{

    protected $guarded = [];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}
