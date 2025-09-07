<?php

namespace Foundation\Lib;

use Kiranti\Supports\BaseConstant;
use App\Foundation\Enums\Role as RoleEnums;

/**
 * Class Role
 * @package App\Foundation\Lib
 */
final class Role extends BaseConstant
{


    /**
     * Role SuperAdmin
     */
    const ROLE_SUPER_ADMIN = 1;

    /**
     * Role Admin
     */
    const ROLE_ADMIN = 2;

    /**
     * Role Author
     */
    const ROLE_AUTHOR = 3;

    /**
     * Role Artist
     */
    const ROLE_ARTIST = 4;

    /**
     * Role Subscriber
     */
    const ROLE_SUBSCRIBER = 5;

    /**
     * @var array $current
     */
    public static array $current = [
      self::ROLE_SUPER_ADMIN => RoleEnums::ROLE_SUPER_ADMIN->value,
      self::ROLE_ADMIN  => RoleEnums::ROLE_ADMIN->value,
      self::ROLE_AUTHOR => RoleEnums::ROLE_AUTHOR->value,
      self::ROLE_ARTIST => RoleEnums::ROLE_ARTIST->value,
      self::ROLE_SUBSCRIBER => RoleEnums::ROLE_SUBSCRIBER->value,
    ];

}
