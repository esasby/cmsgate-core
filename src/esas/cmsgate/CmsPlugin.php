<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 02.10.2018
 * Time: 14:59
 */

namespace esas\cmsgate;


use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\SimpleAutoloader;

/**
 * Class CmsPlugin позволяет удобно настроить и проинициализировать все служебные объекты, необходимые для работы core.
 * Пример использования для CMS Opencart:
 * (new CmsPlugin())
 *      ->setCmsPluginDir(dirname(dirname(dirname(__FILE__))))
 *      ->setComposerVendorDir(dirname(dirname(__FILE__)) . '/vendor')
 *      ->setRegistry(new RegistryOpencart())
 *      ->init();
 * @package esas\cmsgate
 */
class CmsPlugin
{
    private $composerVendorDir;
    private $cmsPluginDir;
    /**
     * @var Registry
     */
    private $registry;

    /**
     * CmsPlugin constructor.
     * @param $composerVendorDir
     * @param $cmsPluginDir
     */
    public function __construct($composerVendorDir, $cmsPluginDir)
    {
        if (substr($composerVendorDir, -1) == '/')
            $composerVendorDir = substr($composerVendorDir, 0,  -1);
        $this->composerVendorDir = $composerVendorDir;
        $this->cmsPluginDir = $cmsPluginDir;
        require_once($this->composerVendorDir . '/autoload.php');
        SimpleAutoloader::register($this->cmsPluginDir);
    }

    /**
     * @param Registry $registry
     * @return CmsPlugin
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
    
    public function init() {
        Logger::init();
        $this->registry->init();
    }

}