<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Illuminate\View\View;

/**
 * Class FooterMenuViewComposer
 * @package Foundation\Composers
 */
final class FooterMenuViewComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('footerMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_FOOTER_MENU));
    }

}
