<?php

namespace Foundation\Models;

use Foundation\Builders\Scopes\LanguageScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kiranti\Supports\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'post'=>'Foundation\Models\Post'
]);
/**
 * Class Tag
 * @package Foundation\Models
 */
class Tag extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_name', 'slug', 'description', 'status', 'lang',
    ];

    public function posts()
    {
        return  $this->morphedByMany(Post::class,'taggable');
    }

    protected static function newFactory()
    {
        return \Database\Factories\TagFactory::new();
    }

}
