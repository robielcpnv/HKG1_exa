<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcb69fd5e2d9cf3ddedd9696b956e2ada
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

        spl_autoload_register(array('ComposerAutoloaderInitcb69fd5e2d9cf3ddedd9696b956e2ada', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcb69fd5e2d9cf3ddedd9696b956e2ada', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInitcb69fd5e2d9cf3ddedd9696b956e2ada::getInitializer($loader)();

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInitcb69fd5e2d9cf3ddedd9696b956e2ada::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequirecb69fd5e2d9cf3ddedd9696b956e2ada($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequirecb69fd5e2d9cf3ddedd9696b956e2ada($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
