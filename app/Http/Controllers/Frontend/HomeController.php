<?php

namespace App\Http\Controllers\Frontend;

use App\Foundation\Enums\Role;
use Illuminate\View\View;
use Foundation\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\SettingService;

final class HomeController extends BaseController
{

    public function __construct(
        private readonly SettingService $settingService,
        private readonly UserService $userService
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

        return view('pages.index', compact('data'));
    }

}
