<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.02.2018
 * Time: 11:59
 */

namespace esas\cmsgate\wrappers;

use esas\cmsgate\OrderStatus;
use esas\cmsgate\protocol\Amount;
use esas\cmsgate\Registry;
use esas\cmsgate\utils\CMSGateException;
use Throwable;

abstract class OrderWrapper extends Wrapper
{
    /**
     * Уникальный идентификатор заказ в рамках CMS
     * @return string
     */
    public abstract function getOrderId();

    /**
     * Уникальный номер заказа в рамках CMS отображаемый клиенту
     * (в некоторых CMS может не совпадать с OrderId и поэтому метод может быть переопределен)
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getOrderId();
    }

    /**
     * Уникальный номер платежа за заказ в рамках CMS
     * (в некоторых CMS для одного заказа может быть несколько оплат и поэтому метод может быть переопределен)
     * @return string
     */
    public function getPaymentId()
    {
        return $this->getOrderId();
    }

    /**
     * В зависимости от настройки возвращает orderNumber или orderId
     * @return string
     */
    public function getOrderNumberOrId()
    {
        return Registry::getRegistry()->getConfigWrapper()->isUseOrderNumber() ? $this->getOrderNumber() : $this->getOrderId();
    }

    /**
     * Идентификатор клиента
     * @return string
     */
    public abstract function getClientId();

    /**
     * Полное имя покупателя
     * @return string
     */
    public abstract function getFullName();

    /**
     * Мобильный номер покупателя для sms-оповещения
     * (если включено администратором)
     * @return string
     */
    public abstract function getMobilePhone();

    /**
     * Email покупателя для email-оповещения
     * (если включено администратором)
     * @return string
     */
    public abstract function getEmail();


    /**
     * Физический адрес покупателя
     * @return string
     */
    public abstract function getAddress();

    public function getAmountObj()
    {
        return new Amount($this->getAmount(), $this->getCurrency());
    }

    /**
     * Общая сумма товаров в заказе
     * @return string
     */
    public abstract function getAmount();

    /**
     * Стоимость доставки
     * @return string
     */
    public abstract function getShippingAmount();

    /**
     * Валюта заказа (буквенный код)
     * @return string
     */
    public abstract function getCurrency();

    /**
     * Массив товаров в заказе
     * @return OrderProductWrapper[]
     */
    public abstract function getProducts();

    /**
     * BillId (идентификатор хуткигрош) успешно выставленного счета
     * @return mixed
     */
    public abstract function getExtId();

    public function isExtIdFilled() {
        $extId = $this->getExtId();
        return $extId != null && $extId != '';
    }

    public function getExtIdNotEmpty() {
        $extId = $this->getExtId();
        if ($extId == null || $extId == '')
            throw new CMSGateException("ExtId is empty");
        return $extId;
    }

    /**
     * Текущий статус заказа в CMS
     * @return OrderStatus
     */
    public abstract function getStatus();

    /**
     * @param OrderStatus $newStatus
     * @throws Throwable
     */
    public function updateStatusWithLogging($newStatus)
    {
        if ($newStatus == null) {
            $this->logger->fatal("New order status is null!!!");
            return;
        }
        $this->logger->info("Setting new status[" . $newStatus . "] for order[" . $this->getOrderNumberOrId() . "]");
        $this->updateStatus($newStatus);
    }

    /**
     * Обновляет статус заказа в БД
     * @param OrderStatus $newStatus
     * @throws Throwable
     */
    public abstract function updateStatus($newStatus);

    /**
     * Сохраняет привязку внешнего идентификтора к заказу
     * @param $extId
     */
    public abstract function saveExtId($extId);
}