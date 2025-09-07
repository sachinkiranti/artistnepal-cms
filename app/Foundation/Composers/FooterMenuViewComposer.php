<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Foundation\Lib\Cache;
use Illuminate\View\View;
use Foundation\Services\NavService;

/**
 * Class FooterMenuViewComposer
 * @package Foundation\Composers
 */
final class FooterMenuViewComposer
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
        $view->with('footerMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_FOOTER_MENU));
    }

}
