<?php

namespace Foundation\Lib;

use Foundation\Models\Post;
use Foundation\Models\User;
use Foundation\Models\Setting;
use Foundation\Models\Category;
use Foundation\Builders\Cache\Meta;

/**
 * Class Cache
 * @package Foundation\Lib
 */
final class Cache
{

    /**
     * Array of cacheable models
     */
    const CACHEABLE_MODELS = [
        Setting::class,
        User::class,
        Category::class,
        Post::class,
    ];

    const CACHE_ENABLED = true;

    const TIME_INTERVAL = '86400'; // 22 * 60

    const WIDGET_CATEGORY_WISE = 'category-wise-posts';

    const MENU_PRIMARY_MENU = 'menu-primary-menu';

    /**
     * @param $data
     * @param $appendIdentifier
     * @return mixed
     */
    public static function getCategoryWisePosts($data, $appendIdentifier)
    {
        return static::remember(static::WIDGET_CATEGORY_WISE.'-'.$appendIdentifier, $data);
    }

    public static function getPrimaryMenu($data)
    {
        return static::remember(static::MENU_PRIMARY_MENU, $data);
    }

    /**
     * @param string $key
     * @param $data
     * @param string $time
     * @return mixed
     */
    public static function remember(string $key, $data, string $time = self::TIME_INTERVAL)
    {
        return \Cache::remember($key, $time, function () use ($data) {
            return $data;
        });
    }

    /**
     * @param string $cacheKey
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $cacheKey, string $key)
    {
        return Meta::get($key);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function setting(string $key)
    {
        $setting = static::get('settings', $key);
        return Utility::isJson($setting) ? json_decode( $setting ) : $setting;
    }

    public static function clear()
    {
        return \Cache::clear();
    }

    public static function forget($key)
    {
        return \Cache::forget($key);
    }

}
