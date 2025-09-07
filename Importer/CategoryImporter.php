<?php

namespace Importer;

use Foundation\Lib\Category as CategoryType;
use Foundation\Models\Category;
use Foundation\Models\User;
use Foundation\Services\CategoryService;

/**
 * Class CategoryImporter
 * @package Importer
 */
final class CategoryImporter extends BaseImporter
{

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryImporter constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct( CategoryService $categoryService )
    {
        parent::__construct('categories.csv', new Category());
        $this->categoryService = $categoryService;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertData(array $data)
    {
        if (is_null($this->model->where('category_name', $data[8] ?? '')->first())) :
            try {
                app('db')->table('categories')
                    ->insert([
                        'id' => $data[0],
                        'unique_identifier' => \Foundation\Lib\Utility::randomNumber(),
                        'slug' => $data[9],
                        'parent_id' => 0,
                        'created_by' => 1,
                        'category_name'        => $data[8],
                        'description' => sprintf('All news about %s', $data[8]),
                        'status'      => 1,
//                    'metas'       => [
//                        'seo_title'       =>  $data[12],
//                        'seo_description' =>  $data[14],
//                        'seo_keywords'    =>  $data[13],
//                    ],
                        'created_at'  => $data[16]
                    ]);
        } catch (\Exception $exception) {
                dd($exception->getMessage());
            }


        endif;
    }

}
