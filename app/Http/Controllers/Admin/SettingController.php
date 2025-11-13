<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Foundation\Models\Setting;
use Kiranti\Supports\BaseController;
use Foundation\Requests\Setting\{
    StoreRequest,
    UpdateRequest
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\SettingService;
use Illuminate\Contracts\Cache\Factory as Cache;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 */
class SettingController extends BaseController
{

    /**
     * The SettingService instance
     *
     * @var $settingService
     */
    private $settingService;

    private $cache;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     * @param Cache $cache
     */
    public function __construct(
        SettingService $settingService,
        Cache $cache
    )
    {
        $this->settingService = $settingService;
        $this->cache          = $cache;
    }


    /**
     * Get the Settings Page with the data in the edit form
     *
     * @return Factory|View
     */
    public function edit()
    {
        $data = [];
        $data['settings'] = $this->settingService->getSettings();
        return view('admin.setting.edit', compact('data'));
    }

    /**
     * Update the website settings
     *
     * @param UpdateRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(UpdateRequest $request)
    {
        $this->settingService->update(
            $request->merge([
            'is_homepage_popup_ads_enabled' => $request->get('is_homepage_popup_ads_enabled') === 'on',
        ])->except('_token'));

        \Foundation\Lib\Cache::clear();

        flash('success', 'Record successfully updated.');
        return redirect()->route( 'admin.setting.edit');
    }
}
