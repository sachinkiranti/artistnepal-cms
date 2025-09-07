<?php

namespace Foundation\Services;

use Foundation\Models\EmailPattern;
use Foundation\Models\EmailTemplate;
use Kiranti\Supports\BaseService;

/**
 * Class EmailPatternService
 * @package Foundation\Services
 */
class EmailPatternService extends BaseService
{

    /**
     * The EmailPattern instance
     *
     * @var $model
     */
    protected $model;

    /**
     * EmailPatternService constructor.
     * @param EmailPattern $emailPattern
     */
    public function __construct(EmailPattern $emailPattern)
    {
        $this->model = $emailPattern;
    }

    /**
     * Filter
     *
     * @param string|null $name
     * @return mixed
     */
    public function filter(string $name = null)
    {
        return $this->model
            ->where(function ($query) use ($name){
                if($name){
                    $query->where('name','like', '%'. $name .'%');
                }
            })
            ->latest();
    }

    /**
     * Get all the patterns
     *
     * @return mixed
     */
    public function getPatternsList()
    {
        return $this->model->pluck('name', 'slug')->toArray();
    }

    /**
     * Load Patterns for a Template
     *
     * @param EmailTemplate $template
     * @return mixed
     */
    public function loadPatternsForTemplate(EmailTemplate $template)
    {
        $data = $template->load('emailPatterns');
        return $data->emailPatterns()->pluck('name', 'slug')->toArray();
    }

}
