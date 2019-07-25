<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 15.07.2019
 * Time: 13:03
 */

namespace esas\cmsgate;

use esas\cmsgate\utils\Logger;

abstract class ConfigStorageCms
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * ConfigStorageCms constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    /**
     * Получение свойства из харнилища настроек конкретной CMS.
     * Если свойства в хранилище нет, должен вернуть null
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public abstract function getConfig($key);

    /**
     * Конвертация представляения boolean свойства в boolean тип (во разных CMS в хранилищах настроект boolean могут храниться в разном виде)
     * @param $key
     * @return bool
     * @throws Exception
     */
    public abstract function convertToBoolean($cmsConfigValue);
}