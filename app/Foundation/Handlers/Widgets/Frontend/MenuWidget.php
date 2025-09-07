<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Illuminate\Support\Collection;
use Foundation\Services\NavService;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class menuWidget
 * @package Foundation\Handlers\Widgets\Frontend
 */
final class MenuWidget extends BaseWidget
{

    /**
     * @var NavService
     */
    private $navService;

    /**
     * CategoryWiseWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        parent::__construct($properties);
        $this->navService = app(NavService::class);
    }

    /**
     * @inheritDoc
     */
    public function remember()
    {
        // TODO: Implement remember() method.
    }

    /**
     * @inheritDoc
     */
    public function toHtml()
    {
        // TODO: Implement toHtml() method.
    }
}
