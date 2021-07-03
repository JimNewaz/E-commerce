<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22b7347aa31ed6fdad791126b0be71b7
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22b7347aa31ed6fdad791126b0be71b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22b7347aa31ed6fdad791126b0be71b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit22b7347aa31ed6fdad791126b0be71b7::$classMap;

        }, null, ClassLoader::class);
    }
}