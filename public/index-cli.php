<?php

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
