<?php

namespace core\App\Cli;

use app\domain\entities\Game;
use app\service\View;
use app\action\{RegisterGame, RunGame, RegisterGamers, ResultGame};

class Application
{
    private RegisterGame $registerGame;
    private RegisterGamers $registerGamers;
    private RunGame $runGame;
    private ResultGame $resultGame;
    private bool $run = true;
    private View $view;

    public function __construct(RegisterGame $registerGame, RegisterGamers $registerGamers, RunGame $runGame, ResultGame $resultGame, View $view,)
    {
        $this->registerGame = $registerGame;
        $this->registerGamers = $registerGamers;
        $this->runGame = $runGame;
        $this->resultGame = $resultGame;
        $this->view = $view;
    }

    public function stop():void
    {
        $this->run = false;
    }

    public function isRun():bool
    {
        return $this->run;
    }

    public function start():void
    {
        $game = $this->registerGame->handle($this);

        if ($this->isRun() and ($game instanceof Game)) {
            $this->registerGamers->handle($game, $this);
        }

        while ($this->isRun()) {
            if ($game->isActive()) {
                $this->runGame->handle($game, $this);
            } else {
                $this->stop();
            }
        }

        $this->resultGame->handle($game);
        $this->view->print(PHP_EOL .PHP_EOL . 'Игра окончена!' . PHP_EOL);
    }
}
