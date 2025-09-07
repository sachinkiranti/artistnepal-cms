<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Foundation\Models\Role;
use Illuminate\View\View;
use Foundation\Models\User;
use Illuminate\Http\Request;
use Foundation\Services\RoleService;
use Foundation\Services\UserService;
use Kiranti\Supports\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Foundation\Notifications\Welcome;
use Foundation\Requests\User\Type\StoreRequest;
use Foundation\Requests\User\Type\UpdateRequest;

/**
 * Class UserTypeController
 * @package App\Http\Controllers\Admin
 */
final class UserTypeController extends BaseController
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * UserTypeController constructor.
     *
     * @param UserService $userService
     * @param RoleService $roleService
     */
    public function __construct(
        UserService $userService,
        RoleService $roleService
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Role $role
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Role $role, Request $request)
    {
        if ($request->ajax()) {
            $user = $this->userService->filter(
                $request->only('filter.name', 'filter.role', 'filter.creation', 'filter.soft_delete'));
            return $this->getDataTable($user, $role);
        }
        $data['roles'] = $this->roleService->getRoles();
        return view('admin.user-type.index', compact('data', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Role $role
     * @return Factory
     */
    public function create(Role $role)
    {
        $data = [];
        $data['role'] = $role;
        return view('admin.user-type.create', compact('data', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Role $role
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(Role $role, StoreRequest $request)
    {

        if ($password = $request->get('password')) {
            $request->merge([
                'password' => bcrypt($password),
            ]);
        }

        if ($request->hasFile('image_holder')) {
            $request->merge([
                'image'   => User::attachImage($request->file('image_holder')),
            ]);
        }

        $user = $this->userService->new($request->all());

        if( $user ){
            $user->roles()->sync((array) $role->id);
        }

        $error = '';

        try {
            $user->notify(new Welcome());
        } catch (\Exception $exception) {
            $error = ' Email Not Sent !'. $exception->getMessage();
        }
        flash('success', 'User successfully created.'. $error);
        return $this->redirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @param User $user
     * @return Factory
     */
    public function show(Role $role, User $user)
    {
        $data = [];
        $data['user'] = $user->load('posts');
        $data['user']->posts = $data['user']->posts()->paginate(1);
        return view('admin.user-type.show', compact('data', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @param User $user
     * @return Factory
     */
    public function edit(Role $role, User $user)
    {
        $data = [];
        $data['user']  = $user;
        return view('admin.user-type.edit', compact('data', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Role $role, User $user)
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

        $this->userService->update(array_filter($request->all()), $user);

        if( $user ){
            $user->roles()->sync((array) $role->id);
        }
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Role $role, User $user)
    {
        $this->userService->delete($user);
        flash('success', 'Record is deleted successfully !');
        return redirect('admin/user-type/'.$role->id);
    }

    /**
     * Get Datatable for the passed User
     *
     * @param $user
     * @param $role
     * @return mixed
     * @throws Exception
     */
    protected function getDataTable($user, $role)
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
            ->addColumn('action', function ($data) use ($role) {
                $model = 'user-type';
                return view('admin.user-type.partials.actions', compact('data', 'model', 'role'))->render();
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

    protected function redirect(Request $request)
    {
        if ($request->has('submit_continue')) {
            return back();
        }
        return redirect()->route( pathinfo($request->route()->getName(), PATHINFO_FILENAME).'.index', [
            'role' => optional($request->route('role'))->id,
        ]);
    }

}
