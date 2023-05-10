<?php

namespace app\service;

use core\Container\Container;
use core\EventManager\EventManager;

class WikiApi
{
    private array $config;

    public function __construct(Container $container, EventManager $eventManager)
    {
//        $this->config = $container->get('config')['wiki'];
    }

    public function getRandomPage()
    {
        $serverRequest = $this->getServerRequest($this->config['wikiRandomPage'])['random'];
        return array_map(fn($arr) => $arr['title'], $serverRequest);
    }

    public function getLinksOnPage($title)
    {
        $this->config['wikiLinksOnPage']['titles'] = $title;
        $serverRequest = $this->getServerRequest($this->config['wikiLinksOnPage'])['pages'];

        return empty($serverRequest) ? [] : $this->parseRequestTitles($serverRequest, 'links');
    }

    public function getLinksToPage($title)
    {
        $this->config['wikiLinksToPage']['titles'] = $title;
        $serverRequest = $this->getServerRequest($this->config['wikiLinksToPage'])['pages'];

        return empty($serverRequest) ? [] : $this->parseRequestTitles($serverRequest, 'linkshere');
    }

    private function getServerRequest($params)
    {
        $url = $this->config['urlApi'] . "?" . http_build_query($params);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

//        if (! curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
//            throw new \Exception("Нет связи с сетью!");
//        }

        return json_decode($output, true)['query'];
    }

    private function parseRequestTitles($serverRequest, $paramKey)
    {
        $res = [];
        if (!empty($serverRequest)) {
            foreach ($serverRequest as $k => $v) {
                foreach ($serverRequest[$k][$paramKey] as $key => $val) {
                    $res[] = $serverRequest[$k][$paramKey][$key]['title'];
                }
            }
        }

        return $res;
    }
}
