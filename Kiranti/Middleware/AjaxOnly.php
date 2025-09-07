<?php

namespace Kiranti\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kiranti\Lib\Kiranti;

/**
 * Class AjaxOnly
 * @package Kiranti\Middleware
 */
final class AjaxOnly
{

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( !$request->ajax() ) {
            die(Kiranti::AJAX_ONLY);
        }

        return $next($request);
    }

}
