<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite1c91f8e241162a96bfced31aac54c04
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Trait\\' => 6,
        ),
        'S' => 
        array (
            'Service\\' => 8,
        ),
        'R' => 
        array (
            'Repository\\' => 11,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'L' => 
        array (
            'Logger\\' => 7,
        ),
        'H' => 
        array (
            'Http\\' => 5,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'E' => 
        array (
            'Entity\\' => 7,
        ),
        'C' => 
        array (
            'Controller\\' => 11,
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Trait\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Trait',
        ),
        'Service\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Service',
        ),
        'Repository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Repository',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Logger\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Logger',
        ),
        'Http\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Http',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Entity\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Entity',
        ),
        'Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controller',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite1c91f8e241162a96bfced31aac54c04::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite1c91f8e241162a96bfced31aac54c04::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite1c91f8e241162a96bfced31aac54c04::$classMap;

        }, null, ClassLoader::class);
    }
}
