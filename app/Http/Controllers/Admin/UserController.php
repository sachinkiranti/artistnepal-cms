<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Foundation\Models\User;
use Foundation\Requests\User\{
    StoreRequest,
    UpdateRequest
};
use Foundation\Services\RoleService;
use Kiranti\Supports\BaseController;
use Foundation\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Foundation\Notifications\Welcome;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends BaseController
{

    /**
     * The UserService instance
     *
     * @var $userService
     */
    private $userService;
    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
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
            $user = $this->userService->filter($request->only(
                'filter.name', 'filter.role', 'filter.creation', 'filter.soft_delete'));
            return $this->getDataTable($user);
        }
        $data['roles'] = $this->roleService->getRoles();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory
     */
    public function create()
    {
        $data = [];
        $data['roles'] = $this->roleService->getRoles();
        return view('admin.user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        if ($request->hasFile('image_holder')) {
            $request->merge([
                'image'   => User::attachImage($request->file('image_holder')),
            ]);
        }
        $user = $this->userService->new($request->merge([
            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
            'password'          => bcrypt($request->get('password')),
        ])->all());
        if( $user ){
            $user->roles()->sync((array) $request->get('roles'));
        }
        $error = '';

        try {
            $user->notify(new Welcome());
        } catch (\Swift_TransportException $exception) {
            $error = ' Email Not Sent !';
        }
        flash('success', 'User successfully created.'. $error);
        return $this->redirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return Factory
     */
    public function show(User $user)
    {
        $data = [];
        $data['user'] = $user->load('posts');
        $data['user']->posts = $data['user']->posts()->paginate(1);
        return view('admin.user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Factory
     */
    public function edit(User $user)
    {
        $data = [];
        $data['user']  = $user;
        $data['roles'] = $this->roleService->getRoles();
        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        if ($password = $request->get('password')) {
            $request->merge([
                'password' => bcrypt($password),
            ]);
        }

        if ($request->hasFile('image_holder')) {
            $request->merge([
                'image'   => User::attachImage($request->file('image_holder'), false, $user->image),
            ]);
        }

        $this->userService->update(array_filter($request->merge([
            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
        ])->all()), $user);

        $user->roles()->sync((array) $request->get('roles'));
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
         $this->userService->delete($user);
         flash('success', 'Record is deleted successfully !');
         return redirect('admin/user');
    }

    /**
     * Get Datatable for the passed User
     *
     * @param $user
     * @return mixed
     * @throws Exception
     */
    protected function getDataTable($user)
    {
        return datatables()
            ->of($user)
            ->addColumn('full_name', function ($data) {
                return '<b>' . $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name . '</b>';
            })
            ->addColumn('roles', function ($data) {
                $value = '';
                foreach ($data->roles as $role){
                    $value .= "<code>" . $role->name . "</code> | ";
                }
                return rtrim($value,'| ');
            })
            ->addColumn('created_at', function ($data) {
                return view('admin.common.created-at',compact('data'))->render();
            })
            ->addColumn('action', function ($data) {
                $model = 'user';
                return view('admin.common.data-table-common-action', compact('data', 'model'))->render();
            })
            ->addColumn('checkbox', function ($data) {
                return view('admin.common.checkbox', compact('data'))->render();
            })
            ->addColumn('status', function ($data) {
                return view('admin.common.status', compact('data'))->render();
            })
            ->rawColumns([ 'checkbox', 'action', 'created_at', 'full_name', 'roles'])
            ->make(true);
    }

}
