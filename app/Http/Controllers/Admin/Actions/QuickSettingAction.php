<?php

namespace App\Http\Controllers\Admin\Actions;

use Foundation\Lib\Cache;
use Foundation\Models\Setting;
use Foundation\Lib\QuickSetting;
use Illuminate\Http\RedirectResponse;

/**
 * Class QuickSettingAction
 * @package App\Http\Controllers\Admin\Actions
 */
final class QuickSettingAction
{

    /**
     * @param string $pattern
     * @param null $value
     * @return RedirectResponse
     */
    public function __invoke(string $pattern, $value = null)
    {
        $message = null;

        switch ($pattern) {
            case QuickSetting::PATTERN_CLEAR_CACHE:

                Cache::clear();
                $message = 'The cache is cleared successfully!';
                break;

            case QuickSetting::PATTERN_CLEAR_LOG:

                static::clearLog();
                $message = 'The log is cleared successfully!';
                break;

            case QuickSetting::PATTERN_CLEAR_VIEW:

                \Artisan::call('view:clear');
                $message = 'The view is cleared successfully!';
                break;

            case QuickSetting::PATTERN_DISABLE_FACEBOOK_COMMENT:

                static::updateMeta('disable_facebook_comment_globally', 1);
                $message = 'Facebook comment is disabled globally!';
                break;

            case QuickSetting::PATTERN_ENABLE_FACEBOOK_COMMENT:

                static::updateMeta('disable_facebook_comment_globally', 0);
                $message = 'Facebook comment is disabled globally!';
                break;

            case QuickSetting::PATTERN_DISABLE_DISQUS_COMMENT:

                static::updateMeta('disable_disqus_comment_globally', 1);
                $message = 'Disqus comment is disabled globally!';
                break;

            case QuickSetting::PATTERN_ENABLE_DISQUS_COMMENT:

                static::updateMeta('disable_disqus_comment_globally', 0);
                $message = 'Disqus comment is enabled globally!';
                break;

            case QuickSetting::PATTERN_DISABLE_SITE_COMMENT:

                static::updateMeta('disable_site_comment_globally', 1);
                $message = 'Site comment is disabled globally!';
                break;

            case QuickSetting::PATTERN_ENABLE_SITE_COMMENT:

                static::updateMeta('disable_site_comment_globally', 0);
                $message = 'Site comment is enabled globally!';
                break;

            case QuickSetting::PATTERN_DISABLE_REACTION:

                static::updateMeta('disable_site_reaction_globally', 1);
                $message = 'Site reaction is disabled globally!';
                break;

            case QuickSetting::PATTERN_ENABLE_REACTION:

                static::updateMeta('disable_site_reaction_globally', 0);
                $message = 'Site reaction is enabled globally!';
                break;

            case QuickSetting::PATTERN_DISABLE_SHARE:

                static::updateMeta('disable_site_share_globally', 1);
                $message = 'Site share is disabled globally!';
                break;

            case QuickSetting::PATTERN_ENABLE_SHARE:

                static::updateMeta('disable_site_share_globally', 0);
                $message = 'Site share is enabled globally!';
                break;

            default:
                flash('error', 'The quick settings operation is unsuccessful.');
                return back()->with(QuickSetting::QUICK_SETTING, 'yes');
        }

        flash('success', $message);
        return back()->with(QuickSetting::QUICK_SETTING, 'yes');
    }

    public static function clearLog()
    {
        if (function_exists('exec')) {
            exec('echo "" > ' . storage_path('logs/laravel.log'));
            exec('truncate -s 0 storage/logs/*.log', $output, $result);
        }
    }

    public static function updateMeta($key, $value)
    {
        Setting::query()->updateOrCreate([ 'key' => $key ], [ 'value' => $value, ]);
        Cache::forget('settings-'.$key);
    }

}
