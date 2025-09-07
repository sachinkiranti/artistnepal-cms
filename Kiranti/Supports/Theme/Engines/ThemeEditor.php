<?php

namespace Kiranti\Supports\Theme\Engines;

use Kiranti\Lib\FileHandler;

/**
 * Class ThemeEditor
 * @package Kiranti\Supports\Theme\Engines
 */
final class ThemeEditor
{

    /**
     * Update the theme
     *
     * @param string $themePath
     * @param array $themeInfo
     */
    public static function update(string $themePath, array $themeInfo)
    {
        (new FileHandler())->update($themePath, $themeInfo);
    }

}
