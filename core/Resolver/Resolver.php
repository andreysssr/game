<?php

namespace core\Resolver;

use core\Container\Container;

class Resolver
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolve($callback, $event, $params)
    {
        if (is_string($callback)){
            $handler = $this->container->get($callback);
        }

        if ($handler instanceof \Closure) {
            $handler( $event, $params = []);
        } else {
            $handler->handle($event, $params = []);
        }
    }
}
