<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel as Model;

/**
 * Class EmailPattern
 * @package Foundation\Models
 */
class EmailPattern extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'status'
    ];

    /**
     * The templates that a pattern belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function emailTemplates()
    {
        return $this->belongsToMany(EmailTemplate::class);
    }

}
