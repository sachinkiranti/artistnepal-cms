<?php

namespace Importer;

use Foundation\Models\Setting;
use Illuminate\Support\Facades\DB;

final class SettingImporter extends BaseImporter
{

    /**
     * PostImporter constructor.
     */
    public function __construct()
    {
        parent::__construct('settings.csv', new Setting());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertData(array $data)
    {dd($data);
        if (is_null($this->model->where('key', $data[1] ?? '')->first())) :

            try {
                DB::table('settings')
                    ->insert([
                        'key' => $data[1],
                        'value' => $data[2]
                    ]);
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }

        endif;
    }

}
