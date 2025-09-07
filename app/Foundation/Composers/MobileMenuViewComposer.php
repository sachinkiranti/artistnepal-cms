<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Foundation\Lib\Cache;
use Illuminate\View\View;
use Foundation\Services\NavService;

/**
 * Class MobileMenuViewComposer
 * @package Foundation\Composers
 */
final class MobileMenuViewComposer
{

    /**
     * @var NavService
     */
    private $navService;

    /**
     * PrimaryMenuViewComposer constructor.
     * @param NavService $navService
     */
    public function __construct( NavService $navService )
    {
        $this->navService = $navService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('mobileMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_MOBILE_MENU));
    }

}
