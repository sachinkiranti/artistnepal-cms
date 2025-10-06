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

    public function getUrl()
    {
        $type = \Foundation\Lib\Nav::only($this->nav_li_type, false, 'types');

        switch ($type) {
            case 'Custom Link':
                $url = $this->value;
                break;

            case 'Page':
                $url = route('page.single', ['slug' => $this->value]);
                break;

            case 'Category':
                $url = route('archive', ['slug' => $this->value]);
                break;

            case 'Post':
                $url = route('post.single', ['slug' => $this->value]);
                break;

            default:
                $url = '#';
                break;
        }

        return $url;
    }

}
