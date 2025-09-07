<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Foundation\Services\PostService;
use Foundation\Services\UserService;
use Foundation\Services\CategoryService;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
final class DashboardController extends Controller
{
    /**
     * @var $postService
     */
    public $postService;

    /**
     * @var UserService
     */
    public $userService;

    /**
     * @var CategoryService
     */
    public $categoryService;

    /**
     * DashboardController constructor.
     * @param PostService $postService
     * @param UserService $userService
     * @param CategoryService $categoryService
     */
    public function __construct(
        PostService $postService,
        UserService $userService,
        CategoryService $categoryService
    )
    {
        $this->postService = $postService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }

    public function __invoke()
    {
        $data = [];

        $data['superAdmin'] = $this->userService->getCountByUserType('super-admin');
        $data['admin'] = $this->userService->getCountByUserType('admin');
        $data['user'] = $this->userService->query()->count();
        $data['post'] = $this->postService->getCount();
        $data['category'] = $this->categoryService->query()->count();

        return view('admin.dashboard', compact('data'));
    }

}
