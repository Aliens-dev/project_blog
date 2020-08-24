<?php


namespace app;

class Config
{

    public static function get($dir) {
        $config = require dirname(__DIR__). DIRECTORY_SEPARATOR. 'config'.DIRECTORY_SEPARATOR.'index.php';
        return $config[$dir];
    }
}