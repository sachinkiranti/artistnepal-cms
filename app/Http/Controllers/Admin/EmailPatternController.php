<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Foundation\Models\EmailPattern;
use Kiranti\Supports\BaseController;
use Foundation\Requests\EmailPattern\{
    StoreRequest,
    UpdateRequest
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\EmailPatternService;

/**
 * Class EmailPatternController
 * @package App\Http\Controllers\Admin
 */
class EmailPatternController extends BaseController
{

    /**
     * The EmailPatternService instance
     *
     * @var $emailPatternService
     */
    private $emailPatternService;

    public function __construct(EmailPatternService $emailPatternService)
    {
        $this->emailPatternService = $emailPatternService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->emailPatternService->filter($request->input('search.value')))
                ->addColumn('created_at', function ($data) {
                    return view('admin.common.created-at',compact('data'))->render();
                })
                /*->addColumn('action', function ($data) {
                    $model = 'emailPattern';
                    return view('admin.common.data-table-action', compact('data', 'model'))->render();
                })*/
                ->addColumn('status', function ($data) {
                     return view('admin.common.status', compact('data'))->render();
                })
                ->addColumn('slug', function ($data) {
                    return "<code>" . $data->slug . "</code>";
                })
                ->rawColumns(['created_at', 'status', 'slug'])
                ->make(true);
        }

        return view('admin.emailpattern.index');
    }
}
