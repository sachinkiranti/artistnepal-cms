<?php

namespace Foundation\Builders\Cache;

use Foundation\Lib\Cache;
use Foundation\Models\Post;
use Foundation\Lib\PostType;
use Kiranti\Config\Language;
use Foundation\Models\Gallery;
use Kiranti\Config\Status;

/**
 * Class CategoryWise
 * @package Foundation\Builders\Cache
 */
final class CategoryWise
{

    public static function gallery($identifier, $limit)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit) {
            return Gallery::query()
                ->orderby('created_at', 'DESC')
                ->where('status', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->get();
        });
    }

    public static function breakingNews($identifier, $limit)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit) {
            return Post::query()
                ->select( 'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name',  'categories.unique_identifier as category_identifier' )
                ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
                ->withCount('comments')
                ->where('posts.lang', Language::get(active_lang(), true))
//                ->where('posts.type', PostType::TYPE_FLASH_NEWS)
                ->where('posts.is_flash_news', Status::ACTIVE_STATUS)
                ->where('posts.post_type', PostType::POST_TYPE_POST)
                ->where('posts.status', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->whereRaw('DATE(IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at)) <= "'.date('Y-m-d H:i:s').'"')
                ->orderByRaw('IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at) DESC')
                ->get();
        });
    }

    public static function trendingNews($identifier, $limit)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit) {
            return Post::query()
                ->select(
                    'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name',  'categories.unique_identifier as category_identifier'
                )
                ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
                ->where('posts.lang', Language::get(active_lang(), true))
                ->where('posts.post_type', PostType::POST_TYPE_POST)
                ->where('posts.status', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->whereRaw('DATE(IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at)) <= "'.date('Y-m-d H:i:s').'"')
                ->orderByRaw('IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at) DESC')
                ->orderby('posts.views', 'DESC')
                ->get();
        });
    }

    public static function categories($identifier, $limit, $categoryId)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit, $categoryId) {
            return Post::query()
                ->select(
                    'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name', 'categories.unique_identifier as category_identifier'
                )
                ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
                ->where('posts.lang', Language::get(active_lang(), true))
                ->where('categories.id', $categoryId)
                ->where('posts.post_type', PostType::POST_TYPE_POST)
                ->where('posts.status', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->orderby('posts.created_at', 'DESC')
                ->get();
        });
    }

    public static function getCategoryIdentifier($categoryId)
    {
        return \Cache::remember('category-identifier-'. $categoryId, Cache::TIME_INTERVAL, function () use ($categoryId) {
            return app('db')
                ->table('categories')
                ->where('id', $categoryId)
                ->value('unique_identifier');
        });
    }

    public static function bisesNews($identifier, $limit)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit) {
            return Post::query()
                ->select(
                    'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name', 'categories.unique_identifier as category_identifier'
                )
                ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
                ->where('posts.lang', Language::get(active_lang(), true))
                ->where('posts.post_type', PostType::POST_TYPE_POST)
//                ->where('posts.type', PostType::TYPE_HOT_NEWS)
                ->where('posts.is_bises_news', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->whereRaw('DATE(IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at)) <= "'.date('Y-m-d H:i:s').'"')
                ->orderByRaw('IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at) DESC')
                ->get();
        });
    }

    public static function pramukhNews($identifier, $limit)
    {
        return \Cache::remember(Cache::WIDGET_CATEGORY_WISE .'-'. $identifier, Cache::TIME_INTERVAL, function () use ($limit) {
            return Post::query()
                ->select(
                    'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name', 'categories.unique_identifier as category_identifier'
                )
                ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
                ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
                ->where('posts.lang', Language::get(active_lang(), true))
                ->where('posts.post_type', PostType::POST_TYPE_POST)
//                ->where('posts.type', PostType::TYPE_MAIN_NEWS)
                ->where('posts.is_pramukh_news', Status::ACTIVE_STATUS)
                ->limit($limit)
                ->whereRaw('DATE(IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at)) <= "'.date('Y-m-d H:i:s').'"')
                ->orderByRaw('IF(posts.published_date IS NOT NULL, posts.published_date, posts.created_at) DESC')
                ->get();
        });
    }

}
