<?php

namespace Foundation\Enums;

enum MediaType: int
{

    case IMAGE = 0;
    case VIDEO = 1;


    public static function dropdown(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => ucwords(strtolower($case->name))])
            ->toArray();
    }

}
