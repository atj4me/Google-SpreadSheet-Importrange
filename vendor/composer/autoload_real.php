<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit998d54e49e5e963882aa15eb7d4df73b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit998d54e49e5e963882aa15eb7d4df73b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit998d54e49e5e963882aa15eb7d4df73b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit998d54e49e5e963882aa15eb7d4df73b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
