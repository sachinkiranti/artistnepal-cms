<?php

namespace Foundation\Handlers;

use Foundation\Services\WidgetService;
use Foundation\Handlers\Widgets\Frontend\AdWidget;
use Foundation\Handlers\Widgets\Frontend\MenuWidget;
use Foundation\Handlers\Widgets\Frontend\HtmlWidget;
use Foundation\Handlers\Widgets\Frontend\AboutWidget;
use Foundation\Handlers\Widgets\Frontend\CategoryWiseWidget;

/**
 * Class Widget
 * @package Foundation\Handlers
 */
final class Widget
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * Key as widget => value as class
     *
     * @var array
     */
    private $resolvedWidgets = [
        'category-wise' => CategoryWiseWidget::class,
        'html'          => HtmlWidget::class,
        'about'         => AboutWidget::class,
        'menu'          => MenuWidget::class,
//        'team'          => TeamWidget::class,
        'ad'            => AdWidget::class
    ];

    /**
     * List of widget prop to be extracted
     *
     * @var array
     */
    protected $widgetProps = [ 'template', 'name', 'category', 'limit', 'description' ];

    /**
     * HomeController constructor.
     * @param WidgetService $widgetService
     */
    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Throwable
     */
    public function handler(string $key)
    {
        return $this->getComponentsAndWidgets($key);
    }

    /**
     * @param string $componentType
     * @return array
     * @throws \Throwable
     */
    private function getComponentsAndWidgets(string $componentType)
    {
        $data = [];
        $components = $this->widgetService->getComponentsByType('frontend')
            ->filter(function ($component, $componentName) use ($componentType) {
                return in_array(str_replace(config('widgets.prefixes.component'), '', $componentName),
                    config('widgets.page-wise-components.'.$componentType));
            });

        foreach ($components as $name => $component) :
            $widgets  = implode('', $this->getWidgetsContent($name) ?? []);
            $componentPath = $component['view_path'];
            if (view()->exists($componentPath)) {
                $data[$name] = view($componentPath, compact('widgets'))->render();
            }
        endforeach;

        return $data;
    }

    /**
     * @param string $componentName
     * @return array
     * @throws \Exception
     */
    private function getWidgetsContent(string $componentName)
    {
        $contents = [];
        $widgets =  $this->widgetService->getWidgetsByComponent($componentName) ?? [];
        foreach ($widgets as $widget => $widgetProp) {
            if (array_key_exists($widgetProp->identifier, $this->resolvedWidgets)) {

                if ($componentName === 'left-section-component') {
                    $widgetProp->post_type = 'bises'; /// @todo
                }

                $widgetClass = $this->resolvedWidgets[$widgetProp->identifier];
                $contents[]  = (new $widgetClass((array) $widgetProp))->toHtml();
            }
        }
        return $contents;
    }

}
