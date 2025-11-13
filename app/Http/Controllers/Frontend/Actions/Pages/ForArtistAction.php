<?php

namespace App\Http\Controllers\Frontend\Actions\Pages;

use App\Http\Controllers\Frontend\BaseController;
use Foundation\Services\FaqService;
use Illuminate\Http\Request;

class ForArtistAction extends BaseController
{

    public function __construct(
        private readonly FaqService $faqService
    ) {}

    public function __invoke( Request $request )
    {
        $data['faqs'] = $this->faqService->forArtist();
        return view('pages.for-artist', compact('data'));
    }

}
