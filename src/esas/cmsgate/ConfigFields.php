<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 10.08.2018
 * Time: 12:21
 */

namespace esas\cmsgate;


class ConfigFields
{
    private static $cmsKeys;

    /**
     * В некоторых CMS используются определенные соглашения по именования настроек модулей (чаще всего префиксы).
     * Данный метод позволяет использовать в core cms-зависимые ключи (например на client view, при формировании html и т.д.)
     * @param $localkey
     * @return mixed
     */
    public static function getCmsRelatedKey($localkey)
    {
        if (self::$cmsKeys == null || !in_array($localkey, self::$cmsKeys)) {
            self::$cmsKeys[$localkey] = Registry::getRegistry()->getConfigWrapper()->createCmsRelatedKey($localkey);
        }
        return self::$cmsKeys[$localkey];
    }

    public static function sandbox()
    {
        return self::getCmsRelatedKey("sandbox");
    }

    public static function debugMode()
    {
        return self::getCmsRelatedKey("debug_mode");
    }

    public static function paymentMethodName()
    {
        return self::getCmsRelatedKey("payment_method_name");
    }

    public static function paymentMethodDetails()
    {
        return self::getCmsRelatedKey("payment_method_details");
    }

    public static function orderStatusPending()
    {
        return self::getCmsRelatedKey("bill_status_pending"); // устаревший ключ, для совместимости
    }

    public static function orderPaymentStatusPending()
    {
        return self::getCmsRelatedKey("order_payment_status_pending");
    }

    public static function orderStatusPayed()
    {
        return self::getCmsRelatedKey("bill_status_payed");
    }

    public static function orderPaymentStatusPayed()
    {
        return self::getCmsRelatedKey("order_payment_status_payed");
    }

    public static function orderStatusFailed()
    {
        return self::getCmsRelatedKey("bill_status_failed");
    }

    public static function orderPaymentStatusFailed()
    {
        return self::getCmsRelatedKey("order_payment_status_failed");
    }

    public static function orderStatusCanceled()
    {
        return self::getCmsRelatedKey("bill_status_canceled");
    }

    public static function orderPaymentStatusCanceled()
    {
        return self::getCmsRelatedKey("order_payment_status_canceled");
    }

    /**
     * Настройка определяет будет ли использоваться orderNumber или orderId при взаимодействии с внещней системой
     * @return mixed
     */
    public static function useOrderNumber()
    {
        return self::getCmsRelatedKey("use_order_number");
    }
}