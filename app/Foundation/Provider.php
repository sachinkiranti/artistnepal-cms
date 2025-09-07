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
    private static $shareable = [
        'pages.shared.primary-menu' => PrimaryMenuViewComposer::class,
        'pages.shared.footer-menu' => FooterMenuViewComposer::class,
        'pages.shared.mobile-menu'  => MobileMenuViewComposer::class,
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
    private static $components = [
        'admin.common.components.summary' => 'summary',
        'admin.common.breadcrumbs'        => 'breadcrumb',
        'admin.common.advanced-filter'    => 'filter',
        'admin.common.summary-script'     => 'summaryscripts',
        'pages.shared.primary-menu'       => 'primary',
        'pages.shared.mobile-menu'        => 'mobile',
        'pages.shared.footer-menu'        => 'footerMenu',
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
        foreach ( static::$components as $view => $alias ) {
            \Blade::component($view, $alias);
        }

        foreach ( static::$shareable as $view => $composer ) {
            \View::composer( $view, $composer );
        }

//        if (count(Cache::CACHEABLE_MODELS)) {
//            foreach(Cache::CACHEABLE_MODELS as $model) {
//                $model::observe(EloquentEventObserver::class);
//            }
//        }

    }

}
