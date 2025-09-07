<?php

namespace Foundation\Models;

use Kiranti\Supports\Cache\Cacheable;
use Kiranti\Supports\BaseModel as Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Category
 * @package Foundation\Models
 */
class Category extends Model
{

    use HasUuids, Cacheable;

    protected $cacheKey = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'unique_identifier', 'parent_id','category_name', 'created_by', 'slug', 'description', 'status', 'lang',
    ];

    public function uniqueIds(): array
    {
        return [ 'unique_identifier', ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

}
