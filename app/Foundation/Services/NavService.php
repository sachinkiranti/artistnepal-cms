<?php

namespace Foundation\Services;

use Foundation\Models\Nav;
use Kiranti\Config\Language;
use Kiranti\Supports\BaseService;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class NavService
 * @package Foundation\Services
 */
final class NavService extends BaseService
{

    /**
     * The Faq instance
     *
     * @var $model
     */
    protected $model;

    /**
     * FaqService constructor.
     * @param Nav $nav
     */
    public function __construct(Nav $nav)
    {
        $this->model = $nav;
    }

    /**
     * @param $section
     * @return Builder|Collection
     */
    public function bySection($section)
    {
        return \Foundation\Builders\Cache\Nav::sectionWise($section);
    }

}
