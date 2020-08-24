<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf279bb83e0dca562f7b64ba1b1753f9b
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '6f2c5977e422114bbaec553e7c77ee8b' => __DIR__ . '/..' . '/http-interop/response-sender/src/functions.php',
        'af86460dee87661987b57a8fc0155734' => __DIR__ . '/../..' . '/helpers/redirect.php',
        '71e0573870aac4c4b0004f0eef41cf88' => __DIR__ . '/../..' . '/helpers/session.php',
        '9c8c9c134ec4f0ca5554e982f145d7da' => __DIR__ . '/../..' . '/helpers/view.php',
        'df22ebda974484b46bb4a673049e1c17' => __DIR__ . '/../..' . '/helpers/routes.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/AliensDev',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf279bb83e0dca562f7b64ba1b1753f9b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf279bb83e0dca562f7b64ba1b1753f9b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
