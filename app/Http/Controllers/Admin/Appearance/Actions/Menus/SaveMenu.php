<?php

namespace App\Http\Controllers\Admin\Appearance\Actions\Menus;

use Foundation\Lib\Cache;
use Foundation\Lib\Nav;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Foundation\Services\NavService;
use Kiranti\Supports\BaseController;
use Illuminate\Http\RedirectResponse;

/**
 * Class SaveMenu
 * @package App\Http\Controllers\Admin\Appearance\Actions\Menus
 */
final class SaveMenu  extends BaseController
{

    /**
     * @var NavService
     */
    private $navService;

    /**
     * SaveMenu constructor.
     *
     * @param NavService $navService
     */
    public function __construct(
        NavService $navService
    )
    {
        $this->navService = $navService;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $ids = [];
        foreach ($request->get('menu') as $key => $nav) {
            if (! array_key_exists('default', $nav)) { // make sure nav arguments are all filled

                $type = in_array($nav['menu-type'], Nav::getTypes()) ? Nav::only($nav['menu-type'], true, 'types') : $nav['menu-type'];

                if (!is_null($nav['id'])) {
                    $ids[] = $nav['id'];
                    $this->navService->query()
                        ->updateOrCreate([
                            'id' => $nav['id'],
                        ], [
                            'parent_id'   => $nav['parent_id'] ?? 0,
                            'section'     => $request->get('section'),
                            'nav_li_type' => $nav['menu-type'],
                            'label'       => $nav['label'],
                            'value'       => $nav['value'],
                            'sort'        => $nav['sort'],
                            'class'       => $nav['class'],
                            'target'      => $nav['target'],
                            'icon'        => $nav['icon'],
                            'lang'        => \Kiranti\Config\Language::get(active_lang(), true),
                        ]);

                } else {
                    $nav = $this->navService->query()
                        ->create([
                            'parent_id'   => $nav['parent_id'] ?? 0,
                            'section'     => $request->get('section'),
                            'nav_li_type' => $type,
                            'label'       => $nav['label'],
                            'value'       => $nav['value'],
                            'sort'        => $nav['sort'],
                            'class'       => $nav['class'],
                            'target'      => $nav['target'],
                            'icon'        => $nav['icon'],
                            'lang'        => \Kiranti\Config\Language::get(active_lang(), true),
                        ]);
                    $ids[] = $nav->id;
                }
            }
        }

        if (!empty($ids)) {
            // delete
            $this->navService->query()
                ->where('section', $request->get('section'))
                ->where('lang', \Kiranti\Config\Language::get(active_lang(), true))
                ->whereNotIn('id', $ids)
                ->delete();
        }

        Cache::forget('nav-'.$request->get('section'));
        flash('success', 'Menu successfully saved.');
        return back();
    }

}
