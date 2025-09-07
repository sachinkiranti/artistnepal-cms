<?php

namespace App\Http\Controllers\Admin;

use Foundation\Models\User;
use Throwable;
use Exception;
use Foundation\Lib\Role;
use Foundation\Lib\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Foundation\Models\Post;
use Foundation\Lib\PostType;
use Illuminate\Http\Request;
use Kiranti\Config\Language;
use Foundation\Requests\Post\{
    StoreRequest,
    UpdateRequest
};
use Foundation\Services\TagService;
use Kiranti\Supports\Concerns\Image;
use Kiranti\Supports\BaseController;
use Foundation\Services\UserService;
use Foundation\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\CommentService;
use Foundation\Services\CategoryService;
use Foundation\Services\ReactionService;
use Foundation\Builders\Filters\Post\Filter;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends BaseController
{

    use Image;

    /**
     * The PostService instance
     *
     * @var $postService
     */
    private $postService;

    /**
     * @var TagService
     */
    private $tagService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var ReactionService
     */
    private $reactionService;

    /**
     * PostController constructor.
     * @param PostService $postService
     * @param TagService $tagService
     * @param CategoryService $categoryService
     * @param UserService $userService
     * @param CommentService $commentService
     * @param ReactionService $reactionService
     */
    public function __construct(
        PostService $postService,
        TagService $tagService,
        CategoryService $categoryService,
        UserService $userService,
        CommentService $commentService,
        ReactionService $reactionService
    )
    {
        $this->postService = $postService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
        $this->commentService = $commentService;
        $this->reactionService = $reactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception|Throwable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->postService->filter())
                ->filter(function ($query) use ($request) {

                    $query->when(!auth()->user()->hasRole(User::DEFAULT_ROLE), function ($query) {
                        $query->where('posts.created_by', auth()->id());
                    });

                    $categories = $request->input('filter.categories');
                    $query->when($categories, function ($query) use ($categories) {
                        $query->whereIntegerInRaw('categories.id', $categories);
                    });

                    $query = Filter::apply($query, $request->only(
                        'filter',
                        'search.value'
                    ));
                })
                ->addColumn('created_at', function ($data) {
                    return view('admin.common.created-at',compact('data'))->render();
                })
                ->addColumn('title', function ($data) {
                    return view('admin.post.partials.title',compact('data'))->render();
                })
                ->addColumn('created_by', function ($data) {
                    return $data->author ?? $data->user_name;
                })
                ->addColumn('action', function ($data) {
                    $model = 'post';
                    return view('admin.post.partials.data-table-action', compact('data', 'model'))->render();
                })
                ->addColumn('status', function ($data) {
                     return view('admin.common.status', compact('data'))->render();
                })
                ->addColumn('checkbox', function ($data) {
                    return view('admin.common.checkbox', compact('data'))->render();
                })
                ->rawColumns(['title', 'content', 'checkbox', 'status', 'views', 'action', 'created_by', 'created_at', ])
                ->make(true);
        }
        $data['categories'] = $this->categoryService->getCategory();
        $data['status'] = $this->postService->status();
        return view('admin.post.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory
     */
    public function create()
    {
        $data = [];
        $data['post-type'] = PostType::$current;
        $data['tag'] = $this->tagService->tag();
        $data['category'] = $this->categoryService->getCategory();
        $data['created_by'] = $this->userService->pluckAuthor();
        $data['media_display_type'] = PostType::getMediaTypes();
        $data['types'] = PostType::$types;
        $data['positions'] = PostType::$positions;
        $data['published_date'] = now();
        return view('admin.post.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     * @throws FileNotFoundException
     */
    public function store(StoreRequest $request)
    {
        if ($request->hasFile('image_holder')) {
            $watermarkPosition = PostType::$positions[$request->get('watermark_position') ?? PostType::WATERMARK_POSITION_BOTTOM_RIGHT];

            $request->merge([
                'has_watermark' => $request->get('has_watermark') === 'on',
                'image'   => Post::attachImage($request->file('image_holder'), $request->get('has_watermark') === 'on', $watermarkPosition),
            ]);
        }

        $request->merge([
            'is_thumbnail_visible' => $request->get('is_thumbnail_visible') === 'on',
        ]);

        $data = array_filter($request->merge([
            'created_by'=> $request->get('created_by') ?? auth()->id(),
            'disable_facebook_comment' => $request->get('disable_facebook_comment') === 'on',
            'disable_disqus_comment' => $request->get('disable_disqus_comment') === 'on',
            'disable_site_comment' => $request->get('disable_site_comment') === 'on',
            'disable_reaction' => $request->get('disable_reaction') === 'on',
            'is_author_visible' => $request->get('is_author_visible') === 'on',
            'is_default_news'    => $request->get('is_default_news') === 'on',
            'is_flash_news'      => $request->get('is_flash_news') === 'on',
            'is_bises_news'      => $request->get('is_bises_news') === 'on',
            'is_pramukh_news'    => $request->get('is_pramukh_news') === 'on',
            'category_id'=> $request->get('sub-category') ?? $request->get('category_id'),
            'created_at' => now(),
            'updated_at' => now(),
            'has_watermark' => $request->get('has_watermark') === 'on',
        ])->only(array_merge($this->postService->getFillable(), [ 'created_at', 'updated_at', ])));

        $postID = app('db')
            ->table('posts')
            ->insertGetId($data);

        if( $post = $this->postService->query()->find($postID) ){
            $this->postService->syncData($post, $request->get('tags'));

            if ($post) {
                foreach ($request->get('images') as $key => $image) {

                    if ($key && $image) {
                        app('db')
                            ->table('post_images')
                            ->updateOrInsert([
                                'post_id'    => $postID,
                                'image'      => $request->input('images.'.$key),
                                'caption'    => $request->input('caption.'.$key),
                            ], [ 'added_by' => auth()->id(), 'created_at' => now(), ]);
                    }

                }
            }
        }

        Cache::clear();
        flash('success', 'Record successfully created.');
        return $this->redirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return Factory
     */
    public function show(Post $post)
    {
        $data = [];

        $data['post'] = $post->loadCount('tags')->load([
            'tags' => function ($query) {
                return $query->select('tags.id', 'tags.tag_name');
            },
            'comments'
        ])->loadCount('category')->loadCount('comments');

        $data['parents'] = $this->categoryService->getParentTree($data['post']->category_id);

        $data['reactions'] = $this->reactionService->summary($post);
        $data['comments']  =  $this->commentService->statusByPost($post);

        return view('admin.post.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return Factory
     */
    public function edit(Post $post)
    {
        $data = [];

        $data['post']  = $post;
        $data['published_date'] = $post->published_date;
        $data['post-type'] = PostType::$current;
        $data['tag'] = $this->tagService->tag();
        $data['category'] = $this->categoryService->getCategory();
        $data['created_by'] = $this->userService->pluckAuthor();
        $data['media_display_type'] = PostType::getMediaTypes();
        $data['types'] = PostType::$types;
        $data['positions'] = PostType::$positions;

        $data['post-images'] = app('db')
            ->table('post_images')
            ->where('post_id', $post->id)
            ->get();

        return view('admin.post.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Post $post)
    {
        if ($request->hasFile('image_holder')) {
            $watermarkPosition = PostType::$positions[$request->get('watermark_position') ?? PostType::WATERMARK_POSITION_BOTTOM_RIGHT];
            $request->merge([
                'has_watermark' => $request->get('has_watermark') === 'on',
                'image'   => Post::attachImage($request->file('image_holder'), $request->get('has_watermark') === 'on', $watermarkPosition, $post->image),
            ]);
        }

        $request->merge([
            'is_thumbnail_visible' => $request->get('is_thumbnail_visible') === 'on',
        ]);

        $request->merge([
            'created_by'=> $request->get('created_by') ?? auth()->id(),
            'disable_facebook_comment' => $request->get('disable_facebook_comment') === 'on',
            'disable_disqus_comment' => $request->get('disable_disqus_comment') === 'on',
            'disable_site_comment' => $request->get('disable_site_comment') === 'on',
            'disable_reaction' => $request->get('disable_reaction') === 'on',
            'is_author_visible' => $request->get('is_author_visible') === 'on',
            'is_default_news'    => $request->get('is_default_news') === 'on',
            'is_flash_news'      => $request->get('is_flash_news') === 'on',
            'is_bises_news'      => $request->get('is_bises_news') === 'on',
            'is_pramukh_news'    => $request->get('is_pramukh_news') === 'on',
            'category_id'=> $request->get('sub-category') ?? $request->get('category_id'),
            'updated_at' => now(),
        ]);

        if ($request->get('remove_thumbnail') === 'on' && $post->image) {
            Post::deleteImages($post->image);
        }

        app('db')
            ->table('posts')
            ->where('id', $post->id)
            ->update($request->only(array_merge($post->getFillable() , [ 'created_at', 'updated_at', ])));

        if( $post ){
            $this->postService->syncData($post, $request->get('tags'));
            $lastUpdatedId = [];
            foreach ($request->get('images') as $key => $image) {

                if ($image) {
                    app('db')
                        ->table('post_images')
                        ->updateOrInsert([
                            'post_id' => $post->id,
                            'image' => $request->input('images.' . $key),
                            'caption' => $request->input('caption.' . $key),
                        ], [
                            'added_by' => auth()->id(),
                            'updated_at' => now(),
                        ]);

                    $lastUpdatedId[] = app('db')
                        ->table('post_images')
                        ->where([
                            'post_id' => $post->id,
                            'image' => $request->input('images.' . $key),
                            'caption' => $request->input('caption.' . $key),
                        ])->value('id');
                }
            }

            if (count($lastUpdatedId) > 0) {
                app('db')
                    ->table('post_images')
                    ->where('post_id', $post->id)
                    ->whereNotIn('id', $lastUpdatedId)
                    ->delete();
            } else {
                app('db')
                    ->table('post_images')
                    ->where('post_id', $post->id)
                    ->delete();
            }

        }
        Cache::clear();
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);
        Cache::clear();
        flash('success', 'Post is deleted successfully !');
        return redirect('admin/post');
    }

}
