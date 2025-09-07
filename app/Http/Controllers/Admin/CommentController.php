<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\CommentService;
use App\Http\Controllers\Frontend\BaseController;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 */
final class CommentController extends BaseController
{

    /**
     * The CommentService instance
     *
     * @var $commentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $data['comments'] = $this->commentService->withCommentable();
        return view('admin.comment.index', compact('data'));
    }

}
