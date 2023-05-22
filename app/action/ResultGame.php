<?php

namespace app\action;

use app\service\IO;
use app\service\View;

class ResultGame
{
    private View $view;
    private IO $io;

    public function __construct(View $view, IO $io)
    {
        $this->view = $view;
        $this->io = $io;
    }

    public function handle($game): void
    {
        $result = $game->getResultGame();

        $this->view->print(PHP_EOL . "------------------------------");
        $this->view->print(PHP_EOL . "Результаты игры: " . PHP_EOL . PHP_EOL);

        $this->view->printTable([
            'header' => [
                'Имя игрока',
                'Финишировал',
                'Сделанных ходов',
                'Минимальных ходов'
            ],

            'table' => $result,
        ]);
    }
}
