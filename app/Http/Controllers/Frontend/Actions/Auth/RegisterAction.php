<?php

namespace App\Http\Controllers\Frontend\Actions\Auth;

use Illuminate\Http\Request;

class RegisterAction
{

    public function __invoke( Request $request )
    {
        $data['is-artist-route'] = $request->routeIs('artist.register');
        return view('pages.auth.register', compact('data'));
    }

}
