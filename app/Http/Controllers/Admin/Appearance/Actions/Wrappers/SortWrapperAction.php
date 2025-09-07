<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Wrappers;

use Exception;
use Foundation\Lib\Cache;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Illuminate\Http\RedirectResponse;
use Foundation\Services\SettingService;

/**
 * Class SortWrapperAction
 * @package App\Http\Controllers\Admin\Appearance\Actions\Wrappers
 */
final class SortWrapperAction extends BaseController
{

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * SortWrapperAction constructor.
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService )
    {
        $this->settingService = $settingService;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        $this->settingService->updateComponentWrappers((array) $request->get('wrappers'));

        if ($advertisements = $request->get('advertisement')) {
            $this->settingService->addOrUpdateWrapperAdvertisement($advertisements);
        }

        Cache::clear();

        flash('success', 'Record successfully updated.');

        return back();
    }

}
