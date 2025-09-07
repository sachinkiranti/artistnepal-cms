<?php

namespace Kiranti\Providers;

use Kiranti\Config\Language;
use Kiranti\Events\ViewsHandler;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Kiranti\Supports\Console\Commands\ClearCommand;
use Kiranti\Supports\Console\Commands\GenerateJsRouteCommand;
use Kiranti\Supports\Theme\Provider as ThemeServiceProvider;
use Kiranti\Supports\Access\Provider as AccessServiceProvider;
use Kiranti\Supports\Generator\Providers\GeneratorServiceProvider;
use Kiranti\Supports\Widget\Console\Commands\GenerateWidgetCommand;

/**
 * Class KirantiServiceProvider
 *
 * @package Kiranti\Providers
 * @version 0.1.3
 */
class KirantiServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('views.count', ViewsHandler::class);
        self::registerDirectives();
        self::addMacros();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->registerDeferredProvider(GeneratorServiceProvider::class);
        $this->app->registerDeferredProvider(AccessServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateJsRouteCommand::class,
                GenerateWidgetCommand::class,
            ]);
        }

        $this->commands([
            ClearCommand::class,
        ]);
    }

    /**
     * List of directive to be registered
     *
     * @return void
     */
    private function registerDirectives()
    {
        $directives = require base_path('/Kiranti/Supports/directives.php');

        collect($directives)->each(function ($item, $key) {
            Blade::directive($key, $item);
        });
    }

    /**
     * List of macros to be registered
     *
     * @return void
     */
    private function addMacros()
    {
        Builder::macro('addSubSelect', function ($column, $query) {
            if (is_null($this->getQuery()->columns)) {
                $this->select($this->getQuery()->from.'.*');
            }

            return $this->selectSub($query->limit(1)->getQuery(), $column);
        });

        Builder::macro('orderBySub', function ($query, $direction = 'asc') {
            return $this->orderByRaw("({$query->limit(1)->toSql()}) {$direction}");
        });

        Builder::macro('orderBySubDesc', function ($query) {
            return $this->orderBySub($query, 'desc');
        });

        Blueprint::macro('lang', function() {
            $this->tinyInteger('lang')
                ->default(Language::DEFAULT_LANGUAGE)
                ->index();
        });
    }

}
