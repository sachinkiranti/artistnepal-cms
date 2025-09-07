<?php

namespace App\Http\Controllers\Admin\Actions;

use Kiranti\Config\Status;
use Kiranti\Config\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * Class CountAction
 * @package App\Http\Controllers\Admin\Actions
 */
class CountAction
{

    /**
     * Return the count of models by status
     *
     * @param Request $request
     * @param $model
     * @return mixed
     */
    public function __invoke(Request $request, $model)
    {
        $startDate = null;

        if( $type = $request->get('type') ){
            switch ($type){
                case 2:
                    $startDate =now()->startOfDay();
                    break;
                case 3:
                    $startDate =now()->startOfWeek();
                    break;
                case 4:
                    $startDate =now()->startOfMonth();
                    break;
                case 5:
                    $startDate =now()->startOfYear();
                    break;
                default:
                    $startDate = null;
            }
        }

        if (Schema::hasTable($model)){
            $query = app('db')
                ->table($model)
                ->selectRaw('count(*) as total')
                ->selectRaw("count(case when status = '".Status::ACTIVE_STATUS."' then 1 end) as active")
                ->selectRaw("count(case when status = '".Status::INACTIVE_STATUS."' then 1 end) as inactive");

            if (Schema::hasColumn($model, 'lang')) {
                $query->where('lang', Language::get(active_lang(), true));
            }

            if($startDate){
                $query->whereBetween('created_at', [ $startDate, now(), ]);
            }
            $all = $query->first();

            $data['status'] = (array) $all;
        } else {
            return 0;
        }

        return $data;
    }
}
