<?php


namespace esas\cmsgate\cache;


use esas\cmsgate\Registry;

class Cache
{
    private $uuid;
    private $status;
    private $orderData;
    private $extId;

    /**
     * Cache constructor.
     * @param $uuid
     * @param $orderData
     * @param $extId
     */
    public function __construct($uuid, $orderData, $extId, $status)
    {
        $this->uuid = $uuid;
        $this->orderData = $orderData;
        $this->extId = $extId;
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getOrderData()
    {
        return $this->orderData;
    }

    /**
     * @return mixed
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $extId
     */
    public function setExtId($extId)
    {
        $this->extId = $extId;
        Registry::getRegistry()->getCacheRepository()->saveExtId($this->uuid, $this->extId);
    }
}