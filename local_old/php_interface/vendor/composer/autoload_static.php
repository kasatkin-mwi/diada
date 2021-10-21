<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit753ae76d0caa55d2e3304d4dde5a3a71
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FCbit\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FCbit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/FCbit',
        ),
    );

    public static $classMap = array (
        'FCbit\\test' => __DIR__ . '/../..' . '/lib/FCbit/test.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit753ae76d0caa55d2e3304d4dde5a3a71::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit753ae76d0caa55d2e3304d4dde5a3a71::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit753ae76d0caa55d2e3304d4dde5a3a71::$classMap;

        }, null, ClassLoader::class);
    }
}