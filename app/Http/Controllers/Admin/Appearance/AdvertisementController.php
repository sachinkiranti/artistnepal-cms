<?php

namespace App\Http\Controllers\Admin\Appearance;

use Foundation\Lib\Cache;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Foundation\Services\PostService;
use Kiranti\Supports\BaseController;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\WidgetService;

/**
 * Class AdvertisementController
 * @package App\Http\Controllers\Admin\Appearance
 */
final class AdvertisementController extends BaseController
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
     * AdvertisementController constructor.
     *
     * @param WidgetService $widgetService
     * @param PostService $postService
     */
    public function __construct(
        WidgetService $widgetService,
        PostService $postService
    )
    {
        $this->widgetService = $widgetService;
        $this->postService = $postService;
    }

    /**
     * @param string $component
     * @param string $widget
     * @return Factory|View
     */
    public function index(string $component, string $widget)
    {
        $data = [];

        $data['widget'] = (object) $this->widgetService->find($widget, $component);

        if ($data['widget']->identifier === 'category-wise') {
            $data['posts'] = $this->postService->getByCategory($data['widget']->category, $data['widget']->limit);
        }

        return view('admin.appearance.customizer.advertisement', compact('data'));
    }

    public function save(Request $request)
    {
        $data = [];
        $data['widget'] = $this->widgetService->find($request->get('widget'), $request->get('component'));

        $advertisementIndex = array_keys($request->input('advertisement.'.$request->get('widget')));

        $advertisements = [];

        foreach ($advertisementIndex as $index) {
            $advertisements[] = [
                'top' => array_combine(
                    $request->input('advertisement.'.$request->get('widget').'.'.$index.'.top.image') ?? [],
                    $request->input('advertisement.'.$request->get('widget').'.'.$index.'.top.caption') ?? []),
                'bottom' => array_combine(
                    $request->input('advertisement.'.$request->get('widget').'.'.$index.'.bottom.image') ?? [],
                    $request->input('advertisement.'.$request->get('widget').'.'.$index.'.bottom.caption') ?? []),
            ];
        }

        $this->widgetService->insert(array_merge($data['widget'], [
            'component' => $request->get('component'),
            'widget_id' => $request->get('widget'),
            'advertisement' => $advertisements,
        ]));

        Cache::clear();

        flash('success', 'Advertisements is updated successfully.');
        return back();
    }

}
