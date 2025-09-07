<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Foundation\Lib\Cache;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;

/**
 * Class DeleteWidget
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class DeleteWidget extends BaseController
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * RenderWidget constructor.
     * @param WidgetService $widgetService
     */
    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->has('widget_id', 'component_name') &&
            array_filter($request->only('widget_id', 'component_name'))) {

            $this->widgetService->delete($request->get('widget_id'), $request->get('component_name'));
            Cache::clear();
            return $this->responseOk(
                'Successfully deleted !'
            );
        }
    }

}
