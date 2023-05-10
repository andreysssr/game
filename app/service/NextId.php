<?php

namespace app\service;

class NextId
{
    public function __construct()
    {
    }

    public function getId()
    {
        return (int) microtime(true);
    }
}
