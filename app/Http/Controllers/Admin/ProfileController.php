<?php

namespace App\Http\Controllers\Admin;

use Foundation\Models\User;
use Foundation\Services\RoleService;
use Foundation\Services\UserService;
use Kiranti\Supports\BaseController;
use Foundation\Requests\User\UpdateRequest;

class ProfileController extends BaseController
{
    /**
     * @var UserService
     */
    public $userService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     */
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     * @param RoleService $roleService
     */
    public function __construct(
        UserService $userService,
        RoleService $roleService
    ){
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function edit()
    {
        $data = [];
        $data['roles'] = $this->roleService->getRoles();
        $data['profile'] = $this->userService->getLoggedInUser();
        return view('admin.user.profile', compact('data'));

    }

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

        $this->userService->update(array_filter($request->all()), $user);

        flash('success', 'Record successfully updated.');
        return redirect()->route('admin.profile.edit',auth()->user()->id);
    }
}
