<?php

namespace Foundation\Lib;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Utility
 * @package Foundation\Lib
 */
final class Utility
{

    /**
     * @param int $min
     * @param int $max
     * @return \Ramsey\Uuid\UuidInterface
     */
    public static function randomNumber($min = 1000000000, $max = 9999999999)
    {
        return Str::uuid();
    }

    public static function isJson($rawJson)
    {
        $jsonArray = json_decode( $rawJson );
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function parseYoutubeID($url)
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        return $matches[1] ?? '';
    }

    public static function parseFacebookUrl($iframe)
    {
        preg_match('/src="([^"]+)"/', $iframe, $match);
        return $match[1] ?? '';
    }

    public static function generateUniqueSlug(Model $model, string $value, string $column = 'slug'): string
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;

        $latestSlug = $model->newQuery()
            ->where($column, 'LIKE', "{$originalSlug}%")
            ->orderByDesc($column)
            ->value($column);

        if (!$latestSlug) {
            return $slug;
        }

        if ($latestSlug === $originalSlug) {
            return "{$originalSlug}-1";
        }

        $pieces = explode('-', $latestSlug);
        $number = intval(end($pieces));

        $nextNumber = $number > 0 ? ($number + 1) : 1;

        return "{$originalSlug}-{$nextNumber}";
    }

    public static function detectSocialPlatform(string $url): string
    {
        $platforms = [
            'facebook'     => 'facebook.com',
            'instagram'    => 'instagram.com',
            'twitter'      => ['twitter.com', 'x.com'],
            'youtube'      => ['youtube.com', 'youtu.be'],
            'tiktok'       => 'tiktok.com',
            'linked_in'    => 'linkedin.com',
            'sound_cloud'  => 'soundcloud.com',
            'spotify'      => 'spotify.com',
            'personal_website' => null, // fallback
        ];

        $url = strtolower(trim($url));

        foreach ($platforms as $key => $patterns) {
            $patterns = (array) $patterns;
            foreach ($patterns as $pattern) {
                if ($pattern && str_contains($url, $pattern)) {
                    return $key;
                }
            }
        }

        return 'personal_website';
    }

}
