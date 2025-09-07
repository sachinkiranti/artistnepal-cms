<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Throwable;
use Kiranti\Lib\Kiranti;
use Illuminate\Support\Arr;
use Kiranti\Lib\FileHandler;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Http\JsonResponse;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;

/**
 * Class WidgetPreviewAction
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class WidgetPreviewAction extends BaseController
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
        $this->factory = $factory;
        $this->widgetService = $widgetService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(Request $request)
    {
        if ( $request->has('widget_name') ) :
            $data = [];

            $widgetName = $request->get('widget_name');

            $fileSystem = new FileHandler();

            $collection = json_decode($fileSystem->content(
                theme_path(strtolower(active_theme()).'/widget.json')
            ), 1);

            $data['image_url']   = Arr::only($collection, 'preview')[$widgetName] ?? '';
            $data['widget_name'] = $widgetName;

            return $this->responseOk(
                $this->factory->make(Kiranti::WIDGET_BACKEND_PATH.'partials.sub-entity-items', compact(
                    'data' ))
                    ->render()
            );
        endif;
    }

}
