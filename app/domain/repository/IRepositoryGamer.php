<?php

namespace app\domain\repository;

interface IRepositoryGamer
{
    public function get($id);

    public function add($object): void;

    public function save($object): void;

    public function remove($object): void;
}
