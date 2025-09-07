<?php

namespace Foundation\Builders\Cache;

use Foundation\Lib\Cache;
use Kiranti\Config\Language;

/**
 * Class Nav
 * @package Foundation\Builders\Cache
 */
final class Nav
{

    public static function sectionWise($section)
    {
        return \Cache::remember('nav-'. $section, Cache::TIME_INTERVAL, function () use ($section) {
            return \Foundation\Models\Nav::query()
                ->with('children')
                ->where('section', $section)
                ->where('parent_id', 0)
                ->where('lang', Language::get(active_lang(), true))
                ->orderBy('sort', 'ASC')
                ->get();
        });
    }

}
