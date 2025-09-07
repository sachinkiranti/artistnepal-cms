<?php

namespace Foundation\Services;

use Foundation\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Kiranti\Config\Language;
use Kiranti\Config\Status;
use Kiranti\Supports\BaseService;

/**
 * Class TagService
 * @package Foundation\Services
 */
class TagService extends BaseService
{

    /**
     * The Tag instance
     *
     * @var $model
     */
    protected $model;

    /**
     * TagService constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Filter
     *
     * @param array|null $data
     * @return mixed
     */
    public function filter(array $data = null)
    {
        $title = Arr::get($data, 'filter.title');
        $description = Arr::get($data, 'filter.description');
        $search = Arr::get($data,'search.value');
        $status = Arr::get($data,'filter.status');
        $from = Arr::get($data,'filter.createdAt.from');
        $to = Arr::get($data,'filter.createdAt.to');

        return $this->model
            ->when($search, function ($query) use ($search) {
                $query->where('tag_name','like', '%'. $search .'%');
                $query->orwhere('description','like', '%'. $search .'%');
                $query->orwhere('status','like', '%'. $search .'%');
                $query->orwhere('created_at','like', '%'. $search .'%');
            })
            ->when($title, function ($query) use ($title){
                $query->where('tag_name','like', '%'. $title .'%');
            })
            ->when($description, function ($query) use ($description){
                $query->where('description','like', '%'. $description .'%');
            })
            ->when($from, function ($query) use ($from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query) use ($to){
                $query->whereDate('created_at', '<=', $to);
            })
            ->when($status, function ($query) use ($status){
                $query->where('status', $status);
            })
            ->where('tags.lang', Language::get(active_lang(), true))
            ->latest();
    }

    /**
     * @return mixed
     */
    public function tag()
    {
        return $this->model
            ->where('status', Status::ACTIVE_STATUS)
            ->where('tags.lang', Language::get(active_lang(), true))
            ->pluck('tag_name', 'id');
    }

    /**
     * @param $model
     * @param $type
     * @return \Illuminate\Support\Collection
     */
    public function modelByTagList($model,$type)
    {
        return DB::table('tags')
            ->select('tags.tag_name as tagName')
            ->join('taggables', 'taggables.tag_id','=', 'tags.id')
            ->join($model,$model.'.id', '=', 'taggables.taggable_id')
            ->where('taggables.taggable_type',$type)
            ->where('tags.lang', Language::get(active_lang(), true))
            ->groupBy('tags.id')
            ->get();
    }


}
