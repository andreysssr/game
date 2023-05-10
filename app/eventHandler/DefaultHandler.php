<?php

namespace app\eventHandler;

class DefaultHandler
{
    private $count = 0;

    public function handle($event, $params = []){
        echo "=========================================" . PHP_EOL;
        echo __METHOD__ . PHP_EOL;
        echo $event . PHP_EOL;
        print_r($params) . PHP_EOL;
        echo ++$this->count . PHP_EOL . PHP_EOL  ;
    }
}
