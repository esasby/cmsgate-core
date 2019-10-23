<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 01.10.2018
 * Time: 11:35
 */

namespace esas\cmsgate;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\view\admin\ConfigForm;
use esas\cmsgate\wrappers\ConfigWrapper;
use esas\cmsgate\wrappers\OrderWrapper;

/**
 * Реализация шаблона registry для удобства доступа к ConfigurationWrapper, OrderWrapper, Translator и т.д..
 * В каждой CMS должен быть обязательно наследован и проинициализирован через Registry->init()
 * Class Registry
 * @package esas\cmsgate
 */
abstract class Registry
{
    protected $configWrapper;
    protected $translator;
    protected $configForm;

    public function init() {
        global $esasRegistry;
        if ($esasRegistry == null) {
            Logger::getLogger(get_class($this))->debug("init");
            $esasRegistry = $this;
        }
    }

    /**
     * @return ConfigWrapper
     */
    public function getConfigWrapper()
    {
        if ($this->configWrapper == null)
            $this->configWrapper = $this->createConfigWrapper();
        return $this->configWrapper;
    }
    
    public abstract function createConfigWrapper();

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        if ($this->translator == null)
            $this->translator = $this->createTranslator();
        return $this->translator;
    }

    public abstract function createTranslator();

    public static function getRegistry() {
        /**
         * @var \esas\cmsgate\Registry $esasRegistry
         */
        global $esasRegistry;
        if ($esasRegistry == null) {
            Logger::getLogger("registry")->fatal("Esas registry is not initialized!");
        }
        return $esasRegistry;
    }

    /**
     * По локальному номеру счета (номеру заказа) возвращает wrapper
     * @param $orderId
     * @return OrderWrapper
     */
    public abstract function getOrderWrapper($orderId);

    /**
     * Получение формы с настройками сделано через Registry, т.к. в некоторых CMS создание формы и ее валидация разнесены в разные хуки
     * @return ConfigForm
     */
    public function getConfigForm()
    {
        if ($this->configForm == null)
            $this->configForm = $this->createConfigForm();
        return $this->configForm;
    }

    public abstract function createConfigForm();

    /**
     * Машинное название платежной системы
     * @return string
     */
    public abstract function getPaySystemName();
}