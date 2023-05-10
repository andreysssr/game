<?php

use app\service\WikiApi;
use core\App\Cli\Application;
use core\Container\Container;

chdir(dirname(__DIR__));
require 'config/autoload.php';

$container = new Container(require 'config/dependencies.php');
$container->set('config', require 'config/default.php');
$container->set('config', parse_ini_file(".cli.env"));
$container->set('config', require 'config/config.php');

$app = $container->get(Application::class);

require 'config/listeners.php';

$app->start();

//=================================
//$class = 'app\service\WikiApi';
//$reflection = new \ReflectionClass($class);
//$constructor = $reflection->getConstructor();

//print_r($constructor);
//print_r($constructor->getParameters());
//

//$arg = [];
//foreach ($arr = $constructor->getParameters() as $parameter){
//    echo $parameter->getName() . " - " . $parameter->getType() .PHP_EOL;
//    $arg[] = (string) $parameter->getType();

//    print_r(!$parameter->isDefaultValueAvailable());
//    print_r($parameter->getName());
//    print_r($parameter->getType());
//    print_r($parameter->getAttributes());
//}

//print_r($arg);

//=================================

//$eventManager = $container->get('core\EventManager\EventManager');

//print_r($eventManager);

//print_r($container->get('config')['wiki']);

//$wiki = new Wiki($container->get('config')['wiki']);

//var_dump($container);

