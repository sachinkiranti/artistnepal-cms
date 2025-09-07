<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Illuminate\Support\Arr;
use Throwable;
use Illuminate\Support\Collection;
use Foundation\Services\PostService;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class HtmlWidget
 * @package Foundation\Handlers\Widgets\Frontend
 */
final class HtmlWidget extends BaseWidget
{

    /**
     * @var PostService
     */
    private $postService;

    /**
     * CategoryWiseWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        parent::__construct($properties);
        $this->template = Arr::get($properties, 'identifier');
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
            'description'      => $this->description,
            'template'  => $this->template,
            'category'  => $this->category,
            'limit'     => $this->limit,
            'advertisement' => $this->advertisement,
        ];

        return view($this->resolveViewPath(), compact('data'))->render();
    }
}
