<?php

namespace Foundation\Services;

use Kiranti\Config\Language;
use Kiranti\Config\Status;
use Foundation\Models\Category;
use Kiranti\Supports\BaseService;
use Foundation\Builders\Filters\Category\Filter;

/**
 * Class CategoryService
 * @package Foundation\Services
 */
class CategoryService extends BaseService
{

    /**
     * The Category instance
     *
     * @var $model
     */
    protected $model;

    /**
     * CategoryService constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Filter
     *
     * @param array|null $data
     * @return mixed
     */
    public function filter(array $data)
    {
        return Filter::apply(
            $this->model
                ->from('categories as category')
                ->select('category.*')
                ->addSelect([
                    'category_tree' => app('db')
                        ->table('categories as parent')
                        ->selectRaw('CONCAT(category_name, " | ",category.category_name) AS parent_name')
                        ->whereColumn('parent.id', 'category.parent_id')
                ])
            , $data)
            ->where('category.lang', Language::get(active_lang(), true))
            ->latest();
    }

    /**
     * Return parent categories
     *
     * [ 'parent_id' === 0 ]
     *
     * @param $id
     * @return mixed
     */
    public function getParents($id = null)
    {
        return $this->model->where([
                ['parent_id', 0],
                ['id', '!=', $id],
                ['status', Status::ACTIVE_STATUS],
            ])
            ->where('categories.lang', Language::get(active_lang(), true))
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryDetails($id)
    {
        return $this->model->where('id',$id)->withCount('posts')->with('user:id,first_name,middle_name,last_name')->first();
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->model
            ->from('categories as category')
            ->select('category.*')
            ->addSelect([
                'category_tree' => app('db')
                    ->table('categories as parent')
                    ->selectRaw('CONCAT(category_name, " | ",category.category_name) AS parent_name')
                    ->whereColumn('parent.id', 'category.parent_id')
            ])
            ->where('status', Status::ACTIVE_STATUS)
            ->where('category.lang', Language::get(active_lang(), true))
            ->get()->map(function ($data) {
                return [
                    'category_id' => $data->id,
                    'category_name' => $data->category_tree ?? $data->category_name,
                ];
            })->pluck('category_name', 'category_id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChild($id)
    {
        return $this->model->where([
                'status' => Status::ACTIVE_STATUS,
                'parent_id' => $id,
            ])
            ->where('categories.lang', Language::get(active_lang(), true))
            ->pluck('category_name', 'id');
    }

    /**
     * Return category tree for given category id
     *
     * @param int $categoryId
     * @return mixed
     */
    public function getParentTree(int $categoryId)
    {
        return $this->model
            ->select('id', 'parent_id', 'category_name')
            ->where('id', $categoryId)
            ->where('categories.lang', Language::get(active_lang(), true))
            ->get();
    }

    public function getTree($limit)
    {
        return $this->model
            ->from('categories as category')
            ->select('category.*')
            ->addSelect([
                'category_full_name' => app('db')
                    ->table('categories as parent')
                    ->selectRaw('CONCAT(parent.category_name, " | ",category.category_name) AS parent_name')
                    ->whereColumn('parent.id', 'category.parent_id')
            ])
            ->orderBy('category.id', 'DESC')
            ->limit($limit)
            ->where('category.lang', Language::get(active_lang(), true))
            ->get();
    }

    public function byIdentifier(string $identifier)
    {
        return $this->model
            ->select('categories.*')
            ->addSelect([
                'category_full_name' => app('db')
                    ->table('categories as parent')
                    ->selectRaw('CONCAT(parent.category_name, " | ",categories.category_name) AS parent_name')
                    ->whereColumn('parent.id', 'categories.parent_id')
            ])
            ->withCount('posts') // posts_count
            ->where('categories.unique_identifier', $identifier)
            ->firstOrFail();
    }

    public function bySlug(string $slug)
    {
        return $this->model
            ->select('categories.*')
//            ->addSelect([
//                'category_full_name' => app('db')
//                    ->table('categories as parent')
//                    ->selectRaw('CONCAT(parent.category_name, " | ",categories.category_name) AS parent_name')
//                    ->whereColumn('parent.id', 'categories.parent_id')
//            ])
            ->withCount('posts') // posts_count
            ->where('categories.unique_identifier', $slug)
            ->firstOrFail();
    }
}
