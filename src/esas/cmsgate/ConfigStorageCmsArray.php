<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 15.07.2019
 * Time: 13:14
 */

namespace esas\cmsgate;

use esas\cmsgate\utils\CMSGateException;
use Exception;

class ConfigStorageCmsArray extends ConfigStorageCms
{
    /**
     * @var array
     */
    protected $configArray;

    public function __construct($configArray)
    {
        parent::__construct();
        $this->configArray = $configArray;
    }


    /**
     * @param $key
     * @return string
     * @throws Exception
     */
    public function getConfig($key)
    {
        if (array_key_exists($key, $this->configArray))
            return $this->configArray[$key];
        else
            return "";
    }

    public function isStorageInitialised($marker)
    {
        return $this->configArray != null && sizeof($this->configArray) > 0;
    }

    /**
     * @param $cmsConfigValue
     * @return bool
     * @throws Exception
     */
    public function convertToBoolean($cmsConfigValue)
    {
        return strtolower($cmsConfigValue) == '1' || strtolower($cmsConfigValue) == 'yes';
    }

    /**
     * Сохранение значения свойства в харнилища настроек конкретной CMS.
     *
     * @param string $key
     * @throws Exception
     */
    public function saveConfig($key, $value)
    {
        throw new CMSGateException("Not implemented");
    }
}