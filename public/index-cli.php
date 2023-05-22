<?php

use core\App\Cli\Application;
use app\service\Container;

chdir(dirname(__DIR__));
require_once 'config/bootstrap.php';

$container = new Container(require 'config/dependencies.php');
$container->set('config', require 'config/default.php');
$container->set('config', parse_ini_file(".env"));
$container->set('config', require 'config/config.php');

$app = $container->get(Application::class);
$app->start();
