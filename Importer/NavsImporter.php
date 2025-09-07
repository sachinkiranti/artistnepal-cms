<?php

namespace Importer;

use Foundation\Models\Nav;
use Illuminate\Support\Facades\DB;

/**
 * Class NavsImporter
 * @package Importer
 */
final class NavsImporter extends BaseImporter
{

    /**
     * PostImporter constructor.
     */
    public function __construct()
    {
        parent::__construct('navs.csv', new Nav());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertData(array $data)
    {
        if (is_null($this->model->where('label', $data[4] ?? '')->first())) :

            try {
                DB::table('navs')
                    ->insert([
                        'parent_id'   => $data[1],
                        'section'     => $data[2],
                        'nav_li_type' => $data[3],
                        'label'       => $data[4],
                        'value'       => $data[5],
                        'sort'        => $data[6],
                        'class'       => $data[7],
                        'target'      => $data[8],
                        'icon'        => $data[9],
                    ]);
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }

        endif;
    }

}
