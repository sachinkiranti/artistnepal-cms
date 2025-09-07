<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Foundation\Handlers\Widget;
use Foundation\Services\PostService;
use Foundation\Services\WidgetService;
use Foundation\Services\CategoryService;

/**
 * Class PageController
 *
 * @package App\Http\Controllers\Frontend
 */
final class PageController extends BaseController
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
     * PageController constructor.
     *
     * @param WidgetService $widgetService
     * @param PostService $postService
     * @param CategoryService $categoryService
     */
    public function __construct (
        WidgetService $widgetService,
        PostService $postService,
        CategoryService $categoryService
    )
    {
        $this->widgetService   = $widgetService;
        $this->postService     = $postService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function __invoke(string $slug, Request $request)
    {
        $data['page'] = $this->postService->byIdentifier($slug)->load('user');
        $components   = (new Widget($this->widgetService))->handler('single');
        return view('pages.page', compact('data', 'components'));
    }

}
