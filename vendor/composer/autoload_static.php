<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9387792ad7c03b8c2bde1beda1e24982
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Ohms\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ohms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Ohms',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9387792ad7c03b8c2bde1beda1e24982::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9387792ad7c03b8c2bde1beda1e24982::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
