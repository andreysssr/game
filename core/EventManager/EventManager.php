<?php

namespace core\EventManager;

use core\Container\Container;
use core\Resolver\Resolver;

class EventManager
{
    private $events = [];
    private $resolver;

    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function attach($eventType, $callback)
    {
        if (!isset($this->events[$eventType])) {
            $this->events[$eventType] = [];
        }

        $this->events[$eventType][] = $callback;

        return $this;
    }

    public function trigger($event, $params = [])
    {
        foreach ($this->getEvents($event) as $callback) {
            $this->resolver->resolve($callback, $event, $params);
        }

        return $this;
    }

    public function getEvents($eventType)
    {
        if (isset($this->events[$eventType])) {
            return $this->events[$eventType];
        }

        return [];
    }
}
