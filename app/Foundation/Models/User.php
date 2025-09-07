<?php

namespace Foundation\Models;

use Kiranti\Supports\Cache\Cacheable;
use Kiranti\Supports\Concerns\HasImage;
use Kiranti\Supports\Concerns\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package Foundation\Models
 */
class User extends Authenticatable
{

    use HasUuids, HasRoles, Notifiable, SoftDeletes, Cacheable, HasImage;

    protected $cacheKey = 'users';

    const DEFAULT_ROLE = 'admin';

    CONST USER_TYPE_SUPER = 0;
    const USER_TYPE_AUTHOR = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'unique_identifier', 'email', 'password', 'first_name', 'middle_name', 'last_name', 'status', 'last_login', 'image', 'information',
    ];

    protected $casts = [
        'last_login' => 'datetime',
    ];

    public function uniqueIds(): array
    {
        return [ 'unique_identifier', ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function getImage()
    {
        if (file_exists(public_path('storage/images/'.static::getFolderName().'/'. ($this->image ?? 'N/A')))) {
            return asset('storage/images/'.static::getFolderName().'/'.$this->image);
        }
        return asset('images/admin/default.jpg');
    }

    public function hasAccess()
    {
        return static::hasRole(static::DEFAULT_ROLE);
    }

    public static function setFolderName(): string
    {
        return 'users';
    }

}
