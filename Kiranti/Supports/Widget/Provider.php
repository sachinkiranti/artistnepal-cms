<?php

namespace Kiranti\Supports\Widget;

use Illuminate\Support\ServiceProvider;
use Kiranti\Supports\Widget\Console\Commands\GenerateWidgetCommand;

class Provider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateWidgetCommand::class,
            ]);
        }
    }

}
