<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use Foundation\Lib\Reaction;
use Illuminate\Http\Request;
use Foundation\Handlers\Widget;
use Kiranti\Events\ViewsHandler;
use Foundation\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;
use Foundation\Services\CategoryService;
use Foundation\Services\ReactionService;

/**
 * Class SingleController
 *
 * @package App\Http\Controllers\Frontend
 */
final class SingleController extends BaseController
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var ReactionService
     */
    private $reactionService;

    /**
     * SingleController constructor.
     *
     * @param WidgetService $widgetService
     * @param PostService $postService
     * @param CategoryService $categoryService
     * @param ReactionService $reactionService
     */
    public function __construct (
        WidgetService $widgetService,
        PostService $postService,
        CategoryService $categoryService,
        ReactionService $reactionService
    )
    {
        $this->widgetService   = $widgetService;
        $this->postService     = $postService;
        $this->categoryService = $categoryService;
        $this->reactionService = $reactionService;
    }

    /**
     * @param string $slug
     * @param Request $request
     * @return Factory|View
     */
    public function __invoke(string $slug, Request $request)
    {
        $data = [];
        $post = $this->postService->byIdentifier($slug);
        $data['post']             = $post;
        $data['pictures']           = $this->postService->getPictures($data['post']->id);
        $data['related-posts']    = $this->postService->getRelatedById($post->id);
        $data['reactions']        = Reaction::all();
        $data['reaction-summary'] = $this->reactionService->summary($post);
        $components               = (new Widget($this->widgetService))->handler('single');

        app(ViewsHandler::class)->handle($post);
        return view('pages.single', compact('data', 'components'));
    }

}
