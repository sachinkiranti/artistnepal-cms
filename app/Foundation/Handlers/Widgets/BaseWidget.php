<?php

namespace Foundation\Handlers\Widgets;

use Illuminate\Support\Collection;
use Foundation\Services\SettingService;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Class BaseWidget
 * @package Foundation\Handlers\Widgets
 */
abstract class BaseWidget implements Htmlable
{

    /**
     * @var SettingService
     */
    protected $settingService;

    protected $identifier;

    protected $component;

    protected $widget_id;

    protected $title;

    protected $template;

    protected $category;

    protected $limit;

    protected $description;

    protected $advertisement;

    protected $post_type = null;

    /**
     * BaseWidget constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->setProperties($properties);
        $this->settingService = app(SettingService::class);
    }

    /**
     * Set the properties
     *
     * @param array $properties
     */
    protected function setProperties(array $properties)
    {
        foreach ($properties as $key => $value) {
            if ( property_exists( $this, $key )) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return string
     */
    protected function resolveViewPath()
    {
        return 'pages.widgets.templates.'.$this->template;
    }

    /**
     * Cache the widget data
     *
     * @return Collection
     */
    abstract public function remember();

}
