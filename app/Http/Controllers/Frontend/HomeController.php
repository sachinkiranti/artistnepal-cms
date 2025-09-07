<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\SettingService;

final class HomeController extends BaseController
{

    public function __construct( private readonly SettingService $settingService ) {}

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
        return view('pages.index', compact('data'));
    }

}
