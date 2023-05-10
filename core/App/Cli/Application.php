<?php

namespace core\App\Cli;

use core\EventManager\EventManager;

class Application
{
    private bool $run = true;
    private $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function attach($event, $listeners){
        $this->eventManager->attach($event, $listeners);
    }

    public function trigger($event, $params = []){
        $this->eventManager->trigger($event, $params = []);
    }

    public function start(): void
    {
        $this->trigger("appStar");
        $this->play();
        $this->stop();
    }

    private function play(): void
    {
        $count = 0;

        while ($this->run){
            $this->trigger("appRun");

            $count >= 3 ? $this->run = false : $count++;
        }
    }

    public function stop(){
        $this->run = false;
        $this->trigger("appStop");
    }
}
