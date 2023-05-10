<?php

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../';
    $class_file = str_replace('\\', '/', $class) . '.php';
    $file = $base_dir . $class_file;
    if (file_exists($file)) {
        require_once $file;
    }
});
