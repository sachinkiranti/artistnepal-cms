<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Foundation\Services\CategoryService;
use Foundation\Services\WidgetService;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Kiranti\Lib\Kiranti;
use Kiranti\Supports\BaseController;

/**
 * Class RenderEntityItems
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class RenderEntityItems extends BaseController
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
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->has('identifier')) {
            $identifier = $request->get('identifier');

            $entitySubRules = config('widgets.data.entity_items.'.strtolower($identifier));

            if (count($entitySubRules) > 0) {

                return $this->responseOk(
                    $this->factory->make(Kiranti::WIDGET_BACKEND_PATH.'partials.sub-entity-items', compact(
                        'entitySubRules' ))
                        ->render()
                );
            }
        }
    }
}
