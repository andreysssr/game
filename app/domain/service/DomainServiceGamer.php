<?php

namespace app\domain\service;

use app\infrastructure\RepositoryGamerMemory;
use core\EventDispatcher\EventDispatcher;

class DomainServiceGamer
{
    private RepositoryGamerMemory $repositoryGamer;
    private EventDispatcher $dispatcher;

    public function __construct(RepositoryGamerMemory $repositoryGamer, EventDispatcher $dispatcher )
    {

        $this->repositoryGamer = $repositoryGamer;
        $this->dispatcher = $dispatcher;
    }
}
