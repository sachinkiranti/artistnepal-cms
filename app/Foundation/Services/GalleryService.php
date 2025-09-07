<?php

namespace Foundation\Services;

use Illuminate\Support\Arr;
use Foundation\Models\Gallery;
use Kiranti\Supports\BaseService;

/**
 * Class GalleryService
 * @package Foundation\Services
 */
class GalleryService extends BaseService
{

    /**
     * The Gallery instance
     *
     * @var $model
     */
    protected $model;

    /**
     * GalleryService constructor.
     * @param Gallery $gallery
     */
    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }

    /**
     * Filter
     *
     * @param array|null $data
     * @return mixed
     */
    public function filter(array $data = null)
    {
        return $this->model
            ->select('galleries.*')
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('users as author', 'author.id', '=', 'galleries.created_by')
            ->where(function ($query) use ($data){
                if($name = Arr::get($data, 'name')){
                    $query->where('name','like', '%'. $name .'%');
                }
            })
            ->latest();
    }

    public function getPictures($id)
    {
        return app('db')
            ->table('gallery_image')
            ->where('gallery_id', $id)
            ->orderBy('id', 'DESC')
            ->get();
    }

}
