<?php

namespace app\action;

use app\domain\entities\Gamer;
use app\service\IO;
use app\service\View;
use app\service\Wiki;

class RegisterGamers
{
    private View $view;
    private IO $io;
    private Wiki $wiki;

    public function __construct(View $view, IO $io, Wiki $wiki)
    {
        $this->view = $view;
        $this->io = $io;
        $this->wiki = $wiki;
    }

    public function handle($game, $app): void
    {
        while ($game->alloweRegisterGamer()){
            $input = $this->io->getInput(PHP_EOL . "Введите имя игрока\nили 0 для выхода из игры: ");

            if ($input == 0)
            {
                $app->stop();
                break;
            }

            $urlsRandom = $this->wiki->getRandomPage();
            $urls['start'] = $urlsRandom[0];
            $urls['stop'] = $urlsRandom[1];

            $game->addGamers(new Gamer($input, $urls, $this->wiki->getLinksToPage($urls['stop'])));
        }
    }
}
