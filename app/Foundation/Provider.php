<?php

namespace Foundation;

use Foundation\Lib\Cache;
use Illuminate\Support\ServiceProvider;
use Foundation\Composers\TeamViewComposer;
use Foundation\Composers\FooterMenuViewComposer;
use Foundation\Composers\MobileMenuViewComposer;
use Foundation\Composers\PrimaryMenuViewComposer;
use Foundation\Composers\FooterRightMenuViewComposer;

/**
 * Class Provider
 * @package Foundation
 */
final class Provider extends ServiceProvider
{

    /**
     * Sharing the data to the views
     *
     * key as view path & value as the view composer
     *
     * @var array
     */
    private static array $shareable = [
        'shared.menu.primary-menu' => PrimaryMenuViewComposer::class,
        'shared.menu.footer-menu' => FooterMenuViewComposer::class,
        'shared.menu.mobile-menu'  => MobileMenuViewComposer::class,
        'pages.shared.right-footer-menu'  => FooterRightMenuViewComposer::class,
        'pages.shared.team'  => TeamViewComposer::class,
    ];

    /**
     * Aliasing the component
     *
     * key as view path & value as the alias
     *
     * @var array
     */
    private static array $components = [
        'admin.common.components.summary' => 'summary',
        'admin.common.breadcrumbs'        => 'breadcrumb',
        'admin.common.advanced-filter'    => 'filter',
        'admin.common.summary-script'     => 'summaryscripts',
        'shared.menu.primary-menu'        => 'primary-menu',
        'shared.menu.mobile-menu'         => 'mobile-menu',
        'shared.menu.footer-menu'         => 'footer-menu',
        'pages.shared.right-footer-menu'  => 'rightFooterMenu',
        'pages.shared.team'               => 'team',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (Provider::$components as $view => $alias ) {
            \Blade::component($view, $alias);
        }

        foreach (Provider::$shareable as $view => $composer ) {
            \View::composer( $view, $composer );
        }

//        if (count(Cache::CACHEABLE_MODELS)) {
//            foreach(Cache::CACHEABLE_MODELS as $model) {
//                $model::observe(EloquentEventObserver::class);
//            }
//        }

    }

}
