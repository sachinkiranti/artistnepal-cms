<?php


namespace Foundation\Lib;

use Kiranti\Supports\BaseConstant;

/**
 * Class PostType
 * @package App\Foundation\Lib
 */
final class PostType extends BaseConstant
{

    /**
     * Post Type Post
     */
    const POST_TYPE_POST = 0;

    /**
     * Post Type Page
     */
    const POST_TYPE_PAGE = 1;

    /**
     * @var $current
     */
    public static $current = [
        self::POST_TYPE_POST    => 'post',
        self::POST_TYPE_PAGE    => 'page',
    ];

    const TYPE_DEFAULT_NEWS = 0;
    const TYPE_FLASH_NEWS = 1;
    const TYPE_HOT_NEWS = 2; // AKA BISES NEWS
    const TYPE_MAIN_NEWS = 3; // AKA Pramukh NEWS

    const PATTERN_PRAMUKH_NEWS = 'pramukh-samachar';
    const PATTERN_BISES_NEWS = 'bises-samachar';
    const PATTERN_SAMACHAR_NEWS = 'samachar';

    public static $types = [
        self::TYPE_DEFAULT_NEWS => 'News',
        self::TYPE_FLASH_NEWS => 'Flash News',
        self::TYPE_HOT_NEWS   => 'Bises News',
        self::TYPE_MAIN_NEWS   => 'Pramukh News',
    ];

    const MEDIA_TYPE_IMAGE = 0;
    const MEDIA_TYPE_VIDEO = 1;
    const MEDIA_TYPE_BOTH = 2;
    const MEDIA_TYPE_FB_VIDEO = 3;

    public static $mediaTypes = [
        self::MEDIA_TYPE_IMAGE => 'Image',
        self::MEDIA_TYPE_VIDEO => 'Youtube Video',
        self::MEDIA_TYPE_BOTH  => 'All',
        self::MEDIA_TYPE_FB_VIDEO  => 'Facebook Video Iframe',
    ];

    const WATERMARK_POSITION_TOP_LEFT = 0;
    const WATERMARK_POSITION_TOP = 1;
    const WATERMARK_POSITION_TOP_RIGHT = 2;
    const WATERMARK_POSITION_LEFT = 3;
    const WATERMARK_POSITION_CENTER = 4;
    const WATERMARK_POSITION_RIGHT = 5;
    const WATERMARK_POSITION_BOTTOM_LEFT = 6;
    const WATERMARK_POSITION_BOTTOM = 7;
    const WATERMARK_POSITION_BOTTOM_RIGHT = 8;

    public static $positions = [
        self::WATERMARK_POSITION_TOP_LEFT     => 'Top Left',
        self::WATERMARK_POSITION_TOP          => 'Top',
        self::WATERMARK_POSITION_TOP_RIGHT    => 'Top Right',
        self::WATERMARK_POSITION_LEFT         => 'Left',
        self::WATERMARK_POSITION_CENTER       => 'Center',
        self::WATERMARK_POSITION_RIGHT        => 'Right',
        self::WATERMARK_POSITION_BOTTOM_LEFT  => 'Bottom Left',
        self::WATERMARK_POSITION_BOTTOM       => 'Bottom',
        self::WATERMARK_POSITION_BOTTOM_RIGHT => 'Bottom Right',
    ];

    public static function getFlashNews($returnIndex = false)
    {
        return static::get(static::TYPE_FLASH_NEWS, $returnIndex);
    }

    public static function getMediaTypes()
    {
        return static::$mediaTypes;
    }

}
