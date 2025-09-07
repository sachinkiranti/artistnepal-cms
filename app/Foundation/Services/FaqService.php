<?php

namespace Foundation\Services;

use Foundation\Models\Faq;
use Illuminate\Support\Arr;
use Kiranti\Config\Language;
use Kiranti\Supports\BaseService;

/**
 * Class FaqService
 * @package Foundation\Services
 */
class FaqService extends BaseService
{

    /**
     * The Faq instance
     *
     * @var $model
     */
    protected $model;

    /**
     * FaqService constructor.
     * @param Faq $faq
     */
    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }

    /**
     * Filter
     *
     * @param array|null $data
     * @return mixed
     */
    public function filter(array $data = null)
    {
        $title = Arr::get($data,'filter.title');
        $body = Arr::get($data,'filter.body');
        $search = Arr::get($data,'search.value');
        $status = Arr::get($data,'filter.status');
        $from = Arr::get($data,'filter.createdAt.from');
        $to = Arr::get($data,'filter.createdAt.to');

        return $this->model
            ->where(function ($query) use ($search){
                if($search){
                    $query->where('faq_name','like', '%'. $search .'%');
                    $query->where('body','like', '%'. $search .'%');
                    $query->where('status','like', '%'. $search .'%');
                }
            })
            ->where(function ($query) use ($title){
                if($title){
                    $query->where('faq_name','like', '%'. $title .'%');
                }
            })
            ->where(function ($query) use ($body){
                if($body){
                    $query->where('body','like', '%'. $body .'%');
                }
            })
            ->where(function ($query) use ($from){
                if($from){
                    $query->whereDate('created_at', '>=', $from);
                }
            })
            ->where(function ($query) use ($to){
                if($to){
                    $query->whereDate('created_at', '<=', $to);
                }
            })
            ->where(function ($query) use ($status){
                if($status != null){
                    $query->where('status', $status);
                }
            })
            ->where('lang', Language::get(active_lang(), true))
            ->latest();
    }

}
