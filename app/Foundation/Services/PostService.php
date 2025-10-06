<?php

namespace Foundation\Services;

use Foundation\Lib\PostType;
use Foundation\Models\Post;
use Foundation\Models\User;
use Illuminate\Support\Arr;
use Kiranti\Config\Language;
use Kiranti\Config\Status;
use Kiranti\Supports\BaseService;

/**
 * Class PostService
 * @package Foundation\Services
 */
class PostService extends BaseService
{

    /**
     * The Post instance
     *
     * @var $model
     */
    protected $model;

    /**
     * PostService constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * Filter
     *
     * @param array|null $data
     * @return mixed
     */
    public function filter()
    {
        return $this->model
            ->select('posts.*', 'categories.category_name')
            ->selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS user_name')
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users', 'users.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::only(active_lang(), true))
            ->latest();
    }

    public function getPostTag()
    {
        return $this->model
            ->with('tags')
            ->get();
    }

    /**
     * Return posts for given category
     *
     * @param $categoryId
     * @param int $limit
     * @return mixed
     */
    public function getByCategory( $categoryId, $limit = 5 )
    {
        return $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('categories.id', $categoryId)
            ->limit($limit)
            ->orderby('posts.id', 'DESC')
            ->get();
    }

    public function getByType($type, $limit)
    {
        return $this->model
            ->select( 'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name' )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.type', $type)
            ->limit($limit)
            ->orderby('posts.id', 'DESC')
            ->get();
    }

    public function getByPostType($postType, $limit)
    {
        return $this->model
            ->select( 'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name' )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.post_type', $postType)
            ->limit($limit)
            ->orderby('posts.id', 'DESC')
            ->get();
    }

    public function getByViews($limit)
    {
        return $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->limit($limit)
            ->orderby('posts.views', 'DESC')
            ->get();
    }

    public function getArchiveByCategory(int $categoryId, int $limit = 5, int $offset = 0)
    {
        return $this->model
            ->select(
                'posts.*',
                'author.email as author_email',
                'author.unique_identifier as author_identifier',
                'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.category_id', $categoryId)
            ->where('posts.status', Status::ACTIVE_STATUS)
//            ->offset($offset)
//            ->limit($limit)
            ->orderby('posts.created_at', 'DESC')
            ->paginate($limit);
    }

    public function byIdentifier(string $identifier)
    {
        return $this->model
            ->select( 'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name' )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->selectRaw("(IFNULL(disable_facebook_comment, 0) + IFNULL(disable_disqus_comment, 0) + IFNULL(disable_site_comment, 0)) AS is_commentable")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->with([
                'user.posts' => function ($query) {
                    return $query->where('status', Status::ACTIVE_STATUS)->latest()->limit(10);
                },
                'comments'
            ])
//            ->where('posts.lang', Language::get(active_lang(), true))
//            ->where('posts.unique_identifier', $identifier)
            ->where(function ($query) use ($identifier) {
                $query->where('posts.unique_identifier', $identifier)
                    ->orWhere('posts.slug', $identifier);
            })
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->firstOrFail();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getRelatedById(string $id)
    {
        $post = $this->model->findOrFail($id);
        return $this->model
            ->select( 'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name' )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.id', '!=', $post->id)
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->where('posts.category_id', $post->category_id)
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
    }

    public function getArchiveByType(int $type, int $limit = 5, int $offset = 0)
    {
        return $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.type', $type)
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->offset($offset)
            ->limit($limit)
            ->orderby('posts.created_at', 'DESC')
            ->get();
    }

    public function getCountByType(int $type, int $limit = 5, int $offset = 0)
    {
        return $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.type', $type)
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->count();
    }

    public function getList(int $type, int $limit = 5, int $offset = 0)
    {
        $query = $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.post_type', PostType::POST_TYPE_POST);

        if ($type === PostType::TYPE_HOT_NEWS) {
            $query = $query->where('posts.is_bises_news', Status::ACTIVE_STATUS);
        }

        if ($type === PostType::TYPE_MAIN_NEWS) {
            $query = $query->where('posts.is_pramukh_news', Status::ACTIVE_STATUS);
        }

        $query = $query
//            ->offset($offset)
//            ->limit($limit)
            ->where('posts.status', Status::ACTIVE_STATUS)
            ->orderby('posts.created_at', 'DESC')
            ->paginate($limit);

        return $query;
    }

    public function getTotalNews(int $type)
    {
        $query = $this->model
            ->select(
                'posts.*', 'author.email as author_email', 'author.unique_identifier as author_identifier', 'categories.category_name'
            )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.post_type', PostType::POST_TYPE_POST);

        if ($type === PostType::TYPE_HOT_NEWS) {
            $query = $query->where('posts.is_bises_news', Status::ACTIVE_STATUS);
        }

        if ($type === PostType::TYPE_MAIN_NEWS) {
            $query = $query->where('posts.is_pramukh_news', Status::ACTIVE_STATUS);
        }

        return $query->where('posts.status', Status::ACTIVE_STATUS)
            ->count();
    }

    public function getCount()
    {
        return $this->model
            ->query()
            ->select('id')
            ->when(!auth()->user()->hasAccess(), function ($query) {
                $query->where('created_by', auth()->id());
            })
            ->count();
    }

    public function getPictures($postId)
    {
        return app('db')
            ->table('post_images')
            ->where('post_id', $postId)
            ->orderBy('id', 'DESC')
            ->get();
    }

}
