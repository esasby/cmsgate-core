<?php


namespace esas\cmsgate\cache;


use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\SessionUtils;

abstract class CacheRepository
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * CacheRepository constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));

    }

    public abstract function add($orderData);

    /**
     * @param $uuid string
     * @return Cache
     */
    public abstract function getByUUID($cacheUUID);

    /**
     * @param $extId string
     * @return Cache
     */
    public abstract function getByExtId($extId);

    /**
     * @param $orderData
     * @return Cache
     */
    public abstract function getByData($orderData);

    public abstract function saveExtId($cacheUUID, $extId);

    public abstract function setStatus($cacheUUID, $status);

    public function loadSessionCacheByExtId($extId) {
        $cache = $this->getByExtId($extId);
        SessionUtils::setCacheObj($cache);
        SessionUtils::setCacheUUID($cache->getUuid());
    }

    public function addSessionCache($orderData) {
        if ($orderData == null || empty($orderData))
            throw new CMSGateException('Incorrect request');
        $cache = $this->getByData($orderData);
        if ($cache != null) {
            SessionUtils::setCacheUUID($cache->getUuid());
            SessionUtils::setCacheObj($cache);
        } else {
            $uuid = $this->add($orderData);
            SessionUtils::setCacheUUID($uuid);
        }
    }

    /**
     * @return Cache
     * @throws CMSGateException
     */
    public function getSessionCache() {
        $cache = SessionUtils::getCacheObj();
        if ($cache != null)
            return $cache;
        $cacheUUID = SessionUtils::getCacheUUID();
        if ($cacheUUID == null || $cacheUUID === '')
            throw new CMSGateException('Cache UUI can not be found in session');
        $cache = $this->getByUUID($cacheUUID);
        SessionUtils::setCacheObj($cache);
        return $cache;
    }

    /**
     * @return Cache
     * @throws CMSGateException
     */
    public function getSessionCacheSafe() {
        $cache = $this->getSessionCache();
        if ($cache == null)
            throw new CMSGateException("Can not load cache from repository by uuid[" . $cacheUUID . "]");
        return $cache;
    }
}