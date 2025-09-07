<?php

namespace Kiranti\Supports\Generator\Providers;

use Illuminate\Support\ServiceProvider;
use Kiranti\Supports\Generator\Console\GenerateCommand;

/**
 * Class GeneratorServiceProvider
 *
 * @package Kiranti\Supports\Generator\Providers
 */
class GeneratorServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCommand::class,
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__.'/../config/generator.php', 'generator'
        );
    }

}
