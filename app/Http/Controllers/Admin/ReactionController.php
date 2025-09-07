<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Foundation\Lib\Reaction;
use Kiranti\Supports\BaseController;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\ReactionService;

/**
 * Class ReactionController
 * @package App\Http\Controllers\Admin
 */
final class ReactionController extends BaseController
{

    /**
     * The ReactionService instance
     *
     * @var $reactionService
     */
    private $reactionService;

    /**
     * CommentController constructor.
     *
     * @param ReactionService $reactionService
     */
    public function __construct(ReactionService $reactionService)
    {
        $this->reactionService = $reactionService;
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
        $data['reaction-types'] = Reaction::all();
        $data['reactions'] = $this->reactionService->withReactable();
        return view('admin.reaction.index', compact('data'));
    }

}
