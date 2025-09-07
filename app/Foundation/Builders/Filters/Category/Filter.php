<?php

namespace Foundation\Builders\Filters\Category;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class Filter
 * @package Foundation\Builders\Filters\Category
 */
final class Filter
{

    public static function apply(Builder $builder, array $data)
    {
        $builder = $builder->newQuery();

        if($searchKey = Arr::get($data, 'search.value')){
            $builder->where('category.category_name', 'like', '%' . $searchKey . '%');
            $builder->orWhere('category.description','like', '%'. $searchKey .'%');
            $builder->orWhere('category.status','like', '%'. $searchKey .'%');
            $builder->orWhere('category.created_at','like', '%'. $searchKey .'%');
        }

        if ($identifier = Arr::get($data,'filter.identifier')) {
            $builder->where('category.unique_identifier', $identifier);
        }

        if ($type = Arr::get($data,'filter.type')) {
            $builder->where('category.type', $type);
        }

        if ($name = Arr::get($data, 'filter.name')) {
            $builder->where('category.category_name', 'like', '%' . $name . '%');
        }

        if ($description = Arr::get($data, 'filter.description')) {
            $builder->where('category.description', 'like', '%' . $description . '%');
        }

        if ($createdFrom = Arr::get($data,'filter.createdAt.from')) {
            $builder->whereDate('category.created_at', '>=', $createdFrom);
        }

        if ($createdTo = Arr::get($data,'filter.createdAt.to')) {
            $builder->whereDate('category.created_at', '<=', $createdTo);
        }

        if ($status = Arr::get($data,'filter.status')) {
            $builder->where('category.status', $status);
        }

        return $builder;
    }

}
