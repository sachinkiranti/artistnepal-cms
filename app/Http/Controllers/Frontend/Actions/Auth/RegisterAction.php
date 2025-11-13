<?php

namespace App\Http\Controllers\Frontend\Actions\Auth;

use App\Foundation\Enums\Role;
use Foundation\Lib\Utility;
use Foundation\Models\ArtistProfile;
use Foundation\Services\UserService;
use Illuminate\Http\Request;
use Kiranti\Config\Status;

class RegisterAction
{

    public function __construct(
        protected readonly UserService $userService,
        protected readonly ArtistProfile $artist
    ) {}

    public function __invoke( Request $request )
    {
        $data['is-artist-route'] = $request->routeIs('artist.register');

        if ($request->isMethod('POST')) {

            $rules = [
                'full_name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ];

            if ($data['is-artist-route']) {
                $rules = [
                    ...$rules,
                    'social_link' => 'required|url'
                ];
            }

            $credentials = $request->validate($rules);

            try {
                \DB::transaction(function () use ($credentials, $data, $request) {
                    $user = $this->userService->new([
                        'first_name' => $credentials['full_name'],
                        'email' => $credentials['email'],
                        'password' => \Hash::make($credentials['password']),
                        'status' => Status::INACTIVE_STATUS,
                    ]);

                    if ($data['is-artist-route']) {

                        $user->assignRole(
                            (array) \Foundation\Models\Role::where('slug', \App\Foundation\Enums\Role::ROLE_ARTIST)->value('id')
                        );

                        $this->artist->newQuery()->updateOrCreate([
                            'user_id' => $user->id,
                        ], [
                            'username' => Utility::generateUniqueSlug(
                                $this->artist,
                                $credentials['full_name'],
                                'username'
                            ),
                            'social_links' => [
                                Utility::detectSocialPlatform($request->get('social_link')) => $request->get('social_link'),
                            ]
                        ]);
                    }
                });
            } catch (\Exception $exception) {
                \Log::error('Registration failed: '.$exception->getMessage());
                return back()->withErrors(['error' => 'Something went wrong. Please try again later.']);
            }

            return back()
                ->with('success', 'Your account has been created! Please verify your email to complete registration.');
        }

        return view('pages.auth.register', compact('data'));
    }

}
