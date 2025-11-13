<?php

namespace App\Http\Controllers\Frontend\Actions;

use App\Foundation\Enums\Role;
use Foundation\Services\UserService;
use App\Http\Controllers\Frontend\BaseController;

class ListingAction extends BaseController
{

    public function __construct(
        private readonly UserService $userService
    ) {}

    public function __invoke()
    {
        $data = [];
        $data['artists'] = $this->userService->getArtists(2);
        return view('pages.archive', compact('data'));
    }

}
