<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Wrappers;

use Exception;
use Illuminate\View\View;
use Kiranti\Supports\BaseController;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\SettingService;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class WrapperAction
 *
 * @package App\Http\Controllers\Admin\Appearance\Actions\Wrappers
 */
final class WrapperAction extends BaseController
{

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * WrapperAction constructor.
     *
     * @param SettingService $settingService
     */
    public function __construct( SettingService $settingService )
    {
        $this->settingService = $settingService;
    }

    /**
     * @return Application|Factory|View
     * @throws Exception
     */
    public function __invoke()
    {
        $data['wrappers'] = $this->settingService->getWrappers();
        $data['advertisements'] = $this->settingService->getWrappersAdvertisements();
        return view('admin.appearance.wrapper.index', compact('data'));
    }

}
