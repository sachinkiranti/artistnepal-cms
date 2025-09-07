<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Kiranti\Lib\Kiranti;
use Foundation\Lib\Cache;
use Illuminate\View\Factory;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;

/**
 * Class UpdateWidget
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class UpdateWidget extends BaseController
{

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * RenderWidget constructor.
     * @param Factory $factory
     * @param WidgetService $widgetService
     */
    public function __construct(
        Factory $factory,
        WidgetService $widgetService
    )
    {
        $this->widgetService = $widgetService;
        $this->factory       = $factory;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        if ($this->widgetService->insert($request->except('_token'))) {
            $widget = (object) $this->widgetService->find($request->get('widget_id'), $request->get('component'));
            $key    = $widget->widget_id;

            Cache::clear();
            return $this->responseOk(
                $this->factory->make(Kiranti::WIDGET_BACKEND_PATH.'partials.widget-list', compact('widget', 'key'))->render()
            );
        }
    }

}
