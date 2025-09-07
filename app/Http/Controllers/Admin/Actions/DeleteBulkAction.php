<?php

namespace App\Http\Controllers\Admin\Actions;

use Foundation\Lib\Cache;
use Illuminate\Http\Request;
use Kiranti\Supports\BaseController;
use Illuminate\Support\Facades\Schema;

/**
 * Class BulkAction
 * @package App\Http\Controllers\Admin\Actions
 */
class DeleteBulkAction extends BaseController
{

    public function __invoke(string $model, Request $request)
    {
        if (Schema::hasTable($model)) {
            app('db')
                ->table($model)
                ->whereIn('id', explode(',', $request->get('ids')))
                ->delete();
            Cache::clear();
            flash('success', 'Records are deleted successfully !');
        } else {
            flash('error', 'Records could not be deleted !');
        }

        return redirect()->back();
    }

}
