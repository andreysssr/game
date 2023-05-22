<?php

namespace app\service;

use Exception;

class Wiki
{
    private array $config;

    public function __construct($config)
    {
        $this->config = $config;
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

        return json_decode($output, true)['query'];
    }

    private function parseRequestTitles($serverRequest, $paramKey)
    {
        $res = [];
        try {
            if (!empty($serverRequest)) {
                foreach ($serverRequest as $k => $v) {
                    foreach ($serverRequest[$k][$paramKey] as $key => $val) {
                        $res[] = $serverRequest[$k][$paramKey][$key]['title'];
                    }
                }
            }
        }catch(Exception $e){
            return [];
        }

        return $res;
    }
}
