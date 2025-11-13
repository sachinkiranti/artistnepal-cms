<?php

namespace Foundation\Builders\Cache;

use Foundation\Lib\Cache;
use Foundation\Models\Setting;
use Illuminate\Support\Str;

/**
 * Class Meta
 * @package Foundation\Builders\Cache
 */
final class Meta
{

    public static function args($key)
    {
        $first = null;
        if (Str::contains($key, '.')) {
            $args = explode('.', $key);
            $first = head($args);
        }

        $arrs = is_json(static::get($first)) ? json_decode(static::get($first), 1) : static::get($first);
        return \Arr::get($arrs, str_replace($first.'.', '', $key));
    }

    public static function toArray($key)
    {
        return collect(is_json(static::get($key)) ? json_decode(static::get($key), 1) : []);
    }

    public static function get($key)
    {
        return \Cache::remember('settings-'. $key, Cache::TIME_INTERVAL, function () use ($key) {
            return app('db')
                ->table('settings')
                ->where('key', $key)
                ->value('value');
        });
    }

    public static function first($key)
    {
        return \Cache::remember('settings-'. $key, Cache::TIME_INTERVAL, function () use ($key) {
            return Setting::query()
                ->where('key', $key)
                ->first();
        });
    }

}
