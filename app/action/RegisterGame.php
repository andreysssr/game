<?php

namespace app\action;

use app\domain\service\DomainServiceGame;
use app\service\NextId;
use core\EventManager\EventManager;

class RegisterGame
{
    private NextId $nextId;
    private DomainServiceGame $serviceGame;
    private EventManager $eventManager;

    public function __construct(NextId $nextId, DomainServiceGame $serviceGame, EventManager $eventManager)
    {
        $this->nextId = $nextId;
        $this->serviceGame = $serviceGame;
        $this->eventManager = $eventManager;
    }

    public function handle($event, $params = []){
        $run = true;
        while ($run){

            echo PHP_EOL;
            echo "Введите количество участников\nили 0 для выхода из игры: ";
            $input = trim(readline());

            if (is_numeric($input) and $input >= 0) {
                $run = false;
            }
        }

        $input = (int)$input;

        if ($input == 0){
            $this->eventManager->trigger('appStop');
        } else{
            $id = $this->nextId->getId();
            $this->serviceGame->create($id, $input);
        }
    }
}
