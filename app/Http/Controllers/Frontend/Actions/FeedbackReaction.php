<?php

namespace App\Http\Controllers\Frontend\Actions;

use Foundation\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Foundation\Services\CommentService;
use Foundation\Requests\Frontend\CommentStoreRequest;

/**
 * Class FeedbackReaction
 * @package App\Http\Controllers\Frontend\Actions
 */
final class FeedbackReaction
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
     * FeedbackReaction constructor.
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

    /**
     * @param CommentStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(CommentStoreRequest $request)
    {
        $post = $this->postService->query()->where('id', $request->get('post_id'))->firstOrFail();
        $this->commentService->forPost($post, [
            'signature' => $request->get('signature'),
            'full_name' => $request->get('full_name'),
            'email'     => $request->get('email'),
            'website'   => $request->get('website'),
            'comment'   => $request->get('comment'),
        ]);
        flash('success', 'You have successfully commented.');
        return back();
    }

}
