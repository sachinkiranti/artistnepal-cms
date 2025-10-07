<?php

namespace App\Http\Controllers\Frontend\Actions\Auth;

use Illuminate\Http\Request;

class ResetAction
{

    public function __invoke( Request $request )
    {
        $data['is-artist-route'] = $request->routeIs('artist.register');
        return view('pages.auth.reset-password', compact('data'));
    }

}
