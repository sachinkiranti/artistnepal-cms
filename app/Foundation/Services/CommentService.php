<?php

namespace Foundation\Services;

use Foundation\Models\Comment;
use Foundation\Models\Post;
use Kiranti\Supports\BaseService;

/**
 * Class CommentService
 * @package Foundation\Services
 */
final class CommentService extends BaseService
{

    /**
     * The Comment instance
     *
     * @var $model
     */
    protected $model;

    /**
     * CommentService constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function forPost(Post $post, array $data)
    {
        $post->comments()->create([
            'signature' => $data['signature'],
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
            'website'   => $data['website'],
            'parent_id' => $data['parent_id'] ?? null,
            'comment'   => $data['comment'] ?? null,
            'status'    => auth()->user()->hasRole(\Foundation\Lib\Role::$current[\Foundation\Lib\Role::ROLE_ADMIN]) ? 1 : 0,
            'approved_at' => auth()->user()->hasRole(\Foundation\Lib\Role::$current[\Foundation\Lib\Role::ROLE_ADMIN]) ? now() : null,
            'approved_by' => auth()->user()->hasRole(\Foundation\Lib\Role::$current[\Foundation\Lib\Role::ROLE_ADMIN]) ? auth()->id() : 0,
        ]);
    }

    public function withCommentable()
    {
        return $this->model->with('commentable')->latest()->paginate(20);
    }

    public function statusByPost(Post $post)
    {
        return $post
            ->comments()
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = '1' then 1 end) as approved")
            ->selectRaw("count(case when status = '0' then 1 end) as pending")
            ->first();
    }

}
