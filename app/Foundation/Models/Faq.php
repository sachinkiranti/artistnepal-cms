<?php

namespace Foundation\Models;

use Foundation\Builders\Scopes\LanguageScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kiranti\Supports\BaseModel as Model;

/**
 * Class Faq
 * @package Foundation\Models
 */
class Faq extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'faq_name', 'slug', 'body', 'status', 'lang',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\FaqFactory::new();
    }

}
