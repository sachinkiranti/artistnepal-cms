<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Foundation\Lib\Cache;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;

/**
 * Class UpdatePriority
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class UpdatePriority extends BaseController
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

    public function __invoke(Request $request)
    {
        if ($request->has('component_name', 'priorities') && array_filter($request->only('component_name', 'priorities'))) {
            foreach ($request->get('priorities') as $widgetId => $priority) :

                $this->widgetService->update($widgetId, $request->get('component_name'), [
                    'priority' => $priority,
                ]);

            endforeach;
            Cache::clear();
            return $this->responseOk(
                'Successfully priority updated !'
            );
        }
    }

}
