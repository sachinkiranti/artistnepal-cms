<?php

namespace App\Http\Controllers\Admin\Appearance;

use Foundation\Lib\Nav;
use Foundation\Lib\PostType;
use Foundation\Services\NavService;
use Foundation\Services\PostService;
use Kiranti\Supports\BaseController;
use Foundation\Services\CategoryService;

/**
 * Class MenuController
 * @package App\Http\Controllers\Admin\Appearance
 */
class MenuController extends BaseController
{

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var NavService
     */
    private $navService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * MenuController constructor.
     * @param PostService $postService
     * @param NavService $navService
     * @param CategoryService $categoryService
     */
    public function __construct(
        PostService $postService,
        NavService $navService,
        CategoryService $categoryService
    )
    {
        $this->postService = $postService;
        $this->navService  = $navService;
        $this->categoryService = $categoryService;
    }

    public function __invoke()
    {
        $data = [];
        $data['posts']   = $this->postService->getByPostType(PostType::POST_TYPE_POST, 50);
        $data['pages']   = $this->postService->getByPostType(PostType::POST_TYPE_PAGE, 50);
        $data['targets'] = Nav::getTargets();
        $data['categories'] = $this->categoryService->getTree(50);
        $data['menu-sections'] = Nav::getSections();
        return view('admin.appearance.menu.index', compact('data'));
    }

}
