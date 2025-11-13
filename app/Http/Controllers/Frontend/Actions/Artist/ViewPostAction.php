<?php

namespace App\Http\Controllers\Frontend\Actions\Artist;

use Foundation\Services\PostService;
use Illuminate\Http\Request;

class ViewPostAction
{

    public function __construct(
        private readonly PostService $postService
    ) {}

    public function __invoke(string $slug, Request $request)
    {
        $data['post'] = $this->postService->byIdentifier($slug)->load('user');

        return view('pages.single', compact('data'));
    }

}
