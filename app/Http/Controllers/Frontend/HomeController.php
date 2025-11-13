<?php

namespace App\Http\Controllers\Frontend;

use App\Foundation\Enums\Role;
use Foundation\Enums\Category;
use Foundation\Lib\PostType;
use Foundation\Services\CategoryService;
use Foundation\Services\PostService;
use Illuminate\View\View;
use Foundation\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\SettingService;
use Kiranti\Config\Status;

final class HomeController extends BaseController
{

    public function __construct(
        private readonly SettingService $settingService,
        private readonly UserService $userService,
        private readonly CategoryService $categoryService,
        private readonly PostService $postService
    ) {}

    /**
     * Show the home page of the website
     *
     * @return Factory|View
     * @throws \Exception
     * @throws \Throwable
     */
    public function __invoke()
    {
        $data = [];

        $data['featured-artists'] = $this->userService->getUsersHavingRole(Role::ROLE_ARTIST->value, 10);
        $data['categories'] = $this->categoryService->query()
            ->where('type', Category::ARTIST)
            ->limit(12)
            ->get();

        $data['blogs'] = $this->postService->query()
            ->where('post_type', PostType::POST_TYPE_POST)
            ->where('status', Status::ACTIVE_STATUS)
            ->limit(12)
            ->get();

        return view('pages.index', compact('data'));
    }

}
