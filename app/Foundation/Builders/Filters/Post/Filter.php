<?php

namespace Foundation\Builders\Filters\Post;

use Foundation\Lib\PostType;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Kiranti\Config\Status;

/**
 * Class Filter
 * @package Foundation\Builders\Filters\post
 */
final class Filter
{

    public static function  apply(Builder $builder, array $data) {

        $builder = $builder->newQuery();

        if($value = Arr::get($data, 'search.value')) {
//            $builder = static::filterSearch($builder, $value);
            $builder->where('posts.title', $value);
        }

        if($identifier = Arr::get($data, 'filter.identifier')) {
            $builder->where('posts.unique_identifier', $identifier);
        }

        if($title = Arr::get($data, 'filter.title')) {
            $builder->where('posts.title', $title);
        }

//        if($content = Arr::get($data, 'filter.content')) {
//            $builder->where('content', 'like', '%' . $content . '%');
//        }

        if ($createdFrom = Arr::get($data,'filter.createdAt.from')) {
            $builder->whereDate('posts.created_at', '>=', $createdFrom);
        }

        if ($createdTo = Arr::get($data,'filter.createdAt.to')) {
            $builder->whereDate('posts.created_at', '<=', $createdTo);
        }

        if(!is_null($status = Arr::get($data, 'filter.status'))) {
            $builder->where('posts.status', $status);
        }

        if(!is_null($post_type = Arr::get($data, 'filter.post_type'))) {
            $builder->where('posts.post_type', $post_type);
        }

        if($createdBy = Arr::get($data, 'filter.CreatedBy')) {
            $builder->whereHas('user', function ($builder) use ($createdBy)
            {
                $builder->where('first_name', 'like', '%'. $createdBy . '%');
            });
        }

        if ($type = Arr::get($data, 'filter.type')) {
            $builder->where('posts.post_type', PostType::POST_TYPE_POST);

        }

        return $builder;
    }

    /**
     * @param $builder
     * @param $search
     * @return mixed
     */
    public static function filterSearch($builder, $search){
        $builder->orWhere('categories.category_name', 'like', '%' . $search . '%');

        $builder
            ->orWhereRaw(
                "CONCAT_WS(' ', users.first_name, users.middle_name, users.last_name) LIKE ? ", ['%'.$search.'%']);

        $builder->Orwhere(
            'users.first_name',
            'like',
            '%'.$search.'%'
        )
            ->orWhere(
                'users.middle_name',

                'like',
                '%'.$search.'%'
            )
            ->orWhere(
                'users.last_name',
                'like',
                '%'.$search.'%'
            );
        $builder->where('title', 'like', '%' . $search . '%');
        return $builder;
    }
}
