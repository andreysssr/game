<?php

namespace app\action;

use app\domain\entities\Game;
use app\service\IO;
use app\service\View;

class RegisterGame
{
    private $view;
    private $io;
    private Game $game;

    public function __construct(View $view, IO $io, Game $game)
    {
        $this->view = $view;
        $this->io = $io;
        $this->game = $game;
    }

    public function handle($app): mixed
    {
        $input = $this->io->getNumberPositiveOrZero(PHP_EOL . "Введите количество участников\nили 0 для выхода из игры: ");

        if ($input === 0) {
            $app->stop();
            return false;
        }

        $this->game->setGamers($input);
        return $this->game;
    }
}
