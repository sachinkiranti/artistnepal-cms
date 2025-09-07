<?php

namespace App\Http\Controllers\Admin;

use Foundation\Models\User;
use Foundation\Services\UserService;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;

class UserActionController extends BaseController
{
    /**
     * @var $userService
     */
    private $userService;

    /**
     * UserActionController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        $this->userService->forceDelete($id);
        flash('success', 'User is deleted successfully !');
        return redirect()->back();
    }

    public function restore($id)
    {
        $this->userService->restore($id);
        flash('success', 'Job is restored successfully !');
        return redirect()->back();
    }
}
