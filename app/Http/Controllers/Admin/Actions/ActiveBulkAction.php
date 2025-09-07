<?php

namespace App\Http\Controllers\Admin\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Kiranti\Config\Status;
use Kiranti\Supports\BaseController;

class ActiveBulkAction extends BaseController
{
    public function __invoke(string $model, Request $request)
    {
        if (Schema::hasTable($model)) {
            app('db')
                ->table($model)
                ->whereIn('id', explode(',', $request->get('ids')))
                ->update([ 'status' => Status::ACTIVE_STATUS, ]);
            flash('success', 'Records are active successfully !');
        } else {
            flash('error', 'Records could not be active !');
        }
        return redirect()->back();
    }
}
