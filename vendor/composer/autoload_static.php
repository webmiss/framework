<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit46fc7c99f5ef3b18e62fb8fbd5c37917
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Webmis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Webmis\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit46fc7c99f5ef3b18e62fb8fbd5c37917::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit46fc7c99f5ef3b18e62fb8fbd5c37917::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
