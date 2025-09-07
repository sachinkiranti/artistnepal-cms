<?php

namespace Foundation\Models;

use Foundation\Builders\Scopes\LanguageScope;
use Kiranti\Supports\BaseModel as Model;

/**
 * Class Gallery
 * @package Foundation\Models
 */
final class Gallery extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'unique_identifier', 'slug', 'thumbnail', 'content', 'status', 'created_by',
    ];

}
