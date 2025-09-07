<?php

namespace Kiranti\Supports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Kiranti\Supports\Access\HasAccess;
use Kiranti\Supports\Concerns\Responsable;

/**
 * Class BaseController
 *
 * @package Kiranti\Supports
 */
abstract class BaseController extends Controller
{

    use HasAccess, Responsable;


    protected $pagination_limit = 10;

    /**
     * Redirect if save & continue
     *
     * @param Request $request
     * @return RedirectResponse
     */
    protected function redirect(Request $request)
    {
        if ($request->has('submit_continue')) {
            return back();
        }
        return redirect()->route( pathinfo($request->route()->getName(), PATHINFO_FILENAME).'.index');
    }

    public function pagination_limit()
    {
        return 10;
    }

}
