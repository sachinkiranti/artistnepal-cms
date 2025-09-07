<?php

namespace Kiranti\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Minifier
 * @package Kiranti\Middleware
 */
final class Minifier
{

    private $replace = [
        '<!--(.*?)-->' => '', //remove comments
        "/<\?php/" => '<?php ',
        "/\n([\S])/" => '$1',
        "/\r/" => '', // remove carrage return
        "/\n/" => '', // remove new lines
        "/\t/" => '', // remove tab
        "/\s+/" => ' ', // remove spaces
    ];

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('production')) :
            return preg_replace(array_keys($this->replace), array_values($this->replace), $htmlString);
        endif;

//        return $htmlString;
    }

}
