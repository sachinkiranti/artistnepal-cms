<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Illuminate\View\View;

/**
 * Class MobileMenuViewComposer
 * @package Foundation\Composers
 */
final readonly class MobileMenuViewComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('mobileMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_MOBILE_MENU));
    }

}
