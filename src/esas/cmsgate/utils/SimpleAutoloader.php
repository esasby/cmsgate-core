<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 02.10.2018
 * Time: 15:03
 */

namespace esas\cmsgate\utils;


class SimpleAutoloader
{
    private static $rootPath;

    static public function loader($class)
    {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $class);
        $path = self::$rootPath . '/' . $className . '.php';
        $path = preg_replace('/cmsgate_scope_[\w]*\//', '', $path); //replacing for scoper
        if (file_exists($path)) {
            require_once($path);
            if (class_exists($class)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * @param string $rootPath
     */
    public static function register($rootPath)
    {
        self::$rootPath = $rootPath;
        spl_autoload_register('\\' . SimpleAutoloader::class .'::loader');
    }

}