<?php

namespace Kiranti\Supports\Theme;

use Throwable;
use Kiranti\Lib\Kiranti;
use Exception as ThemeException;
use Kiranti\Supports\Theme\Engines\ThemeScanner;

/**
 * Class Theme
 * @package Kiranti\Supports\Theme
 */
final class Theme
{

    /**
     * @var ThemeScanner
     */
    private $scanner;

    /**
     * Theme constructor.
     * @param ThemeScanner $themeScanner
     */
    public function __construct( ThemeScanner $themeScanner )
    {
        $this->scanner = $themeScanner;
    }

    /**
     * @param string $theme
     * @throws Throwable
     */
    public function init(string $theme)
    {
        if (! in_array($theme, $this->scanner->getAvailableThemes()))
            throw new ThemeException(sprintf('Given theme (%s) is not found.', $theme));

        \View::addLocation(theme_path() . DIRECTORY_SEPARATOR . $theme);
        \View::addLocation(theme_path() . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . '/views');
//        \Lang::addNamespace(theme_path() . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . '/lang', $theme);
    }

    /**
     * @return mixed
     */
    public static function active()
    {
        try {
            return strtolower(app('db')
                    ->table('settings')
                    ->where('key', Kiranti::THEME_KEY)
                    ->value('value') ?? 'default');
        } catch (\Illuminate\Database\QueryException $exception) {
            return 'default';
        }
    }

    /**
     * @param string $path
     * @return string
     */
    public static function asset(string $path = '/')
    {
        return asset(config('theme.asset_public_path',  'dist/themes').DIRECTORY_SEPARATOR.static::active().DIRECTORY_SEPARATOR.$path);
    }

    /**
     * @param $theme
     * @return array
     * @throws Throwable
     */
    public function all($theme = null)
    {
        return $this->scanner->getAvailableThemes($theme ?? $this->scanner::THEME_KEY);
    }

}
