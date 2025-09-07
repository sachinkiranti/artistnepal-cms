<?php

namespace Foundation\Builders\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kiranti\Config\Language;

/**
 * Class LanguageScope
 * @package Foundation\Builders\Scopes
 */
final class LanguageScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getTable().'.lang', Language::get(active_lang(), true));
    }

}
