<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Foundation\Requests\Setting\UpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Kiranti\Supports\BaseController;
use Foundation\Services\SettingService;
use Illuminate\Contracts\Cache\Factory as Cache;

/**
 * Class TeamController
 * @package App\Http\Controllers\Admin
 */
final class TeamController extends BaseController
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
     * @throws Exception
     */
    public function edit()
    {
        $data = [];
        $data['teams'] = $this->settingService->getTeams();
        return view('admin.team.edit', compact('data'));
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
        $this->settingService->update($request->except('_token'));
        \Foundation\Lib\Cache::forget('settings-teams');
        flash('success', 'Record successfully updated.');
        return redirect()->route( 'admin.team.edit');
    }

}
