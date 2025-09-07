<?php

namespace Importer;

use Foundation\Models\Post;
use Illuminate\Support\Str;
use Foundation\Lib\PostType;
use Illuminate\Support\Facades\DB;

/**
 * Class PostImporter
 * @package Importer
 */
final class PostImporter extends BaseImporter
{

    /**
     * PostImporter constructor.
     */
    public function __construct()
    {
        parent::__construct('news_202008251859.csv', new Post());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertData(array $data)
    {
        if (is_null($this->model->where('unique_identifier', $data[0] ?? '')->first())) :

            try {
                $content = $this->resolveDescription($data[10], (empty($data[11]) || $data[11] == 'NULL'));
                app('db')->table('posts')
                    ->insert([
                    'unique_identifier' => $data[0],
                    'created_by'=> 1,
                    'disable_facebook_comment' => 0,
                    'disable_site_comment' => 0,
                    'disable_reaction' => 0,
                    'category_id'=> $data[1],
                    'image' => (empty($data[11]) || $data[11] == 'NULL') ? null : $data[11],
                    'post_type' => 0,
                    'title'                      => $data[7],
                    'secondary_title'             => $data[8] == 'NULL' ? null : $data[8],
//                    'slug'             => $data[0],
                    'content'                => $content == 'NULL' ? null : $content,
                    'published_date'             => (empty($data[26]) || $data[26] == 'NULL') ? null : $data[26],

                    'seo_title' => (empty($data[28]) || $data[28] == 'NULL') ? null : $data[28],
                    'seo_slug' => (empty($data[28]) || $data[28] == 'NULL') ? null : $data[28],
                    'seo_desc' => (empty($data[30]) || $data[30] == 'NULL') ? null : $data[30],
                    'seo_keywords'  =>(empty($data[29]) || $data[29] == 'NULL') ? null : $data[29],
                    'type' => static::resolveType($data[4], $data[5], $data[6]),

                    'created_at'         =>  (empty($data[26]) || $data[26] == 'NULL') ? null : $data[26],
                    'media_display_type' => (isset($data[14]) && $data[14] == 'photo') ? PostType::MEDIA_TYPE_IMAGE : PostType::MEDIA_TYPE_VIDEO,
                     'author' => (empty($data[17]) || $data[17] == 'NULL') ? null : $data[17],
                     'video_url' => (empty($data[35]) || $data[35] == 'NULL') ? null : $data[35],
                     'views'     => (empty($data[20]) || $data[20] == 'NULL') ? null : $data[20],
                ]);
            } catch (\Exception $exception) {
//                continue;
//                dd($exception->getMessage(), $data);
            }

        endif;
    }

    /**
     * @param string $description
     * @param $image_name
     * @return string
     */
    protected function resolveDescription(string $description, $image_name) {

        return $description;
        $base_url = env('IMAGE_LOCATION', 'http://dev.himalayakhabar.com/');

        if (preg_match('/<img/', $description)) {
            $document = new \DOMDocument();
            @$document->loadHTML(mb_convert_encoding($description , 'HTML-ENTITIES', 'UTF-8'));
            $img_tags = $document->getElementsByTagName('img');
            foreach ($img_tags as $tag)
            {
                $settedSrc = explode('/', $tag->getAttribute('src'));
                $imgLast = last($settedSrc);
                $tag->setAttribute('src', "<img src=\"{$base_url}/images/news/{$imgLast}\">");
            }
            $description = $document->saveHTML();

        }

        $image = '';

        if (! empty($image_name)) {
            $image = "<img src=\"{$base_url}/images/news/{$image_name}\">";
        }

        return $image .$description;
    }

    public static function resolveType($flashNews, $bisesNews, $pramukhNews)
    {
        if ($flashNews === 'Y') {
            return PostType::TYPE_FLASH_NEWS;
        }  elseif ($bisesNews == '1') {
            return PostType::TYPE_HOT_NEWS;
        } elseif ($pramukhNews == 'Y') {
            return PostType::TYPE_MAIN_NEWS;
        } else  {
            return PostType::TYPE_DEFAULT_NEWS;
        }
    }

}
