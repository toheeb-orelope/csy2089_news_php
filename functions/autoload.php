<?php

function autoload($className)
{
    $path = str_replace('\\', '/', $className);
    require '../' . $path . '.php';
}

spl_autoload_register('autoload');

