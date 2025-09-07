<?php

namespace Foundation\Services;

use Foundation\Models\EmailTemplate;
use Kiranti\Supports\BaseService;

/**
 * Class EmailTemplateService
 * @package Foundation\Services
 */
class EmailTemplateService extends BaseService
{

    /**
     * The EmailTemplate instance
     *
     * @var $model
     */
    protected $model;

    /**
     * EmailTemplateService constructor.
     * @param EmailTemplate $emailTemplate
     */
    public function __construct(EmailTemplate $emailTemplate)
    {
        $this->model = $emailTemplate;
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

}
