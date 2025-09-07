<?php

namespace Kiranti\Config;

use Kiranti\Supports\BaseConstant;

/**
 * Class Translation
 * @package Kiranti\Config
 */
final class Language extends BaseConstant
{
    const LANG_KEY = 'default-lang';

    const DEFAULT_LANGUAGE = 0;

    const NEPALI = 0;
    const ENGLISH = 1;

    /**
     * @var $current
     */
    public static $current = [
        self::NEPALI   => 'np',
        self::ENGLISH  => 'en',
    ];

    public static function getLanguageIndex(string $lang)
    {
        return array_search($lang, static::$current);
    }

}
