<?php

namespace app\service;

class CheckLinks
{
    public function __construct()
    {
    }

    public function check(array $currentLinks, array $linksToUrlStop):bool
    {
        return !empty(array_intersect($currentLinks, $linksToUrlStop));
    }
}
