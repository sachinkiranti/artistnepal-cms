<?php

namespace App\Http\Controllers\Frontend;

use App\Foundation\Enums\Role;
use Foundation\Services\UserService;

class ArtistController extends BaseController
{

    public function __construct(
        private readonly UserService $userService
    ) {}

    public function __invoke(string $artist)
    {
        $data = [];

        $data['user'] = $this->userService->byIdentifier( $artist );

        abort_if(!$data['user']->hasRole(Role::ROLE_ARTIST->value), 403);

        return view('pages.artist-single', compact('data'));
    }

}
