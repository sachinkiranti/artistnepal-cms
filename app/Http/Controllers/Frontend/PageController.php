<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Foundation\Services\PostService;
use Foundation\Services\CategoryService;

/**
 * Class PageController
 *
 * @package App\Http\Controllers\Frontend
 */
final class PageController extends BaseController
{

    public function __construct (
        private readonly PostService $postService,
        private readonly CategoryService $categoryService
    )
    {}

    public function __invoke(string $slug, Request $request)
    {
        $data['page'] = $this->postService->byIdentifier($slug)->load('user');

        return view('pages.page', compact('data'));
    }

}
