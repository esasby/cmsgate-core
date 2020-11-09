<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.02.2018
 * Time: 11:59
 */

namespace esas\cmsgate\wrappers;

use esas\cmsgate\protocol\Amount;
use Throwable;

abstract class OrderWrapper extends Wrapper
{
    /**
     * Уникальный номер заказ в рамках CMS
     * @return string
     */
    public abstract function getOrderId();
    
    /**
     * Уникальный номер счета в рамках CMS отображаемый клиенту
     * (в некоторых CMS может не совпадать с OrderId и поэтому метод может быть переопределен)
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getOrderId();
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

    public function getAmountObj() {
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

    /**
     * Текущий статус заказа в CMS
     * @return mixed
     */
    public abstract function getStatus();

    /**
     * Обновляет статус заказа в БД
     * @param $newStatus
     * @throws Throwable
     */
    public abstract function updateStatus($newStatus);

    /**
     * Сохраняет привязку внешнего идентификтора к заказу
     * @param $extId
     */
    public abstract function saveExtId($extId);
}