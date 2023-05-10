<?php

namespace core\EventDispatcher;

use core\EventManager\EventManager;

class EventDispatcher
{
    private EventManager $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function dispatch($arrayEvents){
        foreach ($arrayEvents as $k => $v){
            $this->eventManager->trigger($k, $v);
        }

        $arrayEvents = null;
    }
}
