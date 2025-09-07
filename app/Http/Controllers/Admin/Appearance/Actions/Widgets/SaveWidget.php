<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Exception;
use Foundation\Lib\Cache;
use Kiranti\Lib\Kiranti;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;

/**
 * Class SaveWidget
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class SaveWidget extends BaseController
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
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        if ($this->widgetService->insert($request->except('_token'))) {
            Cache::forget('settings-'.config('widgets.prefixes.component').$request->get('component'));

            $widget = (object) $this->widgetService->find($request->get('widget_id'), $request->get('component'));
            $key    = $widget->widget_id;
            return $this->responseOk(
                $this->factory->make(Kiranti::WIDGET_BACKEND_PATH.'partials.widget-list', compact('widget', 'key'))->render()
            );
        }
    }

}
