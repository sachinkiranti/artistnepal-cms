<?php

namespace App\Http\Controllers\Admin;

use Foundation\Lib\Category as CategoryType;
use Exception;
use Foundation\Services\TagService;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Foundation\Models\Category;
use Kiranti\Supports\BaseController;
use Foundation\Requests\Category\{
    StoreRequest,
    UpdateRequest
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\CategoryService;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends BaseController
{

    /**
     * The CategoryService instance
     *
     * @var $categoryService
     */
    private $categoryService;

    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(
        CategoryService $categoryService,
        TagService $tagService
    )
    {
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
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
        if ($request->ajax()) {
            return datatables()
                ->of($this->categoryService->filter($request->only(
                    'filter',
                    'search.value'
                )))
                ->addColumn('category_name', function ($data) {
                    return $data->category_tree ?? $data->category_name;
                })
                ->addColumn('created_at', function ($data) {
                    return view('admin.common.created-at',compact('data'))->render();
                })
                ->addColumn('action', function ($data) {
                    $model = 'category';
                    return view('admin.common.data-table-action', compact('data', 'model'))->render();
                })
                ->addColumn('description', function ($data) {
                    return view('admin.common.description', compact('data'))->render();
                })
                ->addColumn('status', function ($data) {
                     return view('admin.common.status', compact('data'))->render();
                })
                ->addColumn('checkbox', function ($data) {
                    return view('admin.common.checkbox', compact('data'))->render();
                })
                ->rawColumns(['description','checkbox', 'status', 'action', 'created_at'])
                ->make(true);
        }

        $data['status'] = $this->categoryService->status();

        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory
     */
    public function create()
    {
        $data = [];
        $data['parents'] = $this->categoryService->getParents()->pluck('category_name','id');

        return view('admin.category.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $parent_id = $request->get('child-category') ?? $request->get('parent_id') ?? 0;
        $this->categoryService->new($request->merge([
            'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
            'slug' => Str::slug($request->get('slug')),
            'parent_id' => $parent_id,
            'created_by' => auth()->id(),
            'type' => CategoryType::TYPE_GENERAL_CATEGORY,
        ])->all());
        flash('success', 'Record successfully created.');
        return $this->redirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Factory
     */
    public function show($id)
    {
        $data = [];
        $data['category'] = $this->categoryService->getCategoryDetails($id);

        if (is_null($data['category'])) { abort(404); }

        $data['parents'] = $this->categoryService->getParentTree($id);
        return view('admin.category.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Factory
     */
    public function edit(Category $category)
    {
        $data = [];
        $data['category']  = $category;
        $data['parents'] = $this->categoryService->getParents(CategoryType::TYPE_GENERAL_CATEGORY)->pluck('category_name','id');
        return view('admin.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Category $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $parent_id = $request->get('child-category') ?? $request->get('parent_id') ?? 0;
        $this->categoryService->update($request->merge([
            'parent_id' => $parent_id,
            'created_by' => auth()->id(),
            'slug' => Str::slug($request->get('slug')),
        ])->all(), $category);
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
         $this->categoryService->delete($category);
         flash('success', 'Category is deleted successfully !');
         return redirect('admin/category');
    }

    public function summary()
    {
        $table = 'categories';
        $type = 'category';
        $data['tagCount'] = $this->tagService->getCount();
        $data['categoryCount'] = $this->categoryService->getCount();
        $data['modelByTagList'] = $this->tagService->modelByTagList($table,$type);
        return view('admin.category.summary', compact('data'));
    }
}
