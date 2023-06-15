<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 13.04.2020
 * Time: 12:22
 */

namespace esas\cmsgate;



use esas\cmsgate\descriptors\CmsConnectorDescriptor;
use esas\cmsgate\utils\CMSGateException;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\wrappers\OrderWrapper;

/**
 * Class CmsConnector позволяющий решить проблему множественного неследования в Registry. Часть объектов, создаваемых в
 * Registry относятся к платежной системе (PaySystem), а часть к Cms. Для упрощения создания таких объектов, созданы два
 * класса: CmsConnector и PaysystemConnector.
 * @package esas\cmsgate
 */
abstract class CmsConnector
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CmsConnectorDescriptor
     */
    protected $cmsConnectorDescriptor;

    public function __construct()
    {
        $this->logger = Logger::getLogger(get_class($this));
    }

    public function init() {}

    /**
     * @deprecated use this class instead
     * @return mixed
     */
    public function createSystemSettingsWrapper() {
        return null; //deprecated
    }


    public abstract function createCommonConfigForm($managedFields);

    /**
     * По локальному id заказа возвращает wrapper
     * @param $orderId
     * @return OrderWrapper или null
     */
    public abstract function createOrderWrapperByOrderId($orderId);

    /**
     * По локальному номеру заказа (может отличаться от id) возвращает wrapper.
     * Должен быть переопределен если в CMS есть разница между orderId и orderNumber
     * @param $orderNumber
     * @return OrderWrapper или null
     */
    public function createOrderWrapperByOrderNumber($orderNumber){
        return $this->createOrderWrapperByOrderId($orderNumber);
    }

    /**
     * Возвращает OrderWrapper для текущего заказа текущего пользователя
     * @return OrderWrapper или null
     */
    public abstract function createOrderWrapperForCurrentUser();

    /**
     * По номеру транзакции внешней система возвращает wrapper
     * @param $extId
     * @return OrderWrapper или null
     */
    public abstract function createOrderWrapperByExtId($extId);

    public abstract function createConfigStorage();

    public abstract function createLocaleLoader();

    public function getCurrentEncoding() {
        return "utf-8";
    }

    /**
     * @return CmsConnectorDescriptor
     */
    public function getCmsConnectorDescriptor()
    {
        if ($this->cmsConnectorDescriptor == null)
            $this->cmsConnectorDescriptor = $this->createCmsConnectorDescriptor();
        return $this->cmsConnectorDescriptor;
    }

    public abstract function createCmsConnectorDescriptor();

    /**
     * @return string
     * @throws CMSGateException
     */
    public function getReturnToShopSuccessURL() {
        throw new CMSGateException("Method is not implemented");
    }

    /**
     * @return string
     * @throws CMSGateException
     */
    public function getReturnToShopFailedURL() {
        throw new CMSGateException("Method is not implemented");
    }
}