<?php

namespace app\domain\repository;

use app\domain\entities\Game;

interface IRepositoryGame
{
    public function get($id);

    public function add(Game $game): void;

    public function save(Game $game): void;

    public function remove(Game $game): void;
}
