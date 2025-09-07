<?php

namespace Foundation\Mixins;

use Foundation\Models\Reaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasReactions
 * @package Foundation\Mixins
 */
trait HasReactions
{

    /**
     * The reactions attached to the model.
     *
     * @return MorphMany
     */
    public function reactions() : MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

}
