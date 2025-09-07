<?php

namespace Kiranti\Events;

use Foundation\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ViewsHandler
 * @package Kiranti\Events
 * https://stidges.com/implementing-a-page-view-counter-in-laravel
 */
final class ViewsHandler
{

    const ALREADY_VIEWED = 'already-viewed';

    private $key = null;

    /**
     * @var Session
     */
    private $session;

    /**
     * ViewsThrottle constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function handle(Model $model)
    {
        $this->setKey($model->getTable());

        $this->filter();

        if ( ! $this->isViewed($model))
        {
            $model->isVisiting();

            $this->store($model->id);
        }
    }

    private function isViewed($model)
    {
        $views = $this->session->get($this->getKey(), []);

        return in_array($model->id, $views);
    }

    /**
     * Set the prefix for the given key
     *
     * When we want to create different keys for different models ie for posts, categories, user profiles
     *
     * @param string|null $prefix
     */
    public function setKey(string $prefix = null)
    {
        $this->key = ($prefix ? $prefix.'-' : $prefix).static::ALREADY_VIEWED;
    }

    /**
     * Return key
     *
     * @return string|null
     */
    private function getKey()
    {
        return $this->key ?? static::ALREADY_VIEWED;
    }

    public function filter()
    {
        $views = (array) $this->get();

        if ( ! empty($views) ) {
//            $views = (array) $this->clearExpiredViews($views);

            $this->store($views);
        }
    }

    /**
     * Return the already viewed
     *
     * @return mixed
     */
    public function get()
    {
        return $this->session->get($this->getKey(), null);
    }

    /**
     * Store the given views
     *
     * @param $id
     */
    public function store($id)
    {
        $this->session->push($this->getKey(), $id);
    }

    /**
     * $throttleTime ie let the views expire after one hour
     *
     * Filter through the views array. The argument passed to the
     * function will be the value from the array, which is the timestamp in our case.
     *
     * if the view timestamp + the throttle time is still small than the current time, we want to keep it else expire it.
     *
     * @param $views
     * @return array
     */
    public function clearExpiredViews($views)
    {
        $time = time();

        $throttleTime = 3600;

        return array_filter($views, function ($timestamp) use ($time, $throttleTime) {
            return ($timestamp + $throttleTime) > $time;
        });
    }

}
