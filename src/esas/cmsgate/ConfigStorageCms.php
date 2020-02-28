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
     * Сохранение значения свойства в харнилища настроек конкретной CMS.
     * Важно! значение должно быть сохранено не только в БД, но и в локальном объекте представляющем настройки (если он есть)
     * @param string $key
     * @throws Exception
     */
    public abstract function saveConfig($key, $value);

    /**
     * Конвертация представляения boolean свойства в boolean тип (во разных CMS в хранилищах настроект boolean могут храниться в разном виде)
     * @param $key
     * @return bool
     * @throws Exception
     */
    public abstract function convertToBoolean($cmsConfigValue);

    /**
     * При необходимости соблюдения определенных правил в именовании ключей настроек (зависящих от конкретной CMS)
     * Данный метод должен быть переопределен
     * @param $key
     * @return string
     */
    public abstract function createCmsRelatedKey($key);
}