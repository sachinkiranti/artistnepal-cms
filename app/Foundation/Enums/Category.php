<?php

namespace Foundation\Enums;

enum Category: int
{

    case GENERAL = 0;
    case ARTIST = 1;


    public static function dropdown(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => ucwords(strtolower($case->name))])
            ->toArray();
    }

}
