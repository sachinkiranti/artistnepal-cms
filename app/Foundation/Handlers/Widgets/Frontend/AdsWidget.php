<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Foundation\Services\PostService;
use Illuminate\Support\Collection;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class AdsWidget
 * @package Foundation\Handlers\Widgets\Frontend
 */
final class AdsWidget extends BaseWidget
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * AdsWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        parent::__construct($properties);
        $this->postService = app(PostService::class);
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
        $data           = [];
        $data['widget'] = [
            'id'        => $this->widgetId,
            'title'     => $this->title,
            'desc'      => $this->description,
            'template'  => $this->template,
        ];

        $data['posts'] = $this->remember();

        return view($this->resolveViewPath(), compact('data'))->render();
    }
}
