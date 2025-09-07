<?php

namespace App\Http\Controllers\Frontend\Actions;

use Illuminate\Http\Request;
use Foundation\Services\PostService;
use Foundation\Services\ReactionService;
use App\Http\Controllers\Frontend\BaseController;

/**
 * Class ReactionAction
 * @package App\Http\Controllers\Frontend\Actions
 */
final class ReactionAction extends BaseController
{

    /**
     * @var ReactionService
     */
    private $reactionService;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * ReactionAction constructor.
     *
     * @param ReactionService $reactionService
     * @param PostService $postService
     */
    public function __construct(
        ReactionService $reactionService,
        PostService $postService
    )
    {
        $this->reactionService = $reactionService;
        $this->postService     = $postService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $post = $this->postService->byIdentifier($request->get('post-id'));

        if (! is_null($request->get('post-reaction-type'))) {
            $this->reactionService->forPost($post, [
                'post-id'   => $post->id,
                'type'      => $request->get('post-reaction-type'),
                'signature' => $request->get('post-signature'),
            ]);
        }

        return $this->responseOk([
            'current' => $this->reactionService->bySignature($post, $request->get('post-signature')),
            'summary' => $this->reactionService->summary($post),
        ]);
    }

}
