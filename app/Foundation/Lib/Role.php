<?php

namespace Foundation\Lib;

use Kiranti\Supports\BaseConstant;

/**
 * Class Role
 * @package App\Foundation\Lib
 */
final class Role extends BaseConstant
{

    /**
     * Role Admin
     */
    const ROLE_ADMIN = 0;

    /**
     * Role Job Seeker
     */
    const ROLE_AUTHOR = 1;

    /**
     * @var $current
     */
    public static $current = [
//      self::ROLE_SUPER_ADMIN => 'super-admin',
      self::ROLE_ADMIN  => 'admin',
      self::ROLE_AUTHOR => 'author',
    ];

}
