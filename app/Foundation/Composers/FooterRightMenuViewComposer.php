<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Illuminate\View\View;
use Foundation\Services\NavService;

/**
 * Class FooterRightMenuViewComposer
 * @package Foundation\Composers
 */
final class FooterRightMenuViewComposer
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
        $view->with('rightFooterMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_RIGHT_FOOTER_MENU));
    }

}
