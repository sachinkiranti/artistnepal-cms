<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Throwable;
use Illuminate\View\View;
use Foundation\Lib\Reaction;
use Illuminate\Http\Request;
use Foundation\Handlers\Widget;
use Foundation\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;
use Foundation\Services\SettingService;
use Foundation\Services\CategoryService;
use Foundation\Services\ReactionService;
use Foundation\Handlers\Widgets\Frontend\AdWidget;
use Foundation\Handlers\Widgets\Frontend\HtmlWidget;
use Foundation\Handlers\Widgets\Frontend\MenuWidget;
use Foundation\Handlers\Widgets\Frontend\AboutWidget;
use Foundation\Handlers\Widgets\Frontend\CategoryWiseWidget;

/**
 * Class SingleCustomizerController
 * @package App\Http\Controllers\Frontend
 */
final class SingleCustomizerController extends \Kiranti\Supports\BaseController
{

    /**
     * @var WidgetService
     */
    private $widgetService;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var ReactionService
     */
    private $reactionService;

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
     * SingleController constructor.
     *
     * @param WidgetService $widgetService
     * @param PostService $postService
     * @param SettingService $settingService
     * @param CategoryService $categoryService
     * @param ReactionService $reactionService
     */
    public function __construct (
        WidgetService $widgetService,
        PostService $postService,
        SettingService $settingService,
        CategoryService $categoryService,
        ReactionService $reactionService
    )
    {
        $this->widgetService   = $widgetService;
        $this->postService     = $postService;
        $this->categoryService = $categoryService;
        $this->reactionService = $reactionService;
        $this->settingService  = $settingService;
    }

    /**
     * @param string $slug
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     * @throws Throwable
     */
    public function __invoke(string $slug, Request $request)
    {
        $data = [];
        $data['post']             = $this->postService->byIdentifier($slug);
        $data['related-posts']    = $this->postService->getRelatedById($data['post']->id);
        $data['reactions']        = Reaction::all();
        $data['reaction-summary'] = $this->reactionService->summary($data['post']);
        $components               = (new Widget($this->widgetService))->handler('single');
        return view('pages.single-customizer', compact('data', 'components'));
    }

}
