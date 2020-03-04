<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac595638c31e8a404c78113065edf421
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac595638c31e8a404c78113065edf421::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac595638c31e8a404c78113065edf421::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
