<?php

namespace App\Http\Controllers\Frontend;

use Foundation\Lib\PostType;
use Foundation\Services\CategoryService;
use Throwable;
use Illuminate\Http\Request;
use Foundation\Services\PostService;

/**
 * Class LoadMoreDataController
 * @package App\Http\Controllers\Frontend
 */
final class LoadMoreDataController extends BaseController
{

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * LoadMoreDataController constructor.
     *
     * @param PostService $postService
     * @param CategoryService $categoryService
     */
    public function __construct(
        PostService $postService,
        CategoryService $categoryService
    )
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function __invoke(Request $request)
    {
        $data          = [];

        switch ($request->get('_categoryId')) {
            case PostType::PATTERN_BISES_NEWS:
                $data['posts'] = $this->postService->getList(
                    PostType::TYPE_HOT_NEWS,
                    $request->get('limit') ?? 8,
                    $request->get('_offset')

                );
                break;
            case PostType::PATTERN_PRAMUKH_NEWS:
                $data['posts'] = $this->postService->getList(
                    PostType::TYPE_MAIN_NEWS,
                    $request->get('limit') ?? 8,
                    $request->get('_offset')
                );
                break;
            default:
                $category  = $this->categoryService->bySlug($request->get('_categoryId'));
                $data['posts'] = $this->postService->getArchiveByCategory(
                    $category->id,
                    $request->get('limit') ?? 5,
                    $request->get('_offset')
                );
        }

        $data['count'] = $data['posts']->count();
        return $this->responseOk(
            [
                'render' => view('pages.shared.archive.posts', compact('data'))->render(),
                'count'  => $data['count'],
            ]
        );
    }

}
