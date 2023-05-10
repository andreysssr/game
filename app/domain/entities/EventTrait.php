<?php

namespace app\domain\entities;

trait EventTrait
{
    private $events = [];

    protected function registerEvent($event): void
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
