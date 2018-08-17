<?php
function autoloader($className) {
    $fileName = str_replace('\\', '/', $className) . '.php';

    $path = __DIR__.'/../classes/' . $fileName;

    include $path;
}

spl_autoload_register('autoloader');