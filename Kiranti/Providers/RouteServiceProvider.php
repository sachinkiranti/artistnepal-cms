<?php

namespace Kiranti\Providers;

use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 * @package Kiranti\Providers
 */
class RouteServiceProvider extends \App\Providers\RouteServiceProvider
{

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        parent::mapApiRoutes();

        parent::mapWebRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware([ 'web', 'auth' ])
            ->namespace($this->namespace.'\Admin')
            ->prefix('admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

}
