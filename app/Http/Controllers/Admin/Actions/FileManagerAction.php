<?php

namespace App\Http\Controllers\Admin\Actions;

use Kiranti\Supports\BaseController;

/**
 * Class FileManagerAction
 * @package App\Http\Controllers\Admin\Actions
 */
final class FileManagerAction extends BaseController
{

    public function __invoke()
    {
        return view('admin.media.manager');
    }

}
