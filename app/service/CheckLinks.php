<?php

namespace app\service;

class CheckLinks
{
    public function __construct()
    {
    }

    public static function check(array $currentLinks, array $linksToUrlStop):bool
    {
        return !empty(array_intersect($currentLinks, $linksToUrlStop));
    }
}
