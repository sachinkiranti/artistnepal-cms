<?php

namespace Foundation\Models;

use Kiranti\Supports\BaseModel as Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Gallery
 * @package Foundation\Models
 */
final class Gallery extends Model
{

    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'unique_identifier', 'slug', 'thumbnail', 'content', 'status', 'created_by',
    ];

    public function uniqueIds(): array
    {
        return [ 'unique_identifier', ];
    }

}
