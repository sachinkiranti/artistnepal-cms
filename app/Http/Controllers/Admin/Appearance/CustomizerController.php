<?php

namespace App\Http\Controllers\Admin\Appearance;

use Foundation\Lib\Cache;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;

/**
 * Class CustomizerController
 * @package App\Http\Controllers\Admin\Appearance
 */
class CustomizerController extends BaseController
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * CustomizerController constructor.
     * @param WidgetService $widgetService
     */
    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    /**
     * @return Factory
     * @throws \Exception
     */
    public function __invoke()
    {
        $data['widgets'] = $this->widgetService->get();
        $data['components'] = $this->widgetService->getComponents();
        return view('admin.appearance.customizer.index', compact('data'));
    }

}
