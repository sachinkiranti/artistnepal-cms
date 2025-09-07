<?php

namespace App\Providers;

use Foundation\Models\Post;
use Illuminate\Pagination\Paginator;
use Kiranti\Supports\Theme\Theme;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Kiranti\Supports\Theme\Engines\ThemeScanner;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     * @throws \Throwable
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        $this->app['theme']->init(active_theme());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'Post' => Post::class,
        ]);

        if (request()->server('HTTP_X_FORWARDED_PROTO') == 'https' || $this->app->environment() === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // saved, updated and deleted
//        \Event::listen(['illuminate.query'], function ($sql){
//        });

        Paginator::useBootstrap();
    }
}
