<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 16.02.2018
 * Time: 13:39
 */

namespace esas\cmsgate\wrappers;

use esas\cmsgate\ConfigFields;
use esas\cmsgate\ConfigStorageCms;
use esas\cmsgate\Registry;
use Exception;
use Throwable;

abstract class ConfigWrapper extends Wrapper
{
    /**
     * @var ConfigStorageCms
     */
    protected $configStorageCms;

    /**
     * ConfigWrapper constructor.
     * @param $configStorage
     */
    public function __construct($configStorageCms = null)
    {
        parent::__construct();
        if ($configStorageCms == null) {
            $configStorageCms = Registry::getRegistry()->getConfigStorage();
        }
        $this->configStorageCms = $configStorageCms;
    }


    /**
     * Название системы ХуткиГрош, отображаемое клиенту на этапе оформления заказа
     * @return string
     */
    public function getPaymentMethodName()
    {
        return $this->getConfig(ConfigFields::paymentMethodName());
    }

    /**
     * Описание системы ХуткиГрош, отображаемое клиенту на этапе оформления заказа
     * @return string
     */
    public function getPaymentMethodDetails()
    {
        return $this->getConfig(ConfigFields::paymentMethodDetails());
    }

    /**
     * Включен ли режим песчоницы
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->checkOn(ConfigFields::sandbox());
    }

    /**
     * Включен ли режим debug
     * @return boolean
     */
    public function isDebugMode()
    {
        return $this->checkOn(ConfigFields::debugMode());
    }

    /**
     * Какой статус выставлять заказу при ожидании
     * @return string
     */
    public function getOrderStatusPending()
    {
        return $this->getConfig(ConfigFields::orderStatusPending());
    }

    public function getOrderPaymentStatusPending()
    {
        return $this->getConfig(ConfigFields::orderPaymentStatusPending());
    }


    /**
     * Какой статус присвоить заказу после успешно оплаты счета в ЕРИП (после вызова callback-а шлюзом ХуткиГрош)
     * @return string
     */
    public function getOrderStatusPayed()
    {
        return $this->getConfig(ConfigFields::orderStatusPayed());
    }

    public function getOrderPaymentStatusPayed()
    {
        return $this->getConfig(ConfigFields::orderPaymentStatusPayed());
    }

    /**
     * Какой статус присвоить заказу в случаче ошибки выставления счета в ЕРИП
     * @return string
     */
    public function getOrderStatusFailed()
    {
        return $this->getConfig(ConfigFields::orderStatusFailed());
    }

    public function getOrderPaymentStatusFailed()
    {
        return $this->getConfig(ConfigFields::orderPaymentStatusFailed());
    }

    /**
     * Какой статус присвоить заказу, если оплата была отменена
     * @return string
     */
    public function getOrderStatusCanceled()
    {
        return $this->getConfig(ConfigFields::orderStatusCanceled());
    }

    public function getOrderPaymentStatusCanceled()
    {
        return $this->getConfig(ConfigFields::orderPaymentStatusCanceled());
    }

    /**
     * При взаимодействии с ПС использовать orderId или orderNumber
     * @return boolean
     */
    public function isUseOrderNumber()
    {
        return $this->checkOn(ConfigFields::useOrderNumber());
    }

    public function getConfig($key, $warn = false)
    {
        try {
            $value = Registry::getRegistry()->getConstantConfigValue($key);
            if ($value != null)
                return $value;
            $value = $this->configStorageCms->getConfig($key);
            if ($warn)
                return $this->warnIfEmpty($value, $key);
            else
                return $value;
        } catch (Throwable $e) {
            $this->logger->error("Can not load config field[" . $key . "]");
        }
    }

    public function getConfigOrDefaults($key, $warn = false)
    {
        $text = $this->getConfig($key, $warn);
        if ($text == "")
            $text = $this->translator->getConfigFieldDefault($key);
        return htmlspecialchars_decode($text); // в некотрых CMS при сохранении в БД html-символы кодируются, и поэтому надо их декодировать обратно
    }

    protected function checkOn($key, $warn = false)
    {
        $value = false;
        try {
            $value = Registry::getRegistry()->getConstantConfigValue($key);
            if (is_bool($value) || $value != null)
                return $value;
            $value = $this->configStorageCms->getConfig($key);
            if ($warn)
                $this->warnIfEmpty($value, $key);
            if ((is_null($value) || "" == $value) && $this->needDefaults())
                $value = $this->getDefaultConfig($key);
            if (is_bool($value))
                return $value; //уже boolean
            return ("" == $value || "0" == $value) ? false : $this->configStorageCms->convertToBoolean($value);
        } catch (Throwable $e) {
            $this->logger->error("Can not load config field[" . $key . "]");
        } catch (Exception $e) { // для совместимости с php 5
            $this->logger->error("Can not load config field[" . $key . "]");
        }
        return $value;
    }

    /**
     * Определяет, надо ли подставлять значение по умолчанию. Значения по умолчанию должны подставляться только
     * при первом конфигурировании. Простой проверки значения на null не достаточно в некоторых CMS (например в CSCart если убрать
     * checkbox параметр просто удалится из БД и getCmsConfig будет возращать для него null, хотя должен false)
     * @return bool
     * @throws Exception
     */
    protected function needDefaults()
    {
        // предполагаем, что если в хранилище есть названием платежного метода, это не первая инциализация и значения по умолчанию не нужны
        $paymentMethodName = $this->configStorageCms->isStorageInitialised(ConfigFields::paymentMethodName());
        return empty($paymentMethodName);
    }

    /**
     * Метод для получения значения праметра по ключу
     * @param $config_key
     * @return bool|string
     */
    public function get($config_key)
    {
        switch ($config_key) {
            // сперва пробегаем по соответствующим методам, на случай если они были переопределены в дочернем классе
            case ConfigFields::sandbox():
                return $this->isSandbox();
            case ConfigFields::debugMode():
                return $this->isDebugMode();
            case ConfigFields::paymentMethodName():
                return $this->getPaymentMethodName();
            case ConfigFields::paymentMethodDetails():
                return $this->getPaymentMethodDetails();
            case ConfigFields::orderStatusPending():
                return $this->getOrderStatusPending();
            case ConfigFields::orderPaymentStatusPending():
                return $this->getOrderPaymentStatusPending();
            case ConfigFields::orderStatusPayed():
                return $this->getOrderStatusPayed();
            case ConfigFields::orderPaymentStatusPayed():
                return $this->getOrderPaymentStatusPayed();
            case ConfigFields::orderStatusFailed():
                return $this->getOrderStatusFailed();
            case ConfigFields::orderPaymentStatusFailed():
                return $this->getOrderPaymentStatusFailed();
            case ConfigFields::orderStatusCanceled():
                return $this->getOrderStatusCanceled();
            case ConfigFields::orderPaymentStatusCanceled():
                return $this->getOrderPaymentStatusCanceled();
            case ConfigFields::useOrderNumber():
                return $this->isUseOrderNumber();
            default:
                return $this->getConfig($config_key);
        }
    }

    /**
     * Производит подстановку переменных из заказа в итоговый текст
     * @param OrderWrapper $orderWrapper
     * @return string
     */
    public function cookText($text, $orderWrapper)
    {
        return strtr($text, array(
            "@order_id" => $orderWrapper->getOrderId(),
            "@order_number" => $orderWrapper->getOrderNumber(),
            "@order_number_or_id" => $orderWrapper->getOrderNumberOrId(),
            "@order_total" => $orderWrapper->getAmount(),
            "@order_currency" => $orderWrapper->getCurrency(),
            "@order_fullname" => $orderWrapper->getFullName(),
            "@order_phone" => $orderWrapper->getMobilePhone(),
            "@order_address" => $orderWrapper->getAddress(),
        ));
    }

    public function warnIfEmpty($string, $name)
    {
        if (empty($string)) {
            $this->logger->warn("Configuration field[" . $name . "] is empty.");
        }
        return $string;
    }

    /**
     * Используется для соблюдения определенных правил в именовании ключей настроек (зависящих от конкретной CMS)
     * @param $key
     * @return string
     */
    public function createCmsRelatedKey($key)
    {
        return $this->configStorageCms->createCmsRelatedKey($key);
    }

    /**
     * Сохранение значения свойства в настройках.
     * @param $key - ключ (уже CMS Related)
     * @param $value - значение
     */
    public function saveConfig($key, $value)
    {
        $this->logger->info("Storing config field[" . $key . "] value[" . $value . "]");
        $this->configStorageCms->saveConfig(
            $key,
            $value);
    }

    /**
     * @param $keyValueArray
     * @throws Throwable
     */
    public function saveConfigs($keyValueArray)
    {
        $this->configStorageCms->saveConfigs($keyValueArray);
    }

    /**
     * Нельзя делать в конструкторе
     */
    public abstract function getDefaultConfig($key);

}