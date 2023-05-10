<?php

namespace app\infrastructure;

use app\domain\entities\Game;
use app\domain\repository\IRepositoryGame;

class RepositoryGameMemory implements IRepositoryGame
{

    public function __construct(){}

    private $items = [];

    public function get($id)
    {
        if (!isset($this->items[$id])) {
//            throw new \NotFoundException('Game not found.');
        }
        return clone $this->items[$id];
    }

    public function add(Game $game): void
    {
        $this->items[$game->getId()] = $game;
    }

    public function save(Game $game): void
    {
        $this->items[$game->getId()] = $game;
    }

    public function remove(Game $game): void
    {
        if ($this->items[$game->getId()]) {
            unset($this->items[$game->getId()]);
        }
    }
}
