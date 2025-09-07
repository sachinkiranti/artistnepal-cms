<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use Illuminate\View\View;
use Foundation\Handlers\Widget;
use Foundation\Services\PostService;
use Foundation\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;
use Foundation\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class AuthorController
 * @package App\Http\Controllers\Frontend
 */
final class AuthorController extends BaseController
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
     * @var UserService
     */
    private $userService;

    /**
     * PageController constructor.
     *
     * @param WidgetService $widgetService
     * @param PostService $postService
     * @param CategoryService $categoryService
     * @param UserService $userService
     */
    public function __construct (
        WidgetService $widgetService,
        PostService $postService,
        CategoryService $categoryService,
        UserService $userService
    )
    {
        $this->widgetService   = $widgetService;
        $this->postService     = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    /**
     * @param string $author
     * @return Application|Factory|View
     * @throws Throwable
     */
    public function __invoke(string $author)
    {
        $data['author'] = $this->userService->byIdentifier($author);
        $components   = (new Widget($this->widgetService))->handler('single');
        return view('pages.author', compact('data', 'components'));
    }

}
