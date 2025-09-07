<?php

namespace App\Http\Controllers\Frontend;

use Foundation\Services\SettingService;
use Illuminate\View\View;
use Foundation\Handlers\Widget;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;
use Foundation\Handlers\Widgets\Frontend\AdWidget;
use Foundation\Handlers\Widgets\Frontend\HtmlWidget;
use Foundation\Handlers\Widgets\Frontend\MenuWidget;
use Foundation\Handlers\Widgets\Frontend\AboutWidget;
use Foundation\Handlers\Widgets\Frontend\CategoryWiseWidget;

final class HomeController extends BaseController
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * @var SettingService
     */
    private $settingService;

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
     * @param SettingService $settingService
     */
    public function __construct( WidgetService $widgetService, SettingService $settingService )
    {
        $this->widgetService = $widgetService;
        $this->settingService = $settingService;
    }

    /**
     * Show the home page of the website
     *
     * @return Factory|View
     * @throws \Exception
     * @throws \Throwable
     */
    public function __invoke()
    {
        $data = $this->widgetService->getComponentsByType('frontend');

        $components = (new Widget($this->widgetService))->handler('home');

        $wrappers = $this->settingService->getWrappers();

        $advertisements = $this->settingService->getWrappersAdvertisements();

        return view('pages.index', compact('data', 'components', 'wrappers', 'advertisements'));
    }

}
