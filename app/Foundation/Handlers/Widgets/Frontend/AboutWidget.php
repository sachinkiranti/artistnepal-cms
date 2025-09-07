<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Throwable;
use Illuminate\Support\Collection;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class AboutWidget
 * @package Foundation\Handlers\Widgets\Frontend
 */
final class AboutWidget extends BaseWidget
{

    public function __construct(array $properties)
    {
        parent::__construct($properties);
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
     * @throws Throwable
     */
    public function toHtml()
    {
        $data           = [];

        $data['component'] = $this->component;

        $data['widget-identifier'] = $this->identifier;

        $data['widget'] = [
            'id'        => $this->widget_id,
            'title'     => $this->title,
            'desc'      => $this->description,
            'template'  => $this->template,
            'category'  => $this->category,
            'limit'     => $this->limit,
            'advertisement' => $this->advertisement,
        ];

        return view($this->resolveViewPath(), compact('data'))->render();
    }
}
