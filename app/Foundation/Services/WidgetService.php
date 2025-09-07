<?php

namespace Foundation\Services;

use Exception;
use Foundation\Builders\Cache\Meta;
use Kiranti\Lib\Kiranti;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Foundation\Models\Setting;
use Illuminate\Support\Collection;
use Foundation\Lib\Setting as Option;
use Illuminate\Contracts\Config\Repository;

/**
 * Class WidgetService
 * @package Foundation\Services
 */
final class WidgetService
{

    /**
     * @var Setting
     */
    private $setting;

    /**
     * @var Repository
     */
    private $config;

    private $fillable = [
        'component', 'description', 'entity', 'icon', 'identifier',
        'pagination', 'title', 'widget_id', 'entity-sub-rules', 'no_of_rectangle_image',
        'category', 'template', 'limit', 'menu', 'priority', 'advertisement', 'ad-image', 'expired_at', 'type', 'ad_url',
    ];

    /**
     * WidgetService constructor.
     * @param Setting $setting
     * @param Repository $config
     */
    public function __construct(
        Setting $setting,
        Repository $config
    )
    {
        $this->setting = $setting;
        $this->config = $config;
    }

    /**
     * @param string $type
     * @return Collection
     * @throws Exception
     */
    public function getComponentsByType(string $type)
    {
        return $this->getComponents()->filter(function ($component, $key) use ($type) {
            return isset($component['type']) && $component['type'] === $type && isset($component['is_enabled']) && $component['is_enabled'] == 1;
        });
    }

    /**
     * @param array $params
     * @return bool
     * @throws Exception
     */
    public function insert(array $params)
    {
        $widget = $this->findComponent($params['component'] ?? '', false);

        if ($widget) {
            $merged = array_replace_recursive(json_decode($widget->value, true) ?? [], [
                $params['widget_id'] => Arr::only($params, $this->fillable),
            ]);

            if (isset($merged[$params['widget_id']]['advertisement'], $params['advertisement'])) {
                $merged[$params['widget_id']]['advertisement'] = $params['advertisement'];
            }
            $widget
                ->update([
                    'value' => json_encode($merged)
                ]);
        } else {
            $componentName = $this->getPrefixForComponent() . $params['component'];

            $this->setting->create([
                'key' => $componentName,
                'value' => json_encode([
                    $params['widget_id'] => Arr::only($params, $this->fillable),
                ]),
            ]);
        }

        return true;
    }

    /**
     * Update the widget
     *
     * @param string $widgetId
     * @param string $componentName
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function update(string $widgetId, string $componentName, array $data)
    {
        $widget = $this->findComponent($componentName);

        if  (array_key_exists($widgetId, optional($widget)->value)) {
            return $widget->update([
                'value' => array_merge($widget->value, [
                    $widget->value[$widgetId] => array_merge($widget->value[$widgetId], $data)
                ]),
            ]);
        }
    }

    /**
     * Return the widget
     *
     * @param string $widgetName
     * @param string $componentName
     * @param string|null $getByKey
     * @return mixed
     * @throws Exception
     */
    public function find(string $widgetName, string $componentName, string $getByKey = null)
    {
        $widget = $this->findComponent($componentName);

        $widgetData = json_decode(optional($widget)->value, 1);

        if ( isset($widgetData) && array_key_exists($widgetName, $widgetData) ) {
            return $widgetData[$widgetName][$getByKey] ?? $widgetData[$widgetName];
        }

        abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Delete the widget
     *
     * @param string $widgetName
     * @param string $componentName
     * @return mixed
     * @throws Exception
     */
    public function delete(string $widgetName, string $componentName)
    {
        $widget = $this->findComponent($componentName);
        $widgetData = json_decode(optional($widget)->value, 1);
        if ( array_key_exists($widgetName, $widgetData) ) {
            return $widget->update([
                'value' => json_encode(Arr::except($widgetData, $widgetName))
            ]);
        }

        abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Return widgets for given component name
     *
     * @param string $componentName
     * @return mixed
     * @throws Exception
     */
    public function getWidgetsByComponent(string $componentName)
    {
        return json_decode($this->findComponent($componentName)->value);
    }

    /**
     * Return the component
     *
     * @param string $componentName
     * @param bool $fail
     * @return mixed
     * @throws Exception
     */
    public function findComponent(string $componentName, bool $fail = true)
    {
        $componentName = $this->getPrefixForComponent() . $componentName;

        $component = Meta::first($componentName);

        if ($fail) {
            return $component ?? $this->setting->where('key', $componentName)->firstOrFail();
        }

        return $component ?? $this->setting->where('key', $componentName)->first();
    }

    /**
     * @param string $componentName
     * @return mixed|void
     * @throws Exception
     */
    public function findComponentByName(string $componentName)
    {
        return $this->getComponents()[$componentName] ?? abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function getByWidgetType(string $type = Kiranti::FRONTEND_TYPE)
    {
        return $this->get()->filter(function ($widget) use ($type) {
            return $widget['type'] === $type;
        });
    }

    /**
     * Return widgets
     *
     * @return mixed
     */
    public function get()
    {
        return Collection::make(json_decode($this->setting->where('key', Option::WIDGET_META_KEY)->value('value'), 1));
    }

    /**
     * Return components
     *
     * @return Collection
     * @throws Exception
     */
    public function getComponents()
    {
        $key = (active_lang() === 'en' ? 'en-' : '').Option::COMPONENT_META_KEY;
        return Collection::make(json_decode(
            Meta::get($key),
            1)
        );
    }

    /**
     * Return entities
     *
     * @return array|null
     */
    public function getEntities()
    {
        return $this->retrieve('data.entry');
    }

    /**
     * Return aggregates
     *
     * @return array|null
     */
    public function getAggregates()
    {
        return $this->retrieve('data.aggregates');
    }

    /**
     * Return templates
     *
     * @return array|null
     */
    public function getTemplates()
    {
        return $this->retrieve('data.templates');
    }

    /**
     * Return limits
     *
     * @return array|null
     */
    public function getLimits()
    {
        return array_combine(range(1,20), range(1,20));
    }

    /**
     * Return Widget Prefix
     *
     * @return string|null
     */
    public function getPrefixForWidget()
    {
        return $this->retrieve('prefixes.widget');
    }

    /**
     * Return Component Prefix
     *
     * @return string|null
     */
    public function getPrefixForComponent()
    {
        return $this->retrieve('prefixes.component');
    }

    /**
     * Retrieve the meta from config
     *
     * @param string $meta
     * @return mixed
     */
    private function retrieve(string $meta)
    {
        return Arr::get($this->config->get('widgets'), $meta);
    }

}
