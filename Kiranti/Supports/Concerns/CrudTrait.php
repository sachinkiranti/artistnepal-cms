<?php

namespace Kiranti\Supports\Concerns;

use Foundation\Models\User;
use Kiranti\Config\Status;
use Kiranti\Config\Language;
use Illuminate\Support\Facades\Schema;

/**
 * Trait CrudTrait
 * @package Kiranti\Supports\Concerns
 */
trait CrudTrait
{

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @param array $search
     * @return mixed
     */
    public function createOrUpdate( array $data, array $search)
    {
        return $this->model->updateOrCreate(
            $search,
            $data
        );
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function new( array $data )
    {
        return $this->model->create( $data );
    }

    /**
     * @param array $data
     * @param $model
     * @return mixed
     */
    public function update( array $data, $model)
    {
        $instance = $model;
        $model->update( $data );
        return $instance;
    }

    /**
     * @param null $paginate
     * @return mixed
     */
    public function get( $paginate = null )
    {
        $that = $this->model;

        if (is_null($paginate)) {
            return $that->latest()
                ->get();
        }
        return $that->latest()->paginate($paginate);
    }

    /**
     * Return just count value
     *
     * @return mixed
     */
    public function getActive()
    {
        return $this->model->where('status', Status::ACTIVE_STATUS)->get();
    }


    /**
     * Here $data is new created record of that model
     * And $tags is single or multiple tag value
     *
     * @param $data
     * @param $tags
     * @return mixed
     */
    public function syncData($data,$tags)
    {
        return $data->tags()->sync((array) $tags);
    }

    /**
     * @param $model
     * @return bool
     */
    public function delete($model)
    {
        $model->delete();
        return true;
    }

    /**
     * Return the instance of the current model
     *
     * @return mixed
     */
    public function query()
    {
        return $this->model->query();
    }

    public function status()
    {
        $query = $this->model
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = '".Status::ACTIVE_STATUS."' then 1 end) as active")
            ->selectRaw("count(case when status = '".Status::INACTIVE_STATUS."' then 1 end) as inactive");

        if (Schema::hasColumn($this->model->getTable(), 'created_by')) {
            $query->when(!auth()->user()->hasAccess(), function ($query) {
                $query->where('created_by', auth()->id());
            });
        }
        if (Schema::hasColumn($this->model->getTable(), 'lang')) {
            $query->where('lang', Language::get(active_lang(), true));
        };
        return $query->first()->toArray();
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

}
