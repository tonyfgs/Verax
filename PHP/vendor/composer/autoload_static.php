<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2914a5452c57eeae9bee5207fdf5559c
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'modele\\' => 7,
            'metier\\' => 7,
        ),
        'd' => 
        array (
            'dal\\gateways\\' => 13,
            'dal\\' => 4,
        ),
        'c' => 
        array (
            'controleur\\' => 11,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'C' => 
        array (
            'Config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'modele\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modele',
        ),
        'metier\\' => 
        array (
            0 => __DIR__ . '/../..' . '/metier',
        ),
        'dal\\gateways\\' => 
        array (
            0 => __DIR__ . '/../..' . '/dal/gateways',
        ),
        'dal\\' => 
        array (
            0 => __DIR__ . '/../..' . '/dal',
        ),
        'controleur\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controleur',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2914a5452c57eeae9bee5207fdf5559c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2914a5452c57eeae9bee5207fdf5559c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2914a5452c57eeae9bee5207fdf5559c::$classMap;

        }, null, ClassLoader::class);
    }
}
