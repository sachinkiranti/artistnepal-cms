<?php

namespace App\Http\Controllers\Frontend;

use App\Foundation\Enums\Role;
use Foundation\Models\ArtistProfile;
use Foundation\Models\Category;
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
        $data['profile'] = ArtistProfile::query()
            ->with('galleries')
            ->where('user_id', $data['user']->id)
            ->firstOrFail();
        $data['category'] = Category::query()
            ->where('id', $data['profile']->profession_id)
            ->first();
        $data['similar-artists'] = ArtistProfile::query()
            ->with('user')
            ->where('profession_id', $data['profile']->profession_id)
            ->take(3)
            ->get();

        abort_if(!$data['user']->hasRole(Role::ROLE_ARTIST->value), 403);

        return view('pages.artist-single', compact('data'));
    }

}
