<?php

namespace App\Http\Controllers\Frontend\Actions\Auth;

use Illuminate\Http\Request;

class LoginAction
{

    public function __invoke( Request $request )
    {
        return view('pages.auth.login');
    }

}
