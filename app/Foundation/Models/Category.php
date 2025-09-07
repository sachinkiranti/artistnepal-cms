<?php

namespace Foundation\Models;

use Foundation\Builders\Scopes\LanguageScope;
use Kiranti\Supports\Cache\Cacheable;
use Kiranti\Supports\BaseModel as Model;

/**
 * Class Category
 * @package Foundation\Models
 */
class Category extends Model
{

    use Cacheable;

    protected $cacheKey = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_identifier', 'parent_id','category_name', 'created_by', 'slug', 'description', 'status', 'lang',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

}
