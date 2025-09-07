<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use Foundation\Lib\PostType;
use Illuminate\Http\Request;
use Foundation\Handlers\Widget;
use Foundation\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;
use Foundation\Services\CategoryService;

/**
 * Class ArchiveController
 * @package App\Http\Controllers\Frontend
 */
final class ArchiveController extends BaseController
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
     * ArchiveController constructor.
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
     * Show the archive page of the website
     *
     * @param $slug
     * @param Request $request
     * @return Factory|View
     * @throws \Throwable
     */
    public function __invoke(string $slug, Request $request)
    {
        $data = [];

        switch ($slug) {
            case PostType::PATTERN_BISES_NEWS:
                $data['category_title'] = $slug;
                $data['category']       = 'विशेष';
                $data['posts']          = $this->postService->getList(PostType::TYPE_HOT_NEWS, 15);
                $data['posts_count']    = $this->postService->getTotalNews(PostType::TYPE_HOT_NEWS);
                break;
            case PostType::PATTERN_PRAMUKH_NEWS:
                $data['category_title'] = $slug;
                $data['category']       = 'प्रमुख समाचार';
                $data['posts']          = $this->postService->getList(PostType::TYPE_MAIN_NEWS, 15);
                $data['posts_count']    = $this->postService->getTotalNews(PostType::TYPE_MAIN_NEWS);
                break;
            default:
                $category  = $this->categoryService->bySlug($slug);

                $data['category_title'] = $category->category_name;
                $data['category_id']    = $category->unique_identifier;
                $data['posts']          = $this->postService->getArchiveByCategory($category->id, 15);
                $data['posts_count']    = $category->posts_count;
        }

        $components = (new Widget($this->widgetService))->handler('archive');
        return view('pages.archive', compact('data', 'components'));
    }

}
