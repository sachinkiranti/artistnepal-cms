<?php

namespace Foundation\Builders\SubQueries;

use Foundation\Models\Category;

/**
 * Class CategoryQuery
 * @package Foundation\Builders\SubQueries
 */
final class CategoryQuery
{

    public static function parentCategory(Category $category)
    {
        return $category
            ->select('category_name')
            ->whereRaw('id = category.parent_id')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->getQuery();
    }

    public static function categoryName()
    {
        return Category::query()
            ->select(
                'category_name'
            )
            ->whereColumn('id', 'posts.category_id');
    }

}
