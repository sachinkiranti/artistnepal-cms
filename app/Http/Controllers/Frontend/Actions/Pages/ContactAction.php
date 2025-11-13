<?php

namespace App\Http\Controllers\Frontend\Actions\Pages;

use Illuminate\Http\Request;

class ContactAction
{

    public function __invoke( Request $request )
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required|string|min:3|max:100',
                'email' => 'required|email|max:255',
                'message' => 'required|string|min:10|max:2000',
            ]);

            \Log::debug('Contact Us', $request->all());
            return back()
                ->with('success', 'The message has been successfully sent.');
        }

        $data = [];
        return view('pages.contact-us', compact('data'));
    }

}
