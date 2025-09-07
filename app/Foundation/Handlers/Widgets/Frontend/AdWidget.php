<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Illuminate\Support\Collection;
use Foundation\Services\PostService;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class AdWidget
 * @package Foundation\Handlers\Widgets\Frontend
 */
final class AdWidget extends BaseWidget
{

    /**
     * @var PostService
     */
    private $postService;

    private $widgetProps;

    /**
     * AdsWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        parent::__construct($properties);
        $this->postService = app(PostService::class);
        $this->widgetProps = $properties;
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

        $data['component'] = $this->component;

        $data['widget-identifier'] = $this->identifier;

        $data['widget'] = [
            'id'            => $this->widget_id,
            'title'         => $this->title,
            'advertisement' => asset($this->widgetProps['ad-image'] ?? ''),
            'expired'       => $this->widgetProps['expired_at'] ?? '',
            'type'          => $this->widgetProps['type'] ?? '',
            'url'           => $this->widgetProps['ad_url'] ?? '',
        ];
        $this->template = $this->template ?? 'ad';
        return view($this->resolveViewPath(), compact('data'))->render();
    }
}
