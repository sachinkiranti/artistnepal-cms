<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel as Model;

/**
 * Class EmailTemplate
 * @package Foundation\Models
 */
class EmailTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'body', 'status'
    ];


    /**
     * Email patterns that belong to a template
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function emailPatterns()
    {
        return $this->belongsToMany(EmailPattern::class);
    }

}
