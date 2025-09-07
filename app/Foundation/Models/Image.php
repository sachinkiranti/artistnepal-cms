<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel as Model;

/**
 * Class Image
 * @package Foundation\Models
 */
final class Image extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id', 'title', 'caption', 'image', 'content', 'status', 'priority', 'created_by',
    ];

}
