<?php

namespace App\Http\Controllers\Frontend\Actions;

use App\Foundation\Enums\Role;
use Foundation\Services\UserService;
use App\Http\Controllers\Frontend\BaseController;
use Illuminate\Http\Request;

class ListingAction extends BaseController
{

    public function __construct(
        private readonly UserService $userService
    ) {}

    public function __invoke( Request $request )
    {
        $data = [];
        $data['artists'] = $this->userService->getArtists(2, $request->only([
            'category', 'search', 'eras', 'artist_status'
        ]));
        return view('pages.archive', compact('data'));
    }

}
