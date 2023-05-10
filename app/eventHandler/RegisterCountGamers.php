<?php

namespace app\eventHandler;

use app\domain\service\DomainServiceGame;
use app\domain\service\DomainServiceGamer;

class RegisterCountGamers
{

    private DomainServiceGame $serviceGame;
    private DomainServiceGamer $serviceGamer;

    public function __construct(DomainServiceGame $serviceGame, DomainServiceGamer $serviceGamer)
    {

        $this->serviceGame = $serviceGame;
        $this->serviceGamer = $serviceGamer;
    }
}
