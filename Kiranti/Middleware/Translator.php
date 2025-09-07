<?php

namespace Kiranti\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

/**
 * Class Translator
 * @package Kiranti\Middleware
 */
final class Translator
{

    /**
     * @var Application
     */
    private $app;

    /**
     * @var Request
     */
    private $request;

    /**
     * Translator constructor.
     *
     * @param Application $app
     * @param Request $request
     */
    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->app->setLocale(active_lang());
        return $next($request);
    }

}
