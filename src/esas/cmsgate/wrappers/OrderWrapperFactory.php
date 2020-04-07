<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 07.04.2020
 * Time: 11:31
 */

namespace esas\cmsgate\wrappers;

/**
 * Методы получения OrderWrapper вынесены из Registry в отдельный Factory для возможности наследования в cms-libs
 * Class OrderWrapperFactory
 * @package esas\cmsgate\wrappers
 */
abstract class OrderWrapperFactory
{
    /**
     * По локальному id заказа возвращает wrapper
     * @param $orderId
     * @return OrderWrapper
     */
    public abstract function getOrderWrapperByOrderId($orderId);

    /**
     * По локальному номеру заказа (может отличаться от id) возвращает wrapper.
     * Должен быть переопределен если в CMS есть разница между orderId и orderNumber
     * @param $orderNumber
     * @return OrderWrapper
     */
    public function getOrderWrapperByOrderNumber($orderNumber){
        return $this->getOrderWrapperByOrderId($orderNumber);
    }

    /**
     * Возвращает OrderWrapper для текущего заказа текущего пользователя
     * @return OrderWrapper
     */
    public abstract function getOrderWrapperByOrderForCurrentUser();

    /**
     * По номеру транзакции внешней система возвращает wrapper
     * @param $extId
     * @return OrderWrapper
     */
    public abstract function getOrderWrapperByExtId($extId);

}