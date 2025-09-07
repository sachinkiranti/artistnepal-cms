<?php

namespace Foundation\Composers;

use Foundation\Builders\Cache\Meta;
use Foundation\Lib\Nav;
use Foundation\Lib\Cache;
use Illuminate\View\View;
use Foundation\Services\SettingService;

/**
 * Class TeamViewComposer
 * @package Foundation\Composers
 */
final  class TeamViewComposer
{

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * PrimaryMenuViewComposer constructor.
     * @param SettingService $settingService
     */
    public function __construct( SettingService $settingService )
    {
        $this->settingService = $settingService;
    }

    /**
     * @param View $view
     * @throws \Exception
     */
    public function compose(View $view)
    {
        $view->with('teams', collect(json_decode(Meta::get('teams'), 1)));
    }

}
