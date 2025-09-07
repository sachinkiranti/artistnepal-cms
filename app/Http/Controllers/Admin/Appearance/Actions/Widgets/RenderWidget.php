<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Widgets;

use Kiranti\Lib\Kiranti;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Kiranti\Supports\BaseController;
use Foundation\Services\WidgetService;
use Foundation\Services\CategoryService;

/**
 * Class RenderWidget
 * @package App\Http\Controllers\Admin\Appearance\Actions\Widgets
 */
final class RenderWidget extends BaseController
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * RenderWidget constructor.
     * @param Factory $factory
     * @param CategoryService $categoryService
     * @param WidgetService $widgetService
     */
    public function __construct(
        Factory $factory,
        CategoryService $categoryService,
        WidgetService $widgetService
    )
    {
        $this->factory = $factory;
        $this->categoryService = $categoryService;
        $this->widgetService = $widgetService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->has('identifier')) {
            $widgetId   = Str::random(10);
            $identifier = $request->get('identifier');
            $component  = $request->get('component');

            $entities   = $this->widgetService->getEntities();
            $aggregates = $this->widgetService->getAggregates();
            $categories = $this->categoryService->getCategory();
            $templates  = $this->widgetService->getTemplates();
            $limits     = $this->widgetService->getLimits();

            return $this->responseOk(
                $this->factory->make(Kiranti::WIDGET_BACKEND_PATH.$identifier, compact(
                    'identifier', 'widgetId', 'component', 'entities', 'aggregates', 'categories', 'templates', 'limits' ))
                    ->render()
            );
        }
    }

}
