<?php

namespace App\Http\Controllers\Frontend\Actions\Auth;

use Illuminate\Http\Request;

class LoginAction
{

    public function __invoke( Request $request )
    {

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_login' => 'required|string',
                'pwd' => 'required|string',
            ]);

            if (\Auth::attempt(['email' => $credentials['user_login'], 'password' => $credentials['pwd']])) {
                $request->session()->regenerate();

                return redirect(url('/'))
                    ->with('success', 'Logged in successfully.');
            }

            return back()
                ->with('error', 'Invalid credentials provided.')
                ->onlyInput('user_login');
        }

        return view('pages.auth.login');
    }

}
