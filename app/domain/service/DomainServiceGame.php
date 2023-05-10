<?php

namespace app\domain\service;

use app\domain\entities\Game;
use app\infrastructure\RepositoryGameMemory;
use app\service\CheckLinks;
use app\service\WikiApi;
use core\Container\Container;
use core\EventDispatcher\EventDispatcher;

class DomainServiceGame
{
    private RepositoryGameMemory $repositoryGame;
    private EventDispatcher $dispatcher;
    private Container $container;
//    private Wiki $wiki;
//    private CheckLinks $checkLinks;

    public function __construct(Container $container, RepositoryGameMemory $repositoryGame, EventDispatcher $dispatcher)
    {
        $this->repositoryGame = $repositoryGame;
        $this->dispatcher = $dispatcher;
        $this->container = $container;
//        $this->wiki = $wiki;
//        $this->checkLinks = $checkLinks;
    }

    public function create($nextId, $countGamers): void
    {
//        $game = new Game($nextId, $countGamers, $this->container->get(Wiki::class), $this->container->get(CheckLinks::class));
        $game = new Game($nextId, $countGamers, $this->container->get(WikiApi::class), $this->container->get(CheckLinks::class));

//        $this->repositoryGame->add($game);
//        $this->dispatcher->dispatch($game->releaseEvents());
    }
}
