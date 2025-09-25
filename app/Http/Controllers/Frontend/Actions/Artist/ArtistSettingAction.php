<?php

namespace App\Http\Controllers\Frontend\Actions\Artist;

class ArtistSettingAction
{

    public function __invoke()
    {
        $data = [];
        return view('pages.artist.setting', compact('data'));
    }

}
