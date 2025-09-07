<?php

namespace App\Foundation\Enums;

enum Role: string
{

    /**
     * Role SuperAdmin
     */
    case ROLE_SUPER_ADMIN = 'super-admin';

    /**
     * Role Admin
     */
    case ROLE_ADMIN = 'admin';

    /**
     * Role Author
     */
    case ROLE_AUTHOR = 'author';

    /**
     * Role Artist
     */
    case ROLE_ARTIST = 'artist';

    /**
     * Role Subscriber
     */
    case ROLE_SUBSCRIBER = 'subscriber';

    public static function getStats(): array
    {
        return [
            self::ROLE_ARTIST->value, self::ROLE_SUBSCRIBER->value,
        ];
    }

}
