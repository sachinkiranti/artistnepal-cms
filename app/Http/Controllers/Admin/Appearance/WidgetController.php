<?php

namespace App\Http\Controllers\Admin\Appearance;

use Foundation\Lib\Cache;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;
use Illuminate\Contracts\View\Factory;

/**
 * Class WidgetController
 * @package App\Http\Controllers\Admin\Appearance
 */
final class WidgetController extends BaseController
{

    private $widgetService;

    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    /**
     * @param string $component
     * @return Factory|View
     * @throws \Exception
     */
    public function __invoke(string $component)
    {
        $data = [];

        $data['component'] = $component;
        $data['widgets']   = $this->widgetService->getByWidgetType(
            Arr::get($this->widgetService->findComponentByName($component), 'type')
        );
        $data['component-widgets'] = $this->widgetService->getWidgetsByComponent($component);
        return view('admin.appearance.customizer.edit', compact('data'));
    }

}
