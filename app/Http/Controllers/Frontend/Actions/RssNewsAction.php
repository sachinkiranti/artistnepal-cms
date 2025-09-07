<?php

namespace App\Http\Controllers\Frontend\Actions;

use Foundation\Builders\Cache\Meta;
use Foundation\Services\PostService;
use Kiranti\Config\Status;

/***
 * Class RssNewsAction
 * @package App\Http\Controllers\Frontend\Actions
 */
final class RssNewsAction
{

    private $postService;

    /**
     * RssNewsAction constructor.
     * @param PostService $postService
     */
    public function __construct( PostService $postService )
    {
        $this->postService = $postService;
    }

    public function __invoke()
    {
        $news = $this->postService
            ->query()
            ->select(
                'posts.*',
                'author.email as author_email',
                'author.unique_identifier as author_identifier',
                'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->latest()
            ->limit(100)
            ->get();

        $news->map(function ($each) {
            if (empty($each->guid)) {
                $each->guid = \Str::uuid();
            }
        });

        return response(view('pages.rss', [
            'news' => $news,
            'title' => Meta::get('company'),
        ]), 200)->header('Content-Type', 'text/xml');
    }

}
