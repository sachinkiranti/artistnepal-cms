<?php

namespace App\Http\Controllers\Admin\Actions;

use Foundation\Services\CommentService;
use Foundation\Services\PostService;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;

/**
 * Class CommentAction
 * @package App\Http\Controllers\Admin\Actions
 */
final class CommentAction extends BaseController
{

    /**
     * @var CommentService
     */
    private $commentService;
    /**
     * @var PostService
     */
    private $postService;

    /**
     * CommentAction constructor.
     *
     * @param CommentService $commentService
     * @param PostService $postService
     */
    public function __construct(
        CommentService $commentService,
        PostService $postService
    )
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
    }


    public function __invoke(Request $request)
    {
        $post = $this->postService->byIdentifier($request->get('post-id'));
        $this->commentService->forPost($post, [
            'signature' => $request->get('post-signature'),
            'full_name' => $request->get('full_name'),
            'email'     => $request->get('email'),
            'website'   => $request->get('website'),
            'comment'   => $request->get('comment-box'),
        ]);
        flash('success', 'You have successfully commented.');
        return back();
    }

}
