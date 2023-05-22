<?php

namespace app\action;

use app\service\IO;
use app\service\View;

class RunGame
{
    private View $view;
    private IO $io;

    public function __construct(View $view, IO $io)
    {
        $this->view = $view;
        $this->io = $io;
    }

    public function handle($game, $app): mixed
    {
        $property = $game->getNewStepProperty();

        if (empty($property['listUrl'])){
            $this->view->print([
                PHP_EOL . "------------------------------" . PHP_EOL,
                "Из игры выбыл игрок - " . $property['name'] . PHP_EOL . PHP_EOL,
                "Закончились ходы, переход хода."
            ]);

            $game->stopPlayGamer($property['id']);

            return false;
        }

        $this->view->print([
            PHP_EOL . "------------------------------" . PHP_EOL,
            "Ход делает - " . $property['name'] . PHP_EOL . PHP_EOL,
            "Финишная страница: " . $property['urlStop'] . PHP_EOL,
        ]);

        foreach ($property['listUrl'] as $key => $val) {
            $this->view->print($key + 1 . ') ' . $val . PHP_EOL);
        }

        $input = $this->io->getNumberPositiveOrZero(PHP_EOL . "Выберите номер страницы\nили 0 для выхода из игры: " . PHP_EOL);

        while ($input > count($property['listUrl'])) {
            $input = $this->io->getNumberPositiveOrZero(PHP_EOL . "Выберите номер страницы\nили 0 для выхода из игры: " . PHP_EOL);
        }

        if ($input === 0) {
            $app->stop();
        }else{
            $game->setStepProperty([
                'id' => $property['id'],
                'urlSelected' => $property['listUrl'][$input - 1],
                'listUrl' => $property['listUrl'],
            ]);
        }

        return false;
    }
}
