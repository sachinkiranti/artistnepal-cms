<?php

namespace Foundation\Lib;

/**
 * Class Utility
 * @package Foundation\Lib
 */
final class Utility
{

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    public static function randomNumber($min = 1000000000, $max = 9999999999)
    {
        return (string) hexdec(uniqid());
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

}
