<?php

namespace Foundation\Models;

use Foundation\Builders\Scopes\LanguageScope;
use Kiranti\Supports\BaseModel as Model;

/**
 * Class Nav
 * @package Foundation\Models
 */
final class Nav extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'section', 'nav_li_type', 'label', 'value', 'sort', 'class', 'target', 'icon', 'lang'
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

}
