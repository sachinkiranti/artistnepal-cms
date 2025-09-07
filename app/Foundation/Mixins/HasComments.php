<?php

namespace Foundation\Mixins;

use Foundation\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasComments
 * @package Foundation\Mixins
 */
trait HasComments
{

    /**
     * The comments attached to the model.
     *
     * @return MorphMany
     */
    public function comments() : MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

}
