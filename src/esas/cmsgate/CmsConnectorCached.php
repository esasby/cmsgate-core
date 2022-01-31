<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 13.04.2020
 * Time: 12:23
 */

namespace esas\cmsgate;

use esas\cmsgate\wrappers\OrderWrapper;
use Exception;

abstract class CmsConnectorCached extends CmsConnector
{
    public function createCommonConfigForm($managedFields)
    {
        throw new Exception('Not implemented');
    }

    public function createSystemSettingsWrapper()
    {
        throw new Exception('Not implemented');
    }

    /**
     * По локальному id заказа возвращает wrapper
     * @param $orderId
     * @return OrderWrapper
     */
    public function createOrderWrapperByOrderId($orderId)
    {
        return $this->createOrderWrapperForCurrentUser();
    }

    public function createOrderWrapperForCurrentUser()
    {
        $cache = Registry::getRegistry()->getCacheRepository()->getSessionCacheSafe();
        return $this->createOrderWrapperCached($cache);
    }

    public abstract function createOrderWrapperCached($cache);

    public function createOrderWrapperByOrderNumber($orderNumber)
    {
        return $this->createOrderWrapperForCurrentUser();
    }

    public function createOrderWrapperByExtId($extId)
    {
        return Registry::getRegistry()->getCacheRepository()->getByExtId($extId);
    }

    public function createConfigStorage()
    {
        $cache = Registry::getRegistry()->getCacheRepository()->getSessionCacheSafe();
        return new ConfigStorageCached($cache);
    }

    public function createLocaleLoader()
    {
        $cache = Registry::getRegistry()->getCacheRepository()->getSessionCache();
        return $this->createLocaleLoaderCached($cache);
    }

    public abstract function createLocaleLoaderCached($cache);
}