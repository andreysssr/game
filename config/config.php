<?php

return [
    'wiki' => [
        'urlApi' => "https://{$container->get('config')['lang']}.wikipedia.org/w/api.php",
        'wikiRandomPage' => [
            "action" => "query",
            "format" => "json",
            "rnnamespace" => 0,
            "list" => "random",
            "rnlimit" => "2",
        ],
        'wikiLinksOnPage' => [
            "action" => "query",
            "format" => "json",
            "rnnamespace" => 0,
            "titles" => "",
            "prop" => "links",
            "pllimit" => $container->get('config')['countViewUrl'],
        ],
        'wikiLinksToPage' => [
            "action" => "query",
            "format" => "json",
            "rnnamespace" => 0,
            "titles" => "",
            "prop" => "linkshere",
            "lhlimit" => $container->get('config')['countViewUrl'],
        ],
    ],

];

