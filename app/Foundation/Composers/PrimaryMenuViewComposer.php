<?php

namespace Foundation\Composers;

use Foundation\Lib\Nav;
use Illuminate\View\View;

/**
 * Class PrimaryMenuViewComposer
 * @package Foundation\Composers
 */
final class PrimaryMenuViewComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('primaryMenu', \Foundation\Builders\Cache\Nav::sectionWise(Nav::PRIMARY_MENU));
    }

}
