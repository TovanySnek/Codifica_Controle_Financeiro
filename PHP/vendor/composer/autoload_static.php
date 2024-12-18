<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f2b979019459c6d02348ec328a6b7ae
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bofs\\Php\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bofs\\Php\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f2b979019459c6d02348ec328a6b7ae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f2b979019459c6d02348ec328a6b7ae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9f2b979019459c6d02348ec328a6b7ae::$classMap;

        }, null, ClassLoader::class);
    }
}
