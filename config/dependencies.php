<?php

use app\service\Wiki;

return [
    Wiki::class => function($container){
        return new Wiki($container->get('config')['wiki']);
    }
];
