<?php

namespace Foundation\Handlers\Widgets\Frontend;

use Foundation\Builders\Cache\CategoryWise;
use Throwable;
use Foundation\Lib\Cache;
use Foundation\Lib\PostType;
use Foundation\Services\PostService;
use Foundation\Services\GalleryService;
use Foundation\Handlers\Widgets\BaseWidget;

/**
 * Class CategoryWiseWidget
 * @package App\Foundation\Handlers\Widgets\Frontend
 */
final class CategoryWiseWidget extends BaseWidget
{

    private $templates = [ 'gallery', 'breaking-news', 'trending-news', ];


    protected $no_of_rectangle_image;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var GalleryService
     */
    private $galleryService;

    /**
     * CategoryWiseWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        parent::__construct($properties);
        $this->postService = app(PostService::class);
        $this->galleryService = app(GalleryService::class);
    }

    /**
     * @inheritDoc
     */
    public function remember()
    {
        switch ($this->template) {

            case "gallery":
                $data = CategoryWise::gallery($this->widget_id, $this->limit);
                break;
            case "breaking-news":
                $data = CategoryWise::breakingNews($this->widget_id, $this->limit);
                break;
            case "trending-news":
                $data = CategoryWise::trendingNews($this->widget_id, $this->limit);
                break;
            case "bises-news":
                $data = CategoryWise::bisesNews($this->widget_id, $this->limit);
                break;
            case "pramukh-news":
                $data = CategoryWise::pramukhNews($this->widget_id, $this->limit);
                break;
            default:
                $data = CategoryWise::categories($this->widget_id, $this->limit, $this->category);

        }

        if ($this->post_type === 'bises') {
            $data = CategoryWise::bisesNews($this->widget_id, $this->limit);
        }

        return $data;
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function toHtml()
    {
        $data = [];

        $data['component'] = $this->component;

        $data['widget-identifier'] = $this->identifier;

        $data['widget'] = [
            'id'            => $this->widget_id,
            'title'         => $this->title,
            'desc'          => $this->description,
            'template'      => $this->template,
            'category'      => CategoryWise::getCategoryIdentifier($this->category),
            'limit'         => $this->limit,
            'advertisement' => $this->advertisement,
            'no_of_rectangle_image' => $this->no_of_rectangle_image ?? 1,
        ];

        $data['posts'] = $this->remember();
        return view($this->resolveViewPath(), compact('data'))->render();
    }
}
