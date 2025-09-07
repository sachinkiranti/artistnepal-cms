<?php

namespace Importer;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseImporter
 * @package Importer
 */
abstract class BaseImporter
{

    /**
     * The csv path
     *
     * @var $csv
     */
    protected $csv;

    /**
     * The Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * JsonImporter constructor.
     * @param string $csv
     * @param Model $model
     */
    public function __construct(string $csv, Model $model)
    {
        $this->csv   = $csv;
        $this->model = $model;
    }

    /**
     * Return path of the CSV
     *
     * @return string
     */
    public function csv()
    {
        return storage_path('data/csv/'. $this->csv);
    }

    /**
     * Importing To Database
     */
    public function import()
    {
        if (($handle = fopen ( $this->csv(), 'r' )) !== FALSE) {

            $i = 0;

            while ( ($data = fgetcsv ( $handle, 1000, ',', '"' )) !== FALSE ) {

                if ($i > 0) :

                try {
                    $this->insertData($data);
                } catch (\Exception $e){
                    logger()->info(
                        "While importing : " . $e->getMessage());
                }


                endif;

                $i++;
            }
            fclose ( $handle );
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertData(array $data)
    {
        return $this->model->create($data);
    }

}
