<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Exception;
use Foundation\Services\EmailPatternService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Foundation\Models\EmailTemplate;
use Kiranti\Supports\BaseController;
use Foundation\Requests\EmailTemplate\{
    StoreRequest,
    UpdateRequest
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\EmailTemplateService;

/**
 * Class EmailTemplateController
 * @package App\Http\Controllers\Admin
 */
class EmailTemplateController extends BaseController
{

    /**
     * The EmailTemplateService instance
     *
     * @var $emailTemplateService
     */
    private $emailTemplateService;
    /**
     * @var EmailPatternService
     */
    private $emailPatternService;

    /**
     * EmailTemplateController constructor.
     * @param EmailTemplateService $emailTemplateService
     * @param EmailPatternService $emailPatternService
     */
    public function __construct(EmailTemplateService $emailTemplateService, EmailPatternService $emailPatternService)
    {
        $this->emailTemplateService = $emailTemplateService;
        $this->emailPatternService = $emailPatternService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->emailTemplateService->filter($request->input('search.value')))
                ->addColumn('created_at', function ($data) {
                    return view('admin.common.created-at',compact('data'))->render();
                })
                ->addColumn('action', function ($data) {
                    $model = 'email-template';
                    return '<a href="' . route("admin.email-template.edit", $data->id) . '" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></a>';
                })
                ->addColumn('status', function ($data) {
                     return view('admin.common.status', compact('data'))->render();
                })
                ->addColumn('checkbox', function ($data) {
                    return view('admin.common.checkbox', compact('data'))->render();
                })
                ->addColumn('slug', function ($data) {
                    return "<code>" . $data->slug . "</code>";
                })
                ->rawColumns([ 'checkbox', 'action', 'created_at', 'slug', 'status'])
                ->make(true);
        }

        return view('admin.emailtemplate.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EmailTemplate $emailTemplate
     * @return Factory
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        $data = [];
        $data['emailtemplate']  = $emailTemplate;
        $data['email-patterns'] = json_encode($this->emailPatternService->loadPatternsForTemplate($emailTemplate), JSON_PRETTY_PRINT);
        return view('admin.emailtemplate.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  EmailTemplate $emailTemplate
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, EmailTemplate $emailTemplate)
    {
        $this->emailTemplateService->update($request->all(), $emailTemplate);
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }
}
